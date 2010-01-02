<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(2, new lime_output_color());

$t->comment('We start...');

$appointment=AppointmentPeer::retrieveByUsernameSchoolclassSubjectYear('john.test', '3AP', 'FIS', 2008);

echo $appointment->getSubject();



