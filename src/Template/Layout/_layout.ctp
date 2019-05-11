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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139979567-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-139979567-1');
    </script>
    <?= $this->Html->meta('icon') ?>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('cocktail-com.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <!-- facebook -->
    <meta property="og:url"           content="https://cocktail-com.herokuapp.com/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="カクテル.com" />
    <meta property="og:description"   content="タグや雰囲気からカクテルを探せるサイト!!" />
    <meta property="og:image"         content="https://s3-ap-northeast-1.amazonaws.com/cocktails-img-bucket/main.jpeg" />
</head>
<body>
    <!-- facebook -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.12';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- twitter -->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    <?= $this->element('_header'); ?>
    <div class="container">
        <div class="main">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        </div>
    </div>
    <div class="push"></div>
    <?= $this->element('_footer'); ?>
    <?= $this->fetch('script') ?>
</body>
</html>
