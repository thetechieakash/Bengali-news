<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ChildCategories;

class SubCatagoriesController extends BaseController
{
    public function index()
    {
        $catModel = new Categories();
        $allCats = $catModel->getAllCats();
        $subModel = new SubCategories();
        $allSubCats = $subModel->getAllSubCats();
        $data = [
            'pageTitle' => 'Sub Categories',
            'cats' => $allCats,
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

        $subCatSlug = $slugHelper->slugify($data['subCatSlug']);
        $insertableData = [
            'cat_id'        => $data['id'],
            'sub_cat_name'  => trim($data['subCatName']),
            'sub_cat_slug'  => $subCatSlug,
            'is_active'     => 1,
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
        cache()->delete('navbar_categories');

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
        $newCatName = trim($data['newCatName']) ?? null;
        $newCatSlug = trim($data['newCatSlug']) ?? null;

        // Validate required fields
        if (
            !isset($subCatId) ||
            !isset($catId) ||
            $newCatName === '' ||
            $newCatSlug === '' 
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

        $slugHelper = new Slug();

        $updateData = [
            'sub_cat_name' => $newCatName,
            'sub_cat_slug' => $slugHelper->slugify($newCatSlug),
        ];

        $subCatModel->update($subCatId, $updateData);
        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Sub category updated successfully'
        ]);
    }

    public function updateActive()
    {
        $data  = $this->request->getJSON(true);
        $id    = $data['id'] ?? null;
        $value = (int) ($data['value'] ?? 0);

        if (!$id || !in_array($value, [0, 1], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $subModel = new SubCategories();
        $catModel = new Categories();

        $sub = $subModel->find($id);

        if (!$sub) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Subcategory not found'
            ]);
        }

        if ($value === 1) {

            $parent = $catModel->find($sub['cat_id']);

            if (!$parent || (int)$parent['is_active'] !== 1) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Cannot activate subcategory while parent category is inactive'
                ]);
            }
        }

        $subModel->update($id, ['is_active' => $value]);

        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Subcategory updated successfully'
        ]);
    }

    public function updateStatus()
    {
        $data = $this->request->getJSON(true);
        $id    = $data['id'] ?? null;
        $value = (int) ($data['value'] ?? 0);

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        if (!in_array($value, [0, 1], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid status value'
            ]);
        }

        $subModel = new SubCategories();
        $catModel = new Categories();

        $sub = $subModel->find($id);

        if (!$sub) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Subcategory not found'
            ]);
        }

        if ($value === 1) {
            $parent = $catModel->find($sub['cat_id']);

            if (!$parent || (int)$parent['status'] !== 1) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Parent category must be active before enabling subcategory'
                ]);
            }
        }

        if ($value === 0) {
            $subModel->update($id, ['is_active' => 0, 'status' => 0]);
        } else {
            $subModel->update($id, ['status' => $value]);
        }

        cache()->delete('navbar_categories');

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

        if (!$subCatId || !$catId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $db = db_connect();
        $db->transBegin();

        try {

            $subCatModel   = new SubCategories();
            $childModel    = new ChildCategories();

            $existingSubCat = $subCatModel
                ->where('id', $subCatId)
                ->where('cat_id', $catId)
                ->first();

            if (!$existingSubCat) {
                throw new \Exception('Sub category not found');
            }

            /* -------- DELETE CHILD CATEGORIES -------- */
            $childModel
                ->where('sub_cat_id', $subCatId)
                ->delete();

            /* -------- DELETE SUB CATEGORY -------- */
            $subCatModel->delete($subCatId);

            cache()->delete('navbar_categories');

            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Sub category and its child categories deleted successfully'
            ]);
        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete sub category',
                'debug' => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }

    public function getByCategories()
    {
        $catIds = $this->request->getPost('category_ids');

        if (empty($catIds)) {
            return $this->response->setJSON([]);
        }

        $subCatModel = new SubCategories();

        $subCats = $subCatModel
            ->whereIn('cat_id', $catIds)
            ->where('status', 1)
            ->orderBy('sub_cat_name', 'ASC')
            ->findAll();

        return $this->response->setJSON($subCats);
    }
}
