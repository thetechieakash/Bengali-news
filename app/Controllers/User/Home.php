<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostModel;

class Home extends BaseController
{
    protected NewsPostModel $postModel;
    protected Categories $catModel;

    public function __construct()
    {
        $this->postModel = new NewsPostModel();
        $this->catModel  = new Categories();
    }

    public function index(): string
    {
        $data = [
            'pageTitle'          => 'Home',
            'carousal'           => $this->getCarouselPosts(),
            'randomPosts'        => $this->getRandomCategoryPosts(3, 4),
            'getPostAndCategory' => $this->getPostAndCategory(3),
            'popularNews'        => $this->postModel->popularNews(7),
            'postDuration'       => $this->postModel->postDuration(3, 1),
        ];

        return view('user/Home', array_merge($this->data, $data));
    }

    /* -------------------------------------------------
        |  Carousel Posts
     | ------------------------------------------------- */
    private function getCarouselPosts(int $limit = 10): array
    {
        return $this->postModel
            ->select('news_posts.*, t.type as thumb_type, t.thumbnail_url')
            ->join(
                'news_post_thumbnails t',
                't.news_post_id = news_posts.id',
                'left'
            )
            ->where('news_posts.status', 1)
            ->orderBy('news_posts.created_at', 'DESC')
            ->findAll($limit);
    }

    /* -------------------------------------------------
        |  Random Categories + Posts
     | ------------------------------------------------- */
    private function getRandomCategoryPosts(int $categoryLimit, int $postLimit): array
    {
        $categories = $this->catModel->randomCategory($categoryLimit);
        $result = [];

        foreach ($categories as $category) {
            $posts = $this->getPostsByCategory(
                $category['id'],
                $postLimit
            );

            if (!empty($posts)) {
                $result[] = [
                    'category' => $category,
                    'posts'    => $posts
                ];
            }
        }

        return $result;
    }

    /* -------------------------------------------------
        |  Homepage Category Sections
     | ------------------------------------------------- */
    private function getPostAndCategory(int $postLimit): array
    {
        $categories = $this->catModel
            ->where('status', 1)
            ->orderBy('cat', 'ASC')
            ->findAll();

        $homeData = [];

        foreach ($categories as $category) {
            $posts = $this->getPostsByCategory(
                $category['id'],
                $postLimit
            );

            if (!empty($posts)) {
                $homeData[] = [
                    'category' => $category,
                    'posts'    => $posts
                ];
            }
        }

        return $homeData;
    }

    /* -------------------------------------------------
     |  Reusable Post Query (Core Optimization)
     | ------------------------------------------------- */
    private function getPostsByCategory(int $categoryId, int $limit): array
    {
        return $this->postModel
            ->select('
                news_posts.id,
                news_posts.headline,
                news_posts.slug,
                news_posts.author,
                news_posts.post_date_time,
                news_posts.short_description,
                npt.thumbnail_url
            ')
            ->join(
                'news_post_categories npc',
                'npc.news_post_id = news_posts.id'
            )
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('npc.category_id', $categoryId)
            ->where('news_posts.status', 1)
            ->groupBy('news_posts.id')
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
