<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\NewsletterModel;
use App\Models\NewsPostModel;

class EmailSubscribe extends BaseController
{
    public function subscribe()
    {
        $email = trim($this->request->getPost('email'));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid email'
            ]);
        }

        $model = new NewsletterModel();

        $exists = $model->where('email', $email)->first();

        if ($exists) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Already subscribed'
            ]);
        }

        $token = bin2hex(random_bytes(32));

        $model->insert([
            'email' => $email,
            'token' => $token,
            'is_active' => 1
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Subscribed successfully'
        ]);
    }

    public function unsubscribe($token)
    {
        $model = new NewsletterModel();

        $subscriber = $model->where('token', $token)->first();

        if (!$subscriber) {
            return "Invalid link";
        }

        $model->update($subscriber['id'], ['is_active' => 0]);

        return view('unsubscribe_success');
    }

    
}