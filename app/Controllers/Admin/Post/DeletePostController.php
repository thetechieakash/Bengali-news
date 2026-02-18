<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\NewsPostModel;
use App\Models\NewsPostCategoryModel;
use App\Models\NewsPostSubCategoryModel;
use App\Models\NewsPostTagModel;
use App\Models\NewsPostThumbnailModel;

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
