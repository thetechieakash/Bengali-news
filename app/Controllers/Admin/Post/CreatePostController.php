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

class CreatePostController extends BaseController
{
    public function createPost()
    {
        $db = db_connect();
        $db->transBegin();

        try {
            $request = $this->request->getPost();

            /* -----------------------------
         * 1. NORMALIZE INPUT
         * ----------------------------- */
            $headline   = trim($request['headline'] ?? '');
            $shortDesc  = trim($request['shortdescription'] ?? '');
            $desc       = trim($request['description'] ?? '');
            $categories = array_values(array_unique(array_map('intval', (array) ($request['categories'] ?? []))));
            $subCats    = array_values(array_unique(array_map('intval', (array) ($request['subcategories'] ?? []))));
            $thumbType  = $request['thumbnail_type'] ?? 'link';
            $thumbLink  = trim($request['thumbnail_link'] ?? '');

            // tags (predefined)
            $tags = array_values(array_unique(
                array_map('intval', (array) ($request['tags'] ?? []))
            ));

            /* -----------------------------
            * 2. BASIC VALIDATION
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
            *  VALIDATE CATEGORIES
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

            /*-----------------------------
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
            $slug = (new Slug())->slugify($headline);
            $this->assertUniqueSlug($slug);

            /* -----------------------------
            * 5. CREATE POST (DRAFT)
            * ----------------------------- */
            $user = auth()->user();
            $postId = (new NewsPostModel())->insert([
                'headline'          => $headline,
                'slug'              => $slug,
                'short_description' => $shortDesc,
                'description'       => $desc,
                'status'            => 0,
                'post_date_time'    => null,
                'author'            => $user ? ($user->username ?? $user->getEmail()) : 'system',
            ], true);

            /* -----------------------------
            * 6. CATEGORIES
            * ----------------------------- */
            $catPivot = new NewsPostCategoryModel();
            foreach ($categories as $catId) {
                $catPivot->insert([
                    'news_post_id' => $postId,
                    'category_id'  => $catId
                ]);
            }

            /* -----------------------------
            * 7. SUB-CATEGORIES
            * ----------------------------- */
            if ($subCats) {
                $subPivot = new NewsPostSubCategoryModel();
                foreach ($subCats as $subId) {
                    $subPivot->insert([
                        'news_post_id'    => $postId,
                        'sub_category_id' => $subId
                    ]);
                }
            }

            /* -----------------------------
            * 8. TAGS (ATTACH ONLY)
            * ----------------------------- */
            if ($tags) {
                $postTagModel = new NewsPostTagModel();

                foreach ($tags as $tagId) {
                    $postTagModel->insert([
                        'news_post_id' => $postId,
                        'tag_id'       => $tagId
                    ]);
                }
            }

            /* -----------------------------
            * 9. THUMBNAIL
            * ----------------------------- */
            if ($thumbType === 'image') {
                $file = $this->request->getFile('thumbnail_image');

                if (!$file || !$file->isValid()) {
                    throw new \Exception('Invalid thumbnail image');
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

                $thumbUrl = base_url("uploads/posts/thumbnails/$folder/" . $upload['file_name']);
            } else {
                $thumbUrl = $thumbLink;
            }

            (new NewsPostThumbnailModel())->insert([
                'news_post_id'  => $postId,
                'type'          => $thumbType,
                'thumbnail_url' => $thumbUrl
            ]);

            /* -----------------------------
            * 10. COMMIT
            * ----------------------------- */
            $db->transCommit();

            return $this->response->setJSON([
                'success'  => true,
                'message'  => 'Post saved as draft',
                'redirect' => base_url("admin/news/update/$postId")
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
            throw new \Exception('Slug already exists. Please change headline.');
        }
    }
}
