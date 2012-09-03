<?php echo pack('CCC', 0xEF, 0xBB, 0xBF)  /* BOM */ ?>username,password,firstname,lastname,email,institution,department,idnumber,emailstop
<?php foreach($userlist as $user): ?>
<?php echo sprintf('%s,%s,%s,%s,%s,%s,%s,%s,%s',
  $user->getUsername(),
  $user->getFakePassword(),
  $user->getFirstname(),
  $user->getLastname(),
  $user->getHasValidatedEmail()? $user->getEmail() : $user->getFakeEmail(),
  $user->getInstitution(),
  $user->getDepartment(),
  $user->getUsername(),
  $user->getHasValidatedEmail()? 0 : 1
  ) . "\n" ?>
<?php endforeach ?>