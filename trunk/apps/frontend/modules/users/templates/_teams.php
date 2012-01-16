<div id='teams'>
<h2><?php echo __('Teams') ?></h2>
<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Name') ?></th>
		<th class="sf_admin_text"><?php echo __('Role') ?></th>
		<th class="sf_admin_text"><?php echo __('Expiry') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($current_user->getTeams() as $team): ?>
	<tr>
		<th>
			<?php echo link_to($team->getTeam(), 'teams/show?id=' . $team->getTeam()->getId()) ?>
		</th>
		<td>
			<?php echo $current_user->getIsMale()? $team->getRole()->getMaleDescription() : $team->getRole()->getFemaleDescription() ?>
		</td>
    <td style="text-align: right">
    <?php include_partial('content/expiry', array('date'=>$team->getExpiry('U'))) ?>
    </td>
		<td>
    <?php include_partial('teams/teams_td_actions', array('user'=>$current_user, 'team'=>$team->getTeam())) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
<ul class="sf_admin_actions">
<li class="sf_admin_action_new">
<?php
echo link_to(
__('Add to a team'),
url_for('users/addtoteam?user='.$current_user->getUserId())
) ?>
</li>
</ul>

</div>
