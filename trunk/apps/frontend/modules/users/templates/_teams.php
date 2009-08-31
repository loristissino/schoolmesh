<div id='teams'>
<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Name') ?></th>
		<th class="sf_admin_text"><?php echo __('Role') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($current_user->getTeams() as $team): ?>
	<tr>
		<td>
			<?php echo $team->getTeam() ?>
		</td>
		<td>
			<?php echo $current_user->getIsMale()? $team->getRole()->getMaleDescription() : $team->getRole()->getFemaleDescription() ?>
		</td>
		<td>
			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_edit">
				<?php echo link_to(
					__('Change role'),
					url_for('users/changerole?id='.$current_user->getUserId(). '&team=' . $team->getId())
					)
				?>
				</li>
			</ul>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
</div>
