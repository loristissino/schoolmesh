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
      <th class="sf_admin_text">Title</th>
      <th class="sf_admin_text">Content</th>
      <th class="sf_admin_text">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($wpinfos as $wpinfo): ?>
	<?php if($state >= $wpinfo->getWpinfoType()->getState()): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <th><?php echo $wpinfo->getWpinfoType()->getTitle() ?></th>
      <td><?php echo  html_entity_decode($wpinfo->getContent()) ?></td>
      <td>
		<ul class="sf_admin_td_actions">
			<?php if ($state==Workflow::WP_DRAFT): ?>
			<li class="sf_admin_action_fill">
			<?php /* here I should show edit or show depending on the state */ ?>
				<?php echo link_to(
				__('Fill'),
				'wpinfo/edit?id='.$wpinfo->getId(),
				array('method' => 'get') 
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