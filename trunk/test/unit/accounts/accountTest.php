<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(20, new lime_output_color());

$t->comment('Sample user');

$user=sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$profile=$user->getProfile();

$accounts=$profile->getAccounts();
$t->is(sizeof($accounts), 5, '->getAccounts() retrieves the correct number of accounts');

$sambaAccount = new SambaAccount();

$profile->addAccount($sambaAccount);
$t->pass('->addAccount() can add a Samba Account');

$t->is($profile->hasAccountOfType('samba'), true, '->hasAccountOfType() returns true for an existing account');
$t->is($profile->hasAccountOfType('moodle'), false, '->hasAccountOfType() returns false for a non existing account');

$moodleAccount = new MoodleAccount();

$profile->addAccount($moodleAccount);
$t->pass('->addAccount() can add a Moodle Account');
$t->is($profile->hasAccountOfType('moodle'), true, '->hasAccountOfType() returns true for an existing account');

$accounts=$profile->getAccounts();
$t->is(sizeof($accounts), 6, '->getAccounts() retrieves the correct number of accounts');

$testAccount = $profile->getAccountByType('samba');

$t->isa_ok($testAccount, SambaAccount, '->getAccountByName() returns the correct account type for Samba accounts');

$testAccount = $profile->getAccountByType('moodle');

$t->isa_ok($testAccount, MoodleAccount, '->getAccountByName() returns the correct account type for Moodle accounts');

$otherMoodleAccount = new MoodleAccount();
$profile->addAccount($otherMoodleAccount);
$t->pass('->addAccount() does not fail if the account already exists for the user');

$profile->removeAccountByName('samba');
$t->pass('->removeAccountByName() correctly removes an account');
$t->is($profile->hasAccountOfType('samba'), false, '->hasAccountOfType() returns false for a non existing account');
$profile->removeAccountByName('foobar');
$t->pass('->removeAccountByName() does not fail when we try to remove an account that does not exist');

$checkList= new CheckList();
$checkList->addCheck(new Check(Check::PASSED, 'test', 'test'));
$checkList->addCheck(new Check(Check::FAILED, 'test', 'test'));

$t->diag("Let's check the accounts...");

$user=sfGuardUserProfilePeer::retrieveByUsername('helen.abram');
$profile=$user->getProfile();

$t->is_deeply($profile->getWebPermissions(), array('posix', 'samba'), 'the user starts with the right credentials');

$availablePermissions=array('posix', 'samba');

$profile->checkAccounts($availablePermissions, $checkList);

$t->is(sizeof($checkList->getAllChecks()), 18, 'ok');

$posixAccount=$profile->getAccountByType('posix');

$t->isa_ok($posixAccount, PosixAccount,  'retrieved a Posix Account');

$posixAccount
->setAccountSetting('foo', 'bar')
->setAccountSetting('oof', 123)
->save();

$t->is($posixAccount->getAccountSetting('foo'), 'bar', 'settings result correctly saved');
$t->is($posixAccount->getAccountSetting('oof'), 123, 'works with numbers');
$t->is($posixAccount->getAccountSetting('bar'), null, 'if a setting is not set, we get null');

$t->is($posixAccount->getUsername(), 'helen.abram', '->getUsername() retrieves the correct username');

/*unset($posixAccount);
$posixAccount=$profile->getAccountByType('posix');

$posixAccount->updateInfoFromRealWorld();
$t->is($posixAccount->getAccountSetting('foo'), 'bar', 'settings result correctly saved');
$t->is($posixAccount->getAccountSetting('oof'), 123, 'works with numbers');
$t->is($posixAccount->getAccountSetting('bar'), null, 'if a setting is not set, we get null');



*/