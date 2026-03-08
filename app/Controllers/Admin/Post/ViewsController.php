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
        $highlightId = $this->request->getGet('highlight');
        $sort = $this->request->getGet('sort');
        $newsModel = new NewsPostModel();
        $commentModel = new NewsPostCommentModel();

        // Get all news first
        $news = $newsModel
            ->where('status', true)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $newsIds = array_column($news, 'id');

        if (!empty($newsIds)) {

            //  Get comment statistics
            $commentStats = $commentModel
                ->select("
                news_post_id,
                COUNT(id) as total_comments,
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as approved_comments,
                SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending_comments
            ")->where('parent_id', null)
                ->whereIn('news_post_id', $newsIds)
                ->groupBy('news_post_id')
                ->findAll();

            $statsMap = [];
            foreach ($commentStats as $stat) {
                $statsMap[$stat['news_post_id']] = $stat;
            }

            // Attach stats & comments to news
            foreach ($news as &$item) {

                $id = $item['id'];

                $item['total_comments']   = $statsMap[$id]['total_comments'] ?? 0;
                $item['approved_comments'] = $statsMap[$id]['approved_comments'] ?? 0;
                $item['pending_comments']  = $statsMap[$id]['pending_comments'] ?? 0;
            }
        }
        return view('admin/PublishedNews', [
            'pageTitle' => 'News',
            'news' => $news,
            'highlightId' => $highlightId,
            'sort' => $sort
        ]);
    }
    public function draft()
    {
        $highlightId = $this->request->getGet('highlight');
        $sort = $this->request->getGet('sort');
        $newsModel = new NewsPostModel();
        $commentModel = new NewsPostCommentModel();

        // Get all news first
        $news = $newsModel
            ->where('status', false)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $newsIds = array_column($news, 'id');

        if (!empty($newsIds)) {

            //  Get comment statistics
            $commentStats = $commentModel
                ->select("
                news_post_id,
                COUNT(id) as total_comments,
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as approved_comments,
                SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending_comments
            ")->where('parent_id', null)
                ->whereIn('news_post_id', $newsIds)
                ->groupBy('news_post_id')
                ->findAll();

            $statsMap = [];
            foreach ($commentStats as $stat) {
                $statsMap[$stat['news_post_id']] = $stat;
            }

            // Attach stats & comments to news
            foreach ($news as &$item) {

                $id = $item['id'];

                $item['total_comments']   = $statsMap[$id]['total_comments'] ?? 0;
                $item['approved_comments'] = $statsMap[$id]['approved_comments'] ?? 0;
                $item['pending_comments']  = $statsMap[$id]['pending_comments'] ?? 0;
            }
        }
        return view('admin/DraftNews', [
            'pageTitle' => 'News',
            'news' => $news,
            'highlightId' => $highlightId,
            'sort' => $sort
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
}
