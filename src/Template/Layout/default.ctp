<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <script type="text/javascript" src="/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <?= $this->Html->meta('icon') ?>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('cocktail-book.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header class="top-header">
        <ul>
            <li>
                <h1 class="title"><a href="<?= $this->Url->build('/') ?>"><?= $this->fetch('title') ?><span>▼</span></a></h1>
                <ul>
                    <li><a href="<?= $this->Url->build('/') ?>">カクテルを検索</a></li>
                    <li><a href="<?= $this->Url->build('/cocktails/add') ?>">カクテルを作成</a></li>
                    <li><a href="<?= $this->Url->build('') ?>">材料を管理</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
