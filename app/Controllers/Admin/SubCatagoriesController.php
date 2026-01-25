<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\Categories;
use App\Models\SubCategories;

class SubCatagoriesController extends BaseController
{
    public function index()
    {
        $model = new SubCategories();
        $allSubCats = $model->getAllSubCats();
        $data = [
            'pageTitle' => 'Sub Categories',
            'subCats' => $allSubCats,
        ];
        return view('admin/SubCategories', $data);
    }
    public function createSubCategory()
    {
        $data = $this->request->getJSON(true);

        $subCatModel = new SubCategories();
        $catModel = new Categories();

        $slugHelper = new Slug();
        $mainCat = $catModel->find($data['id']);
        if (!$mainCat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category not found',
            ]);
        }

        $subCatSlug = $slugHelper->slugify($data['subCatName']);
        $insertableData = [
            'cat_id'        => $data['id'],
            'sub_cat_name'  => trim($data['subCatName']),
            'sub_cat_slug'  => $subCatSlug,
            'is_active'     => !empty($data['subCatStatus']) ? 1 : 0,
            'status'        => 1,
        ];
        // die();
        if (!$subCatModel->validate($insertableData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $subCatModel->errors()
            ]);
        }

        $subCatModel->insert($insertableData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub Category created successfully',
            'data' => $insertableData
        ]);
    }

    public function updateSubCategory()
    {
        $data = $this->request->getJSON(true);

        $subCatId   = $data['subCatId'] ?? null;
        $catId      = $data['catId'] ?? null;
        $newCatName = $data['newCatName'] ?? null;

        // Validate required fields
        if (
            !isset($subCatId) ||
            !isset($catId) ||
            trim($newCatName) === ''
        ) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'All fields are required'
            ]);
        }
        $catModel = new Categories();

        if (!$catModel->find($catId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Parent category not found'
            ]);
        }
        $subCatModel = new SubCategories();

        // Fetch sub category + validate relationship in ONE query
        $existingSubCat = $subCatModel
            ->where('id', $subCatId)
            ->where('cat_id', $catId)
            ->first();

        if (!$existingSubCat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sub category not found or invalid category'
            ]);
        }

        // No changes detected
        if ($existingSubCat['sub_cat_name'] === trim($newCatName)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No changes detected'
            ]);
        }

        $slugHelper = new Slug();

        $updateData = [
            'sub_cat_name' => trim($newCatName),
            'sub_cat_slug' => $slugHelper->slugify(trim($newCatName)),
        ];

        $subCatModel->update($subCatId, $updateData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub category updated successfully'
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
        $model = new SubCategories();

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
        $model = new SubCategories();

        $model->update($id, ['status' => (int)$value]);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Updated successfully'
        ]);
    }
    public function deleteSubCategory()
    {
        $data = $this->request->getJSON(true);

        $subCatId = $data['subCatId'] ?? null;
        $catId    = $data['catId'] ?? null;

        if (!isset($subCatId) || !isset($catId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $subCatModel = new SubCategories();

        // Validate sub category + parent relationship
        $existingSubCat = $subCatModel
            ->where('id', $subCatId)
            ->where('cat_id', $catId)
            ->first();

        if (!$existingSubCat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sub category not found or invalid category'
            ]);
        }
        $subCatModel->delete($subCatId);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub category deleted successfully'
        ]);
    }
}
