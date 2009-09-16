<div id='credentials'>
<table>
	<tr>
		<th><label><?php echo __('Credentials') ?></label></th>
		<td>
		<ul>
			<?php foreach($current_user->getSfGuardUser()->getAllPermissions() as $permission): ?>
				<li><?php echo $permission ?></li>
			<?php endforeach ?>
		</ul>
		</td>
	</tr>
</table>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential('backadmin')): ?>
<li class="sf_admin_action_new">
<?php
echo link_to(
__('Add credential'),
url_for('users/addcredential?user='.$current_user->getUserId())
) ?>
</li>
<?php endif ?>
</ul>

</div>


