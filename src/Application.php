<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Cache\Cache;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\ORM\TableRegistry;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware($middlewareQueue)
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(ErrorHandlerMiddleware::class)

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(AssetMiddleware::class)

            // Add routing middleware.
            ->add(new RoutingMiddleware($this));

        return $middlewareQueue;
    }

    public function bootstrap()
    {
        // config/bootstrap.php を `require_once`  するために parent を呼びます。
        parent::bootstrap();

        // エレメントマスタキャッシュがない場合はDBより読み込む
        if(($elements_master = Cache::read('elements_master')) === false ){
            $elementsRepository = TableRegistry::get('Elements');
            $elements_master = $elementsRepository->find('all', [
                'all' => ['Elements.name' => 'ASC']
            ])->toArray();
            Cache::write('elements_master', $elements_master);
        }

        // タグマスタキャッシュがない場合はDBより読み込む
        if(($tags_master = Cache::read('tags_master')) === false ){
            $tagsRepository = TableRegistry::get('Tags');
            $tags_master = $tagsRepository->find('all', [
                'order' => ['Tags.name' => 'ASC']
            ])->toArray();
            Cache::write('tags_master', $tags_master);
        }

    }
}

