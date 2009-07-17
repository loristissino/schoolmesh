<?php use_helper('Javascript') ?>
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($wpinfo->getAppointment()->__toString(), 'plansandreports/fill?id='.$wpinfo->getAppointment()->getId()) . ' » ' . 
	$type->getTitle())
	?>

<h1><?php echo __('Edit Wpinfo') ?></h1>
<h2><?php echo $type->getTitle() ?></h2>
<p>
	<?php if ($type->getIsRequired()): ?>
		<?php echo image_tag('required', 'title=' . __('Filling required')) ?>
	<?php endif ?>
	<?php echo $type->getDescription() ?>
</p>

<?php if ($sf_user->hasFlash('error_info')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_info')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('notice_info')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice_info')?></div>
<?php endif; ?>
<form action="<?php echo url_for('wpinfo/update?id='.$wpinfo->getId()) ?>" method="POST">

<?php echo javascript_tag("
tinyMCE.init({

mode : \"textareas\",

language: \"it\",

entity_encoding : \"raw\",

theme : \"advanced\",

editor_selector : \"mceAdvanced\"

});
") ?>
</script>
<textarea name="value" class="mceAdvanced" style="width:100%">
<?php echo $wpinfo->getContent() ?>
</textarea>
<br />
<input type="submit" name="save" value="<?php echo __("Save") ?>" />
<input type="submit" name="back" value="<?php echo __("Save and go back to workplan") ?>" />
<?php if($next_item): ?>
	<input type="submit" name="continue" value="<?php echo sprintf(__('Save and go to next item (%s)'), $next_item->getWpinfoType()->getTitle()); ?>" />
<?php endif; ?>
</form>

<h2><?php echo __('Hints') ?></h2>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'hints')
) ?>
</li>
</ul>
<div id="hints" style="display:visible">
<?php if(sizeof($hints)>0): ?>
<p><strong><?php echo __('The following sentences were used in other workplans:'); ?></strong></p>
<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Content') ?></th>
      <th class="sf_admin_text"><?php echo __('Information') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>

	<?php foreach($hints as $hint): ?>
	<?php $i=0 ?>
			<tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
				<td><?php echo html_entity_decode($hint->getContent()); ?></td>
				<td>
					<?php foreach($hint->getUsedIn() as $used_in): ?>
						<em>&nbsp;<?php echo sprintf(__('Used in «%s»'), $used_in); ?></em><br />
					<?php endforeach; ?>
					</ul>
				</td>
				<td>
						<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_append">
							<?php echo link_to(
							__('Append it'),
							'wpinfo/append?id='.$wpinfo->getId() . '&app='.$hint->getId(),
							array('method' => 'put') 
							)?>
						</li>
						<li class="sf_admin_action_replace">
							<?php echo link_to(
							__('Use it'),
							'wpinfo/replace?id='.$wpinfo->getId() . '&app='.$hint->getId(),
							array('method' => 'put') 
							)?>
						</li>
					</ul>
				</td>
			</tr>
<?php endforeach; ?>
</table>

<?php else: ?>
<p><?php echo __('No hints avaliable for this item.') ?></p>
<?php endif; ?>
</div>

<h2><?php echo __('Example') ?></h2>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'example')
) ?>
</li>
</ul>
<div id="example" style="display:visible">
<?php if($example): ?>
<p><strong><?php echo __('You can base your text on the following example:'); ?></strong></p>
<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Content') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
			<tr class="sf_admin_row odd">
				<td><?php echo html_entity_decode($example); ?></td>
				<td>
						<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_replace">
							<?php echo link_to(
							__('Use it'),
							'wpinfo/takeexample?id='.$wpinfo->getId(),
							array('method' => 'put') 
							)?>
						</li>
					</ul>
				</td>
			</tr>
</table>

<?php else: ?>

<p><?php echo __('No example avaliable for this item.') ?></p>
<?php endif; ?>
</div>


</div>