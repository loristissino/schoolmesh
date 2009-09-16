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
		<th>
			<?php echo $team->getTeam() ?>
		</th>
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
				<li class="sf_admin_action_delete">
				<?php echo link_to(
					sprintf(__('Remove %s from this team'), $current_user->getFullname()),
					url_for('users/removefromteam?id='.$current_user->getUserId(). '&team=' . $team->getTeam()->getId()),
					array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
					)
				?>
				</li>
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
__('Add to team'),
url_for('users/addtoteam?user='.$current_user->getUserId())
) ?>
</li>
</ul>

</div>
