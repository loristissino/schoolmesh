<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(1, new lime_output_color());

$t->comment('Appointment test');

$appointment=AppointmentPeer::retrieveByUsernameSchoolclassSubjectYear('john.test', '3AP', 'FIS', 2008);

$t->like($appointment->getSubject(), '/Fisica/', '->getSubject() returns the correct Subject');
/*

echo $appointment->getId() . "\n";

$ids=array();

$student=sfGuardUserProfilePeer::retrieveByUsername('vincenzo.decarolis');
$ids[]=$student->getId();

$student=sfGuardUserProfilePeer::retrieveByUsername('helen.abram');
$ids[]=$student->getId();

$suggestions=$appointment->getSuggestionsForStudents($ids, 'Term1');

$t->is(sizeof($suggestions), 2, '->getSuggestionsForStudents() retrieves the correct objects');


print_r($suggestions);

sort($ids);

$sits=$wpmoduleitem->getStudentsSituationsAsArray($ids, 'term1');
$t->is_deeply($sits, $ids, '->getStudentsSituationsAsArray() retrieves the correct ids');


$t->is(in_array($student->getId(), $sits), true, 'the student is correctly listed');

$wpmoduleitem->toggleStudent($student->getId(), 'term1');
$sits=$wpmoduleitem->getStudentsSituationsAsArray($ids, 'term1');
$t->is(in_array($student->getId(), $sits), false, '->toggleStudent() removes the student');

$wpmoduleitem->toggleStudent($student->getId(), 'term1');
$sits=$wpmoduleitem->getStudentsSituationsAsArray($ids, 'term1');
$t->is(in_array($student->getId(), $sits), true, '->toggleStudent() moves the student back in');




*/