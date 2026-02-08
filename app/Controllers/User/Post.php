<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostModel;
use App\Models\NewsPostCommentModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Post extends BaseController
{
    public function index($identifier): string
    {
        $newsModel = new NewsPostModel();
        $commentModel = new NewsPostCommentModel();
        $post = $newsModel->getActivePostForUser($identifier);
        if (!$post) {
            throw PageNotFoundException::forPageNotFound();
        }
        $readMorePosts = $newsModel->readMore($post['id'], 6);
        $comments = $commentModel->getCommentsWithAdminReply($post['id']);
        $data = [
            'pageTitle' => 'Post',
            'post' => $post,
            'readMorePosts' => $readMorePosts,
            'comments' => $comments,
            'recapcha_key' => env('GOOGLE_RECAPTCHA_KEY')

        ];
        return view('user/Post', array_merge($this->data, $data));
    }
}
