<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\NewsPostModel;
use App\Models\AdsModel;


class Search extends BaseController
{
    public function index()
    {
        $keyword = trim($this->request->getGet('q'));

        if (!$keyword) {
            return redirect()->back();
        }

        $newsModel = new NewsPostModel();
        $adsModel  = new AdsModel();

        $results = $newsModel->fuzzySearch($keyword);

        $data = [
            'pageTitle' => 'Search Result',
            'tickerActive' => true,
            'keyword' => $keyword,
            'results' => $results,
            'popularNews' => $newsModel->popularNews(7),
            'pager'       => $newsModel->pager,
            'topAds'      => $adsModel->getAdsForPage('search', 'top', true),
            'bottomAds'   => $adsModel->getAdsForPage('search', 'bottom', true),
            'leftAds'     => $adsModel->getAdsForPage('search', 'left', true),
            'rightAds'    => $adsModel->getAdsForPage('search', 'right', true),
            'blockAds'    => $adsModel->getAdsForPage('search', 'block', true),
            'scriptAds'   => $adsModel->getScriptAds('search', 'script')
        ];
        // dd(array_merge($this->data, $data));
        return view('user/Search', array_merge($this->data, $data));
    }
}
