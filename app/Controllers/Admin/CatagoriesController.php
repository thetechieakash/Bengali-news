<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\Catagories;
use App\Models\SubCatagories;

class CatagoriesController extends BaseController
{
    public function index()
    {
        $model = new Catagories();
        $allCats = $model->getAllCats();
        $data = [
            'pageTitle' => 'Catagories',
            'cats' => $allCats,
        ];
        // echo $slug;
        return view('admin/Catagories', $data);
    }
    public function createCatagory()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request type'
            ]);
        }

        $data = $this->request->getPost();

        $model = new Catagories();
        $slugHelper = new Slug();

        $insertableData = [
            'cat'       => trim($data['category']),
            'slug'      => $slugHelper->slugify($data['category']),
            'is_active' => isset($data['status']) ? 1 : 0,
            'status'    => 1,
        ];

        if (!$model->validate($insertableData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $model->errors()
            ]);
        }

        $model->insert($insertableData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $insertableData
        ]);
    }
    public function createSubCatagory()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request type'
            ]);
        }

        $data = $this->request->getPost();

        $model = new SubCatagories();
        $slugHelper = new Slug();
        $slugify = $slugHelper->slugify($data['category']);
        if ($model->where('slug', $slugify)->findAll()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category created successfully'
            ]);
        }
        $insertableData = [
            'cat'       => trim($data['category']),
            'slug'      => $slugHelper->slugify($data['category']),
            'is_active' => isset($data['status']) ? 1 : 0,
            'status'    => 1,
        ];

        if (!$model->validate($insertableData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $model->errors()
            ]);
        }

        $model->insert($insertableData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $insertableData
        ]);
    }


    public function readCatagory() {}

    public function updateCatagory()
    {
        $data = $this->request->getJSON(true);

        $id     = $data['id'] ?? null;
        $newCat = $data['newCatName'] ?? null;

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid category ID'
            ]);
        }

        if ($newCat === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category name cannot be empty'
            ]);
        }

        $model = new Catagories();
        $existingCat = $model->find($id);

        if (!$existingCat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }
        if ($existingCat['cat'] === $newCat) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'No changes detected'
            ]);
        }
        $slugHelper = new Slug();
        $updateData = [
            'cat' => $newCat,
            'slug' => $slugHelper->slugify($newCat)
        ];

        $model->update($id, $updateData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category updated successfully'
        ]);
    }


    public function updateActive()
    {
        $data = $this->request->getJSON(true);
        $id = $data['id'] ?? null;
        $value = $data['value'] ?? null;
        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        $model = new Catagories();

        $model->update($id, ['is_active' => (int)$value]);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Updated successfully'
        ]);
    }

    public function updateStatus()
    {
        $data = $this->request->getJSON(true);
        $id = $data['id'] ?? null;
        $value = $data['value'] ?? null;
        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        $model = new Catagories();

        $model->update($id, ['status' => (int)$value]);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Updated successfully'
        ]);
    }

    public function deleteCatagory()
    {
        $data = $this->request->getJSON(true);
        $id = $data['id'] ?? null;

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $model = new Catagories();
        $cat = $model->find($id);

        if (!$cat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }

        $model->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
