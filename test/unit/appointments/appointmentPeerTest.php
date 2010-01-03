<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(2, new lime_output_color());

$t->comment('First, we import users...');
sfGuardUserProfilePeer::importFromCSVFile('data/example_uploads/users.csv');
$t->comment('Second, we import classes...');
SchoolclassPeer::importFromCSVFile('data/example_uploads/classes.csv');

$t->diag('::importFromCSVFile()');

$checkList=AppointmentPeer::importFromCSVFile('data/example_uploads/appointments.csv');

$appointment=AppointmentPeer::retrieveByUsernameSchoolclassSubjectYear('cristina.bonucci','3BP', 'LIG', '2008_09');

$t->isa_ok($appointment, Appointment, 'the appointment was imported');

$user=sfGuardUserProfilePeer::retrieveByUsername('cristina.bonucci');
$profile=$user->getProfile();

$t->is($profile->getBelongsToTeam('cdc3bp'), true, 'user belongs to the team');

