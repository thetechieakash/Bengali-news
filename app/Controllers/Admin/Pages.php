<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PagesModel;

class Pages extends BaseController
{
    public function aboutUs()
    {
        $data = [
            'pageTitle' => 'About Us',
            'pageName'  => 'aboutus',
            'content'   => $this->getContent('aboutus')
        ];

        return view('admin/AboutUs', $data);
    }

    public function privacyPolicy()
    {
        $data = [
            'pageTitle' => 'Privacy Policy',
            'pageName'  => 'privacypolicy',
            'content'   => $this->getContent('privacypolicy')
        ];

        return view('admin/PrivacyPolicy', $data);
    }

    private function getContent($pageName)
    {
        $model = new PagesModel();
        return $model->where('page_name', $pageName)->first();
    }

    public function save()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $pageName    = $this->request->getPost('page_name');
        $description = $this->request->getPost('description');

        if (empty($description)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Content cannot be empty'
            ]);
        }

        $model = new PagesModel();

        $existing = $model->where('page_name', $pageName)->first();

        if ($existing) {

            $model->update($existing['id'], [
                'description' => $description
            ]);

            $msg = 'Page updated successfully';
        } else {

            $model->insert([
                'page_name'   => $pageName,
                'description' => $description
            ]);

            $msg = 'Page created successfully';
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => $msg
        ]);
    }
}
