<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Helpers\FileUploader;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\NewsPostModel;
use App\Models\NewsPostCategoryModel;
use App\Models\NewsPostSubCategoryModel;
use App\Models\TagModel;
use App\Models\NewsPostTagModel;
use App\Models\NewsPostThumbnailModel;
use CodeIgniter\I18n\Time;

class UpdatePostController extends BaseController
{
    public function updatePost(int $id)
    {
        $db = db_connect();
        $db->transBegin();

        try {
            $postModel = new NewsPostModel();
            $post = $postModel->find($id);

            if (!$post) {
                throw new \Exception('Post not found');
            }

            $request = $this->request->getPost();

            /* -----------------------------
             * 1. NORMALIZE INPUT
             * ----------------------------- */
            $headline   = trim($request['headline'] ?? '');
            $shortDesc  = trim($request['shortdescription'] ?? '');
            $desc       = trim($request['description'] ?? '');
            $categories = array_values(array_unique(array_map('intval', (array) ($request['categories'] ?? []))));
            $subCats = array_values(array_unique(array_map('intval', (array) ($request['subcategories'] ?? []))));
            $thumbType = $request['thumbnail_type'] ?? 'link';
            $thumbLink = trim($request['thumbnail_link'] ?? '');
            $newStatus = isset($request['status']) ? (int) $request['status'] : 0;

            if ($post['status'] == 1 && $newStatus == 0) {
                $newStatus = 1;
            }
            
            $tags = array_values(array_unique(array_map(
                'intval',
                (array) ($request['tags'] ?? [])
            )));


            /* -----------------------------
             * 2. VALIDATION
             * ----------------------------- */
            if ($headline === '' || $desc === '') {
                throw new \Exception('Headline and description are required');
            }

            if (empty($categories)) {
                throw new \Exception('At least one category is required');
            }

            if (!in_array($thumbType, ['link', 'image'], true)) {
                throw new \Exception('Invalid thumbnail type');
            }

            if (
                $thumbType === 'link' &&
                $thumbLink &&
                !filter_var($thumbLink, FILTER_VALIDATE_URL)
            ) {
                throw new \Exception('Invalid thumbnail URL');
            }

            /* -----------------------------
             * 3. VALIDATE CATEGORIES
             * ----------------------------- */
            $catCount = (new Categories())
                ->whereIn('id', $categories)
                ->where('status', 1)
                ->countAllResults();

            if ($catCount !== count($categories)) {
                throw new \Exception('Invalid category selected');
            }

            if ($subCats) {
                $subCount = (new SubCategories())
                    ->whereIn('id', $subCats)
                    ->whereIn('cat_id', $categories)
                    ->countAllResults();

                if ($subCount !== count($subCats)) {
                    throw new \Exception('Invalid subcategory selected');
                }
            }
            /* -----------------------------
             *  VALIDATE TAGS
             * ----------------------------- */
            if ($tags) {
                $tagCount = (new TagModel())
                    ->whereIn('id', $tags)
                    ->countAllResults();
                if ($tagCount !== count($tags)) {
                    throw new \Exception('Invalid tag selected');
                }
            }

            /* -----------------------------
             * 4. SLUG (STRICT UNIQUE)
             * ----------------------------- */
            $slug = $post['slug'];
            if ($post['headline'] !== $headline) {
                $slug = (new Slug())->slugify($headline);
                $this->assertUniqueSlug($slug, $id);
            }

            /* -----------------------------
             * 5. STATUS + DATE RULES
             * ----------------------------- */
            $postDate = $post['post_date_time'];

            // Draft → Publish (first time)
            if ($post['status'] == 0 && $newStatus == 1 && !$postDate) {
                $postDate = Time::now()->toDateTimeString();
            }

            // Unpublish → Publish again (frontend confirms)
            if ($post['status'] == 0 && $newStatus == 1 && $postDate) {
                $postDate = Time::now()->toDateTimeString();
            }

            /* -----------------------------
             * 6. UPDATE POST
             * ----------------------------- */
            $postModel->update($id, [
                'headline'          => $headline,
                'slug'              => $slug,
                'short_description' => $shortDesc,
                'description'       => $desc,
                'status'            => $newStatus,
                'post_date_time'    => $postDate,
            ]);

            /* -----------------------------
             * 7. SYNC CATEGORIES
             * ----------------------------- */
            $catPivot = new NewsPostCategoryModel();
            $catPivot->where('news_post_id', $id)->delete();

            if ($categories) {
                $catPivot->insertBatch(array_map(fn($catId) => [
                    'news_post_id' => $id,
                    'category_id'  => $catId
                ], $categories));
            }

            /* -----------------------------
             * 8. SYNC SUB-CATEGORIES
             * ----------------------------- */
            $subPivot = new NewsPostSubCategoryModel();
            $subPivot->where('news_post_id', $id)->delete();

            if ($subCats) {
                $subPivot->insertBatch(array_map(fn($subId) => [
                    'news_post_id'    => $id,
                    'sub_category_id' => $subId
                ], $subCats));
            }

            /* -----------------------------
             * 9. SYNC TAGS
             * ----------------------------- */
            $postTagModel = new NewsPostTagModel();
            $postTagModel->where('news_post_id', $id)->delete();

            if ($tags) {
                $postTagModel->insertBatch(array_map(fn($tagId) => [
                    'news_post_id' => $id,
                    'tag_id'       => $tagId
                ], $tags));
            }


            /* -----------------------------
            * 10. THUMBNAIL (SMART UPDATE)
            * ----------------------------- */
            $thumbModel = new NewsPostThumbnailModel();
            $oldThumb   = $thumbModel->where('news_post_id', $id)->first();

            $thumbRemoved = (int) ($request['thumbnail_removed'] ?? 0);

            // DEFAULT: keep old thumbnail
            $newThumbType = $oldThumb['type'] ?? null;
            $newThumbUrl  = $oldThumb['thumbnail_url'] ?? null;

            /**
             * CASE 1: User removed thumbnail explicitly
             */
            if ($thumbRemoved === 1) {
                if ($oldThumb && $oldThumb['type'] === 'image') {
                    $path = ROOTPATH . 'public/' . parse_url($oldThumb['thumbnail_url'], PHP_URL_PATH);
                    if (is_file($path)) {
                        unlink($path);
                    }
                }
                $newThumbType = null;
                $newThumbUrl  = null;
            }

            /**
             * CASE 2: User selected LINK
             */
            elseif ($thumbType === 'link' && !empty($thumbLink) && $thumbRemoved !== 1) {

                // delete old image if switching type
                if ($oldThumb && $oldThumb['type'] === 'image') {
                    $path = ROOTPATH . 'public/' . parse_url($oldThumb['thumbnail_url'], PHP_URL_PATH);
                    if (is_file($path)) {
                        unlink($path);
                    }
                }

                $newThumbType = 'link';
                $newThumbUrl  = trim($thumbLink);
            }

            /**
             * CASE 3: User uploaded IMAGE
             */
            elseif ($thumbType === 'image') {
                $file = $this->request->getFile('thumbnail_image');

                if ($file && $file->isValid()) {
                    $allowed = ['image/jpeg', 'image/png', 'image/webp'];
                    if (!in_array($file->getMimeType(), $allowed, true)) {
                        throw new \Exception('Invalid image type');
                    }

                    // delete old image
                    if ($oldThumb && $oldThumb['type'] === 'image') {
                        $path = ROOTPATH . 'public/' . parse_url($oldThumb['thumbnail_url'], PHP_URL_PATH);
                        if (is_file($path)) {
                            unlink($path);
                        }
                    }

                    $folder = date('m_y');
                    $path   = ROOTPATH . "public/uploads/posts/thumbnails/$folder";
                    if (!is_dir($path)) {
                        mkdir($path, 0775, true);
                    }

                    $upload = (new FileUploader($path))->upload($file);
                    if (!$upload['status']) {
                        throw new \Exception($upload['message']);
                    }

                    $newThumbType = 'image';
                    $newThumbUrl  = base_url("uploads/posts/thumbnails/$folder/" . $upload['file_name']);
                }
            }

            /**
             * FINAL SAVE
             */
            $thumbModel->where('news_post_id', $id)->delete();

            if ($newThumbType && $newThumbUrl) {
                $thumbModel->insert([
                    'news_post_id'  => $id,
                    'type'          => $newThumbType,
                    'thumbnail_url' => $newThumbUrl
                ]);
            }


            /* -----------------------------
             * 11. COMMIT
             * ----------------------------- */
            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Post updated successfully',
                'redirect' => base_url('admin/all-news')
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function assertUniqueSlug(string $slug, ?int $ignoreId = null): void
    {
        $model = new NewsPostModel();

        $query = $model->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id !=', $ignoreId);
        }

        if ($query->first()) {
            throw new \Exception('Slug already exists');
        }
    }
}
