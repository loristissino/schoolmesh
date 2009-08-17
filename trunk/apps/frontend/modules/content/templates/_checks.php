<?php use_helper('Javascript') ?>

<h2><?php echo __('Checks') ?></h2>

<p><?php echo format_number_choice('[0]No check was done.|[1]One check was done.|(1,+Inf]A total of %1 checks were done.', array('%1'=>sizeof($checkList->getAllChecks())), sizeof($checkList->getAllChecks())); ?></p>
<ul>
<?php foreach(array(Check::PASSED=>'green', Check::WARNING=>'orange', Check::FAILED=>'red') as $key=>$value): ?>
<?php if($checkList->getTotalResults($key)>0): ?>
<li>
<strong style="color:<?php echo $value ?>">
<?php echo format_number_choice($checkList->getLongMessage($key), array('%1'=>$checkList->getTotalResults($key)), $checkList->getTotalResults($key)) ?>
</strong>
</li>
<?php endif ?>
<?php endforeach ?>
</ul>

<hr />

<?php foreach($checkList->getGroupNames() as $groupname): ?>
	<p>
	<strong>
	<?php echo link_to_function(
	$groupname,
  visual_effect('toggle_blind', $groupname)
) ?></strong>  (<?php foreach(array(Check::PASSED=>'green', Check::WARNING=>'orange', Check::FAILED=>'red') as $key=>$value): ?>

<?php if($checkList->getResultsByGroupName($groupname, $key)>0): ?>
	<span style="color: <?php echo $value ?>">
		<?php echo format_number_choice($checkList->getShortMessage($key), array('%1'=>$checkList->getResultsByGroupName($groupname, $key)), $checkList->getResultsByGroupName($groupname, $key)) ?> 
	</span>
<?php endif ?>
<?php endforeach ?>)
</p>

		<div class='check_results' id="<?php echo $groupname ?>" style="display:<?php  echo (!$start_closed and $checkList->getResultsByGroupName($groupname, Check::FAILED)>0)? 'visible': 'none' ?>">
		<?php foreach($checkList->getChecksByGroupName($groupname) as $check): ?>
		<p>
			<?php echo image_tag($check->getImageTag(), 'title=' . $check->getImageTitle()); ?>
			<?php echo $check->getMessage() ?>
		</p>
		<?php endforeach ?>
		</div>
<?php endforeach ?>
