<div id='guardgroups'>
<table>
	<tr>
		<th><label><?php echo __('GuardGroups') ?></label></th>
		<td>
		<ul>
			<?php foreach($current_user->getGuardGroups() as $guardgroup): ?>
				<li><?php echo $guardgroup->getsfGuardGroup()->getName() ?></li>
			<?php endforeach ?>
		</ul>
		</td>
	</tr>
</table>
</div>


