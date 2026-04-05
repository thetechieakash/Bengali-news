<?php

namespace App\Controllers\Admin\Post;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostCommentModel;
use App\Models\NewsPostModel;
use App\Models\SubAuthorModel;
use App\Models\TagModel;

class ViewsController extends BaseController
{
    public function index()
    {
        $highLightId = $this->request->getGet('highlight');
        return view('admin/NewsList', [
            'pageTitle' => 'Published News',
            'status' => 1, // published
            'highLightId'=>$highLightId,
            'isSuperAdmin' => auth()->user()->inGroup('superadmin')
        ]);
    }

    public function draft()
    {
        $highLightId = $this->request->getGet('highlight');
        return view('admin/NewsList', [
            'pageTitle' => 'Draft News',
            'status' => 0, // draft
            'highLightId' => $highLightId,
            'isSuperAdmin' => auth()->user()->inGroup('superadmin')
        ]);
    }

    public function news()
    {
        $catModel = new Categories();
        $tagModel = new TagModel();
        $subAuthorModel = new SubAuthorModel();

        $data = [
            'pageTitle' => 'Create News',
            'tags' => $tagModel->findAll(),
            'categories' => $catModel
                ->where('status', 1)
                ->orderBy('cat', 'ASC')
                ->findAll(),
            'subAuthor' => $subAuthorModel->findAll(),

        ];

        return view('admin/CreateNews', $data);
    }

    public function updateNews($id)
    {
        $catModel = new Categories();
        $newsModel = new NewsPostModel();
        $tagModel = new TagModel();
        $subAuthorModel = new SubAuthorModel();

        $data = [
            'pageTitle' => 'Update News',
            'post' => $newsModel->getPostForEdit($id),
            'tags' => $tagModel->findAll(),
            'categories' => $catModel
                ->where('status', 1)
                ->orderBy('cat', 'ASC')
                ->findAll(),
            'subAuthor' => $subAuthorModel->findAll(),

        ];
        return view('admin/UpdateNews', $data);
    }

    public function getNewsList()
    {
        $request = service('request');

        $newsModel = new NewsPostModel();
        $commentModel = new NewsPostCommentModel();

        $start  = (int) $request->getGet('start');
        $length = (int) $request->getGet('length');
        $draw   = (int) $request->getGet('draw');

        $search = $request->getGet('search')['value'] ?? '';
        $status = (int) $request->getGet('status');

        $isSuperAdmin = auth()->user()->inGroup('superadmin');

        // -----------------------------
        // TOTAL RECORDS
        // -----------------------------
        $totalRecords = $newsModel->builder()
            ->where('news_posts.status', $status)
            ->countAllResults();

        // -----------------------------
        // BASE QUERY WITH JOIN
        // -----------------------------
        $builder = $newsModel->builder();

        $builder->select('news_posts.*, users.username');
        $builder->join('users', 'users.id = news_posts.author', 'left');
        $builder->where('news_posts.status', $status);

        // -----------------------------
        // SEARCH
        // -----------------------------
        if (!empty($search)) {
            $builder->groupStart()
                ->like('news_posts.headline', $search)
                ->orLike('news_posts.id', $search)
                ->orLike('news_posts.slug', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        // -----------------------------
        // FILTERED COUNT
        // -----------------------------
        $filteredRecords = $builder->countAllResults(false);

        // -----------------------------
        // SORTING (FINAL FIX)
        // -----------------------------
        $order = $request->getGet('order');

        $orderColumnIndex = $order[0]['column'] ?? null;
        $orderDirection   = strtolower($order[0]['dir'] ?? 'desc'); //

        // Column mapping
        $columns = [
            0 => null,
            1 => 'news_posts.headline',
        ];

        if ($isSuperAdmin) {
            $columns[2] = 'users.username';
            $columns[3] = null;
            $columns[4] = 'news_posts.created_at';
            $columns[5] = 'news_posts.status';
        } else {
            $columns[2] = null;
            $columns[3] = 'news_posts.created_at';
            $columns[4] = 'news_posts.status';
        }

        //  REMOVE draw == 1 CONDITION COMPLETELY

        if (
            $orderColumnIndex !== null
            && isset($columns[$orderColumnIndex])
            && $columns[$orderColumnIndex]
        ) {

            $builder->orderBy($columns[$orderColumnIndex], $orderDirection);
        } else {
            // default fallback
            $builder->orderBy('news_posts.created_at', 'DESC');
        }

        // -----------------------------
        // PAGINATION
        // -----------------------------
        $builder->limit($length, $start);

        $news = $builder->get()->getResultArray();

        // -----------------------------
        // COMMENT STATS
        // -----------------------------
        $newsIds = array_column($news, 'id');
        $statsMap = [];

        if (!empty($newsIds)) {
            $stats = $commentModel
                ->select("
                news_post_id,
                COUNT(id) as total_comments,
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as approved_comments,
                SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending_comments
            ")
                ->where('parent_id', null)
                ->whereIn('news_post_id', $newsIds)
                ->groupBy('news_post_id')
                ->findAll();

            foreach ($stats as $row) {
                $statsMap[$row['news_post_id']] = $row;
            }
        }

        // -----------------------------
        // FINAL DATA
        // -----------------------------
        $data = [];
        $sl = $start;

        foreach ($news as $post) {

            $sl++;

            $stats = $statsMap[$post['id']] ?? [];

            $authorName = $post['username'] ?? 'Unknown';

            $data[] = [
                "sl" => $sl . '.',
                "id" => $post['id'],
                "headline" => $post['headline'],
                "slug" => $post['slug'],
                "views" => $post['views'],
                "status" => (int) $post['status'],
                "author" => $authorName,
                "total_comments" => (int) ($stats['total_comments'] ?? 0),
                "approved_comments" => (int) ($stats['approved_comments'] ?? 0),
                "pending_comments" => (int) ($stats['pending_comments'] ?? 0),
                "date" => (new \DateTime($post['created_at']))->format('d M, Y h:i A')
            ];
        }

        // -----------------------------
        // RESPONSE
        // -----------------------------
        return $this->response->setJSON([
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }
}
