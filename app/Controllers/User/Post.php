<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TagModel;
use App\Models\NewsPostModel;
use App\Models\NewsPostCommentModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Post extends BaseController
{
    public function index($identifier)
    {
        $newsModel = new NewsPostModel();
        $commentModel = new NewsPostCommentModel();
        $tagModel = new TagModel();
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
            'recapcha_key' => env('GOOGLE_RECAPTCHA_KEY'),
            'relatedPosts' => $newsModel->relatedPosts($post['id'], $post['category_ids'], $post['subcategory_ids'], 20),
            'popularTags' => $tagModel->popularTags(15),
        ];
        return view('user/Post', array_merge($this->data, $data));
    }
}
