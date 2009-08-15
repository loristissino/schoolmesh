<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(15, new lime_output_color());

$t->comment('Sample user');

$user=sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$profile=$user->getProfile();

$accounts=$profile->getAccounts();
$t->is(sizeof($accounts), 3, '->getAccounts() retrieves the correct number of accounts');

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
$t->is(sizeof($accounts), 5, '->getAccounts() retrieves the correct number of accounts');

$testAccount = $profile->getAccountByType('samba');

$t->isa_ok($testAccount, SambaAccount, '->getAccountByName() returns the correct account type for Samba accounts');

$t->like($testAccount->getInfo(), '/samba/', 'the info field is kept for Samba accounts');

$testAccount = $profile->getAccountByType('moodle');

$t->isa_ok($testAccount, MoodleAccount, '->getAccountByName() returns the correct account type for Moodle accounts');

$t->like($testAccount->getInfo(), '/moodle/', 'the info field is kept for Moodle accounts');

foreach($profile->getAccounts() as $account)
{
	echo $account->getHello() . "\n";
}

$otherMoodleAccount = new MoodleAccount();
$profile->addAccount($otherMoodleAccount);
$t->pass('->addAccount() does not fail if the account already exists for the user');

$profile->removeAccountByName('samba');
$t->pass('->removeAccountByName() correctly removes an account');
$t->is($profile->hasAccountOfType('samba'), false, '->hasAccountOfType() returns false for a non existing account');
$profile->removeAccountByName('foobar');
$t->pass('->removeAccountByName() does not fail when we try to remove an account that does not exist');

