<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    public $layout = '_layout';

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->assign('title', 'カクテル.com');

        // パス別の処理
        switch ($this->templatePath) {
            case 'Cocktails':
                // 表示に必要は区分値
                $this->set('glass_list', Configure::read('glass'));
                $this->set('percentage_list', Configure::read('percentage'));
                $this->set('taste_list', Configure::read('taste'));
                $this->set('category_list', Configure::read('category_kbn'));
                $this->set('no_img_url', '/img/no_image.jpg');

                // テンプレート別処理
                switch ($this->template){
                    case 'index':
                    case 'search':
                    case 'add':
                    case 'edit':
                        // マスタキャッシュをセット
                        $this->set('tags_master', Cache::read('tags_master'));
                        break;
                }
                break;
            case 'Elements':
                $this->set('category_list', Configure::read('category_kbn'));
                break;
        }
    }
}
