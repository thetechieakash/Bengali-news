<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;


class UserController extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider(true);
        $usersList = $users->withIdentities()
            ->withDeleted()
            ->withGroups()
            ->withPermissions()
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data = [
            'pageTitle' => 'All Users',
            'users' => $usersList
        ];
        return view('admin/Users', $data);
    }
    public function user()
    {
        $data = [
            'pageTitle' => 'Create Users',
        ];
        return view('admin/CreateUsers', $data);
    }
    public function createUser()
    {
        if (!auth()->loggedIn()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]',
        ];
        if (! $this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors()
            ]);
        }
        // Get the User provider
        $users = auth()->getProvider(true);

        // Create the User entity
        $user = new User([
            'username' => trim($this->request->getPost('username')),
            'email'    => trim($this->request->getPost('email')),
            'password' => $this->request->getPost('password')
        ]);

        // Save via Shield
        $users->save($user);

        $userId = $users->getInsertID();

        if (! $userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to create user',
                'errors'  => $users->errors()
            ]);
        }
        /* -----------------------------
     * ROLE / GROUP ASSIGNMENT
     * ----------------------------- */

        // Default role
        $role = 'user';

        // Only superadmin can assign roles
        if (auth()->user()->inGroup('superadmin')) {
            $requestedRole = $this->request->getPost('role');

            if (in_array($requestedRole, ['superadmin', 'admin', 'author', 'user'], true)) {
                $role = $requestedRole;
            }
        }

        // Fetch saved user entity
        $savedUser = $users->findById($userId);

        // Assign Shield group
        $savedUser->addGroup($role);
        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'User created successfully',
            'redirect' => base_url('admin/all-users')
        ]);
    }

    public function updateUser()
    {
        if (!auth()->loggedIn()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }
        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];
        if (! $this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors()
            ]);
        }
        // Get the User provider
        $users = auth()->getProvider(true);
        $userId = $this->request->getPost('userId');
        // Create the User entity

        $user = $users->findById($userId);
        if (empty($user)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => 'User not found'
            ]);
        }
        $user->fill([
            'username' => trim($this->request->getPost('username')),
            'email'    => trim($this->request->getPost('email')),
            'password' => $this->request->getPost('password')
        ]);
        $isSaved = $users->save($user);
        if (!$isSaved) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update user',
                'errors'  => $users->errors()
            ]);
        }
        /* -----------------------------
     * ROLE / GROUP UPDATE
     * ----------------------------- */
        if (auth()->user()->inGroup('superadmin')) {

            $requestedRole = $this->request->getPost('role');

            if (in_array($requestedRole, ['superadmin', 'admin', 'author', 'user'], true)) {

                // Remove old groups
                $currentGroups = $user->getGroups();
                if (! empty($currentGroups)) {
                    $user->removeGroup(...$currentGroups);
                }

                // Assign new group
                $user->addGroup($requestedRole);
            }
        }
        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'User updated successfully',
        ]);
    }

    public function deleteUser()
    {
        if (! auth()->loggedIn()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        if (! auth()->user()->inGroup('superadmin')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => "You don't have permission to delete users"
            ]);
        }

        $userId = (int) $this->request->getPost('user_id');

        if (! $userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User ID is required'
            ]);
        }

        // Prevent self-delete
        if ($userId === auth()->id()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You cannot delete your own account'
            ]);
        }

        $users = auth()->getProvider(true);
        $user  = $users->findById($userId);

        if (! $user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        if (! $users->delete($userId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete user',
                'errors'  => $users->errors()
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

    public function restoreUser()
    {
        if (! auth()->loggedIn()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }
        if (! auth()->user()->inGroup('superadmin')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => "You don't have permission to restore users"
            ]);
        }
        $userId = $this->request->getPost('user_id');

        if (! $userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User ID is required'
            ]);
        }

        $users = auth()->getProvider(true);

        $user = $users->withDeleted()->findById($userId);

        if (! $user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
        
        $users = new UserModel();

        $users->where('id', $userId)->set('deleted_at', null)->update();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'User reactivated successfully'
        ]);
    }
}
