<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsPostModel;
use App\Models\Categories;
use App\Models\ChildCategories;
use App\Models\SubCategories;
use App\Models\TagModel;
use App\Models\NewsPostCommentModel;
use App\Models\WebsiteVisitModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $postModel = new NewsPostModel();
        $catModel = new Categories();
        $subCatModel = new SubCategories();
        $childCatModel = new ChildCategories();
        $tagModel = new TagModel();
        $commentModel = new NewsPostCommentModel();
        $visitModel = new WebsiteVisitModel();
        $user = auth();
        // Basic Counts
        $totalPosts       = $postModel->countAll();
        $postedBy         = $postModel->where('author', $user->id())->countAllResults();
        $publishedPosts   = $postModel->where('status', '1')->countAllResults();
        $draftPosts       = $postModel->where('status', '0')->countAllResults();
        $totalCategories  = $catModel->countAll();
        $totalSubCats     = $subCatModel->countAll();
        $totalChildCats     = $childCatModel->countAll();
        $totalTags        = $tagModel->countAll();
        $totalComments    = $commentModel->countAll();
        $publishedComments    = $commentModel->where(['status' => 1, 'parent_id' => null])->countAllResults();
        $pendingComments  = $commentModel->where(['status' => 0, 'parent_id' => null])->countAllResults();

        // Latest 5 Posts
        // $latestPosts = $postModel
        //     ->orderBy('created_at', 'DESC')
        //     ->limit(5)
        //     ->find();

        //  Get visits directly (ARRAY, not JSON response)
        $visits = $visitModel
            ->select('visit_date, COUNT(*) as total')
            ->where('visit_date >=', date('Y-m-d', strtotime('-30 days')))
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'ASC')
            ->findAll();

        //  Total Website Visits (All Time)
        $totalVisits = $visitModel->countAll();

        $data = [
            'pageTitle'        => 'Dashboard',
            'totalPosts'       => $totalPosts,
            'postedBy'         => $postedBy,
            'publishedPosts'   => $publishedPosts,
            'draftPosts'       => $draftPosts,
            'totalCategories'  => $totalCategories,
            'totalSubCats'     => $totalSubCats,
            'totalChildCats'   => $totalChildCats,
            'totalTags'        => $totalTags,
            'totalComments'    => $totalComments,
            'publishedComments' => $publishedComments,
            'pendingComments'  => $pendingComments,
            'visits'           => $visits,
            'totalVisits'      => $totalVisits,
            // 'latestPosts'      => $latestPosts,
        ];

        return view('admin/Dashboard', $data);
    }
}
