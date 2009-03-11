<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(4, new lime_output_color());

$t->ok(ldap::checkLdapPassword('loris.tissino', 'lorisp'), '::checkLdapPassword() returns true for good credentials');
$t->is(ldap::checkLdapPassword('loris.tissino', 'pulcinella'), false, '::checkLdapPassword() returns false for bad credentials');
$t->is(ldap::checkLdapPassword('', ''), false, '::checkLdapPassword() returns false for empty credentials');
$t->is(@ldap::checkLdapPassword(), false, '::checkLdapPassword() returns false for no credentials at all');




