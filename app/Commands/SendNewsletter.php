<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\NewsletterModel;
use App\Models\NewsPostModel;

class SendNewsletter extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Cron';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'newsletter:send';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'newsletter:send';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'command:name [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        try {
            helper('url');

            $subscriberModel = new NewsletterModel();
            $newsModel = new NewsPostModel();

            $today = date('Y-m-d');

            $subscribers = $subscriberModel
                ->where('is_active', 1)
                ->groupStart()
                ->where('last_sent_at IS NULL')
                ->orWhere('last_sent_at <', $today . ' 00:00:00')
                ->groupEnd()
                ->findAll();

            if (!$subscribers) {
                echo "No subscribers\n";
                return 0; // SUCCESS (not failure)
            }

            $news = $newsModel
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->findAll();

            if (empty($news)) {
                echo "No news found\n";
                return 0; // SUCCESS
            }

            $email = \Config\Services::email();

            foreach ($subscribers as $sub) {

                $email->clear(true);

                $message = view('email/NewsLetter', [
                    'news' => $news,
                    'unsubscribe' => base_url('unsubscribe/' . $sub['token']),
                    'siteName' => "puruliamirror"
                ]);

                $email->setTo($sub['email']);
                $email->setSubject('Daily News Update');
                $email->setMessage($message);
                $email->setMailType('html');

                if ($email->send()) {
                    $subscriberModel->update($sub['id'], [
                        'last_sent_at' => date('Y-m-d H:i:s')
                    ]);
                    echo "Sent to: {$sub['email']}\n";
                } else {
                    echo "Failed: {$sub['email']}\n";
                }
            }

            echo "Newsletter sent successfully\n";
            return 0; // SUCCESS

        } catch (\Throwable $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            return 1; // FAILURE
        }
    }
}
