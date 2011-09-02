<?php if ($workplan->countWpmodules()): ?>
<?php $number=0 ?>
<?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
	<h3><?php echo sprintf(__('Module #%d:&nbsp;'), ++$number) ?><?php echo $wpmodule ?></h3>
	<p><em><?php echo sprintf(__('Period: %s'), $wpmodule->getPeriod()) ?></em></p>
	<?php if($wpmodule->getHoursEstimated()>0): ?>
		<p><em><?php echo __('Hours estimated: ') . $wpmodule->getHoursEstimated() ?></em></p>
	<?php endif ?>
	<?php include_partial('wpmodule/wpmodule_shown', array('wpmodule'=>$wpmodule, 'workplan'=>$workplan)) ?>
  <h4><?php echo __('Syllabus links') ?></h4>
  <?php include_partial('syllabus', array('syllabus_contributions'=>$wpmodule->getSyllabusContributionsWithRefs())) ?>
<?php endforeach; ?>
<?php endif; ?>




