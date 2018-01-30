<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use App\Model\Common\Logger;

/**
 * Application Controller
 */
class AppController extends Controller
{
    protected $logger;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        // ログ出力用メソッド登録
        $this->logger = new Logger();

        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }
}
