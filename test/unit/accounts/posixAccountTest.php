<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(6, new lime_output_color());

$t->comment('Sample user');
$t->comment('### These will work only if the given user actually exists...');
$user=sfGuardUserProfilePeer::retrieveByUsername('john.test');
$profile=$user->getProfile();

$posixAccount=$profile->getAccountByType('posix');
$t->isa_ok($posixAccount, PosixAccount, '->getAccountByName() retrieves a PosixAccount');

$posixAccount->updateInfoFromRealWorld();
$t->pass('->updateInfoFromRealWorld() updates known info');

$t->is($posixAccount->getAccountInfo('group'), 'docenti', '->getAccountInfo() retrieves the correct info');

$t->is($posixAccount->getAccountInfo('username'), 'john.test', '->getAccountInfo() retrieves the correct info');

$user2=sfGuardUserProfilePeer::retrieveByUsername('john.test');
$posixAccount=$user2->getProfile()->getAccountByType('posix');
$t->is($posixAccount->getAccountInfo('gid'), 61, '->getAccountInfo() retrieves the correct info');
$t->is($posixAccount->getAccountInfo('username'), 'john.test', '->getAccountInfo() retrieves the correct info');






