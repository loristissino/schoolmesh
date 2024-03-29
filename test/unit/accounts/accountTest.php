<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(26, new lime_output_color());

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

$t->is_deeply($profile->getWebPermissions(), array('login', 'posix', 'samba'), 'the user starts with the right credentials');

$availablePermissions=array('posix', 'samba');

$profile->checkAccounts($availablePermissions, $checkList);

// $checks=$checkList->getAllChecks();

// We can't test this because we don't actually know how many tests will be performed
// $t->is(sizeof($checks), 17, 'all checks are correctly run');


//print_r($checks);

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

$user=sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$profile=$user->getProfile();

$posixAccount=$profile->getAccountByType('posix');

$t->comment('AccountPeer');

$loginAccount=AccountPeer::retrieveByUserIdAndType($user->getId(), 'login');
$t->isa_ok($loginAccount, LoginAccount, '::retrieveByUserIdAndType() retrieves the correct account');

$t->comment('Account');
$loginAccount=$posixAccount->getSiblingAccountByType('login');
$t->isa_ok($loginAccount, LoginAccount, '->getSiblingAccountByType() retrieves the correct account');

$t->comment('Settings');
$posixAccount->setAccountSetting('hard_blocks_quota', 3000);
$posixAccount->setAccountInfo('used_files', 100);
$t->is($posixAccount->getAccountSetting('hard_blocks_quota'), 3000, 'settings are correctly stored');
$posixAccount->setAccountSetting('hard_files_quota', 1000);
$t->is($posixAccount->getAccountSetting('hard_blocks_quota'), 3000, 'settings are correctly stored');
$t->is($posixAccount->getAccountInfo('used_files'), 100, 'settings are correctly stored');

unset($posixAccount);

$posixAccount=$profile->getAccountByType('posix');
$posixAccount=$posixAccount->getRealAccount();

$t->is($posixAccount->getAccountSetting('hard_blocks_quota'), 3000, 'settings are correctly stored');
$t->is($posixAccount->getAccountInfo('used_files'), 100, 'settings are correctly stored');




