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
</div>


