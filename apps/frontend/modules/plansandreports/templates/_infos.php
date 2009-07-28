<?php if ($sf_user->hasFlash('notice_info')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice_info')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error_info')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_info')?></div>
<?php endif; ?>
<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Last update') ?></th>
      <th class="sf_admin_text"><?php echo __('Content') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($wpinfos as $wpinfo): ?>
	<?php if($state >= $wpinfo->getWpinfoType()->getState()): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <th><?php echo $wpinfo->getWpinfoType()->getTitle() ?></th>
      <td><?php echo Generic::datetime($wpinfo->getUpdatedAt('U'), $sf_context) ?></td>
      <td>
		  <?php if ($wpinfo->getContent()=='' and $wpinfo->getWpinfoType()->getIsRequired()): ?>
			<?php echo image_tag('notdone', 'title=' . __('this content is required and is currently missing')) ?>
	  <?php endif ?>
	<?php echo  html_entity_decode($wpinfo->getContent()) ?></td>
      <td>
		<ul class="sf_admin_td_actions">
			<?php if ($wpinfo->getWpinfoType()->getState()==$state): ?>
			<li class="sf_admin_action_<?php echo $wpinfo->getWpinfoType()->getIsRequired()? 'fill':'optional'; ?>">
				<?php echo link_to(
				__('Fill'),
				'wpinfo/edit?id='.$wpinfo->getId(),
				array('title'=>$wpinfo->getWpinfoType()->getIsRequired()?__('Fill this field (required)'):__('Fill this field (optional)')) 
				)?>
			</li>
			<?php endif ?>
		</ul>
	  </td>
    </tr>
    <?php endif ?>
   <?php endforeach; ?>
  </tbody>
</table>
</div>