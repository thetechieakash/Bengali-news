<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ChildCategories;
use App\Models\NewsPostModel;
use App\Models\AdsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ChildCategory extends BaseController
{
    protected NewsPostModel $postModel;
    protected Categories $catModel;
    protected SubCategories $subCatModel;
    protected ChildCategories $childCatModel;
    protected AdsModel $adsModel;

    public function __construct()
    {
        $this->postModel     = new NewsPostModel();
        $this->catModel      = new Categories();
        $this->subCatModel   = new SubCategories();
        $this->childCatModel = new ChildCategories();
        $this->adsModel      = new AdsModel();
    }

    public function index(string $categorySlug, string $subCategorySlug, string $childCategorySlug)
    {
        $category = $this->catModel->getSpecificCatBySlug($categorySlug);
        $subCategory = $this->subCatModel->getSubCatsBySlug($subCategorySlug);
        $childCategory = $this->childCatModel->getChildBySlug($childCategorySlug);

        if (!$category || !$subCategory || !$childCategory) {
            throw PageNotFoundException::forPageNotFound();
        }

        $posts = $this->getChildCategoryPosts(
            $category['id'],
            $subCategory['id'],
            $childCategory['id']
        );

        $data = [
            'pageTitle'     => $childCategory['child_cat_name'],
            'category'      => $category,
            'subCategory'   => $subCategory,
            'childCategory' => $childCategory,
            'posts'         => $posts,
            'pager'         => $this->postModel->pager,
            'popularNews'   => $this->postModel->popularNews(7),

            // Ads
            'topAds'    => $this->adsModel->getAdsForPage('child_category', 'top', true),
            'bottomAds' => $this->adsModel->getAdsForPage('child_category', 'bottom', true),
            'leftAds'   => $this->adsModel->getAdsForPage('child_category', 'left', true),
            'rightAds'  => $this->adsModel->getAdsForPage('child_category', 'right', true),
            'blockAds'  => $this->adsModel->getAdsForPage('child_category', 'block', true),
            'scriptAds' => $this->adsModel->getScriptAds('child_category', 'script'),
        ];
// dd($data);
        return view('user/ChildCategory', array_merge($this->data, $data));
    }

    /**
     * Get paginated posts by child category
     */
    private function getChildCategoryPosts(
        int $categoryId,
        int $subCategoryId,
        int $childCategoryId,
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
            ->where('npcc.child_category_id', $childCategoryId)
            ->where('news_posts.status', 1)
            ->groupBy('news_posts.id')
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->paginate($perPage, 'childcategory');
    }
}
