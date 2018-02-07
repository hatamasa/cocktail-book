<h1>管理者ログイン</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('login') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('ログイン') ?>
<?= $this->Form->end() ?>