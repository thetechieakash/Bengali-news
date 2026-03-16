<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\NewsPostCommentModel;
use App\Models\NewsPostModel;
use App\Libraries\RecaptchaService;

class PostComment extends BaseController
{
    public function store()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request type'
            ])->setStatusCode(403);
        }
        try {
            $data = $this->request->getPost();

            /* -----------------------------
             * 1. BASIC INPUT
             * ----------------------------- */
            $postId  = (int) ($data['postid'] ?? 0);
            $token = $this->request->getPost('g-recaptcha-response');

            if ($postId <= 0 || empty($token)) {
                throw new \Exception('Invalid request');
            }

            /* -----------------------------
             * 2. VALIDATION
             * ----------------------------- */
            $rules = [
                'name'    => 'required|min_length[2]|max_length[100]',
                'email'   => 'required|valid_email|max_length[150]',
                'comment' => 'required|min_length[5]',
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            /* -----------------------------
             * 3. CHECK POST EXISTS
             * ----------------------------- */
            $postModel = new NewsPostModel();
            $post = $postModel
                ->where('id', $postId)
                ->where('status', 1)
                ->first();

            if (!$post) {
                throw new \Exception('Post not found');
            }

            /* -----------------------------
             * 4. VERIFY reCAPTCHA v3
             * ----------------------------- */
            $recaptchaService = new RecaptchaService();
            $recaptcha = $recaptchaService->verify($token);

            if (
                empty($recaptcha['success']) || ($recaptcha['score'] ?? 0) < 0.4 || ($recaptcha['action'] ?? '') !== 'comment'
            ) {
                throw new \Exception('reCAPTCHA verification failed');
            }

            /* -----------------------------
             * 5. SAVE COMMENT (PENDING)
             * ----------------------------- */
            $commentModel = new NewsPostCommentModel();

            $insert = $commentModel->insert([
                'news_post_id'    => $postId,
                'guest_name'      => trim($data['name']),
                'guest_email'     => trim($data['email']),
                'comment'         => trim($data['comment']),
                'status'          => 0, // pending approval
                'recaptcha_score' => $recaptcha['score'],
                'ip_address'      => $this->request->getIPAddress(),
                'user_agent'      => $this->request->getUserAgent()->getAgentString(),
            ]);

            if (!$insert) {
                throw new \Exception('Failed to save comment');
            }
            log_message('debug', 'reCAPTCHA RESPONSE: ' . json_encode($recaptcha));

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Comment submitted successfully. Awaiting approval.',
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $e->getMessage(),
            ]);
        }
    }
}
