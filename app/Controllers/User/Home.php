<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;


class Home extends BaseController
{
    public function index(): string
    {

        $data = [
            'pageTitle' => 'Home',
        ];
        return view('user/Home', array_merge($this->data, $data));

        // $user = auth()->user();
        // dd([
        //     'userIs_loggedin' => $user->loggedIn(),
        //     'groups' => $user->getGroups(),
        //     'inGroup' => $user->inGroup('superadmin'),
        //     'can_admin' => $user->can('admin.access'),
        //     'can_news' => $user->can('news.create'),
        // ]);
    }
}
