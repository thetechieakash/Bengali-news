<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\NewsPostModel;

class Home extends BaseController
{
    public function index(): string
    {

        $postModel = new NewsPostModel();
        $catModel = new Categories();
        $carousal = $postModel
            ->select('news_posts.*, t.type as thumb_type, t.thumbnail_url')
            ->join(
                'news_post_thumbnails t',
                't.news_post_id = news_posts.id'
            )
            ->where('news_posts.status', 1)
            ->where('t.thumbnail_url IS NOT NULL')
            ->orderBy('news_posts.created_at', 'ASC')
            ->limit(5)
            ->findAll();
        $categories = $catModel->randomCategory(3);

        $randomPosts = [];

        foreach ($categories as $category) {

            $posts = $postModel
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
                ->where('npc.category_id', $category['id'])
                ->where('news_posts.status', 1)
                ->groupBy('news_posts.id')
                ->orderBy('news_posts.post_date_time', 'DESC')
                ->limit(4)
                ->findAll();

            $randomPosts[] = [
                'category' => $category,
                'posts'    => $posts
            ];
        }
        $data = [
            'pageTitle' => 'Home',
            'carousal' => $carousal,
            'randomPost' => $randomPosts

        ];
        return view('user/Home', array_merge($this->data, $data));

        // $user = auth()->user();
        // dd([
        //     'userIs_loggedin' => $user->loggedIn(),
        //     'groups' => $user->getGroups(),
        //     'inGroup' => $user->inGroup('superadmin'),
        //     'can_admin' => $user->can('admin.access'),
        //     'can_news' => $user->can('news.create'),
        // ]);
    }
}
