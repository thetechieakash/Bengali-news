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
        $path = trim($this->request->getUri()->getPath(), '/');

        // Don't track admin panel
        if (str_starts_with($path, 'admin')) {
            return;
        }

        // Ignore bots
        if ($this->request->getUserAgent()->isRobot()) {
            return;
        }
        // Get real IP (Cloudflare safe)
        $ip = $this->request->getServer('HTTP_CF_CONNECTING_IP');

        if (empty($ip)) {
            $ip = $this->request->getIPAddress();
        }
        $db = \Config\Database::connect();

        // Query Builder + safe compiled SQL
        $builder = $db->table('website_visits');

        $sql = $builder->set([
            'ip_address' => $ip,
            'visit_date' => date('Y-m-d'),
            'hits'       => 1,
            'created_at' => date('Y-m-d H:i:s')
        ])
            ->getCompiledInsert();

        // Handle duplicate safely
        $db->query($sql . ' ON DUPLICATE KEY UPDATE hits = hits + 1');
    }
}
