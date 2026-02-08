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

class DeletePostController extends BaseController
{
    public function deletePost($id)
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
                $path = ROOTPATH . 'public' . ltrim(parse_url($thumb['thumbnail_url'], PHP_URL_PATH), '/');
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
