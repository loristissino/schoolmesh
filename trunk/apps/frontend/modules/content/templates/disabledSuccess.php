<?php include_partial('content/breadcrumps', array(
  'current'=> __('Module unavailable'),
  ))
?>    

<p><?php echo __('The module you requested has been disabled on this SchoolMesh setup.') ?></p>
<?php if(sizeof($siblings)>1): ?>
  <p><?php echo __('It might be available in one of the following sibling servers:') ?></p>
  <ul>
  <?php foreach($siblings as $name=>$url): ?>
    <li><?php echo link_to($name, $url) ?></li>
  <?php endforeach ?>
  </ul>
<?php elseif(sizeof($siblings)==1): ?>
  <p><?php echo __('It might be available in the following server:') ?> <?php foreach($siblings as $name=>$url): ?><?php echo link_to($name, $url) ?><?php endforeach ?>.</p>
<?php endif ?>
