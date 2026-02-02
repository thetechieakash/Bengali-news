<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\AuthGroups;

class AuthorizationController extends BaseController
{
    public function index($id)
    {
        if (! auth()->user()->inGroup('superadmin')) {
            return redirect()->back()->with('error', 'you are unauthorized to access this page');
        }

        $users = auth()->getProvider(true);
        $user  = $users->findById($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $authGroups = new AuthGroups();

        $data = [
            'pageTitle'       => 'Roles & Permissions',
            'user'            => $user,
            'groups'          => $authGroups->groups,
            'permissions'     => $authGroups->permissions,
            'userGroups'      => $user->getGroups(),
            'userPermissions' => $user->getPermissions(),
        ];

        return view('admin/AuthorizationUser', $data);
    }
}
