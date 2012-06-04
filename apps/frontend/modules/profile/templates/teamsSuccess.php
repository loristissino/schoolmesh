<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile'=>__('My profile')
    ),
  'current'=>__('My teams, my roles, my charges'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<p>
<?php echo __('These are the teams you currently belong to, with the role you play within them.') ?>
</p>

<table>
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Role') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Charge R.N.') ?></th>
      <th class="sf_admin_text"><?php echo __('Confirmation R.N.') ?></th>
      <th class="sf_admin_text"><?php echo __('Expiry') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Teams as $Team): ?>
    <tr>
      <td><?php echo link_to($Team->getTeam()->getDescription(), url_for('teams/show?id='.$Team->getTeam()->getId())) ?></td>
      <td><?php echo $Team->getSfGuardUser()->getProfile()->getIsMale()?$Team->getRole()->getMaleDescription():$Team->getRole()->getFemaleDescription() ?></td>
      <td><?php echo $Team->getRole()->getQualityCode() ?></td>
      <?php if($Team->getRole()->getNeedsChargeLetter()): ?>
        <td>
          <?php echo $Team->getChargeReferenceNumber() ?>
          <?php if(!$Team->getChargeReferenceNumber()): ?>
            <?php include_partial('content/dubious', array('text'=>__('Looks like this charge has not been approved yet'))) ?>
          <?php endif ?>
        </td>
        <td><?php echo $Team->getConfirmationReferenceNumber() ?></td>
      <?php else: ?>
        <td colspan="2" class="notimportant"></td>
      <?php endif ?>
      
      <td style="text-align: right"><?php include_partial('content/expiry', array('date'=>$Team->getExpiry('U'))) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
