<?php slot('title', __('Classes')) ?>
<?php slot('breadcrumbs',
	__('Classes') 
	)
	
	?>
	<h1><?php echo __('Classes') ?></h1>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Id') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($schoolclasses as $schoolclass): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $schoolclass->getId() ?></td>
      <td><?php echo $schoolclass->getDescription() ?></td>
	<td>
				<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_view">
					<?php echo link_to(
				__('View'),
				'schoolclasses/view?id='.$schoolclass->getId(),
				array('title'=>__('View the composition of this class'))
				)?>
				</li>
			</ul>
	</td>  
    </tr>
    <?php endforeach; ?>
  </tbody>  
</table>  

<hr />
<?php include_partial('dacancellare') ?>

