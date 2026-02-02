<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Category extends BaseController
{
    public function index($identifier): string
    {

        $catModel = new Categories();
        $category = $catModel->getSpecificCatBySlug($identifier);
        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'pageTitle' => $category['cat'],
            'category' => $category
        ];
        return view('user/Category', array_merge($this->data, $data));
    }
}
