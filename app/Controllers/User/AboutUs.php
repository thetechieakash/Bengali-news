<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PagesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AboutUs extends BaseController
{
    public function index()
    {
        $model  = new PagesModel();
        $pageContent = $model->where('page_name', 'aboutus')->first();
        if (!$pageContent) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'pageTitle'  => 'About Us',
            'tickerActive' => false,

            'pageContent' => $pageContent
        ];
        return view('user/AboutUs', array_merge($this->data, $data));
    }
}
