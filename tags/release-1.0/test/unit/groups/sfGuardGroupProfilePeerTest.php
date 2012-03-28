<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(1, new lime_output_color());

$t->diag('::RetrieveGuardGroupByName()');

$group = sfGuardGroupProfilePeer::retrieveGuardGroupByName('teacher');
$t->is($group->getDescription(), 'Gruppo Docenti', 'a group is correctly retrieved');

