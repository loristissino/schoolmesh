<?php use_helper('jQuery') ?>

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

<?php foreach($checkList->getRawValue()->getGroupNames() as $groupname): ?>
	<p>
	<strong>
	<?php echo jq_link_to_function(
	image_tag($checkList->getResultsByGroupName($groupname, Check::FAILED)>0? 'stop': 'go', array('alt'=>'')),
  jq_visual_effect('slideToggle', '#r' .md5($groupname))
) ?> &nbsp;<?php echo __($groupname) ?></strong>  (<?php echo check_count($checkList, $groupname) ?>)</p>

		<div class='check_results' id="r<?php echo md5($groupname) ?>" style="display:<?php  echo ($show_successes or (!$start_closed and ($checkList->getResultsByGroupName($groupname, Check::FAILED)+$checkList->getResultsByGroupName($groupname, Check::WARNING))>0))? 'visible': 'none' ?>">
		<?php foreach($checkList->getChecksByGroupName($groupname) as $check): ?>
		<p>
			<?php echo image_tag($check->getImageTag(), array('title'=>$check->getImageTitle(), 'alt'=>$check->getImageTitle())); ?>
			<?php echo __($check->getMessage()) ?>
			<?php if ($check->getLinkTo()): ?>
				<?php echo link_to(image_tag('fill', array('alt'=>__('Fill'))), $check->getLinkTo(), array('title'=>__('Fill'))) ?>
			<?php endif ?>
      
		</p>
		<?php endforeach ?>
		</div>
<?php endforeach ?>

<?php if($sf_request->getReferer()): ?>
<h2><?php echo __('Actions') ?></h2>
	<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
      'action_back',
      true,
      __('Back'),
      $sf_request->getReferer()
      )?>
  </ul>
<?php endif ?>
