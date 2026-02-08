<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostModel;
use App\Models\TagModel;

class ViewsController extends BaseController
{
    public function index()
    {
        $newsModel = new NewsPostModel();
        $data = [
            'pageTitle' => 'News',
            'news' => $newsModel
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];
        return view('admin/AllNews', $data);
    }

    public function news()
    {
        $catModel = new Categories();
        $tagModel = new TagModel();

        $data = [
            'pageTitle' => 'Create News',
            'tags' => $tagModel->findAll(),
            'categories' => $catModel
                ->where('status', 1)
                ->orderBy('cat', 'ASC')
                ->findAll()
        ];

        return view('admin/CreateNews', $data);
    }

    public function updateNews($id)
    {
        $catModel = new Categories();
        $newsModel = new NewsPostModel();
        $tagModel = new TagModel();
        $data = [
            'pageTitle' => 'Update News',
            'post' => $newsModel->getPostForEdit($id),
            'tags' => $tagModel->findAll(),
            'categories' => $catModel
                ->where('status', 1)
                ->orderBy('cat', 'ASC')
                ->findAll()
        ];

        return view('admin/UpdateNews', $data);
    }
}
