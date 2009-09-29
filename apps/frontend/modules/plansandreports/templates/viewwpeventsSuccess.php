<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' .
	__('View events')
	)
	
	?><h1><?php echo __("Workplan: ") . $workplan ?></h1>

<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
	<li><?php echo __("State: ") . $workplan->getState() ?></li>
</ul>

<h2><?php echo __('Events') ?></h2>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php if (sizeof($events)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Date') ?></th>
      <th class="sf_admin_text"><?php echo __('User') ?></th>
      <th class="sf_admin_text"><?php echo __('Comment') ?></th>
      <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo Generic::datetime($event->getCreatedAt('U')) ?></td>
      <td><?php echo $event->getSfGuardUser()->getProfile()->getFullname()?></td>
      <td><?php echo $event->getComment()?></td>
      <td><?php include_partial('state', array('steps'=>Workflow::getWpfrSteps(), 'state'=>$event->getState(), 'size'=>'r')) ?></td>
	  <td>
	<ul class="sf_admin_td_actions">  
				<li class="sf_admin_action_edit">
					<?php echo link_to(
				__('Edit'),
				'plansandreports/editwpevent?id=' . $event->getId()
				)?>
				</li>
				<li class="sf_admin_action_delete">
				<?php echo link_to(
					sprintf(__('Delete'), $event->getId()),
					url_for('plansandreports/removewpevent?id='.$event->getId()),
					array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
					)
				?>
				</li>

				
				</ul>
  
	  </td>  
	</tr>
	<?php endforeach ?>
  </tbody>
</table>  

<?php endif ?>

<ul class="sf_admin_actions">
<li class="sf_admin_action_new">
<?php
echo link_to(
__('Add event'),
url_for('plansandreports/addwpevent?appointment='.$workplan->getId())
) ?>
</li>
</ul>
