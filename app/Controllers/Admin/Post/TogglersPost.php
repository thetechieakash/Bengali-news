<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\NewsPostModel;
use CodeIgniter\I18n\Time;

class TogglersPost extends BaseController
{
    public function updateStatus()
    {
        $data = $this->request->getJSON(true);

        $id    = (int) ($data['id'] ?? 0);
        $value = isset($data['value']) ? (int) $data['value'] : null;

        /* -----------------------------
     * 1. BASIC VALIDATION
     * ----------------------------- */
        if ($id <= 0 || !in_array($value, [0, 1], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $postModel = new NewsPostModel();
        $post = $postModel->find($id);

        if (!$post) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'News post not found'
            ]);
        }

        /* -----------------------------
     * 2. STATUS + DATE RULES (FINAL)
     * ----------------------------- */
        if ($value === 1) {
            // PUBLISH
            $update = [
                'status' => 1,
                'post_date_time' => Time::now()->toDateTimeString()
            ];
        } else {
            // UNPUBLISH
            $update = [
                'status' => 0,
                'post_date_time' => null
            ];
        }

        /* -----------------------------
     * 3. UPDATE
     * ----------------------------- */
        try {
            if ($postModel->update($id, $update) === false) {
                throw new \Exception(json_encode($postModel->errors()));
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => $value
                    ? 'News published successfully'
                    : 'News unpublished successfully'
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status',
                'debug'   => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }
}
