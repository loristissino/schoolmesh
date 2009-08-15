<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(6, new lime_output_color());

$t->comment('Sample user');

$user=sfGuardUserProfilePeer::retrieveByUsername('john.test');
$profile=$user->getProfile();

$googleappsAccount = new GoogleappsAccount();
$googleappsAccount->setInfo('test', 123);

$t->diag('->addAccount()');
$profile->addAccount($googleappsAccount);
$t->pass('a googleapps account is added');

$t->diag('->getExternalAccountByName()');
$t->is($profile->getExternalAccountByName('googleapps')->getInfo('test'), 123, 'returns the correct account');

$sambaAccount = new SambaAccount();
$sambaAccount->setInfo('test', 124);
$profile->addAccount($sambaAccount);
$t->pass('a samba account is added');

$t->diag('->getExternalAccounts()');

$t->is_deeply($profile->getExternalAccounts(), array('googleapps'=>$googleappsAccount, 'samba'=>$sambaAccount),  'returns the correct array of accounts');

$t->comment('Information related to the account can be changed using the reference');

$profile->getExternalAccountByName('googleapps')->setInfo('test', 987);
$t->is($profile->getExternalAccountByName('googleapps')->getInfo('test'), 987, 'returns the changed value');

$t->comment('user is accessed from inside the account');

$t->is($googleappsAccount->getProfile()->getUsername(), 'john.test', 'returns information about the user');
