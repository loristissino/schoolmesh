<?php use_helper('jQuery') ?>
<?php if($sf_user->getProfile()->getPrefersRichtext()): ?>
  <?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php endif ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$wpinfo->getAppointment()->getId() => $wpinfo->getAppointment()
    ),
  'current'=>$type->getTitle()
  ))
?>

<? /* FIXME: I should use CSS here, instead of the table */ ?>
<table>
<tr>
<td>

<div id="sf_admin_content">
<h2><?php echo $type->getTitle() ?></h2>
<p>
	<?php if ($type->getIsRequired()): ?>
		<?php echo image_tag('fill', array('title'=> __('Filling required'), 'alt'=> __('Filling required'))) ?>
	<?php else: ?>
		<?php echo image_tag('optional', array('title='=> __('Filling optional'), 'alt'=> __('Filling required'))) ?>
	<?php endif ?>
	
	<?php echo $type->getDescription() ?></p>
	<?php if ($type->getTemplate()): ?>
		<p><?php echo image_tag('star', array('alt'=> __('*'))) ?> <strong><em><?php echo __('This content must match a template. You can base it on the example provided below.') ?></em></strong>
	<?php endif ?>
</p>

<?php if ($sf_user->hasFlash('error_info')): ?>
  <div class="error"><p><?php echo $sf_user->getFlash('error_info')?></p></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('notice_info')): ?>
  <div class="notice"><p><?php echo $sf_user->getFlash('notice_info')?></p></div>
<?php endif; ?>
<form action="<?php echo url_for('wpinfo/update?id='.$wpinfo->getId()) ?>" method="post" id="editform">

<?php if($sf_user->getProfile()->getPrefersRichtext()): ?>

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
<?php endif ?>

<textarea name="value" class="mceAdvanced" style="width:600px" rows="20" cols="50">
<?php if ($sf_user->getProfile()->getPrefersRichtext()): ?><?php echo nl2br($wpinfo->getContent()) ?><?php else: ?><?php echo br2nl($wpinfo->getContent()) ?><?php endif ?></textarea>

<h2><?php echo __('Actions') ?></h2>

<ul class="sf_admin_actions">
	<li class="sf_admin_action_save">
	<a href="<?php echo url_for('plansandreports/fill?id='.$wpinfo->getAppointment()->getId()) ?>" 
		onClick="var f = document.getElementById('editform'); var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'save'); m.setAttribute('value', 'save'); f.appendChild(m); f.submit(); return false;"
		title="<?php echo __('Save what you wrote until now') ?>"
	><?php echo __("Save") ?></a><br>
	</li>
	<li class="sf_admin_action_saveandback">
	<a href="<?php echo url_for('plansandreports/fill?id='.$wpinfo->getAppointment()->getId()) ?>" 
		onClick="var f = document.getElementById('editform'); var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'back'); m.setAttribute('value', 'back'); f.appendChild(m); f.submit(); return false;"
		title="<?php echo __('Save this content and go back to the main document') ?>"
	><?php echo __("Save and go back to the main document") ?></a>
	</li><br>
<?php if($next_item): ?>
	<li class="sf_admin_action_saveandnext">
	<a href="<?php echo url_for('plansandreports/fill?id='.$wpinfo->getAppointment()->getId()) ?>" 
	onClick="var f = document.getElementById('editform'); var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'continue'); m.setAttribute('value', 'continue'); f.appendChild(m); f.submit(); return false;"
		title="<?php echo sprintf(__('Save and start editing the next item, that happens to be «%s»'), $next_item->getWpinfoType()->getTitle()) ?>"
	><?php echo sprintf(__('Save and go to next item, «%s»'), $next_item->getWpinfoType()->getTitle()) ?></a>
	</li>
<?php endif ?>
</ul>

</form>
</div>


</td>
<td>

<div id="sf_admin_bar">

<h3><?php echo __('Hints') ?></h3>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#hints')
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
  <tbody>
<?php foreach($hints as $hint): ?>
	<?php $i=0 ?>
			<tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
				<td><?php echo html_entity_decode($hint->getContent()); ?></td>
				<td>
					<?php foreach($hint->getUsedIn() as $used_in): ?>
						<em>&nbsp;<?php echo sprintf(__('Used in «%s»'), $used_in ? $used_in : __('orphan module')); ?></em><br />
					<?php endforeach; ?>
					</ul>
				</td>
				<td>
						<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_append">
							<?php echo link_to(
							__('Append it'),
							'wpinfo/append?id='.$wpinfo->getId() . '&app='.$hint->getId(),
							array('method' => 'put', 'title'=>__('Append this content to what you wrote and saved')) 
							)?>
						</li>
						<li class="sf_admin_action_replace">
							<?php echo link_to(
							__('Use it'),
							'wpinfo/replace?id='.$wpinfo->getId() . '&app='.$hint->getId(),
							array('method' => 'put',  'title'=>__('Replace what you wrote with this content')) 
							)?>
						</li>
					</ul>
				</td>
			</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php else: ?>
<p><?php echo __('No hints avaliable for this item.') ?></p>
<?php endif; ?>
</div>

<?php if($example!=$wpinfo->getContent()): ?>
<h3><?php echo __('Example') ?></h3>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#example')
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
							array('method' => 'put',  'title'=>__('Replace what you wrote with this content')) 
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
<?php endif ?>

</td>
</tr>
</table>


</div>

