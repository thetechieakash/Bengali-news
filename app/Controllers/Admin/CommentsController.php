<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsPostCommentModel;
use App\Models\NewsPostModel;


class CommentsController extends BaseController
{
    public function approved()
    {
        $highlightId = $this->request->getGet('highlight');
        $data = [
            'pageTitle' => 'Comments',
            'status' => 1,
            'highlightId' => $highlightId
        ];
        return view('admin/Comments', $data);
    }
    public function pending()
    {
        $highlightId = $this->request->getGet('highlight');
        $data = [
            'pageTitle' => 'Comments',
            'status' => 0,
            'highlightId' => $highlightId
        ];
        return view('admin/Comments', $data);
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

    public function reply()
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

            $model    = new NewsPostCommentModel();
            $newsPost = new NewsPostModel();

            // Parent comment
            $parent = $model->find($commentId);

            if (!$parent) {
                throw new \Exception('Comment not found');
            }

            // Get post info
            $post = $newsPost
                ->select('slug, headline')
                ->where('id', $parent['news_post_id'])
                ->first();

            if (!$post) {
                throw new \Exception('Post not found');
            }

            // Generate comment link
            $commentLink = base_url('news/' . $post['slug'] . '#comment-' . $commentId);

            // Logged in admin
            $user = auth()->user();

            $adminName  = $user ? ($user->username ?? $user->getEmail()) : 'System';
            $adminEmail = $user ? $user->getEmail() : 'system@autoreply';

            // Check if admin already replied
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

                // Update existing reply
                if (!$model->update($existingReply['id'], $data)) {
                    throw new \Exception('Failed to update reply');
                }

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Reply updated successfully'
                ]);
            }

            // Insert new reply
            if (!$model->insert($data)) {
                throw new \Exception('Failed to post reply');
            }

            // Send email notification
            if (!empty($parent['guest_email'])) {
                $this->sendReplyEmail(
                    $parent['guest_email'],
                    $parent['guest_name'],
                    $post['headline'],
                    $commentLink
                );
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
        // $model->delete($id);
        $model->where('id', $id)
            ->orWhere('parent_id', $id)
            ->delete();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Comment deleted'
        ]);
    }

    public function fetchComments()
    {
        if (!$this->request->isAJAX()) {
            return $this->jsonFail('Invalid request');
        }

        $model = new NewsPostCommentModel();

        $draw   = (int) $this->request->getPost('draw');
        $start  = (int) $this->request->getPost('start');
        $length = (int) $this->request->getPost('length');

        $searchValue = $this->request->getPost('search')['value'] ?? '';
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDir = $this->request->getPost('order')[0]['dir'] ?? 'desc';

        $type = (int) $this->request->getPost('type');
        $status = ($type === 1) ? 1 : 0;

        $highlightId = (int) $this->request->getPost('highlight');

        $columns = [
            0 => 'news_post_comments.id',
            1 => 'news_post_comments.status',
            2 => 'news_post_comments.comment',
            3 => 'news_post_comments.guest_name',
            4 => 'news_post_comments.recaptcha_score',
            5 => 'news_post_comments.created_at',
        ];

        $orderColumn = $columns[$orderColumnIndex] ?? 'news_post_comments.created_at';

        $builder = $model
            ->select('
            news_post_comments.*,
            news_posts.slug,
            news_posts.status as post_status
        ')
            ->join('news_posts', 'news_posts.id = news_post_comments.news_post_id')
            ->where('news_post_comments.parent_id', null)
            ->where('news_post_comments.status', $status);

        // 🔍 SEARCH
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('news_post_comments.comment', $searchValue)
                ->orLike('news_post_comments.guest_name', $searchValue)
                ->orLike('news_post_comments.guest_email', $searchValue)
                ->groupEnd();
        }

        $totalRecords = $builder->countAllResults(false);
        $filteredRecords = $totalRecords;

        // Highlight priority
        if ($highlightId) {
            $builder->orderBy('news_post_comments.id = ' . $highlightId, 'DESC', false);
        }

        $builder->orderBy($orderColumn, $orderDir);

        $comments = $builder->findAll($length, $start);

        $data = [];
        $sl = $start;

        foreach ($comments as $row) {
            $sl++;

            $postUrl = ($row['post_status'] == 1)
                ? base_url('admin/published-news?highlight=' . $row['news_post_id'])
                : base_url('admin/draft-news?highlight=' . $row['news_post_id']);

            $data[] = [
                'DT_RowId'   => 'comment-row-' . $row['id'],
                'id'         => $row['id'],
                'sl'         => $sl,
                'status'     => (int)$row['status'],
                'comment'    => $row['comment'],
                'guest_name' => $row['guest_name'],
                'guest_email' => $row['guest_email'],
                'score'      => (float)$row['recaptcha_score'],
                'date'       => $row['created_at'],
                'post_url'   => $postUrl
            ];
        }

        return $this->response->setJSON([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    public function fetchReply()
    {
        if (!$this->request->isAJAX()) {
            return $this->jsonFail('Invalid request');
        }

        $id = $this->request->getPost('id');
        $commentModel = new NewsPostCommentModel();

        $reply = $commentModel->where(['parent_id' => $id, 'is_admin_reply' => 1])->first();

        if (empty($reply)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No reply'
            ]);
        }
        return $this->response->setJSON([
            'success' => true,
            'reply' => $reply
        ]);
    }

    public function deleteReply()
    {
        if (!$this->request->isAJAX()) {
            return $this->jsonFail('Invalid request');
        }

        $id = (int) $this->request->getPost('id');

        if (!$id) {
            return $this->jsonFail('Invalid comment');
        }

        $model = new NewsPostCommentModel();
        $model->where('parent_id', $id)->delete();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Reply deleted'
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

    private function sendReplyEmail($email, $name, $postTitle, $link)
    {
        $emailService = \Config\Services::email();

        $data = [
            'name'      => $name,
            'postTitle' => $postTitle,
            'link'      => $link,
            'siteName'  => 'Purulia Mirror'
        ];

        $message = view('email/CommentReply', $data);

        $emailService->setTo($email);
        $emailService->setSubject('Admin replied to your comment');
        $emailService->setMessage($message);
        $emailService->setMailType('html');

        if (!$emailService->send()) {
            log_message('error', $emailService->printDebugger(['headers']));
        }
    }

    private function jsonFail($msg)
    {
        return $this->response->setJSON(['success' => false, 'message' => $msg]);
    }
}
