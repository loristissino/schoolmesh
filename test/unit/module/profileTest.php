<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');
 
$t = new lime_test(9, new lime_output_color());

$t->comment("Teacher's Profile");

$c=new Criteria();
$c->add(sfGuardUserPeer::USERNAME, 'loris.tissino');
$u=sfGuardUserPeer::doSelectOne($c);
$t->is($u->getProfile()->getFullName(), "Loris Tissino", '->getFullName() returns the complete name of the user');
$t->is(sizeof($u->getProfile()->getCurrentAppointments()), 3, '->getCurrentAppointments() returns the correct number of appointments');
$t->is(sizeof($u->getProfile()->getTeams()), 3, '->getTeams() returns the correct number of teams');


$t->comment("Technician's Profile");
unset($c);

$c=new Criteria();
$c->add(sfGuardUserPeer::USERNAME, 'juri.domodossola');
$u=sfGuardUserPeer::doSelectOne($c);
$t->is($u->getProfile()->getFullName(), "Juri Domodossola", '->getFullName() returns the complete name of the user');
$t->is(sizeof($u->getProfile()->getCurrentAppointments()), 0, '->getCurrentAppointments() returns 0');
$t->is(sizeof($u->getProfile()->getTeams()), 1, '->getTeams() returns the correct number of teams');

$t->comment("Student's Profile");
unset($c);

$c=new Criteria();
$c->add(sfGuardUserPeer::USERNAME, 'helen.abram');
$u=sfGuardUserPeer::doSelectOne($c);
$t->is($u->getProfile()->getFullName(), "Hélèn Abram", '->getFullName() returns the complete name of the user');
$t->is(sizeof($u->getProfile()->getCurrentAppointments()), 0, '->getCurrentAppointments() returns 0');
$t->is(sizeof($u->getProfile()->getTeams()), 0, '->getTeams() returns the correct number of teams');

//$t->comment("Admin credentials");

