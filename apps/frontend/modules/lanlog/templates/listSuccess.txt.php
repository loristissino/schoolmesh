<?php foreach ($lanlog_list as $lanlog): ?>
<?php echo sprintf("%s:%s:%s:%s:%s:%s\n",
  $lanlog->getsfGuardUser()->getUsername(),
  $lanlog->getsfGuardUser()->getProfile()->getFullname(),
  $lanlog->getWorkstation(),
  $lanlog->getWorkstation()->getIpCidr(),
  $lanlog->getCreatedAt('d/m/y H.i.s'),
  $lanlog->getUpdatedAt('d/m/y H.i.s')
  ) ?>
<?php endforeach; ?>
