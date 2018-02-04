<header class="top-header display-inline">
    <div id="nav-drawer">
        <input id="nav-input" type="checkbox" class="nav-unshown">
        <label id="nav-open" for="nav-input"><span></span></label>
        <label class="nav-unshown" id="nav-close" for="nav-input"></label>
        <div id="nav-content">
            <ul>
                <li class="nav-title">カクテル.com</li>
                <a href="<?= $this->Url->build('/') ?>"><li>カクテルを検索</li></a>
                <!-- TODO 管理者ログイン時のみ表示 -->
                <a href="<?= $this->Url->build('/admin/cocktails/add') ?>"><li>カクテルを作成</li></a>
                <a href="<?= $this->Url->build('/admin/elements') ?>"><li>材料を管理</li></a>
            </ul>
        </div>
    </div>
    <div class="title">
        <a href="<?= $this->Url->build('/') ?>"><?= $this->fetch('title') ?></a>
    </div>
</header>