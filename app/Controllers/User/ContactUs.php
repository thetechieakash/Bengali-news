<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;
use App\Libraries\RecaptchaService;

class ContactUs extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle'  => 'Contact Us',
            'tickerActive' => false,
            'recaptcha_key' => env('GOOGLE_RECAPTCHA_KEY'),

        ];
        return view('user/ContactUs', array_merge($this->data, $data));
    }
    
    public function send()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $rules = [

            'name' => 'required|min_length[2]|max_length[120]',
            'email' => 'required|valid_email|max_length[150]',
            'phone' => 'required|min_length[8]|max_length[20]',
            'subject' => 'required|max_length[200]',
            'message' => 'required|min_length[10]'

        ];

        if (!$this->validate($rules)) {

            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }
        $token = $this->request->getPost('g-recaptcha-response');

        if (!$token) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Captcha token missing'
            ]);
        }
        $recaptchaService = new RecaptchaService();
        $recaptcha = $recaptchaService->verify($token);
        if (
            empty($recaptcha['success']) ||
            ($recaptcha['score'] ?? 0) < 0.5 ||
            ($recaptcha['action'] ?? '') !== 'contact'
        ) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'reCAPTCHA verification failed'
            ]);
        }
        $model = new ContactMessageModel();

        $model->insert([
            'name' => trim($this->request->getPost('name')),
            'email' => trim($this->request->getPost('email')),
            'phone' => trim($this->request->getPost('phone')),
            'subject' => trim($this->request->getPost('subject')),
            'message' => trim($this->request->getPost('message')),
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString()

        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Message sent successfully. We will contact you soon.'
        ]);
    }
}
