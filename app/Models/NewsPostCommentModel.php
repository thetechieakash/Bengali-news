<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostCommentModel extends Model
{
    protected $table      = 'news_post_comments';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'news_post_id',
        'parent_id',
        'guest_name',
        'guest_email',
        'comment',
        'is_admin_reply',
        'status',
        'recaptcha_score',
        'ip_address',
        'user_agent',
        'deleted_at'
    ];

    protected $validationRules = [
        'news_post_id' => 'required|is_natural_no_zero',
        'guest_name'   => 'required|min_length[2]|max_length[120]',
        'guest_email'  => 'required|valid_email|max_length[150]',
        'comment'      => 'required|min_length[5]',
    ];

    protected $validationMessages = [
        'guest_name' => [
            'required' => 'Name is required',
        ],
        'guest_email' => [
            'valid_email' => 'Valid email required',
        ],
        'comment' => [
            'required' => 'Comment cannot be empty',
        ],
    ];

    /* ------------------------------------
    |  QUERY HELPERS
    ------------------------------------ */

    // Approved comments for frontend
    public function getApprovedForPost(int $postId): array
    {
        return $this
            ->where('news_post_id', $postId)
            ->where('status', 1)
            ->where('parent_id', null)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    // Replies for a comment
    public function getReplies(int $parentId): array
    {
        return $this
            ->where('parent_id', $parentId)
            ->where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    // Admin moderation list
    public function getPending(): array
    {
        return $this
            ->where('status', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getCommentsByPostId($postid)
    {
        return $this->where(['news_post_id' => $postid, 'status' => 1])
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }
    public function getCommentsWithAdminReply(?int $postId = null): array
    {
        $builder = $this->where('parent_id', null);

        if ($postId !== null) {
            $builder->where('news_post_id', $postId);
        }

        $comments = $builder
            ->orderBy('created_at', 'DESC')
            ->findAll();

        if (empty($comments)) {
            return [];
        }

        // Collect parent IDs
        $commentIds = array_column($comments, 'id');

        // Fetch admin replies
        $replies = $this->whereIn('parent_id', $commentIds)
            ->where('is_admin_reply', 1)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        // Group replies by parent_id
        $replyMap = [];
        foreach ($replies as $reply) {
            $replyMap[$reply['parent_id']][] = $reply;
        }

        // Attach replies
        foreach ($comments as &$comment) {
            $comment['reply'] = $replyMap[$comment['id']] ?? [];
        }

        return $comments;
    }
}
