<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(12, new lime_output_color());

$t->diag('::importFromCSVFile()');
$checks=sfGuardUserProfilePeer::importFromCSVFile('data/example_uploads/users.csv');

foreach(array(
	'alice.alessandrini'=>'Alessandrini',
	'bebe.lasow'=>'Łasøw',
	'pasquale.derolandis'=>'De Rolandis',
	'giorgio.botto' => 'Bottò',
	'bruna.bagala' => 'Bagalà',
) as $key=>$value)
{
	$user = sfGuardUserProfilePeer::retrieveByUsername($key);
	$profile=$user->getProfile();
	$t->is($profile->getLastName(), $value, 'user imported: ' . $value);
}

foreach(array(
	'2005'=>'Tassan Zanin Giulianelli',
	'2011'=>'Domodossola',
) as $key=>$value)
{
	$profile = sfGuardUserProfilePeer::retrieveByImportCode($key);
	$t->is($profile->getLastName(), $value, 'user imported: ' . $value);
	$t->like($profile->getUsername(), '/^u[0-9]*$/', 'the name is temporary: ' .$profile->getUsername());
	$t->like($profile->getSystemAlerts(), '/username invented/', 'a system alert is added when the username is invented');
}

$profiles = sfGuardUserProfilePeer::retrieveAllUsers();

$found=false;
foreach($profiles as $profile)
{
	if($profile->getFirstName()=='Gianpiero' && $profile->getLastName()=='Bergamo')
		$found=true;
}

$t->is($found, false, 'a user with no import code is not imported');
	

