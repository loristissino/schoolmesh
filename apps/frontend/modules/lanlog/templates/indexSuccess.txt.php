<?php foreach ($lanlog_list as $lanlog): ?>
<?php echo sprintf("%s\t%s\t%s\t%s\n", 
    str_pad($lanlog->getsfGuardUser()->getUsername(), 20),
    str_pad($lanlog->getWorkstation(), 20),
    str_pad($lanlog->getWorkstation()->getSubnet(), 20),
    $lanlog->getUpdatedAt()) ?>
<?php endforeach; ?>
