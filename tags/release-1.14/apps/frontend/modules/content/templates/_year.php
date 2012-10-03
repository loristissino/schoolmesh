<h3><?php echo __('Year') ?></h3>
<?php $count=0 ?>
<?php foreach($years as $y): ?>
	<?php if(($year!=$y->getId())): ?>
	<?php echo link_to(
		__($y->__toString()),
		url_for('content/setyear?id='.$y->getId(). '&back='. Generic::b64_serialize($back)),
		array(
			'title'=>__('Select the year %year%', array('%year%'=>$y->getDescription()))
			)
		)
	?>
	<?php else: ?>
		<strong><?php echo $y->__toString() ?></strong>
    <?php if ($year!=sfConfig::get('app_config_current_year')): ?>
      <?php slot('general_alerts', __('You are currently working on year %set_year%, not on current year.', array('%set_year%'=>$y->__toString()))) ?>
    <?php endif ?>
    
	<?php endif ?>
  <?php if($count++<sizeof($years)-1): ?>
    <?php echo ' - ' ?>
  <?php endif ?>
<?php endforeach ?>
