<?php if(isset($messages)):?>
<div class="messages-form">
<?php foreach ($messages as $message): ?>
  <p><?php echo $message?></p>
<?php endforeach;?>
</div>
<?php endif;?>