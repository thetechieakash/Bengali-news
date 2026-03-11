<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ChildCategories;

class CategoriesController extends BaseController
{
    private int $navbarLimit = 10;
    public function index()
    {
        $model = new Categories();
        $allCats = $model->getAllCats();
        $data = [
            'pageTitle' => 'Categories',
            'cats' => $allCats,
        ];
        return view('admin/Categories', $data);
    }

    public function createCategory()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request type'
            ]);
        }

        $data = $this->request->getPost();

        if (empty(trim($data['category'] ?? ''))) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category name is required'
            ]);
        }

        $model = new Categories();
        $slugHelper = new Slug();

        $isActive = isset($data['status']) ? 1 : 0;

        /* -------- CHECK ACTIVE LIMIT -------- */

        if ($isActive === 1) {

            $activeCount = $model
                ->where('is_active', 1)
                ->countAllResults();

            if ($activeCount >= $this->navbarLimit) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => "Only {$this->navbarLimit} categories can be active in the navbar. Disable another category first."
                ]);
            }
        }

        $catSlug = $slugHelper->slugify($data['slug']);

        $insertableData = [
            'cat'       => trim($data['category']),
            'slug'      => $catSlug,
            'is_active' => $isActive,
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

        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $insertableData
        ]);
    }

    public function updateCategory()
    {
        $data = $this->request->getJSON(true);

        $id     = $data['id'] ?? null;
        $newCat = $data['newCatName'] ?? null;
        $newCatSlug = $data['slug'] ?? null;

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
        if ($newCatSlug === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category slug cannot be empty'
            ]);
        }

        $model = new Categories();
        $existingCat = $model->find($id);

        if (!$existingCat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }

        $slugHelper = new Slug();
        $updateData = [
            'cat' => $newCat,
            'slug' => $slugHelper->slugify($newCatSlug)
        ];

        $model->update($id, $updateData);
        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category updated successfully'
        ]);
    }

    public function updateActive()
    {
        $data  = $this->request->getJSON(true);
        $id    = $data['id'] ?? null;
        $value = isset($data['value']) ? (int) $data['value'] : null;

        if (!$id || !in_array($value, [0, 1], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $db = db_connect();
        $db->transBegin();

        try {
            $catModel    = new Categories();
            $subCatModel = new SubCategories();

            /* -------- LIMIT CHECK (ONLY WHEN ACTIVATING) -------- */
            if ($value === 1) {

                // If already active, skip count check
                $current = $catModel->select('is_active')->find($id);

                if (!$current) {
                    throw new \RuntimeException('Category not found');
                }

                if ((int) $current['is_active'] === 0) {
                    $activeCount = $catModel
                        ->where('is_active', 1)
                        ->countAllResults();

                    if ($activeCount >= $this->navbarLimit) {
                        $db->transRollback();

                        return $this->response->setJSON([
                            'success' => false,
                            'message' => "Only {$this->navbarLimit} categories can be active in the navbar. Please disable another category first."
                        ]);
                    }
                }
            }

            /* -------- UPDATE CATEGORY -------- */
            $catModel->update($id, ['is_active' => $value]);

            /* -------- IF CATEGORY DISABLED → DISABLE SUB CATEGORIES -------- */
            if ($value === 0) {
                $subCatModel
                    ->where('cat_id', $id)
                    ->set(['is_active' => 0])
                    ->update();
            }

            cache()->delete('navbar_categories');

            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => $value
                    ? 'Category activated successfully'
                    : 'Category and its subcategories deactivated'
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Update failed',
                'debug'   => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }

    public function updateStatus()
    {
        $data  = $this->request->getJSON(true);
        $id    = $data['id'] ?? null;
        $value = isset($data['value']) ? (int) $data['value'] : null;

        if (!$id || !in_array($value, [0, 1], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $db = db_connect();
        $db->transBegin();

        try {
            $catModel    = new Categories();
            $subCatModel = new SubCategories();

            /* ---------- CATEGORY UPDATE ---------- */
            $catUpdate = [
                'status' => $value
            ];

            if ($value === 0) {
                $catUpdate['is_active'] = 0;
            }

            $catModel->update($id, $catUpdate);

            /* ---------- SUBCATEGORY SYNC ---------- */
            if ($value === 0) {
                $subCatModel
                    ->where('cat_id', $id)
                    ->set([
                        'status'    => 0,
                        'is_active' => 0
                    ])
                    ->update();
            }

            cache()->delete('navbar_categories');

            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Category and subcategories updated successfully'
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update category status',
                'debug'   => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }



    public function deleteCategory()
    {
        $data = $this->request->getJSON(true);
        $id = $data['id'] ?? null;

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $db = db_connect();
        $db->transBegin();

        try {

            $categoryModel     = new Categories();
            $subCategoryModel  = new SubCategories();
            $childCategoryModel = new ChildCategories();

            $category = $categoryModel->find($id);

            if (!$category) {
                throw new \Exception('Category not found');
            }

            /* -------- GET SUB CATEGORY IDS -------- */
            $subCategoryIds = $subCategoryModel
                ->where('cat_id', $id)
                ->findColumn('id');

            /* -------- GET CHILD CATEGORY IDS -------- */

            if (!empty($subCategoryIds)) {

                $childIds = $childCategoryModel
                    ->whereIn('sub_cat_id', $subCategoryIds)
                    ->findColumn('id');
            }

            /* -------- DELETE POST ↔ CATEGORY LINKS -------- */
            $db->table('news_post_categories')
                ->where('category_id', $id)
                ->delete();

            /* -------- DELETE POST ↔ SUBCATEGORY LINKS -------- */
            if (!empty($subCategoryIds)) {

                $db->table('news_post_sub_categories')
                    ->whereIn('sub_category_id', $subCategoryIds)
                    ->delete();
            }

            /* -------- DELETE CHILD CATEGORIES -------- */
            if (!empty($subCategoryIds)) {

                $childCategoryModel
                    ->whereIn('sub_cat_id', $subCategoryIds)
                    ->delete();
            }

            /* -------- DELETE SUB CATEGORIES -------- */
            $subCategoryModel
                ->where('cat_id', $id)
                ->delete();

            /* -------- DELETE CATEGORY -------- */
            $categoryModel->delete($id);

            cache()->delete('navbar_categories');

            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Category, subcategories and child categories deleted successfully'
            ]);
        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete category',
                'debug' => ENVIRONMENT !== 'production' ? $e->getMessage() : null
            ]);
        }
    }
}
