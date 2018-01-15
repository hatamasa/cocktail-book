<div class="errors-form">
<?php foreach ($errors as $error):?>
    <?php if(is_array($error)):?>
        <?php foreach ($error as $errormsg):?>
        	    <p><?php echo $errormsg?></p>
        <?php endforeach;?>
    <?php else: ?>
        	<p><?php echo $error?></p>
    <?php endif; ?>
<?php endforeach;?>
</div>
<div class="messages-form">
<?php foreach ($messages as $message): ?>
	<p><?php echo $message?></p>
<?php endforeach;?>
</div>