<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TagModel;
use App\Models\NewsPostModel;
use App\Models\NewsPostCommentModel;
use App\Models\PostViewModel;
use App\Models\AdsModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Post extends BaseController
{
    public function index($identifier)
    {
        $newsModel = new NewsPostModel();
        $commentModel = new NewsPostCommentModel();
        $tagModel = new TagModel();
        $viewModel = new PostViewModel();
        $adsModel  = new AdsModel();


        $post = $newsModel->getActivePostForUser($identifier);
        if (!$post) {
            throw PageNotFoundException::forPageNotFound();
        }

        $ip = $this->request->getIPAddress();
        $oneHourAgo = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $alreadyViewed = $viewModel
            ->where('post_id', $post['id'])
            ->where('ip_address', $ip)
            ->where('viewed_at >=', $oneHourAgo)
            ->countAllResults();

        if ($alreadyViewed == 0) {

            // Increase main views counter safely
            $newsModel->where('id', $post['id'])
                ->set('views', 'views+1', false)
                ->update();

            // Store view log
            $viewModel->insert([
                'post_id'    => $post['id'],
                'ip_address' => $ip,
            ]);

            // Update local post array so frontend shows updated value immediately
            $post['views']++;
        }
        
        $readMorePosts = $newsModel->readMore($post['id'], 6);
        $comments = $commentModel->getCommentsWithAdminReply($post['id']);
        $data = [
            'pageTitle' => $post['headline'],
            'post' => $post,
            'readMorePosts' => $readMorePosts,
            'comments' => $comments,
            'recapcha_key' => env('GOOGLE_RECAPTCHA_KEY'),
            'relatedPosts' => $newsModel->relatedPosts($post['id'], $post['category_ids'], $post['subcategory_ids'], 20),
            'popularTags' => $tagModel->popularTags(15),
            'topAds'      => $adsModel->getAdsForPage('post', 'top', true),
            'bottomAds'   => $adsModel->getAdsForPage('post', 'bottom', true),
            'leftAds'     => $adsModel->getAdsForPage('post', 'left', true),
            'rightAds'    => $adsModel->getAdsForPage('post', 'right', true),
            'blockAds'    => $adsModel->getAdsForPage('post', 'block', true),
        ];
        return view('user/Post', array_merge($this->data, $data));
    }
}
