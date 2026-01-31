<?php

namespace App\Controllers\Admin;

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

class PostController extends BaseController
{
    public function index()
    {
        $newsModel = new NewsPostModel();
        $data = [
            'pageTitle' => 'News',
            'news' => $newsModel
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];
        return view('admin/AllNews', $data);
    }

    public function news()
    {
        $catModel = new Categories();
        $data = [
            'pageTitle' => 'Create News',
            'categories' => $catModel
                ->where('status', 1)
                ->orderBy('cat', 'ASC')
                ->findAll()
        ];
        return view('admin/CreateNews', $data);
    }

    public function createNewsPost()
    {
        // $request = $this->request;
        $request = $this->request->getPost();

        /* ---------------------------------
     * 1. COLLECT & NORMALIZE INPUT
     * --------------------------------- */
        $data = [
            'headline'        => trim($request['headline']),
            'shortDesc'       => trim($request['shortdescription']),
            'description'     => trim($request['description']),
            'tags'            => trim($request['tags']),
            'postDateRaw'     => trim($request['date']),
            'categories'      => (array) $request['categories'],
            'subCategories'   => isset($request['subcategories']) ? (array) $request['subcategories'] : [],
            'thumbnailType'   => $request['thumbnail_type'],
            'thumbnailLink'   => trim($request['thumbnail_link']),
        ];
        $status = 0;
        /* ---------------------------------
     * 2. VALIDATION (FAST FAIL)
     * --------------------------------- */
        $errors = [];

        /* ---- REQUIRED ---- */
        if ($data['headline'] === '') {
            $errors['headline'] = 'Headline is required';
        }

        if ($data['description'] === '') {
            $errors['description'] = 'Description is required';
        }

        if (empty($data['categories'])) {
            $errors['categories'] = 'At least one category is required';
        }

        /* ---- OPTIONAL VALIDATION ---- */
        if (!in_array($data['thumbnailType'], ['link', 'image'], true)) {
            $errors['thumbnail_type'] = 'Invalid thumbnail type';
        }

        if ($data['thumbnailType'] === 'link' && $data['thumbnailLink'] && !filter_var($data['thumbnailLink'], FILTER_VALIDATE_URL)) {
            $errors['thumbnail_link'] = 'Invalid thumbnail URL';
        }

        if (!empty($errors)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $errors
            ]);
        }

        /* ---------------------------------
     * 3. VALIDATE SUBCATEGORY OWNERSHIP
     * --------------------------------- */
        if (!empty($data['subCategories'])) {
            $validSubCats = (new SubCategories())
                ->whereIn('id', $data['subCategories'])
                ->whereIn('cat_id', $data['categories'])
                ->countAllResults();

            if ($validSubCats !== count($data['subCategories'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors'  => [
                        'subcategories' => 'Invalid subcategory selection'
                    ]
                ]);
            }
        }

        /* ---------------------------------
     * 4. SLUG GENERATION
     * --------------------------------- */
        $slugHelper = new Slug();
        $postModel  = new NewsPostModel();

        $baseSlug = $slugHelper->slugify($data['headline']);
        $slug     = $baseSlug;
        $counter  = 1;

        while ($postModel->where('slug', $slug)->countAllResults()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        /* ---------------------------------
     * 5. DATE HANDLING
     * --------------------------------- */
        $postDateTime = null;
        if ($data['postDateRaw']) {
            $dt = \DateTime::createFromFormat('d/m/Y H:i', $data['postDateRaw']);
            if ($dt !== false) {
                $postDateTime = $dt->format('Y-m-d H:i:s');
            }
            if ($dt < new \DateTime()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors'  => [
                        'date' => 'Post date must be in the future'
                    ]
                ]);
            }
        }

        /* ---------------------------------
     * 6. TRANSACTION START
     * --------------------------------- */
        $db = db_connect();
        $db->transBegin();

        try {

            /* -------- MAIN POST -------- */
            $postId = $postModel->insert([
                'headline'          => $data['headline'],
                'slug'              => $slug,
                'author'            => session('admin_name') ?? auth()->id() ?? auth()->user()->getEmail(),
                'post_date_time'    => $postDateTime,
                'short_description' => $data['shortDesc'],
                'description'       => $data['description'],
                'status'            => 0,
            ]);

            if (!$postId) {
                throw new \Exception(json_encode($postModel->errors()));
            }

            /* -------- CATEGORIES -------- */
            $catPivot = new NewsPostCategoryModel();
            foreach ($data['categories'] as $catId) {
                if ($catPivot->insert([
                    'news_post_id' => $postId,
                    'category_id'  => $catId
                ]) === false) {
                    throw new \Exception(json_encode($catPivot->errors()));
                }
            }

            /* -------- SUBCATEGORIES -------- */
            if (!empty($data['subCategories'])) {
                $subPivot = new NewsPostSubCategoryModel();
                foreach ($data['subCategories'] as $subId) {
                    if ($subPivot->insert([
                        'news_post_id'    => $postId,
                        'sub_category_id' => $subId
                    ]) === false) {
                        throw new \Exception(json_encode($subPivot->errors()));
                    }
                }
            }

            /* -------- TAGS -------- */
            $tagModel     = new TagModel();
            $postTagModel = new NewsPostTagModel();
            $tags         = array_unique(array_filter(array_map('trim', explode(',', $data['tags']))));

            foreach ($tags as $tagName) {
                $tag = $tagModel->where('name', $tagName)->first();
                $tagId = $tag ? $tag['id'] : $tagModel->insert(['name' => $tagName]);

                if (!$tagId) {
                    throw new \Exception(json_encode($tagModel->errors()));
                }

                $postTagModel->insert([
                    'news_post_id' => $postId,
                    'tag_id'       => $tagId,
                ]);
            }

            /* -------- THUMBNAIL -------- */
            if ($data['thumbnailType'] === 'image') {
                $file = $this->request->getFile('thumbnail_image');

                if (!$file || !$file->isValid()) {
                    throw new \Exception('Invalid thumbnail file');
                }
                // month-wise folder: 01_26
                $monthFolder = date('m_y');

                $uploadPath = ROOTPATH . 'public/uploads/posts/thumbnails/' . $monthFolder;

                // ensure directory exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }

                $uploader = new FileUploader($uploadPath);
                $upload   = $uploader->upload($file);

                if (!$upload['status']) {
                    throw new \Exception($upload['message']);
                }

                $thumbUrl = base_url('uploads/posts/thumbnails/' . $monthFolder . '/' . $upload['file_name']);
            } else {
                $thumbUrl = $data['thumbnailLink'];
            }

            $thumbModel = new NewsPostThumbnailModel();
            if ($thumbModel->insert([
                'news_post_id'  => $postId,
                'type'          => $data['thumbnailType'],
                'thumbnail_url' => $thumbUrl,
            ]) === false) {
                throw new \Exception(json_encode($thumbModel->errors()));
            }

            /* -------- COMMIT -------- */
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'success'  => true,
                'message' => 'News post saved successfully',
                'redirect' => base_url('admin/news/update/' . $postId)
            ]);
        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to create news',
                'debug'   => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }

    public function updateNews($id)
    {
        $catModel = new Categories();
        $newsModel = new NewsPostModel();
        $data = [
            'pageTitle' => 'Update News',
            'update' => true,
            'post' => $newsModel->getPostForEdit($id),
            'categories' => $catModel
                ->where('status', 1)
                ->orderBy('cat', 'ASC')
                ->findAll()
        ];

        return view('admin/UpdateNews', $data);
    }

    public function updateNewsPost($id)
    {
        $request = $this->request->getPost();

        /* ---------------------------------
     * 1. COLLECT & NORMALIZE INPUT
     * --------------------------------- */
        $data = [
            'headline'        => trim($request['headline'] ?? ''),
            'shortDesc'       => trim($request['shortdescription'] ?? ''),
            'description'     => trim($request['description'] ?? ''),
            'tags'            => trim($request['tags'] ?? ''),
            'postDateRaw'     => trim($request['date'] ?? ''),
            'categories'      => array_unique((array) ($request['categories'] ?? [])),
            'subCategories'   => array_unique((array) ($request['subcategories'] ?? [])),
            'thumbnailType'   => $request['thumbnail_type'] ?? 'link',
            'thumbnailLink'   => trim($request['thumbnail_link'] ?? ''),
        ];

        /* ---------------------------------
     * 2. VALIDATION
     * --------------------------------- */
        $errors = [];

        /* ---- REQUIRED ---- */
        if ($data['headline'] === '') {
            $errors['headline'] = 'Headline is required';
        }

        if ($data['description'] === '') {
            $errors['description'] = 'Description is required';
        }

        if (empty($data['categories'])) {
            $errors['categories'] = 'At least one category is required';
        }

        /* ---- OPTIONAL ---- */
        if (!in_array($data['thumbnailType'], ['link', 'image'], true)) {
            $errors['thumbnail_type'] = 'Invalid thumbnail type';
        }

        if ($data['thumbnailType'] === 'link' && $data['thumbnailLink'] && !filter_var($data['thumbnailLink'], FILTER_VALIDATE_URL)) {
            $errors['thumbnail_link'] = 'Invalid thumbnail URL';
        }

        if ($errors) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $errors
            ]);
        }


        /* ---------------------------------
     * 3. VALIDATE SUBCATEGORY OWNERSHIP
     * --------------------------------- */
        if (!empty($data['subCategories'])) {
            $validSubCats = (new SubCategories())
                ->whereIn('id', $data['subCategories'])
                ->whereIn('cat_id', $data['categories'])
                ->countAllResults();

            if ($validSubCats !== count($data['subCategories'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid subcategory selection'
                ]);
            }
        }


        /* ---------------------------------
     * 4. DATE
     * --------------------------------- */
        $postDateTime = null;

        if (!empty($data['postDateRaw'])) {

            $dt = \DateTime::createFromFormat('d/m/Y H:i', $data['postDateRaw']);

            if ($dt !== false) {
                $postDateTime = $dt->format('Y-m-d H:i:s'); // adds :00 seconds
            }
            if ($dt < new \DateTime()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors'  => [
                        'date' => 'Post date must be in the future'
                    ]
                ]);
            }
        }

        /* ---------------------------------
     * 5. TRANSACTION
     * --------------------------------- */
        $db = db_connect();
        $db->transBegin();

        try {
            $postModel = new NewsPostModel();
            $post      = $postModel->find($id);

            if (!$post) {
                throw new \Exception('Post not found');
            }

            /* -------- SLUG (only if headline changed) -------- */
            $slug = $post['slug'];

            if ($post['headline'] !== $data['headline']) {
                $slugHelper = new Slug();
                $baseSlug = $slugHelper->slugify($data['headline']);
                $slug = $baseSlug;
                $i = 1;

                while (
                    $postModel
                    ->where('slug', $slug)
                    ->where('id !=', $id)
                    ->countAllResults()
                ) {
                    $slug = $baseSlug . '-' . $i++;
                }
            }

            /* -------- UPDATE MAIN POST -------- */
            $postModel->update($id, [
                'headline'          => $data['headline'],
                'slug'              => $slug,
                'short_description' => $data['shortDesc'],
                'description'       => $data['description'],
                'post_date_time'    => $postDateTime,
            ]);

            /* -------- SYNC CATEGORIES -------- */
            $catPivot = new NewsPostCategoryModel();
            $catPivot->where('news_post_id', $id)->delete();

            foreach ($data['categories'] as $catId) {
                $catPivot->insert([
                    'news_post_id' => $id,
                    'category_id'  => $catId
                ]);
            }

            /* -------- SYNC SUBCATEGORIES -------- */
            $subPivot = new NewsPostSubCategoryModel();
            $subPivot->where('news_post_id', $id)->delete();

            if (!empty($data['subCategories'])) {
                foreach ($data['subCategories'] as $subId) {
                    $subPivot->insert([
                        'news_post_id'    => $id,
                        'sub_category_id' => $subId
                    ]);
                }
            }


            /* -------- SYNC TAGS -------- */
            $postTagModel = new NewsPostTagModel();
            $tagModel     = new TagModel();

            $postTagModel->where('news_post_id', $id)->delete();

            $tags = array_unique(array_filter(array_map(
                'trim',
                explode(',', $data['tags'])
            )));

            foreach ($tags as $tagName) {
                $tag = $tagModel->where('name', $tagName)->first();
                $tagId = $tag ? $tag['id'] : $tagModel->insert(['name' => $tagName]);

                if (!$tagId) {
                    throw new \Exception('Tag insert failed');
                }

                $postTagModel->insert([
                    'news_post_id' => $id,
                    'tag_id'       => $tagId
                ]);
            }

            /* -------- THUMBNAIL -------- */
            $folderDate = $postDateTime
                ? date('m_y', strtotime($postDateTime))
                : date('m_y');

            $uploadBasePath = ROOTPATH . 'public/uploads/posts/thumbnails/' . $folderDate;

            if (!is_dir($uploadBasePath)) {
                mkdir($uploadBasePath, 0775, true);
            }

            $thumbModel = new NewsPostThumbnailModel();
            $thumb = $thumbModel->where('news_post_id', $id)->first();

            $thumbnailRemoved = (int) ($request['thumbnail_removed'] ?? 0);
            $file = $this->request->getFile('thumbnail_image');

            /* ---- CASE 1: USER REMOVED THUMBNAIL ---- */
            if ($thumbnailRemoved === 1 && $thumb) {

                // delete file if it exists and is local
                if ($thumb['type'] === 'image' && $thumb['thumbnail_url']) {
                    $oldPath = ROOTPATH . 'public/' . parse_url($thumb['thumbnail_url'], PHP_URL_PATH);
                    if (is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $thumbModel->delete($thumb['id']);
            }
            /* ---- CASE 2: USER UPLOADED NEW IMAGE ---- */ elseif ($data['thumbnailType'] === 'image' && $file && $file->isValid()) {


                // remove old file first
                if ($thumb && $thumb['type'] === 'image') {
                    $oldPath = ROOTPATH . 'public/' . parse_url($thumb['thumbnail_url'], PHP_URL_PATH);
                    if (is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $uploader = new FileUploader($uploadBasePath);
                $upload = $uploader->upload($file);

                if (!$upload['status']) {
                    throw new \Exception($upload['message']);
                }

                $thumbUrl = base_url('uploads/posts/thumbnails/' . $folderDate . '/' . $upload['file_name']);


                $thumb
                    ? $thumbModel->update($thumb['id'], [
                        'type' => 'image',
                        'thumbnail_url' => $thumbUrl
                    ])
                    : $thumbModel->insert([
                        'news_post_id' => $id,
                        'type' => 'image',
                        'thumbnail_url' => $thumbUrl
                    ]);
            }

            /* ---- CASE 3: USER SWITCHED TO LINK ---- */ elseif ($data['thumbnailType'] === 'link' && $data['thumbnailLink']) {

                // delete old image if exists
                if ($thumb && $thumb['type'] === 'image') {
                    $oldPath = ROOTPATH . 'public/' . parse_url($thumb['thumbnail_url'], PHP_URL_PATH);
                    if (is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $thumb
                    ? $thumbModel->update($thumb['id'], [
                        'type' => 'link',
                        'thumbnail_url' => $data['thumbnailLink']
                    ])
                    : $thumbModel->insert([
                        'news_post_id' => $id,
                        'type' => 'link',
                        'thumbnail_url' => $data['thumbnailLink']
                    ]);
            }

            /* ---- CASE 4: USER DID NOTHING ---- */
            // DO NOTHING → thumbnail stays as-is


            $db->transComplete();

            return $this->response->setJSON([
                'success'  => true,
                'message'  => 'News updated successfully',
                'redirect' => base_url('admin/all-news')
            ]);
        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update news',
                'debug'   => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }

    public function deleteNewsPost($id)
    {
        $db = db_connect();
        $db->transBegin();

        try {
            $postModel  = new NewsPostModel();
            $thumbModel = new NewsPostThumbnailModel();

            $post = $postModel->find($id);

            if (!$post) {
                throw new \Exception('Post not found');
            }

            /* -------- DELETE THUMBNAIL FILE -------- */
            $thumb = $thumbModel->where('news_post_id', $id)->first();

            if ($thumb && $thumb['type'] === 'image' && str_contains($thumb['thumbnail_url'], base_url())) {
                $path = ROOTPATH . 'public/' . ltrim(parse_url($thumb['thumbnail_url'], PHP_URL_PATH), '/');
                if (is_file($path)) {
                    unlink($path);
                }
            }


            /* -------- DELETE PIVOT DATA -------- */
            (new NewsPostCategoryModel())->where('news_post_id', $id)->delete();
            (new NewsPostSubCategoryModel())->where('news_post_id', $id)->delete();
            (new NewsPostTagModel())->where('news_post_id', $id)->delete();
            $thumbModel->where('news_post_id', $id)->delete();

            /* -------- DELETE POST -------- */
            $postModel->delete($id);

            $db->transCommit();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }
            return $this->response->setJSON([
                'success' => true,
                'message' => 'News deleted successfully'
            ]);
        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete news',
                'debug'   => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }
}
