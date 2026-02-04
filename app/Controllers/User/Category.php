<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\NewsPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Category extends BaseController
{
    public function index($identifier)
    {

        $catModel = new Categories();
        $subCatModel = new SubCategories();
        $category = $catModel->getSpecificCatBySlug($identifier);
        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'pageTitle' => $category['cat'],
            'category' => $category,
            'subCategory'=> $subCatModel->getSubCatsByCatId($category['id'])
        ];

        return view('user/Category', array_merge($this->data, $data));
    }
}
