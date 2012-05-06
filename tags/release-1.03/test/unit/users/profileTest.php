<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(7, new lime_output_color());

$t->comment('Creation of a sfGuardUser, and automatic generation of profile');
$t->comment('(we can do this when we know the username from the very beginning)');

$user=new sfGuardUser();
$user
->setUsername('john.doe')
->save();

$t->isa_ok($user, sfGuardUser, 'a new user is created');

$profile=$user->getProfile();

$t->isa_ok($profile, sfGuardUserProfile, 'a new profile is automatically created');

$profile
->setFirstName('John')
->setLastName('Doe')
->save();

$checkuser=sfGuardUserProfilePeer::retrieveByUsername('john.doe');
$t->is($checkuser->getProfile()->getLastName(), 'Doe', 'the user and the profile are correctly retrieved');

$t->comment('Creation of a Profile, and consequent generation of sfGuardUser');
$t->comment('(we must do this when we import users from a file, and we must find a good username)');

unset($user, $profile, $checkuser);

$profile=new sfGuardUserProfile();
$profile
->setFirstName('Barbara')
->setLastName('Doe');

$t->isa_ok($profile, sfGuardUserProfile, 'a new profile is created (not yet saved)');

$username_info=$profile->findGoodUsername();

$user=new sfGuardUser();
$user
->setUsername($username_info['username'])
->save();

$t->isa_ok($user, sfGuardUser, 'a new user is created');

$profile
->setUserId($user->getId())
->save();

$t->isa_ok($profile, sfGuardUserProfile, 'a new profile is created (now saved)');

$checkuser=sfGuardUserProfilePeer::retrieveByUsername('barbara.doe');
$t->is($checkuser->getProfile()->getLastName(), 'Doe', 'the user and the profile are correctly retrieved');

