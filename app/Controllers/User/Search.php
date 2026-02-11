<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\NewsPostModel;

class Search extends BaseController
{
    public function index()
    {
        $keyword = trim($this->request->getGet('q'));

        if (!$keyword) {
            return redirect()->back();
        }

        $newsModel = new NewsPostModel();
        $results = $newsModel->fuzzySearch($keyword);

        $data = [
            'pageTitle' => 'Search Result',
            'keyword' => $keyword,
            'results' => $results,
            'popularNews' => $newsModel->popularNews(7),
            'pager'       => $newsModel->pager,
        ];
        // dd(array_merge($this->data, $data));
        return view('user/Search', array_merge($this->data, $data));
    }
}
