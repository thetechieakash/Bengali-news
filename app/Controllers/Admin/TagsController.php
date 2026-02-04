<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TagModel;

class TagsController extends BaseController
{
    public function search()
    {
        $q = trim($this->request->getGet('q'));

        $model = new TagModel();

        if ($q === '') {
            return $this->response->setJSON([]);
        }

        $tags = $model
            ->like('name', $q)
            ->limit(10)
            ->findAll();

        return $this->response->setJSON($tags);
    }
}
