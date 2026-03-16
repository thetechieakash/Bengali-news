<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;

class MessagesController extends BaseController
{
    public function index()
    {
        $model = new ContactMessageModel();
        $data = [
            'pageTitle' => 'Messages Manager',
            'messages'=> $model->findAll()
        ];
        return view('admin/Messages', $data);
    }
    public function delete($id)
    {
        $model = new ContactMessageModel();

        if (!$model->find($id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Message not found'
            ]);
        }

        $model->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Message deleted successfully'
        ]);
    }
}
