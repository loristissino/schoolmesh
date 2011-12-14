<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(4, new lime_output_color());

//$t->ok(Authentication::checkLdapPassword('loris.tissino', 'lorisp'), '::checkLdapPassword() returns true for good credentials');
$t->is(Authentication::checkLdapPassword('loris.tissino', 'pulcinella'), false, '::checkLdapPassword() returns false for bad credentials');
$t->is(Authentication::checkLdapPassword('', ''), false, '::checkLdapPassword() returns false for empty credentials');
$t->is(@Authentication::checkLdapPassword(), false, '::checkLdapPassword() returns false for no credentials at all');

$t->is(Authentication::testOnly('loris.tissino', 'something'), true, '::testOnly() returns always true');



