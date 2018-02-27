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
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-4702990894338882",
        enable_page_level_ads: true
      });
    </script>
    <?= $this->Html->meta('icon') ?>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('cocktail-com.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('_header'); ?>
    <div class="container">
        <div class="main">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        </div>
    </div>
    <div class="push"></div>
    <?= $this->element('_footer'); ?>
</body>
</html>
