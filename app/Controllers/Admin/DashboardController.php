<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsPostModel;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\TagModel;
use App\Models\NewsPostCommentModel;


class DashboardController extends BaseController
{
    public function index()
    {
        $postModel = new NewsPostModel();
        $catModel = new Categories();
        $subCatModel = new SubCategories();
        $tagModel = new TagModel();
        $commentModel = new NewsPostCommentModel();

        // Basic Counts
        $totalPosts       = $postModel->countAll();
        $publishedPosts   = $postModel->where('status', '1')->countAllResults();
        $draftPosts       = $postModel->where('status', '0')->countAllResults();
        $totalCategories  = $catModel->countAll();
        $totalSubCats     = $subCatModel->countAll();
        $totalTags        = $tagModel->countAll();
        $totalComments    = $commentModel->countAll();
        $publishedComments    = $commentModel->where('status', 1)->countAllResults();
        $pendingComments  = $commentModel->where('status', 0)->countAllResults();

        // Latest 5 Posts
        // $latestPosts = $postModel
        //     ->orderBy('created_at', 'DESC')
        //     ->limit(5)
        //     ->find();



        $data = [
            'pageTitle'        => 'Dashboard',
            'totalPosts'       => $totalPosts,
            'publishedPosts'   => $publishedPosts,
            'draftPosts'       => $draftPosts,
            'totalCategories'  => $totalCategories,
            'totalSubCats'     => $totalSubCats,
            'totalTags'        => $totalTags,
            'totalComments'    => $totalComments,
            'publishedComments'=> $publishedComments,
            'pendingComments'  => $pendingComments,
            // 'latestPosts'      => $latestPosts,
        ];

        return view('admin/Dashboard', $data);
    }
}
