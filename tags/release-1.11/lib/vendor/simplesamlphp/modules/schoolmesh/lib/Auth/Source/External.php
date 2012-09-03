<?php

/**
 * Example external authentication source.
 *
 * This class is an example authentication source which is designed to
 * hook into an external authentication system.
 *
 * To adapt this to your own web site, you should:
 * 1. Create your own module directory.
 * 2. Add a file "default-enable" to that directory.
 * 3. Copy this file and modules/exampleauth/www/resume.php to their corresponding
 *    location in the new module.
 * 4. Replace all occurrences of "exampleauth" in this file and in resume.php with the name of your module.
 * 5. Adapt the getUser()-function, the authenticate()-function and the logout()-function to your site.
 * 6. Add an entry in config/authsources.php referencing your module. E.g.:
 *        'myauth' => array(
 *            '<mymodule>:External',
 *        ),
 *
 * @package simpleSAMLphp
 * @version $Id$
 */
class sspmod_schoolmesh_Auth_Source_External extends SimpleSAML_Auth_Source {

	/**
	 * Constructor for this authentication source.
	 *
	 * @param array $info  Information about this authentication source.
	 * @param array $config  Configuration.
	 */
	public function __construct($info, $config) {
		assert('is_array($info)');
		assert('is_array($config)');

		/* Call the parent constructor first, as required by the interface. */
		parent::__construct($info, $config);

		/* Do any other configuration we need here. */
    
    if (!is_string($config['cookie_name'])) {
      throw new Exception('Missing or invalid cookie_name option in config.');
    }
    $this->cookie_name = $config['cookie_name'];
    
    if (!is_string($config['info_url'])) {
      throw new Exception('Missing or invalid info_url option in config.');
    }
    $this->info_url = $config['info_url'];

    if (!is_string($config['domain'])) {
      throw new Exception('Missing or invalid domain option in config.');
    }
    $this->domain = $config['domain'];
    
    if (!is_string($config['login_page'])) {
      throw new Exception('Missing or invalid login_page option in config.');
    }
    $this->login_page = $config['login_page'];
    
	}


	/**
	 * Retrieve attributes for the user.
	 *
	 * @return array|NULL  The user's attributes, or NULL if the user isn't authenticated.
	 */
  
  private function dumper($data)
    {
    echo '<pre>' . print_r($data, true) . '</pre>';
    }

  
	private function getUser() {
    
    $data=$this->unserialize($this->getSessionData($this->cookie_name));
    
    if($data['symfony/user/sfUser/authenticated']!=1)
    {
      return null;
    }
    
    $user_id=$data['symfony/user/sfUser/attributes']['sfGuardSecurityUser']['user_id'];
    
    $info=file($this->info_url . $user_id);
    
    list($user_id,$uid,$displayName)=explode(':', $info[0]);
    
    if(!$uid)
    {
      return NULL;
    }
    
    	$attributes = array(
			'uid' => array($uid),
			'displayName' => array($displayName),
			'mail' => array($uid . '@' . $this->domain),
		);

		return $attributes;
    
    


	}


	/**
	 * Log in using an external authentication helper.
	 *
	 * @param array &$state  Information about the current authentication.
	 */
	public function authenticate(&$state) {
		assert('is_array($state)');

		$attributes = $this->getUser();
		if ($attributes !== NULL) {
			/*
			 * The user is already authenticated.
			 *
			 * Add the users attributes to the $state-array, and return control
			 * to the authentication process.
			 */
			$state['Attributes'] = $attributes;
      
			return;
		}

    



		/*
		 * The user isn't authenticated. We therefore need to
		 * send the user to the login page.
		 */

		/*
		 * First we add the identifier of this authentication source
		 * to the state array, so that we know where to resume.
		 */
		$state['schoolmesh:AuthID'] = $this->authId;


		/*
		 * We need to save the $state-array, so that we can resume the
		 * login process after authentication.
		 *
		 * Note the second parameter to the saveState-function. This is a
		 * unique identifier for where the state was saved, and must be used
		 * again when we retrieve the state.
		 *
		 * The reason for it is to prevent
		 * attacks where the user takes a $state-array saved in one location
		 * and restores it in another location, and thus bypasses steps in
		 * the authentication process.
		 */
		$stateId = SimpleSAML_Auth_State::saveState($state, 'schoolmesh:External');

		/*
		 * Now we generate an URL the user should return to after authentication.
		 * We assume that whatever authentication page we send the user to has an
		 * option to return the user to a specific page afterwards.
		 */
		$returnTo = SimpleSAML_Module::getModuleURL('schoolmesh/resume.php', array(
			'State' => $stateId,
		));


		/*
		 * Get the URL of the authentication page.
		 *
		 * Here we use the getModuleURL function again, since the authentication page
		 * is also part of this module, but in a real example, this would likely be
		 * the absolute URL of the login page for the site.
		 */
		$authPage = $this->login_page;

		/*
		 * The redirect to the authentication page.
		 *
		 * Note the 'ReturnTo' parameter. This must most likely be replaced with
		 * the real name of the parameter for the login page.
		 */
		SimpleSAML_Utilities::redirect($authPage, array(
			'ReturnTo' => $ReturnTo, 
		));

		/*
		 * The redirect function never returns, so we never get this far.
		 */
		assert('FALSE');
	}


