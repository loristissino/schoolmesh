<div id='guardgroups'>
<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Name') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($current_user->getGuardGroups() as $guardgroup): ?>
	<tr>
		<th>
			<?php echo $guardgroup->getsfGuardGroup()->getName() ?>
		</th>
		<td>
			<ul class="sf_admin_td_actions">
				<?php if ($sf_user->hasCredential('backadmin')): ?>
				<li class="sf_admin_action_delete">
				<?php echo link_to(
					sprintf(__('Remove %s from this GuardGroup'), $current_user->getFullName()),
					url_for('users/removefromguardgroup?id='.$current_user->getUserId(). '&guardgroup=' . $guardgroup->getsfGuardGroup()->getName()),
					array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
					)
				?>
				</li>
				<?php endif ?>
			</ul>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential('backadmin')): ?>
<li class="sf_admin_action_new">
<?php
echo link_to(
__('Add to a GuardGroup'),
url_for('users/addtoguardgroup?user='.$current_user->getUserId())
) ?>
</li>
<?php endif ?>
</ul>

</div>
