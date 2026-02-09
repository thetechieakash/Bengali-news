<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\NewsPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Category extends BaseController
{
    protected NewsPostModel $postModel;
    protected Categories $catModel;
    protected SubCategories $subCatModel;

    public function __construct()
    {
        $this->postModel   = new NewsPostModel();
        $this->catModel    = new Categories();
        $this->subCatModel = new SubCategories();
    }
    public function index($identifier)
    {
        $category = $this->catModel->getSpecificCatBySlug($identifier);

        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }

        $posts = $this->getCategoryPosts($category['id']);

        $data = [
            'pageTitle'   => $category['cat'],
            'category'    => $category,
            'subCategory' => $this->subCatModel->getSubCatsByCatId($category['id']),
            'posts'       => $posts,
            'pager'       => $this->postModel->pager,
            'popularNews' => $this->postModel->popularNews(7),
        ];

        return view('user/Category', array_merge($this->data, $data));
    }
    /**
     * Get paginated posts by category
     */
    private function getCategoryPosts(int $categoryId, int $perPage = 5): array
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
                'news_post_sub_categories npsc',
                'npsc.news_post_id = news_posts.id'
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
            ->paginate($perPage, 'category');
    }
}
