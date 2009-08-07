<div id='teams'>
<table>
	<tr>
		<th><label><?php echo __('Teams') ?></label></th>
		<td>
		<ul>
			<?php foreach($current_user->getTeams() as $team): ?>
				<li><?php echo $team->getTeam() ?> (<?php echo $team->getRole() ?>)</li>
			<?php endforeach ?>
		</ul>
		</td>
	</tr>
</table>
</div>


