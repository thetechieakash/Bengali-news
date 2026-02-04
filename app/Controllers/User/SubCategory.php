<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\NewsPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class SubCategory extends BaseController
{
    public function index(string $categorySlug, string $subCategorySlug)
    {

        $catModel = new Categories();
        $subCatModel = new SubCategories();
        $category = $catModel->getSpecificCatBySlug($categorySlug);
        $subCategory = $subCatModel->getSubCatsBySlug($subCategorySlug);
        if (!$category || !$subCategory) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'pageTitle' => $subCategory['sub_cat_name'],
            'category' => $category,
            'subCategory' => $subCategory,

        ];
        return view('user/SubCategory', array_merge($this->data, $data));
    }
}
