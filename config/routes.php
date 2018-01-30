<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    // 初期表示、検索画面表示
    $routes->get('/', ['controller' => 'Cocktails', 'action' => 'index']);
    // 検索
    $routes->get('/cocktails/search', ['controller' => 'Cocktails', 'action' => 'search']);
    // 詳細表示
    $routes->get('/cocktails/:id', ['controller' => 'Cocktails', 'action' => 'view'])
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);
    // 編集画面表示
    $routes->get('/cocktails/:id/edit', ['controller' => 'Cocktails', 'action' => 'edit'])
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);
    // 編集
    $routes->put('/cocktails/:id/edit', ['controller' => 'Cocktails', 'action' => 'edit'])
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);
    // 新規作成画面表示
    $routes->get('/cocktails/add', ['controller' => 'Cocktails', 'action' => 'add']);
    // 新規作成
    $routes->post('/cocktails/add', ['controller' => 'Cocktails', 'action' => 'add']);

    // ajax材料セレクトボックス取得
    $routes->get('/cocktails/getElementsOptions/:id', ['controller' => 'Cocktails', 'action' => 'getElementsOptions'])
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);
    // ajax材料テーブルを追加する
    $routes->post('/cocktails/mergeElementsTable', ['controller' => 'Cocktails', 'action' => 'mergeElementsTable']);
    // ajax材料テーブルから削除する
    $routes->post('/cocktails/deleteElementsTable', ['controller' => 'Cocktails', 'action' => 'deleteElementsTable']);

    // 材料管理初期表示
    $routes->get('/elements', ['controller' => 'Elements', 'action' => 'index']);
    // 材料検索
    $routes->post('/elements/search', ['controller' => 'Elements', 'action' => 'search']);
    // 材料詳細表示
    $routes->post('/elements/:id', ['controller' => 'Elements', 'action' => 'show'])
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);


    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
