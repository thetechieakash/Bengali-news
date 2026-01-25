<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;


class Post extends BaseController
{
    public function index(): string
    {

        $data = [
            'pageTitle' => 'Post',
        ];
        return view('user/Post',$data);
    }
}
