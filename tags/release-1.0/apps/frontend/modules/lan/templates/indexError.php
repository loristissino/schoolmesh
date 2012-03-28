<?php include_partial('content/breadcrumps', array(
  'current'=>__('Workstations')
  ))
?>

<?php include_partial('content/flashes') ?>

<?php if($sf_user->hasCredential('admin')): ?>
  <?php include_partial('subnets', array('Subnets'=>$Subnets, 'currentsubnet'=>$currentsubnet, 'mysubnet'=>$mysubnet)) ?>
<?php else: ?>
  <p><?php echo __('You do not seem to be logged on in the local area network.') ?></p>
<?php endif ?>
