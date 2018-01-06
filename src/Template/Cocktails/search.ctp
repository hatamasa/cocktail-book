<?php
use Cake\Core\Configure;

$glass = Configure::read('glass');
$percentage = Configure::read('percentage');
$taste = Configure::read('taste');
?>

<div class="resultsCol">
	<?php foreach ($results as $row): ?>
	<ul>
		<li>id: <?php echo $row['id']?></li>
		<li><?php echo $row['name']?></li>
		<li>グラス：<?php echo $glass[$row['glass']]?></li>
		<li>強さ： <?php echo $percentage[$row['percentage']]?></li>
		<li>色： <?php echo $row['color']?></li>
		<li>味： <?php echo $taste[$row['taste']]?></li>
	</ul>
    <?php endforeach; ?>
</div>
