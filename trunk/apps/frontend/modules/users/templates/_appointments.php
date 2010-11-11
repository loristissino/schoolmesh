<div id='appointments'>
<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Year') ?></th>
		<th class="sf_admin_text"><?php echo __('Class') ?></th>
		<th class="sf_admin_text"><?php echo __('Subject') ?></th>
		<th class="sf_admin_text"><?php echo __('Hours') ?></th>
		<th class="sf_admin_text"><?php echo __('State') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($current_user->getWorkplans() as $appointment): ?>
	<tr>
    <?php include_partial('content/td_year', array('year'=>$appointment->getYear())) ?>
    <td>
			<?php echo $appointment->getSchoolclass()->getId() ?>
		</td>
		<td>
			<?php echo $appointment->getSubject() ?>
		</td>
		<td>
			<?php echo $appointment->getHours() ?>
		</td>
		<td>
			<?php include_partial('plansandreports/state', array('state' => $appointment->getState(), 'steps' => Workflow::getWpfrSteps(), 'size'=>'r')) ?>
		<td>
			<ul class="sf_admin_td_actions">
				<?php  if ($appointment->getState()==Workflow::AP_ASSIGNED): ?>
				<li class="sf_admin_action_edit">
				<?php echo link_to(
					__('Edit'),
					url_for('users/editappointment?id='.$appointment->getId())
					)
				?>
				</li>				
				<?php endif ?>
				<?php  if ($appointment->getState()==Workflow::AP_ASSIGNED): ?>
				<li class="sf_admin_action_delete">
				<?php echo link_to(
					__('Delete'),
					url_for('users/removeappointment?id='.$current_user->getUserId(). '&appointment=' . $appointment->getId()),
					array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
					)
				?>
				</li>
				<?php endif ?>
				<?php  if ($sf_user->hasCredential('backadmin')): ?>
				<li class="sf_admin_action_log">
				<?php echo link_to(
					__('View events'),
					url_for('plansandreports/viewwpevents?id='.$appointment->getId())
					)
				?>
				</li>
				<?php endif ?>
        
				<?php /*
				<?php  if ($sf_user->hasCredential('backadmin')): ?>
				<li class="sf_admin_action_upload">
				<?php echo link_to(
					__('Upload file'),
					url_for('users/upload?id='.$current_user->getUserId(). '&appointment=' . $appointment->getId() . '&what=workplan')
					)
				?>
				</li>
				<?php endif ?>
				<?php */ ?>

			</ul>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
<ul class="sf_admin_actions">
<li class="sf_admin_action_new">
<?php
echo link_to(
__('Add appointment'),
url_for('users/addappointment?user='.$current_user->getUserId())
) ?>
</li>
</ul>

</div>
