<?php include_partial('content/breadcrumps', array(
  'current'=>__('LAN Logons and logoffs'),
  'title'=>$sf_context->getActionName()=='viewbyuser'? __('LAN Logons and logoffs, by user'): __('LAN Logons and logoffs, by workstation')
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($lanlog_list)>0): ?>

<table cellspacing="0" summary="LAN logons and logoffs">

  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Username') ?></th>
      <th class="sf_admin_text"><?php echo __('Full name') ?></th>
      <th class="sf_admin_text"><?php echo __('Host') ?></th>
      <th class="sf_admin_text"><?php echo __('Logon') ?></th>
      <th class="sf_admin_text"><?php echo __('Last access') ?></th>
      <th class="sf_admin_text"><?php echo __('Logoff') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php $i=0; ?>
    <?php foreach ($lanlog_list as $lanlog): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">

      <td><strong><?php echo link_to(
        $lanlog->getsfGuardUser()->getUsername(),
        'users/edit?id='.$lanlog->getsfGuardUser()->getId()
        ) ?></strong></td>
      <td><?php if($sf_context->getActionName()=='viewbyworkstation'):?>
          <?php echo link_to(
            $lanlog->getsfGuardUser()->getProfile()->getFullname(),
            'lanlog/viewbyuser?id='.$lanlog->getUserId()
            ) ?> 
        <?php else: ?>
          <?php echo $lanlog->getsfGuardUser()->getProfile()->getFullname() ?>
        <?php endif ?>
      </td>
      <td><?php if($sf_context->getActionName()=='viewbyuser'):?>
          <?php echo link_to(
            $lanlog->getWorkstation(),
            'lanlog/viewbyworkstation?id='.$lanlog->getWorkstation()->getId()
            ) ?> 
        <?php else: ?>
          <?php echo $lanlog->getWorkstation() ?>
        <?php endif ?></td>
      <td><?php echo $lanlog->getCreatedAt('d/m/y H:i:s') ?></td>
      <td><?php if($lanlog->getIsOnline()): ?><?php echo $lanlog->getUpdatedAt('d/m/y H:i:s') ?><?php endif ?></td>
      <td><?php if(!$lanlog->getIsOnline()): ?><?php echo $lanlog->getUpdatedAt('d/m/y H:i:s') ?><?php endif ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif ?>

</div>

</div>

