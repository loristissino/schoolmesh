<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

new
sfDatabaseManager(ProjectConfiguration::getApplicationConfiguration('frontend',
'test', true));
$loader = new sfPropelData();
$loader->loadData(sfConfig::get('sf_data_dir').'/fixtures');

$t = new lime_test(13, new lime_output_color());

$t->diag('->retrieveByUsername()');
$user = sfGuardUserProfilePeer::retrieveByUsername('loris.tissino');
$t->is($user->getProfile()->getLastName(), 'Tissino', '->retrieveByUsername() returns the User for the given username');

$t->diag('->getUsernameIsValid()');
$user->setUsername('root');
$t->is($user->getProfile()->getUsernameIsValid(), false, '->getUsernameIsValid() returns false for a reserved username');

// valid usernames
foreach(array('foobar', 'foobar1', 'foobar1a', 'foo.bar', 'foo.bar1', 'a234567890b234567890') as $username)
{
	$user->setUsername($username);
	$t->is($user->getProfile()->getUsernameIsValid(), true, '->getUsernameIsValid() returns true for a good username: ' . $username);
}

// invalid usernames
foreach(array('.foobar', '1foobar', 'a234567890b2345678901', 'foobar$', 'foo_bar') as $username)
{
	$user->setUsername($username);
	$t->is($user->getProfile()->getUsernameIsValid(), false, '->getUsernameIsValid() returns false for an invalid username: ' . $username);
}

