<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'teams/index'=>__("Teams")
    ),
  'current'=>$Team->getDescription()
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <tbody>
    <tr>
      <th><?php echo __('Description') ?></th>
      <td><?php echo $Team->getDescription() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Posix name') ?></th>
      <td><?php echo $Team->getPosixName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Quality code') ?></th>
      <td><?php echo $Team->getQualityCode() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<div id='members'>
<?php if(sizeof($components)>0): ?>
<h2><?php echo __('Members') ?></h2>

<table>
<thead>
	<tr>
		<th class="sf_admin_text"><?php echo __('Name') ?></th>
		<th class="sf_admin_text"><?php echo __('Role') ?></th>
		<th class="sf_admin_text"><?php echo __('Actions') ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($components as $component): ?>
	<tr>
		<td>
			<?php echo link_to_if($sf_user->hasCredential('admin'), $component->getsfGuardUser()->getProfile()->getFullName(), 'users/edit?id='.$component->getsfGuardUser()->getId() . '#teams') ?>
		</td>
		<td>
			<?php echo $component->getsfGuardUser()->getProfile()->getIsMale()? $component->getRole()->getMaleDescription() : $component->getRole()->getFemaleDescription() ?>
		</td>
    <td>
        <?php include_partial('teams/teams_td_actions', array('user'=>$component->getsfGuardUser()->getProfile(), 'team'=>$Team)) ?>
    </td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
</div>

<?php else: ?>
<p><?php echo __('This team has no members.') ?></p>
<?php endif ?>

<?php if($sf_user->hasCredential('teams')):?>
<ul class="sf_admin_actions">
  <li class="sf_admin_action_edit">
  <?php echo link_to(
    __('Edit'),
    url_for('teams/edit?id='.$Team->getId())
    ) ?>
  </li><br />
</ul>
<?php endif ?>
