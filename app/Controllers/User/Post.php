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


        // $user = auth()->user();
        // dd([
        //     'groups' => $user->getGroups(),
        //     'inGroup' => $user->inGroup('superadmin'),
        //     'can_admin' => $user->can('admin.access'),
        //     'can_news' => $user->can('news.create'),
        // ]);
        return view('user/Post',$data);
    }
}
