<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(28, new lime_output_color());

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

foreach(array(
	'Gianpiero Bergamo'=>'no import code',
	'Paolo Samuelli'=>'invalid type',
	'Giulia Donati'=>'duplicated import code'
	) as $key=>$value)
{
	$found=false;
	foreach($profiles as $profile)
	{
		if($profile->getFullName()==$key)
			$found=true;
	}

	$t->is($found, false, sprintf('not imported (%s)', $value));
}


foreach(array(
	'alice.alessandrini'=>'allievi',
	'bebe.lasow'=>'docenti',
) as $key=>$value)
{
	$user = sfGuardUserProfilePeer::retrieveByUsername($key);
	$profile=$user->getProfile();
	$t->is($profile->getRole()->getPosixName(), $value, 'role correctly assigned: ' . $value);
}

$user = sfGuardUserProfilePeer::retrieveByUsername('pasquale.derolandis');
$profile=$user->getProfile();
$t->is($profile->getRole(), null, 'role left unassigned for other kind of users');
$t->like($profile->getSystemAlerts(), '/role/', 'a system alert is set when no role is specified');

$user = sfGuardUserProfilePeer::retrieveByUsername('alice.alessandrini');
$profile=$user->getProfile();
$t->is($profile->getCurrentSchoolclassId(), '4AP', 'student correctly enroled');

$user = sfGuardUserProfilePeer::retrieveByUsername('bob.bernardi');
$profile=$user->getProfile();
$t->is($profile->getCurrentSchoolclassId(), null, 'student inserted but not enroled');
$t->like($profile->getSystemAlerts(), '/missing class/', 'a system alert is set when no class is specified');

$user = sfGuardUserProfilePeer::retrieveByUsername('cristina.bonucci');
$profile=$user->getProfile();
$t->is($profile->getBelongsToTeam('dipinfo'), true, 'teacher correctly put in the team specified');
$guardgroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName('teacher');
$t->is($profile->getBelongsToGuardGroup($guardgroup), true, 'teacher belongs to the «teacher» guard group');

$t->is($profile->hasPermission('internet'), true, 'teacher has the «internet» permission');

$user = sfGuardUserProfilePeer::retrieveByUsername('lucio.stelli');
$profile=$user->getProfile();
$t->like($profile->getSystemAlerts(), '/missing team/', 'a system alert is set when no team is specified');


$t->diag('::retrievePermissionByName()');

$permission=sfGuardUserProfilePeer::retrievePermissionByName('foobar');
$t->is($permission, false, '::retrievePermissionByName() returns false if the permission does not exists');

$permission=sfGuardUserProfilePeer::retrievePermissionByName('planning');
$t->is($permission->getDescription(), 'Pianificazione didattica', '::retrievePermissionByName() returns the correct permission');

$t->diag('::retrieveAllButStudents()');
$nonstudents=sfGuardUserProfilePeer::retrieveAllButStudents();

$check=array();
foreach($nonstudents as $profile)
{
	$check[]=$profile->getFullName();
}

$t->is_deeply($check, array(
0 => 'Fabio Adriani',  1 => 'Bruna Bagalà',  2 => 'Cristina Bonucci',  3 => 'Bianca Brindisi',  4 => 'Bianca Brindisi',  5 => 'Antonio Danubio',  6 => 'Marco De Filippis',  7 => 'Juri Domodossola',  8 => 'Flavia Gemona',  9 => 'Francesco Genova',  10 => 'Francesco Genova',  11 => 'Vinicio Grimaldi',  12 => 'Paola Moretti',  13 => 'Mario Rossi',  14 => 'Giorgio Simonacci',  15 => 'Lucio Stelli',  16 => 'John Test',  17 => 'Loris Tissino',  18 => 'Gabriella Vicenza',  19 => 'Bebé Łasøw'
), '::retrieveAllButStudents() returns all users but students');

