<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

/*
 * カクテル検索機能
 */
Router::scope('/', function (RouteBuilder $routes) {
    // 初期表示、検索画面表示
    $routes->get('/', ['controller' => 'Cocktails', 'action' => 'index']);
    // 検索
    $routes->get('/cocktails/search', ['controller' => 'Cocktails', 'action' => 'search']);
    // 詳細表示
    $routes->get('/cocktails/:id', ['controller' => 'Cocktails', 'action' => 'view'])
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    $routes->fallbacks(DashedRoute::class);
});

/**
* 管理者画面
*/
Router::scope('/admin', function (RouteBuilder $routes) {
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

    $routes->fallbacks(DashedRoute::class);
});

Plugin::routes();
