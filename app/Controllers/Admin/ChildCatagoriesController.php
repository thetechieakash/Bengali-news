<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ChildCategories;

class ChildCatagoriesController extends BaseController
{
    public function index()
    {
        $catModel = new Categories();
        $allCats = $catModel->getAllCats();
        $model = new ChildCategories();
        $allChildCats = $model->getAllChildCats();

        $data = [
            'pageTitle' => 'Child Categories',
            'allCats' => $allCats,
            'allChildCats' => $allChildCats,
        ];
        return view('admin/ChildCategories', $data);
    }

    public function createChildCategory()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request data'
            ]);
        }

        $childModel  = new ChildCategories();
        $subCatModel = new SubCategories();
        $slugHelper  = new Slug();

        // Validate required fields
        if (
            empty($data['sub_cat_id']) ||
            empty($data['child_cat_name']) ||
            empty($data['child_cat_slug'])
        ) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'All fields are required'
            ]);
        }

        // Check if sub category exists
        $subCategory = $subCatModel->find($data['sub_cat_id']);

        if (!$subCategory) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sub category not found'
            ]);
        }

        $childSlug = $slugHelper->slugify($data['child_cat_slug']);

        // Slug duplicate check
        $slugExists = $childModel
            ->where('child_cat_slug', $childSlug)
            ->first();

        if ($slugExists) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => [
                    'child_cat_slug' => 'Slug already exists'
                ]
            ]);
        }

        $insertData = [
            'sub_cat_id'     => $data['sub_cat_id'],
            'child_cat_name' => trim($data['child_cat_name']),
            'child_cat_slug' => $childSlug,
            'is_active'      => 1,
            'status'         => 1,
        ];

        if (!$childModel->validate($insertData)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $childModel->errors()
            ]);
        }

        $childModel->insert($insertData);
        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Child Category created successfully'
        ]);
    }

    public function updateChildCategory()
    {
        $data = $this->request->getJSON(true);

        if (!$data || empty($data['id'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $childModel  = new ChildCategories();
        $subCatModel = new SubCategories();
        $slugHelper  = new Slug();

        $child = $childModel->find($data['id']);

        if (!$child) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Child category not found'
            ]);
        }

        // Validate required fields
        if (
            empty($data['sub_cat_id']) ||
            empty($data['child_cat_name']) ||
            empty($data['child_cat_slug'])
        ) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'All fields are required'
            ]);
        }

        // Check sub category exists
        if (!$subCatModel->find($data['sub_cat_id'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sub category not found'
            ]);
        }

        $newSlug = $slugHelper->slugify($data['child_cat_slug']);

        // Unique slug check (exclude current row)
        $slugExists = $childModel
            ->where('child_cat_slug', $newSlug)
            ->where('id !=', $data['id'])
            ->first();

        if ($slugExists) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => [
                    'child_cat_slug' => 'Slug already exists'
                ]
            ]);
        }

        $updateData = [
            'sub_cat_id'     => $data['sub_cat_id'],
            'child_cat_name' => trim($data['child_cat_name']),
            'child_cat_slug' => $newSlug,
            'is_active' => 1,
            'status' => 1
        ];
        $childModel->update($data['id'], $updateData);
        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Child category updated successfully'
        ]);
    }

    public function deleteChildCategory()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['id'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid ID'
            ]);
        }

        $childModel = new \App\Models\ChildCategories();

        $child = $childModel->find($data['id']);
        if (!$child) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Child category not found'
            ]);
        }

        $childModel->delete($data['id']);
        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Child category deleted successfully'
        ]);
    }

    public function getChildren()
    {
        $subIds = $this->request->getPost('subcategory_ids');

        $childModel = new ChildCategories();

        return $this->response->setJSON(
            $childModel
                ->whereIn('sub_cat_id', $subIds)
                ->findAll()
        );
    }
}
