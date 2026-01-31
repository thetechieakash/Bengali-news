<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Post extends BaseController
{
    public function index($identifier): string
    {
        $newsModel = new NewsPostModel();
        $post = $newsModel->getPostForEdit($identifier);
        if (!$post) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'pageTitle' => 'Post',
            'post' => $post,

        ];
        return view('user/Post', $data);
    }
}
