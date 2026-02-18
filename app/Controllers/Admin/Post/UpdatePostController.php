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
use CodeIgniter\I18n\Time;

class UpdatePostController extends BaseController
{
    public function updatePost(int $id)
    {
        $db = db_connect();
        $db->transBegin();

        try {

            $post = $this->getPostOrFail($id);
            $data = $this->normalizeInput($post);

            $this->validatePost($data);

            $slug = (new Slug())->slugify($data['slug']);
            $this->assertUniqueSlug($slug, $id);

            $data = $this->applyStatusRules($post, $data);

            (new NewsPostModel())->update($id, [
                'headline'          => $data['headline'],
                'slug'              => $slug,
                'sub_author_id'      => $data['subauthor'] ?: null,
                'short_description' => $data['shortDesc'],
                'description'       => $data['description'],
                'status'            => $data['status'],
                'post_date_time'    => $data['post_date_time'],
            ]);

            $this->syncPivot(new NewsPostCategoryModel(), $id, 'category_id', $data['categories']);
            $this->syncPivot(new NewsPostSubCategoryModel(), $id, 'sub_category_id', $data['subcategories']);
            $this->syncPivot(new NewsPostTagModel(), $id, 'tag_id', $data['tags']);

            $this->handleThumbnail($id, $data);

            $db->transCommit();

            return $this->successResponse();
        } catch (\Throwable $e) {

            $db->transRollback();
            return $this->failResponse($e->getMessage());
        }
    }

    private function getPostOrFail(int $id)
    {
        $post = (new NewsPostModel())->find($id);
        if (!$post) throw new \Exception('Post not found.');
        return $post;
    }

    private function normalizeInput(array $post): array
    {
        $req = $this->request->getPost();

        return [
            'headline'      => trim($req['headline'] ?? ''),
            'slug'          => trim($req['slug'] ?? $post['slug']),
            'subauthor'     => intval($req['subauthor'] ?? 0),
            'shortDesc'     => trim($req['shortdescription'] ?? ''),
            'description'   => trim($req['description'] ?? ''),
            'categories'    => array_unique(array_map('intval', (array)($req['categories'] ?? []))),
            'subcategories' => array_unique(array_map('intval', (array)($req['subcategories'] ?? []))),
            'tags'          => array_unique(array_map('intval', (array)($req['tags'] ?? []))),
            'thumbType'     => $req['thumbnail_type'] ?? 'link',
            'thumbLink'     => trim($req['thumbnail_link'] ?? ''),
            'selectedMedia' => trim($req['selected_media'] ?? ''),
            'thumbRemoved'  => (int)($req['thumbnail_removed'] ?? 0),
            'status'        => isset($req['status']) ? (int)$req['status'] : (int)$post['status'],
        ];
    }

    private function applyStatusRules(array $post, array $data): array
    {
        $oldStatus = (int)$post['status'];
        $newStatus = (int)$data['status'];

        if ($oldStatus === 0 && $newStatus === 1) {
            $data['post_date_time'] = Time::now()->toDateTimeString();
        } else {
            $data['post_date_time'] = $post['post_date_time'];
        }

        if ($oldStatus === 1 && $newStatus === 0) {
            $data['status'] = 1;
        }

        return $data;
    }

    private function syncPivot($model, int $postId, string $field, array $values): void
    {
        $model->where('news_post_id', $postId)->delete();

        if (!$values) return;

        $model->insertBatch(array_map(fn($val) => [
            'news_post_id' => $postId,
            $field         => $val
        ], $values));
    }

    private function handleThumbnail(int $postId, array $data): void
    {
        $model = new NewsPostThumbnailModel();
        $model->where('news_post_id', $postId)->delete();

        if ($data['thumbRemoved']) return;

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
            $model->insert([
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

        if (!is_dir($path)) mkdir($path, 0775, true);

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

    private function validatePost(array $data): void
    {
        if (!$data['headline'] || !$data['description']) {
            throw new \Exception('Headline and description required.');
        }

        if (empty($data['categories'])) {
            throw new \Exception('At least one category required.');
        }
    }

    private function assertUniqueSlug(string $slug, int $ignoreId): void
    {
        $exists = (new NewsPostModel())
            ->where('slug', $slug)
            ->where('id !=', $ignoreId)
            ->first();

        if ($exists) {
            throw new \Exception('Slug already exists.');
        }
    }

    private function successResponse()
    {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Post updated successfully',
            'redirect' => base_url('admin/all-news')
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
