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

            $user = auth();
            (new NewsPostModel())->update($id, [
                'headline'          => $data['headline'],
                'slug'              => $slug,
                'sub_author_id'      => $data['subauthor'] ?: null,
                'short_description' => $data['shortDesc'],
                'description'       => $data['description'],
                'status'            => $data['status'],
                'post_date_time'    => $data['post_date_time'],
                'author'            => $user->id(),
            ]);

            $this->syncPivot(new NewsPostCategoryModel(), $id, 'category_id', $data['categories']);
            $this->syncPivot(new NewsPostSubCategoryModel(), $id, 'sub_category_id', $data['subcategories']);
            $this->syncPivot(new NewsPostChildCategoryModel(), $id, 'child_category_id', $data['childcategories']);
            $this->syncPivot(new NewsPostTagModel(), $id, 'tag_id', $data['tags']);

            $this->handleThumbnail($id, $data);

            $db->transCommit();

            return $this->successResponse($data['status']);
        } catch (\Throwable $e) {

            $db->transRollback();
            return $this->failResponse($e->getMessage());
        }
    }

    private function getPostOrFail(int $id)
    {
        $post = (new NewsPostModel())->find($id);

        if (!$post) {
            throw new \Exception('Post not found.');
        }

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
            'childcategories' => array_unique(array_map('intval', (array)($req['childcategories'] ?? []))),
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
        $existing = $model->where('news_post_id', $postId)->first();

        // If removed explicitly
        if ($data['thumbRemoved']) {
            if ($existing) {
                $model->where('news_post_id', $postId)->delete();
            }
            return;
        }

        $type = null;
        $url  = null;

        // Image upload
        if ($data['thumbType'] === 'image') {

            $file = $this->request->getFile('thumbnail_image');

            //  If no new file uploaded → KEEP OLD
            if (!$file || $file->getError() === 4) {
                return;
            }

            $newUrl = uploadImage($file);

            //  Upload failed → KEEP OLD
            if (!$newUrl) {
                return;
            }

            $type = 'image';
            $url  = $newUrl;
        }

        //  Link
        elseif ($data['thumbType'] === 'link' && $data['thumbLink']) {
            $type = 'link';
            $url  = $data['thumbLink'];
        }

        //  Media
        elseif ($data['thumbType'] === 'media' && $data['selectedMedia']) {
            $type = 'media';
            $url  = $data['selectedMedia'];
        }

        //  Replace only if new data exists
        if ($type && $url) {

            if ($existing) {
                $model->where('news_post_id', $postId)->delete();
            }

            $model->insert([
                'news_post_id'  => $postId,
                'type'          => $type,
                'thumbnail_url' => $url
            ]);
        }
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

    private function successResponse($status)
    {
        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'Post updated successfully',
            'status' => $status,
            'redirect' => $status == 1 ? base_url('admin/published-news') : base_url('admin/draft-news')
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
