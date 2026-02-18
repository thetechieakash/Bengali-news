<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubAuthorModel;

class SubAuthorController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SubAuthorModel();
    }

    public function index()
    {
        $authors = $this->model->orderBy('id', 'DESC')->findAll();

        $data = [
            'pageTitle' => 'Sub Author Manager',
            'authors'=> $authors
        ];
        return view('admin/SubAuthor', $data);
    }

    public function getAuthor($id)
    {
        $author = $this->model->find($id);

        if (!$author) {
            return $this->response->setJSON([
                'success' => false
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $author
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (empty($data['name']) || empty($data['email'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        if ($this->model->where('email', $data['email'])->first()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email already exists'
            ]);
        }

        $imagePath = null;

        $file = $this->request->getFile('profile_image');
        
        if ($file && $file->isValid()) {

            $folder = 'uploads/sub_authors';
            if (!is_dir(FCPATH . $folder)) {
                mkdir(FCPATH . $folder, 0775, true);
            }

            $fileName = $file->getRandomName();
            $file->move(FCPATH . $folder, $fileName);

            $imagePath = $folder . '/' . $fileName;
        }

        $this->model->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'profile_image' => $imagePath,
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub author created successful'
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (empty($data['name']) || empty($data['email'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        // Prepare data to update
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        // Handle optional file upload
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $folder = 'uploads/sub_authors';
            $fileName = $file->getRandomName();
            $file->move(FCPATH . $folder, $fileName);
            $updateData['profile_image'] = $folder . '/' . $fileName;
        }
        // If no file is selected, old image stays unchanged

        // Update the author
        $this->model->update($id, $updateData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub author updated successfully'
        ]);
    }

    public function delete($id)
    {
        $author = $this->model->find($id);

        if (!$author) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Author not found'
            ]);
        }

        //  Delete image file if exists
        if (!empty($author['profile_image'])) {

            $filePath = FCPATH . $author['profile_image'];

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete database record
        $this->model->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub author deleted successfully'
        ]);
    }
}
