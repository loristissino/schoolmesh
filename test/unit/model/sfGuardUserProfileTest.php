<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(46, new lime_output_color());

$t->diag('sfGuardUserProfilePeer::retrieveByUsername()');
$user = sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');

$profile=$user->getProfile();
$t->is($profile->getLastName(), 'Tissino', '::retrieveByUsername() returns the User for the given username');

$t->diag('->getUsernameIsAlreadyUsed()');

$t->is($profile->getUsernameIsAlreadyUsed('root'), true, 'returns true for a reserved username');
$t->is($profile->getUsernameIsAlreadyUsed('antonio.d'), true, 'returns true for a different user\'s username');
$t->is($profile->getUsernameIsAlreadyUsed('loris.tissino'), false, 'returns false for the same user');
$t->is($profile->getUsernameIsAlreadyUsed('loris.tissino', false), true, 'returns true for the same user when ignoreself param is set to false');

$t->diag('->getUsernameIsValid()');
$t->is($profile->getUsernameIsValid('root'), false, 'returns false for a reserved username');
$t->is($profile->getUsernameIsValid(), true, 'returns true for a the same user');


// valid usernames
foreach(array('foobar', 'foobar1', 'foobar1a', 'foo.bar', 'foo.bar1', 'a234567890b234567890') as $username)
{
	$user->setUsername($username);
	$t->is($user->getProfile()->getUsernameIsValid(), true, 'returns true for a good username: ' . $username);
}

// invalid usernames
foreach(array('.foobar', '1foobar', 'a234567890b2345678901', 'foobar$', 'foo_bar') as $username)
{
	$user->setUsername($username);
	$t->is($user->getProfile()->getUsernameIsValid(), false, 'returns false for an invalid username: ' . $username);
}

$t->diag('->findGoodUsername()');

$profile=new sfGuardUserProfile();

$username_info=$profile
->setFirstName('Edoardo')
->setLastName('Verdi')
->findGoodUsername();

$t->is($username_info['invented'], false, 'if the name is short and good must not be invented');
$t->is($username_info['username'], 'edoardo.verdi', sprintf('the name is correctly generated: «%s» -> «%s»', $profile->getFirstName() . ' ' . $profile->getLastName(), $username_info['username']));

$username_info=$profile
->setFirstName('Edoardo Augusto')
->setLastName('Verdini')
->findGoodUsername();

$t->is($username_info['invented'], true, 'if the name is too long we must find a temporary one');
$t->like($username_info['username'], '/u[0-9]*/', 'the name is temporary: ' .$username_info['username']);



$username_info=$profile
->setFirstName('Bebé')
->setLastName('Łasøw Müller')
->findGoodUsername();

$t->is($username_info['invented'], false, 'if the name contains special chars is translitterated');
$t->is($username_info['username'], 'bebe.lasowmueller', sprintf('the name is correctly generated: «%s» -> «%s»', $profile->getFirstName() . ' ' . $profile->getLastName(), $username_info['username']));

$t->diag('->isDeletable()');

$user = sfGuardUserProfilePeer::retrieveByUsername('john.test');
$profile=$user->getProfile();
$t->is($profile->getIsDeletable(), false, 'returns false for a teacher with some appointments');

$user = sfGuardUserProfilePeer::retrieveByUsername('stefano.ospite');
$profile=$user->getProfile();

$t->is($profile->getIsDeletable(), true, 'returns true for a user with no previous activity');


$t->diag('->addSystemAlerts()');

$user = sfGuardUserProfilePeer::retrieveByUsername('stefano.ospite');
$profile=$user->getProfile();

$t->is($profile->getSystemAlerts(), null, 'a normal user has no system alerts');
$profile->addSystemAlert('foo');
$t->is($profile->getSystemAlerts(), 'foo', 'the first system alert is normally set');
$profile->addSystemAlert('bar');
$t->is($profile->getSystemAlerts(), 'foo - bar', 'the second system alert is concatenated to the first');

$profile->setSystemAlerts(null);
$profile->addSystemAlert('foo', false);
$t->is($profile->getSystemAlerts(), null, 'the second param set to false prevents the alert to be added');
$profile->addSystemAlert('foo', true);
$t->is($profile->getSystemAlerts(), 'foo', 'the second param set to true makes the alert added');
$profile->addSystemAlert('bar', true);
$t->is($profile->getSystemAlerts(), 'foo - bar', 'the second system alert is concatenated to the first also when param2 is true');

$t->diag('->addGoogleappsAccountAlerts()');

//$profile->addGoogleappsAccountAlerts();
$t->unlike($profile->getSystemAlerts(), '/googleapps account missing/', 'a new user does not have googleapps account activated');

$profile->GoogleappsEnable();
$t->like($profile->getGoogleappsAccountTemporaryPassword(), '/[0-9]*/', 'a password is set when an account is enabled');

$profile->GoogleappsDisable();
$t->is($profile->getGoogleappsAccountTemporaryPassword(), null, 'a password is unset when an account is disabled');

$t->comment("Teacher's Profile");

$user = sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$profile=$user->getProfile();
$t->is($profile->getFullName(), "Loris Tissino", '->getFullName() returns the complete name of the user');
$t->is(sizeof($profile->getCurrentAppointments()), 3, '->getCurrentAppointments() returns the correct number of appointments');
$t->is(sizeof($profile->getTeams()), 3, '->getTeams() returns the correct number of teams');

$t->comment("Technician's Profile");

$user = sfGuardUserProfilePeer::retrieveByUsername('juri.domodossola');
$profile=$user->getProfile();
$t->is($profile->getFullName(), "Juri Domodossola", '->getFullName() returns the complete name of the user');
$t->is(sizeof($profile->getCurrentAppointments()), 0, '->getCurrentAppointments() returns 0');
$t->is(sizeof($profile->getTeams()), 1, '->getTeams() returns the correct number of teams');

$t->comment("Student's Profile");

$user = sfGuardUserProfilePeer::retrieveByUsername('helen.abram');
$profile=$user->getProfile();
$t->is($profile->getFullName(), "Hélèn Abram", '->getFullName() returns the complete name of the user');
$t->is(sizeof($profile->getCurrentAppointments()), 0, '->getCurrentAppointments() returns 0');
$t->is(sizeof($profile->getTeams()), 0, '->getTeams() returns the correct number of teams');

//$t->comment("Admin credentials");

$t->diag('->posix_getpwuid()');

$user = sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$profile=$user->getProfile();

$userinfo=$profile->posix_getpwuid(0);
$t->is($userinfo['name'], 'root', 'returns the correct user');
$userinfo=$profile->posix_getpwuid(9999);
$t->is($userinfo, false, 'returns false if the user does not exist');
