<?php echo pack('CCC', 0xEF, 0xBB, 0xBF)  /* BOM */ ?>username,first name,last name,password
<?php foreach($userlist as $user): ?>
<?php echo sprintf('%s,%s,%s,%s', $user->getUsername(), $user->getFirstname(), $user->getLastname(), $user->getGoogleappsAccountTemporaryPassword()) . "\n" ?>
<?php endforeach ?>