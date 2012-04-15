<div id='credentials'>
<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Name') ?></th>
		<th class="sf_admin_text"><?php echo __('Description') ?></th>
		<th class="sf_admin_text"><?php echo __('Type') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($current_user->getSfGuardUser()->getAllPermissions() as $permission): ?>
	<tr>
		<th>
			<?php echo $permission->getName() ?>
		</th>
		<td>
			<?php echo $permission->getDescription() ?>
		</td>
		<td>
			<?php echo $current_user->hasUserPermission($permission->getName())? __('Individual'):__('Inherited') ?>
		</td>
		<td>
			<ul class="sf_admin_td_actions">
				<?php if ($sf_user->hasCredential('backadmin') && $current_user->hasUserPermission($permission->getName())): ?>
				<li class="sf_admin_action_delete">
				<?php echo link_to(
					sprintf(__('Revoke this credential for %s'), $current_user->getFullName()),
					url_for('users/revokepermission?id='.$current_user->getUserId(). '&permission=' . $permission->getName()),
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
__('Grant a new credential'),
url_for('users/addcredential?user='.$current_user->getUserId())
) ?>
</li>
<?php endif ?>
</ul>

</div>


