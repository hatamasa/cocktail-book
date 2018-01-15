<?php if(isset($errors[$name])):?>
<div class="input-errors">
<?php foreach ($errors[$name] as $error):?>
    <div><?php echo $error?></div>
<?php endforeach;?>
</div>
<?php endif;?>