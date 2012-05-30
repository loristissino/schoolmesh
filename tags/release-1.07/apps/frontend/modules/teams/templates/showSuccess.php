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
		<th class="sf_admin_text"><?php echo __('Expiry') ?></th>
		<th class="sf_admin_text"><?php echo __('Notes') ?></th>
		<th class="sf_admin_text"><?php echo __('Reference number') ?></th>
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
			<?php echo link_to($component->getsfGuardUser()->getProfile()->getIsMale()? $component->getRole()->getMaleDescription() : $component->getRole()->getFemaleDescription(), url_for('organization/role?id='.$component->getRoleId()))  ?>
		</td>
    <td style="text-align: right">
      <?php include_partial('content/expiry', array('date'=>$component->getExpiry('U'))) ?>
    </td>
    <td><?php include_partial('content/notes', array('notes'=>$component->getNotes())) ?></td>
    <td><?php echo $component->getReferenceNumber() ?></td>
    <td>
        <?php include_partial('teams/teams_td_actions', array('user'=>$component->getsfGuardUser()->getProfile(), 'team'=>$Team, 'referer'=>url_for('teams/show?id='.$Team->getId()))) ?>
    </td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
</div>

<?php else: ?>
<p><?php echo __('This team has no members.') ?></p>
<?php endif ?>

<?php if($sf_user->hasCredential('teams')): ?>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if(
    'action_edit',
    $sf_user->hasCredential('teams'),
    __('Edit'),
    url_for('teams/edit?id='.$Team->getId())
    ) ?>
  <?php echo li_link_to_if(
    'action_log',
    $sf_user->hasCredential('backadmin'),
    __('Logs'),
    url_for('teams/viewlogs?id='.$Team->getId())
    ) ?>
  <?php echo li_link_to_if('action_users', $sf_user->hasCredential('users') && $Team->getIsPublic(), __('Find these people in users management module'), url_for('users/list?query=teams:'.$Team->getPosixName())) ?> 
</ul>
<?php endif ?>


