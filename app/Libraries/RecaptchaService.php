<?php

namespace App\Libraries;

use Config\Services;

class RecaptchaService
{
    public function verify(string $token): array
    {
        $secret = env('GOOGLE_RECAPTCHA_SECRET');

        $client = Services::curlrequest([
            'timeout' => 10,
            'verify'  => ENVIRONMENT !== 'development'
        ]);

        try {

            $response = $client->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'form_params' => [
                        'secret'   => $secret,
                        'response' => $token,
                        'remoteip' => service('request')->getIPAddress(),
                    ],
                ]
            );

            $result = json_decode($response->getBody(), true);

            if (!$result) {
                return ['success' => false];
            }

            return $result;
        } catch (\Throwable $e) {

            log_message('error', 'reCAPTCHA error: ' . $e->getMessage());

            return ['success' => false];
        }
    }
}
