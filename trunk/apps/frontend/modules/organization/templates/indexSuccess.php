<?php include_partial('content/breadcrumps', array(
  'current'=>__("Organization")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<h2><?php echo __('Key roles') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Key role') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Charged user') ?></th>
      <th class="sf_admin_text"><?php echo __('Expiry') ?></th>
      <?php if($sf_user->hasCredential('teams')): ?>
        <th class="sf_admin_text"><?php echo __('Reference number') ?></th>
        <th class="sf_admin_text"><?php echo __('Team') ?></th>
      <?php endif ?>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach($list as $item): ?>
      <?php if($item['userteam']): ?>
        <?php foreach($item['userteam'] as $component): ?>
          <?php include_partial('tr_userteam', array('role'=>$item['keyrole'], 'component'=>$component)) ?>
        <?php endforeach ?>
        <?php else: ?>
          <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
            <td class="warning"><?php echo $item['keyrole']->getMaleDescription() ?></td>
            <td class="warning"><?php echo $item['keyrole']->getQualityCode() ?></td>
            <td colspan="4" class="highlighted warning"><?php echo __('No one in charge') ?></td>
          </tr>
      <?php endif ?>
    <?php endforeach ?>
  </tbody>
</table>

<h2><?php echo __('Functional roles') ?></h2>

<ul class="sf_admin_actions">
<?php foreach($functionalroles as $Role): ?>
  <?php echo li_link_to_if('action_users', true, $Role->getMaleDescription(), url_for('organization/role?id='.$Role->getId())) ?>
<?php endforeach ?>
</ul>

<h2><?php echo __('Organizational chart') ?></h2>

<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_download', true, __('Get updated organizational chart'), url_for('organization/chart')) ?>
</ul>

<?php if($sf_user->hasCredential('admin')): ?>
<h2><?php echo __('SchoolMesh') ?></h2>

<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_schoolmesh', true, __('Authorizations'), url_for('organization/authorizations')) ?>
</ul>
<?php endif ?>


</div>
