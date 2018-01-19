<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Sample</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->css('boottest.css') ?>
    <!-- jQuery読み込み -->
    <script type="text/javascript" src="/js/jquery-3.2.0.min.js"></script>

    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Hello, world!</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 font-sp">カラム1コンテンツ</div>
            <div class="col-lg-8 font-sp">カラム2コンテンツ</div>
            <div class="col-lg-2 font-sp">カラム3コンテンツ</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2">カラム1コンテンツ</div>
            <div class="col-md-8">カラム2コンテンツ</div>
            <div class="col-md-2">カラム3コンテンツ</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-2">カラム1コンテンツ</div>
            <div class="col-sm-8">カラム2コンテンツ</div>
            <div class="col-sm-2">カラム3コンテンツ</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-2">カラム1コンテンツ</div>
            <div class="col-xs-8">カラム2コンテンツ</div>
            <div class="col-xs-2">カラム3コンテンツ</div>
        </div>
    </div>
</body>
</html>