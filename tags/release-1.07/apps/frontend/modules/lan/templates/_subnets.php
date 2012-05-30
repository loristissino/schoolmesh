<?php foreach($Subnets as $Subnet): ?>
<?php if($Subnet==$currentsubnet): ?>
  <strong><?php echo $Subnet ?></strong>
<?php else: ?>
  <?php echo link_to(
    $Subnet,
    'lan/selectsubnet?id=' . $Subnet->getId()
    )
  ?>
<?php endif ?>
<?php endforeach ?>

<?php if($currentsubnet!=$mysubnet): ?>
  <?php slot('general_alerts', __('You are currently working on subnet %subnet%, not on the one you are actually logged on.', array('%subnet%'=>$currentsubnet->__toString()))) ?>
<?php endif ?>