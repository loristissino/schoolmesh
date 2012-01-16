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
      <th>Id:</th>
      <td><?php echo $Team->getId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $Team->getDescription() ?></td>
    </tr>
    <tr>
      <th>Posix name:</th>
      <td><?php echo $Team->getPosixName() ?></td>
    </tr>
    <tr>
      <th>Quality code:</th>
      <td><?php echo $Team->getQualityCode() ?></td>
    </tr>
    <tr>
      <th>Needs folder:</th>
      <td><?php echo $Team->getNeedsFolder() ?></td>
    </tr>
    <tr>
      <th>Needs mailing list:</th>
      <td><?php echo $Team->getNeedsMailingList() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<div id='members'>
<?php if(sizeof($components)>0): ?>

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
			<?php echo link_to($component->getsfGuardUser()->getProfile()->getFullName(), 'users/edit?id='.$component->getsfGuardUser()->getId() . '#teams') ?>
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

<ul class="sf_admin_actions">
  <li class="sf_admin_action_edit">
  <?php echo link_to(
    __('Edit'),
    url_for('teams/edit?id='.$Team->getId())
    ) ?>
  </li><br />
</ul>
