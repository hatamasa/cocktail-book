<?php if(isset($errors[$name])):?>
<div class="input-errors">
<?php foreach ($errors[$name] as $error):?>
    <?php if(is_array($error)):?>
        <?php foreach ($error as $e):?>
            <div><?= $e?></div>
        <?php endforeach;?>
    <?php else:?>
        <div><?= $error?></div>
    <?php endif;?>
<?php endforeach;?>
</div>
<?php endif;?>