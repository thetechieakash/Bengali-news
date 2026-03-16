<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ChildCategories;
use App\Models\NewsPostModel;
use App\Models\AdsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class SubCategory extends BaseController
{
    protected NewsPostModel $postModel;
    protected Categories $catModel;
    protected SubCategories $subCatModel;
    protected ChildCategories $childCatModel;
    protected AdsModel $adsModel;


    public function __construct()
    {
        $this->postModel   = new NewsPostModel();
        $this->catModel    = new Categories();
        $this->subCatModel = new SubCategories();
        $this->childCatModel = new ChildCategories();
        $this->adsModel  = new AdsModel();
    }

    public function index(string $categorySlug, string $subCategorySlug)
    {
        $category    = $this->catModel->getSpecificCatBySlug($categorySlug);
        $subCategory = $this->subCatModel->getSubCatsBySlug($subCategorySlug);

        if (!$category || !$subCategory) {
            throw PageNotFoundException::forPageNotFound();
        }

        $posts = $this->getSubCategoryPosts(
            $category['id'],
            $subCategory['id']
        );

        $data = [
            'pageTitle'   => $subCategory['sub_cat_name'],
            'tickerActive' => true,
            'category'    => $category,
            'subCategory' => $subCategory,
            'childCategory' => $this->childCatModel->getChildBySubCatId($subCategory['id']),
            'posts'       => $posts,
            'pager'       => $this->postModel->pager,
            'popularNews' => $this->postModel->popularNews(7),
            'topAds'      => $this->adsModel->getAdsForPage('sub_category', 'top', true),
            'bottomAds'   => $this->adsModel->getAdsForPage('sub_category', 'bottom', true),
            'leftAds'     => $this->adsModel->getAdsForPage('sub_category', 'left', true),
            'rightAds'    => $this->adsModel->getAdsForPage('sub_category', 'right', true),
            'blockAds'    => $this->adsModel->getAdsForPage('sub_category', 'block', true),
            'scriptAds'   => $this->adsModel->getScriptAds('sub_category', 'script')
        ];

        return view('user/SubCategory', array_merge($this->data, $data));
    }

    /**
     * Get paginated posts by category & sub-category
     */
    private function getSubCategoryPosts(
        int $categoryId,
        int $subCategoryId,
        int $perPage = 5
    ): array {
        return $this->postModel
            ->select('
                news_posts.id,
                news_posts.headline,
                news_posts.slug,
                news_posts.author,
                news_posts.post_date_time,
                news_posts.short_description,
                npt.type,
                npt.thumbnail_url
            ')
            ->join(
                'news_post_categories npc',
                'npc.news_post_id = news_posts.id'
            )
            ->join(
                'news_post_sub_categories npsc',
                'npsc.news_post_id = news_posts.id',
                'left'
            )
            ->join(
                'news_post_child_categories npcc',
                'npcc.news_post_id = news_posts.id',
                'left'
            )
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('npc.category_id', $categoryId)
            ->where('npsc.sub_category_id', $subCategoryId)
            ->where('news_posts.status', 1)
            ->groupBy('news_posts.id')
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->paginate($perPage, 'subcategory');
    }
}
