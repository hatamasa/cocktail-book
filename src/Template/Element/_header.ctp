<header class="top-header display-inline">
    <div id="nav-drawer">
        <input id="nav-input" type="checkbox" class="nav-unshown">
        <label id="nav-open" for="nav-input"><span></span></label>
        <label class="nav-unshown" id="nav-close" for="nav-input"></label>
        <div id="nav-content">
            <ul>
                <li class="nav-title">カクテル.com</li>
                <a href="<?= $this->Url->build('/') ?>"><li>カクテルを検索</li></a>
                <?php if ($auth->user()): ?>
                <li class="nav-title">管理者メニュー</li>
                <a href="<?= $this->Url->build('/cocktails/add') ?>"><li>カクテルを作成</li></a>
                <a href="<?= $this->Url->build('/elements') ?>"><li>管理画面</li></a>
                <a href="<?= $this->Url->build('/users/logout/') ?>"><li>ログアウト</li></a>
                <?php endif;?>
            </ul>
        </div>
    </div>
    <div class="title">
        <a href="<?= $this->Url->build('/') ?>"><?= $this->fetch('title') ?></a>
        <?php if ($auth->user()): ?>
        <ul>
            <li><?=$this->request->session()->read('Auth.User.login')?>でログイン中</li>
        </ul>
        <?php endif;?>
    </div>
</header>