<div id='enrolments'>
<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Year') ?></th>
		<th class="sf_admin_text"><?php echo __('Class') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($current_user->getEnrolments() as $enrolment): ?>
	<tr>
		<th>
			<?php echo $enrolment->getYear() ?>
		</th>
		<td>
			<?php echo $enrolment->getSchoolclass() ?>
		</td>
		<td>
			<ul class="sf_admin_td_actions">
				<?php // if ($enrolment->getYear()->getId()==sfConfig::get('app_config_current_year')): ?>
				<li class="sf_admin_action_edit">
				<?php echo link_to(
					__('Edit'),
					url_for('users/editenrolment?id='.$enrolment->getId())
					)
				?>
				</li>
				<?php // endif ?>
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
__('Add enrolment'),
url_for('users/addenrolment?user='.$current_user->getUserId())
) ?>
</li>
</ul>

</div>
