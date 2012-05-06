<?php echo pack('CCC', 0xEF, 0xBB, 0xBF)  /* BOM */ ?>email address,first name,last name,password
<?php foreach($userlist as $user): ?>
<?php echo Generic::correctString(sprintf('%s@%s,%s,%s,%s', $user->getUsername(), $domain, $user->getFirstname(), $user->getLastname(), $user->getTempGooglePassword())) . "\n" ?>
<?php endforeach ?>
