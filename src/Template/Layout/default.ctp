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
    <header class="top-header display-inline">
        <div id="nav-drawer">
            <input id="nav-input" type="checkbox" class="nav-unshown">
            <label id="nav-open" for="nav-input"><span></span></label>
            <label class="nav-unshown" id="nav-close" for="nav-input"></label>
            <div id="nav-content">
                <ul>
                    <li class="nav-title">カクテル.com</li>
                    <li><a href="<?= $this->Url->build('/') ?>">カクテルを検索</a></li>
                    <li><a href="<?= $this->Url->build('/cocktails/add') ?>">カクテルを作成</a></li>
                    <li><a href="<?= $this->Url->build('') ?>">材料を管理</a></li>
                </ul>
            </div>
        </div>
        <div class="title">
            <a href="<?= $this->Url->build('/') ?>"><?= $this->fetch('title') ?></a>
        </div>
    </header>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
