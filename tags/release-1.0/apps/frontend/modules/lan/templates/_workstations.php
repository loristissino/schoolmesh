<ul>
<?php foreach($Workstations as $Workstation): ?>
  <li>
    <?php echo $Workstation->getName() ?>
    <?php if($Workstation->getIsEnabled()): ?>
      (<?php echo __('Currently enabled by %user%', array('%user%'=>$Workstation->getUser())) ?>)
    <?php endif ?>
  </li>
<?php endforeach ?>
</ul>
