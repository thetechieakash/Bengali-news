<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Categories;

class NavbarController extends BaseController
{
    public function index()
    {
        $cats = new Categories();

        $navbar = $cats
            ->where(['is_active' => 1, 'status' => 1])
            ->orderBy('position', 'ASC')
            ->findAll();

        return view('admin/Navbar', [
            'pageTitle' => 'Navbar Customize',
            'navbar'    => $navbar
        ]);
    }

    public function updateOrder()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $data = $this->request->getJSON(true);

        if (empty($data['order'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid data'
            ]);
        }

        $catModel = new Categories();

        $updateData = [];
        foreach ($data['order'] as $item) {
            $updateData[] = [
                'id'       => $item['id'],
                'position' => $item['position']
            ];
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $catModel->updateBatch($updateData, 'id');

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update order'
            ]);
        }

        cache()->delete('navbar_categories');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Order updated successfully'
        ]);
    }
}
