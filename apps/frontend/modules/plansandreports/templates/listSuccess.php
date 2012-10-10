<?php include_partial('content/breadcrumps', array(
  'current'=>__('Appointments management'),
  'title'=>__("Workplans and reports' monitoring")
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('content/pagerhead', array('pager'=>$pager)) ?>

<?php if($pager->getNbResults()>0): ?>

<?php include_partial('content/pager', array('pager'=>$pager, 'link'=>'plansandreports/list')) ?>

<form action="<?php echo url_for('plansandreports/batch') ?>" method="post">

<table cellspacing="0">
  <thead>
    <tr>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>

      <th class="sf_admin_text"><?php echo link_to(__('Class'), url_for( 'plansandreports/setsortlistpreference?sortby=class')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Type'), url_for( 'plansandreports/setsortlistpreference?sortby=type')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Subject'), url_for('plansandreports/setsortlistpreference?sortby=subject')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Teacher'), url_for( 'plansandreports/setsortlistpreference?sortby=teacher')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Hours'), url_for( 'plansandreports/setsortlistpreference?sortby=hours'))  ?></th>
	  <?php /*<th class="sf_admin_text"><?php echo __('Last action') ?></th> */ ?>
	  <th class="sf_admin_text"><?php echo link_to(__('State'), url_for( 'plansandreports/setsortlistpreference?sortby=state')) ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($pager->getResults() as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
	<td>
  <input type="checkbox" name="ids[]" value="<?php echo $workplan->getId() ?>" class="sf_admin_batch_checkbox" />
</td>

      <td><?php echo link_to($workplan->getSchoolclassId(), url_for('schoolclasses/appointments?id=' . $workplan->getSchoolclassId() . '&type=' . $workplan->getAppointmentTypeId())) ?></td>
      <td><?php echo $workplan->getAppointmentType() ?></td>
      <td><?php if($workplan->getSubject()): ?><?php echo $workplan->getSubject()->getDescription() ?><?php endif ?></td>
      <td>
      <?php if($sf_user->hasCredential('admin')): ?>
        <?php echo link_to(
          $workplan->getFullName(),
          url_for('users/edit?id=' . $workplan->getsfGuardUser()->getId()). '#appointments'
          )
        ?>
      <?php else: ?>
        <?php echo $workplan->getFullName() ?>
      <?php endif ?>
      </td>
	  <td><?php echo $workplan->getHours() ?></td>
	  <?php /*<?php $lastlog=$workplan->getLastLog() ?>  
	  <td><?php echo $lastlog?$lastlog->getCreatedAt():'' ?></td>*/ ?>
	  <td><?php  include_partial('state', array('state' => $workplan->getState(), 'steps' => $steps, 'size'=>'r')) ?></td>
	  <td><?php  include_partial('action_monitor', array('workplan' => $workplan, 'steps' => $steps, 'page'=> $page))  ?></td>

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('content/pager', array('pager'=>$pager, 'link'=>'plansandreports/list')) ?>


<?php include_partial('checkalljs') ?>
    <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
        <select name="batch_action">

          <?php echo optionsforselect(array(
            '' => __('Choose an action'),
            'Approve' => __('Approve selected documents'),
            ), null) ?>
        </select>
        <?php echo submittag(_('Ok')) ?>
      </li>
    </ul>
</form>

<?php endif ?>

<hr />

<h2><?php echo __('Filters') ?></h2>
<?php include_partial('content/filter',
	array(
		'title'=>'State',
		'type'=>'state',
		'link_selectall'=>'All states',
		'link_selectall_tooltip'=>'Show documents in all states',
		'items'=>$states,
		'separator'=>' - '
		)
	)
?>
<?php include_partial('content/filter',
	array(
		'title'=>'Teacher',
		'type'=>'teacher',
		'link_selectall'=>'All teachers',
		'link_selectall_tooltip'=>'Show documents of all teachers',
		'items'=>$teachers,
		'separator'=>' - '
		)
	)
?>
<?php  include_partial('content/filter',
	array(
		'title'=>'Subject',
		'type'=>'subject',
		'link_selectall'=>'All subjects',
		'link_selectall_tooltip'=>'Show documents for all subjects',
		'items'=>$subjects,
		'separator'=>' - '
		)
	) 
?>
<?php include_partial('content/filter',
	array(
		'title'=>'Class',
		'type'=>'class',
		'link_selectall'=>'All classes',
		'link_selectall_tooltip'=>'Show documents for all classes',
		'items'=>$schoolclasses,
		'separator'=>' - '
		)
	)
?>
<?php include_partial('content/filter',
	array(
		'title'=>'Appointment type',
		'type'=>'type',
		'link_selectall'=>'All appointment types',
		'link_selectall_tooltip'=>'Show documents for all appointment types',
		'items'=>$appointment_types,
		'separator'=>' - '
		)
	)
?>
<?php include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'plansandreports/list')) ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('wpfr_monitoring'), __('Appointments recapitulation'), 'plansandreports/recapitulation') ?>
</ul>
