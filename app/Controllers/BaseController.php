<?php

namespace App\Controllers;

use App\Libraries\CategoryService;
use App\Models\WebsiteVisitModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    protected $data = [];
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);
        $this->data['navbarCategories'] = CategoryService::getNavbarCategories();
        $this->trackVisit();
        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
    protected function trackVisit()
    {
        // Don't track admin panel
        if (strpos($this->request->getUri()->getPath(), 'admin') === 0) {
            return;
        }

        // Ignore bots
        if ($this->request->getUserAgent()->isRobot()) {
            return;
        }

        $visitModel = new WebsiteVisitModel();

        // If using Cloudflare
        $ip = $this->request->getServer('HTTP_CF_CONNECTING_IP')
            ?? $this->request->getIPAddress();

        $today = date('Y-m-d');

        try {
            $visitModel->insert([
                'ip_address' => $ip,
                'visit_date' => $today,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            // Ignore duplicate error (because UNIQUE key exists)
        }
    }
}
