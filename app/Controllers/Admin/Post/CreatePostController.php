<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\{
    NewsPostModel,
    NewsPostCategoryModel,
    NewsPostSubCategoryModel,
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
            'tags'          => array_unique(array_map('intval', (array)($req['tags'] ?? []))),
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
        $user = auth()->user();

        return (new NewsPostModel())->insert([
            'headline'          => $data['headline'],
            'slug'              => $slug,
            'sub_author_id'     => $data['subauthor'] ?: null,
            'short_description' => $data['shortDesc'],
            'description'       => $data['description'],
            'status'            => 0,
            'post_date_time'    => null,
            'author'            => $user ? ($user->username ?? $user->getEmail()) : 'system',
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
            $url  = $this->uploadImage();
            $type = $url ? 'image' : null;
        }

        if ($data['thumbType'] === 'link' && $data['thumbLink']) {
            $type = 'link';
            $url  = $data['thumbLink'];
        }

        if ($data['thumbType'] === 'media' && $data['selectedMedia']) {
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

    private function uploadImage(): ?string
    {
        $file = $this->request->getFile('thumbnail_image');

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        if (!str_starts_with($file->getMimeType(), 'image/')) {
            throw new \Exception('Invalid image type.');
        }

        $folder = date('m_y');
        $path   = FCPATH . "uploads/posts/thumbnails/$folder/";

        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $newName = $file->getRandomName();
        $file->move($path, $newName);

        $relativePath = "uploads/posts/thumbnails/$folder/$newName";

        (new MediaModel())->insert([
            'file_name' => $newName,
            'file_path' => $relativePath,
            'file_type' => 'image',
            'folder'    => $folder,
            'file_size' => $file->getSize()
        ]);

        return $relativePath;
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
