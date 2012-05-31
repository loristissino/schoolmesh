<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(5, new lime_output_color());

$wpmoduleitem=WpmoduleItemPeer::retrieveOneByContent('proprietà elettroniche dei solidi');

$ids=array();

$student=sfGuardUserProfilePeer::retrieveByUsername('vincenzo.decarolis');

$ids[]=$student->getId();

$student=sfGuardUserProfilePeer::retrieveByUsername('helen.abram');

$ids[]=$student->getId();

$sits=$wpmoduleitem->getStudentsSituations($ids, 'Term1');

$t->is(sizeof($sits), 2, '->getStudentsSituations() retrieves the correct objects');

sort($ids);

$sits=$wpmoduleitem->getStudentsSituationsAsArray($ids, 'Term1');
$t->is_deeply($sits, $ids, '->getStudentsSituationsAsArray() retrieves the correct ids');


$t->is(in_array($student->getId(), $sits), true, 'the student is correctly listed');

$wpmoduleitem->toggleStudent($student->getId(), 'Term1');
$sits=$wpmoduleitem->getStudentsSituationsAsArray($ids, 'Term1');
$t->is(in_array($student->getId(), $sits), false, '->toggleStudent() removes the student');

$wpmoduleitem->toggleStudent($student->getId(), 'Term1');
$sits=$wpmoduleitem->getStudentsSituationsAsArray($ids, 'Term1');
$t->is(in_array($student->getId(), $sits), true, '->toggleStudent() moves the student back in');

