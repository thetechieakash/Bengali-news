<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\{
    NewsPostModel,
    NewsPostCategoryModel,
    NewsPostSubCategoryModel,
    NewsPostChildCategoryModel,
    NewsPostTagModel,
    NewsPostThumbnailModel
};

class DeletePostController extends BaseController
{
    public function deletePost(int $id)
    {
        $db = db_connect();
        $db->transBegin();

        try {

            $postModel = new NewsPostModel();

            $post = $postModel->find($id);

            if (!$post) {
                throw new \Exception('Post not found');
            }

            /* -------- DELETE TAXONOMY RELATIONS -------- */

            (new NewsPostCategoryModel())
                ->where('news_post_id', $id)
                ->delete();

            (new NewsPostSubCategoryModel())
                ->where('news_post_id', $id)
                ->delete();

            (new NewsPostChildCategoryModel())
                ->where('news_post_id', $id)
                ->delete();

            (new NewsPostTagModel())
                ->where('news_post_id', $id)
                ->delete();

            /* -------- DELETE THUMBNAIL -------- */

            (new NewsPostThumbnailModel())
                ->where('news_post_id', $id)
                ->delete();

            /* -------- DELETE POST -------- */

            $postModel->delete($id);

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Post deleted successfully'
            ]);
        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete post',
                'debug'   => ENVIRONMENT !== 'production'
                    ? $e->getMessage()
                    : null
            ]);
        }
    }
}
