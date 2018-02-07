<?php
namespace App\Controller;

use Cake\Controller\Controller;
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

        $this->loadComponent('Auth', [
            // 認可
            'authorize' => 'Controller',
            // ログイン認証
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'login',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            // 未認証の場合、直前のページに戻します
            'unauthorizedRedirect' => $this->referer()
        ]);

        // 未承認で許可するアクション
        $this->Auth->allow(['index', 'search', 'view']);
    }

    /**
     * 'authorize' => 'Controller'でアクセスのたびに評価される
     * allowで許可させているアクションでは実行されない
     * {@inheritDoc}
     * @see \Cake\Controller\Controller::isAuthorized($user)
     */
    public function isAuthorized($user)
    {
        // デフォルトでは、アクセスを拒否します。
        return false;
    }

}
