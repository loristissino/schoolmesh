<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(5, new lime_output_color());


$availableAccounts = array('posix', 'login', 'samba', 'moodle', 'googleapps');

$profiles=sfGuardUserProfilePeer::doSelect(new Criteria());

$t->is(sizeof($profiles), 20, '::doSelect() retrieves the correct number of profiles');



$checkList=sfGuardUserProfilePeer::createMissingAccounts($availableAccounts);

$t->pass('::createMissingAccounts() creates the neeeded accounts');

$user=sfGuardUserProfilePeer::retrieveByUsername('giulia.d');
$profile=$user->getProfile();

$t->like($profile->getSystemAlerts(), '/user not active with accounts/', 'an alert is set when an inactive user has accounts');

$user=sfGuardUserProfilePeer::retrieveByUsername('francesco.g');
$profile=$user->getProfile();

$t->is($profile->hasAccountOfType('posix'), true, 'an account is created when needed');

$user=sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$profile=$user->getProfile();

$t->like($profile->getSystemAlerts(), '/extra account/', 'an alert is set when an account exists but should not be available');
