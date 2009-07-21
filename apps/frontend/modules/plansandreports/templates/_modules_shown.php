<?php if ($workplan->countWpmodules()): ?>
<?php $number=0 ?>
<?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
	<h3><?php echo sprintf(__('Module #%d:&nbsp;'), ++$number) ?><?php echo $wpmodule ?></h3>
	<p><em><?php echo sprintf(__('Period: %s'), $wpmodule->getPeriod()) ?></em></p>
	<?php includepartial('wpmodule/wpmodule_shown', array('wpmodule'=>$wpmodule)) ?>
<?php endforeach; ?>
<?php endif; ?>




