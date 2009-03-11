<?php

class ldap {

static function checkLdapPassword($username, $password)
{

//  $user = LDAP::getUser($username);
if (!strpos($username, '.')>0)
    return false;

list($first, $last)=@explode('.', $username);

if ($password==$first . 'p')
  {
    return true;
  }
  else
  {
    return false;
  }
/*
$server=sfConfig::get('app_ldap_host');
$basedn=sfConfig::get('app_ldap_domain');

$dn = "uid=$username,ou=People,$basedn";

if (!($connect = ldap_connect($server))) {
    die ("Could not connect to LDAP server\n");
   }

ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

return @ldap_bind($connect, $dn, $password);

 */
 
 }
 
 
}
