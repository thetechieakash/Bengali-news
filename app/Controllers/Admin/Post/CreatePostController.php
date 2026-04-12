<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\{
    NewsPostModel,
    NewsPostCategoryModel,
    NewsPostSubCategoryModel,
    NewsPostChildCategoryModel,
    NewsPostTagModel,
    NewsPostThumbnailModel,
    MediaModel
};
use App\Helpers\Slug;

class CreatePostController extends BaseController
{
    public function createPost()
    {
        $db = db_connect();
        $db->transBegin();

        try {

            $data = $this->normalizeInput();
            $this->validatePost($data);

            $slug = (new Slug())->slugify($data['slug'] ?: $data['headline']);
            $this->assertUniqueSlug($slug);

            $postId = $this->insertPost($data, $slug);

            $this->syncPivot(new NewsPostCategoryModel(), $postId, 'category_id', $data['categories']);
            $this->syncPivot(new NewsPostSubCategoryModel(), $postId, 'sub_category_id', $data['subcategories']);
            $this->syncPivot(new NewsPostChildCategoryModel(), $postId, 'child_category_id', $data['childcategories']);
            $this->syncPivot(new NewsPostTagModel(), $postId, 'tag_id', $data['tags']);

            $this->handleThumbnail($postId, $data);

            $db->transCommit();

            return $this->successResponse("Post saved as draft", "admin/news/update/$postId");
        } catch (\Throwable $e) {

            $db->transRollback();
            return $this->failResponse($e->getMessage());
        }
    }

    private function normalizeInput(): array
    {
        $req = $this->request->getPost();

        return [
            'headline'      => trim($req['headline'] ?? ''),
            'slug'          => trim($req['slug'] ?? ''),
            'subauthor'     => intval($req['subauthor'] ?? 0),
            'shortDesc'     => trim($req['shortdescription'] ?? ''),
            'description'   => trim($req['description'] ?? ''),
            'categories'    => array_unique(array_map('intval', (array)($req['categories'] ?? []))),
            'subcategories' => array_unique(array_map('intval', (array)($req['subcategories'] ?? []))),
            'childcategories' => array_unique(array_map('intval', (array)($req['childcategories'] ?? []))),            'tags'          => array_unique(array_map('intval', (array)($req['tags'] ?? []))),
            'thumbType'     => $req['thumbnail_type'] ?? 'link',
            'thumbLink'     => trim($req['thumbnail_link'] ?? ''),
            'selectedMedia' => trim($req['selected_media'] ?? ''),
        ];
    }

    private function validatePost(array $data): void
    {
        if (!$data['headline'] || !$data['description']) {
            throw new \Exception('Headline and description required.');
        }

        if (empty($data['categories'])) {
            throw new \Exception('At least one category required.');
        }

        if (!in_array($data['thumbType'], ['link', 'image', 'media'], true)) {
            throw new \Exception('Invalid thumbnail type.');
        }

        if ($data['thumbType'] === 'image') {
            $file = $this->request->getFile('thumbnail_image');

            if (!$file || $file->getError() === 4) {
                throw new \Exception('Thumbnail image is required.');
            }
        }

        // MEDIA REQUIRED
        if ($data['thumbType'] === 'media') {
            if (empty($data['selectedMedia'])) {
                throw new \Exception('Please select media image.');
            }
        }
        if (
            $data['thumbType'] === 'link' &&
            $data['thumbLink'] &&
            !filter_var($data['thumbLink'], FILTER_VALIDATE_URL)
        ) {
            throw new \Exception('Invalid thumbnail URL.');
        }
    }

    private function insertPost(array $data, string $slug): int
    {
        $user = auth();

        return (new NewsPostModel())->insert([
            'headline'          => $data['headline'],
            'slug'              => $slug,
            'sub_author_id'     => $data['subauthor'] ?: null,
            'short_description' => $data['shortDesc'],
            'description'       => $data['description'],
            'status'            => 0,
            'post_date_time'    => null,
            'author'            => $user->id(),
        ], true);
    }

    private function syncPivot($model, int $postId, string $field, array $values): void
    {
        if (!$values) return;

        $model->insertBatch(array_map(fn($val) => [
            'news_post_id' => $postId,
            $field         => $val
        ], $values));
    }

    private function handleThumbnail(int $postId, array $data): void
    {
        $type = null;
        $url  = null;

        if ($data['thumbType'] === 'image') {
            $file = $this->request->getFile('thumbnail_image');

            // No file selected
            if (!$file || $file->getError() === 4) {
                throw new \Exception('Thumbnail image is required');
            }

            // Upload failed → stop everything
            $url = uploadImage($file);

            if (!$url) {
                throw new \Exception('Thumbnail upload failed');
            }

            $type = 'image';
        }

        if ($data['thumbType'] === 'link' && $data['thumbLink']) {
            $type = 'link';
            $url  = $data['thumbLink'];
        }

        if ($data['thumbType'] === 'media' && $data['selectedMedia']) {
            if (!$data['selectedMedia']) {
                throw new \Exception('Media image required');
            }
            $type = 'media';
            $url  = $data['selectedMedia'];
        }

        if ($type && $url) {
            (new NewsPostThumbnailModel())->insert([
                'news_post_id'  => $postId,
                'type'          => $type,
                'thumbnail_url' => $url
            ]);
        }
    }


    private function assertUniqueSlug(string $slug): void
    {
        if ((new NewsPostModel())->where('slug', $slug)->first()) {
            throw new \Exception('Slug already exists.');
        }
    }

    private function successResponse(string $message, string $redirect)
    {
        return $this->response->setJSON([
            'success'  => true,
            'message'  => $message,
            'redirect' => base_url($redirect)
        ]);
    }

    private function failResponse(string $message)
    {
        return $this->response->setJSON([
            'success' => false,
            'message' => $message
        ]);
    }
}
