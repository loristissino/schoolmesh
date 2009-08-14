<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(7, new lime_output_color());

$t->comment('Sample user');

$user=new sfGuardUser();
$user
->setUsername('charles.doe')
->save();

$profile=$user->getProfile();
$profile
->setFirstName('Charles')
->setLastName('Doe')
->save();

