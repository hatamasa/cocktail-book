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

    // ajax材料セレクトボックス取得
    $routes->get('/cocktails/getElementsOptions/:id', ['controller' => 'Cocktails', 'action' => 'getElementsOptions'])
    ->setPatterns(['id' => '\d+'])
    ->setPass(['id']);
    // ajax材料テーブルを追加する
    $routes->post('/cocktails/mergeElementsTable', ['controller' => 'Cocktails', 'action' => 'mergeElementsTable']);
    // ajax材料テーブルから削除する
    $routes->post('/cocktails/deleteElementsTable', ['controller' => 'Cocktails', 'action' => 'deleteElementsTable']);

    $routes->fallbacks(DashedRoute::class);
});

Plugin::routes();
