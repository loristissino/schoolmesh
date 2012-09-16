<?php

/**
 * Authentication class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Authentication {

	static function testOnly($username, $password)
	{
    $user=sfGuardUserProfilePeer::retrieveByUsername($username);
    return self::storeAuthentication($user, true);
	}
  
	static function checkDBPassword($username, $password)
	{
		$user=sfGuardUserProfilePeer::retrieveByUsername($username);
    // we are always sure that the user exists, because otherwise the form validator would have failed
    
		$algorithm = $user->getAlgorithm();
		if (false !== $pos = strpos($algorithm, '::'))
		{
		  $algorithm = array(substr($algorithm, 0, $pos), substr($algorithm, $pos + 2));
		}
		if (!is_callable($algorithm))
		{
		  throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
		}

    return self::storeAuthentication($user, $user->getPassword() == call_user_func_array($algorithm, array($user->getSalt().$password)));
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

    if(@ldap_bind($connect, $dn, $password))
    {
      $user=sfGuardUserProfilePeer::retrieveByUsername($username);
      return self::storeAuthentication($user, true);
    }
    return false;
	}
 
	static function checkSambaPassword($username, $password)
	{
		$share = sfConfig::get('app_authentication_samba_share');
		$address = sfConfig::get('app_authentication_samba_address');
		
		$command = sprintf('echo exit | smbclient "%s" "%s" -I %s -U %s', $share, $password, $address, $username);

		$output="";
		$result=-1;
		@exec($command, $output, $result);
		
    if($result == 0)
    {
      $user=sfGuardUserProfilePeer::retrieveByUsername($username);
      return self::storeAuthentication($user, true);
    }
    return false;
    
	}

  static public function storeAuthentication(sfGuardUser $user, $auth=false)
  {
    if($auth)
    {
      $profile=$user->getProfile();
      $profile
      ->setLastLoginAt(time())
      ->save();
      return true;
    }
    return false;
  }

  
  public static function generateRandomPassword()
  {
    return strtoupper(str_replace(array('.', '/', '0', 'O'), array('+', '?', '1', '2'), substr(crypt(rand(1000, 9999).time(), '00'), 2, 10)));
  }
  
  public static function encrypt($value, $key)
  {
    if(!$value){return false;}
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv);
    return trim(base64_encode($crypttext));
  }
  
  public static function decrypt($value, $key)
  {
    if(!$value){return false;}
    $crypttext = base64_decode($value); 
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext);
  }
 
}
