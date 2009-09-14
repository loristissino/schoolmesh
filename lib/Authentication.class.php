<?php

class Authentication {

	static function testOnly($username, $password)
	{
		return true;
	}
	
	static function checkFirstSambaThenDBPassword($username, $password)
	{
		
	$user=sfGuardUserProfilePeer::retrieveByUsername($username);
	$profile=$user->getProfile();
	if ($profile->hasAccountOfType('samba'))
	{
		return self::checkSambaPassword($username, $password);
	}
	else
	{
		return self::checkDBPassword($username, $password);
	}
	}
	
	static function checkDBPassword($username, $password)
	{
		$user=sfGuardUserProfilePeer::retrieveByUsername($username);
		$algorithm = $user->getAlgorithm();
		if (false !== $pos = strpos($algorithm, '::'))
		{
		  $algorithm = array(substr($algorithm, 0, $pos), substr($algorithm, $pos + 2));
		}
		if (!is_callable($algorithm))
		{
		  throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
		}

		return $user->getPassword() == call_user_func_array($algorithm, array($user->getSalt().$password));
	}

	static function checkLdapPassword($username, $password)
	{
		$server=sfConfig::get('app_authentication_ldap_host');
		$basedn=sfConfig::get('app_authentication_ldap_domain');

		$dn = "uid=$username,ou=People,$basedn";

		if (!($connect = ldap_connect($server))) {
			die ("Could not connect to LDAP server\n");
		   }

		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

		return @ldap_bind($connect, $dn, $password);
	}
 
	static function checkSambaPassword($username, $password)
	{
		$share = sfConfig::get('app_authentication_samba_share');
		$address = sfConfig::get('app_authentication_samba_address');
		$command = sprintf('echo exit | smbclient "%s" "%s" -I %s -U %s', $share, $password, $address, $username);

		$output="";
		$result=-1;
		@exec($command, $output, $result);
		
		return ($result == 0);
	}
 
}