	/**
	 * Resume authentication process.
	 *
	 * This function resumes the authentication process after the user has
	 * entered his or her credentials.
	 *
	 * @param array &$state  The authentication state.
	 */
	public static function resume() {

		/*
		 * First we need to restore the $state-array. We should have the identifier for
		 * it in the 'State' request parameter.
		 */
		if (!isset($_REQUEST['State'])) {
			throw new SimpleSAML_Error_BadRequest('Missing "State" parameter.');
		}
		$stateId = (string)$_REQUEST['State'];

		/*
		 * Once again, note the second parameter to the loadState function. This must
		 * match the string we used in the saveState-call above.
		 */
		$state = SimpleSAML_Auth_State::loadState($stateId, 'schoolmesh:External');

		/*
		 * Now we have the $state-array, and can use it to locate the authentication
		 * source.
		 */
		$source = SimpleSAML_Auth_Source::getById($state['schoolmesh:AuthID']);
		if ($source === NULL) {
			/*
			 * The only way this should fail is if we remove or rename the authentication source
			 * while the user is at the login page.
			 */
			throw new SimpleSAML_Error_Exception('Could not find authentication source with id ' . $state[self::AUTHID]);
		}

		/*
		 * Make sure that we haven't switched the source type while the
		 * user was at the authentication page. This can only happen if we
		 * change config/authsources.php while an user is logging in.
		 */
		if (! ($source instanceof self)) {
			throw new SimpleSAML_Error_Exception('Authentication source type changed.');
		}


		/*
		 * OK, now we know that our current state is sane. Time to actually log the user in.
		 *
		 * First we check that the user is acutally logged in, and didn't simply skip the login page.
		 */
		$attributes = $source->getUser();
		if ($attributes === NULL) {
			/*
			 * The user isn't authenticated.
			 *
			 * Here we simply throw an exception, but we could also redirect the user back to the
			 * login page.
			 */
			throw new SimpleSAML_Error_Exception('User not authenticated after login page.');
		}

		/*
		 * So, we have a valid user. Time to resume the authentication process where we
		 * paused it in the authenticate()-function above.
		 */

		$state['Attributes'] = $attributes;
		SimpleSAML_Auth_Source::completeAuth($state);

		/*
		 * The completeAuth-function never returns, so we never get this far.
		 */
		assert('FALSE');
	}


	/**
	 * This function is called when the user start a logout operation, for example
	 * by logging out of a SP that supports single logout.
	 *
	 * @param array &$state  The logout state array.
	 */
	public function logout(&$state) {
		assert('is_array($state)');
    
		if (!session_id()) {
			/* session_start not called before. Do it here. */
			session_start();
		}
    
    unset($_SESSION['uid']);
    
    $this->deleteSessionData($this->cookie_name);

		/*
		 * If we need to do a redirect to a different page, we could do this
		 * here, but in this example we don't need to do this.
		 */
    
    
    
	}
  
  
 
 	/**
	 * This function is used to unserialize data from session files.
	 * http://www.php.net/manual/en/function.session-decode.php
   * 
   * @author Frits dot vanCampen at moxio dot com 23-Mar-2012 05:24 
   * @author Loris Tissino 
   * 
	 */ 
    public function unserialize($session_data)
    {
      $method = ini_get("session.serialize_handler");
      switch ($method)
      {
        case "php":
            return $this->unserialize_php($session_data);
            break;
        case "php_binary":
            return $this->unserialize_phpbinary($session_data);
            break;
        default:
            throw new Exception("Unsupported session.serialize_handler: " . $method . ". Supported: php, php_binary");
      }
    }

 	/**
	 * This function is used to unserialize data from session files.
	 * http://www.php.net/manual/en/function.session-decode.php
   * 
   * @author Frits dot vanCampen at moxio dot com 23-Mar-2012 05:24 
   * @author Loris Tissino 
   * 
	 */ 
    private function unserialize_php($session_data)
    {
      $return_data = array();
      $offset = 0;
      while ($offset < strlen($session_data))
      {
          if (!strstr(substr($session_data, $offset), "|"))
          {
              throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
          }
          $pos = strpos($session_data, "|", $offset);
          $num = $pos - $offset;
          $varname = substr($session_data, $offset, $num);
          $offset += $num + 1;
          $data = unserialize(substr($session_data, $offset));
          $return_data[$varname] = $data;
          $offset += strlen(serialize($data));
      }
      return $return_data;
    }

 	/**
	 * This function is used to unserialize data from session files.
	 * http://www.php.net/manual/en/function.session-decode.php
   * 
   * @author Frits dot vanCampen at moxio dot com 23-Mar-2012 05:24 
   * @author Loris Tissino 
   * 
	 */ 
    private function unserialize_phpbinary($session_data)
    {
      $return_data = array();
      $offset = 0;
      while ($offset < strlen($session_data))
      {
          $num = ord($session_data[$offset]);
          $offset += 1;
          $varname = substr($session_data, $offset, $num);
          $offset += $num;
          $data = unserialize(substr($session_data, $offset));
          $return_data[$varname] = $data;
          $offset += strlen(serialize($data));
      }
      return $return_data;
    }

  
    private function getSessionData($cookiename)
    {
      return implode('', file($this->getSessionFile($cookiename)));
    }

    private function deleteSessionData($cookiename)
    {
      unlink($this->getSessionFile($cookiename));
    }
    
    private function getSessionFile($cookiename)
    {
      $save_path = session_save_path();
      return $save_path . '/sess_' . $_COOKIE[$cookiename];
    }
    
  
  
  

}
