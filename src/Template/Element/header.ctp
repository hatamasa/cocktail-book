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
                <li><a href="<?= $this->Url->build('/elements') ?>">材料を管理</a></li>
            </ul>
        </div>
    </div>
    <div class="title">
        <a href="<?= $this->Url->build('/') ?>"><?= $this->fetch('title') ?></a>
    </div>
</header>