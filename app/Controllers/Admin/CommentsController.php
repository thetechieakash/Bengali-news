<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsPostCommentModel;


class CommentsController extends BaseController
{
    public function approved()
    {
        $highlightId = $this->request->getGet('highlight');
        $commentsModel = new NewsPostCommentModel();
        $comments = $commentsModel->getCommentsWithAdminReply(active: true);
        $data = [
            'pageTitle' => 'Comments',
            'comments' => $comments,
            'highlightId' => $highlightId
        ];
        return view('admin/ApprovedComments', $data);
    }
    public function pending()
    {
        $highlightId = $this->request->getGet('highlight');
        $commentsModel = new NewsPostCommentModel();
        $comments = $commentsModel->getCommentsWithAdminReply(active: false);
        $data = [
            'pageTitle' => 'Comments',
            'comments' => $comments,
            'highlightId' => $highlightId
        ];
        return view('admin/PendingComments', $data);
    }

    public function store()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        try {
            $commentId = (int) $this->request->getPost('comment_id');
            $reply     = trim($this->request->getPost('reply'));

            if ($commentId <= 0 || $reply === '') {
                throw new \Exception('Invalid input');
            }

            $model = new NewsPostCommentModel();

            // Parent comment
            $parent = $model->find($commentId);
            if (!$parent) {
                throw new \Exception('Comment not found');
            }

            // Auth user
            $user = auth()->user();
            $adminName  = $user ? ($user->username ?? $user->getEmail()) : 'system';
            $adminEmail = $user ? $user->getEmail() : 'system@autoreply';

            // Existing admin reply?
            $existingReply = $model
                ->where('parent_id', $commentId)
                ->where('is_admin_reply', 1)
                ->first();

            $data = [
                'news_post_id'   => $parent['news_post_id'],
                'parent_id'      => $commentId,
                'comment'        => $reply,
                'status'         => 1,
                'is_admin_reply' => 1,
                'guest_name'     => $adminName,
                'guest_email'    => $adminEmail,
            ];

            if ($existingReply) {

                // UPDATE reply
                if (!$model->update($existingReply['id'], $data)) {
                    throw new \Exception('Failed to update reply');
                }

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Reply updated successfully'
                ]);
            }

            // INSERT reply
            if (!$model->insert($data)) {
                throw new \Exception('Failed to post reply');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Reply posted successfully'
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function approve()
    {
        if (!$this->request->isAJAX()) {
            return $this->jsonFail('Invalid request');
        }

        $id = (int) $this->request->getPost('id');

        if (!$id) {
            return $this->jsonFail('Invalid comment');
        }

        $model = new NewsPostCommentModel();
        $model->update($id, ['status' => 1]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Comment approved'
        ]);
    }

    public function unpublish()
    {
        if (!$this->request->isAJAX()) {
            return $this->jsonFail('Invalid request');
        }

        $id = (int) $this->request->getPost('id');

        if (!$id) {
            return $this->jsonFail('Invalid comment');
        }

        $model = new NewsPostCommentModel();
        $model->update($id, ['status' => 0]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Comment unpublished'
        ]);
    }

    public function delete()
    {
        if (!$this->request->isAJAX()) {
            return $this->jsonFail('Invalid request');
        }

        $id = (int) $this->request->getPost('id');

        if (!$id) {
            return $this->jsonFail('Invalid comment');
        }

        $model = new NewsPostCommentModel();
        $model->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Comment deleted'
        ]);
    }
    public function getPostComment()
    {
        $newsId = $this->request->getGet('id');
        $type   = $this->request->getGet('type');

        if (!$newsId || !$type) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid request'
            ]);
        }

        $commentModel = new NewsPostCommentModel();

        $status = ($type === 'approve') ? 1 : 0;

        $comments = $commentModel
            ->where('news_post_id', $newsId)
            ->where(['status' => $status, 'parent_id' => null])
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'comments' => $comments
        ]);
    }
    private function jsonFail($msg)
    {
        return $this->response->setJSON(['success' => false, 'message' => $msg]);
    }
}
