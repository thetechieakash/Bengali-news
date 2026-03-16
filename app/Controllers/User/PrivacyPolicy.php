<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PagesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PrivacyPolicy extends BaseController
{
    public function index()
    {
        $model  = new PagesModel();
        $pageContent = $model->where('page_name', 'privacypolicy')->first();
        if (!$pageContent) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'pageTitle'  => 'Privacy & Policy',
            'tickerActive' => false,
            'pageContent' => $pageContent
        ];
        return view('user/PrivacyPolicy', array_merge($this->data, $data));
    }
}
