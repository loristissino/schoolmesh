<?php

require 'lib/model/om/BasesfGuardUserSecurity.php';


/**
 * Skeleton subclass for representing a row from the 'sf_guard_user_security' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class sfGuardUserSecurity extends BasesfGuardUserSecurity {
  
  public function getProfile()
  {
    return sfGuardUserProfilePeer::retrieveByPK($this->getUserId());
  }

  public function get2FACheck($code)
  {
    $TimeStamp	  = Google2FA::get_timestamp();
    $secretkey 	  = Google2FA::base32_decode($this->getInitializationKey());
    $otp       	  = Google2FA::oath_hotp($secretkey, $TimeStamp);
    
    $result=Google2FA::verify_key($this->getInitializationKey(), $code);
    if(!$result)
    {
      $this->setLastLoginAttemptAt(time())->save();
      return false;
    }
    
    return (time() - $this->getLastLoginAttemptAt('U') > sfConfig::get('app_authentication_2fa_timewindow', 5));
    // to avoid brute force attacks, we don't allow trials in a 5 seconds (configurable) frame
    
  }
  
  private function _getCookieName()
  {
    return sfConfig::get('app_authentication_2fa_trusted_browser_cookie_name', 'smtb') . substr(sha1($this->getProfile()->getImportCode()), 0, 6);
  }
  
  public function getBrowserIsTrusted(sfWebRequest $request)
  {
    $trusted_browser_cookie = $request->getCookie($this->_getCookieName());
    
    $trusted_browsers = $this->getTrustedBrowsers();
    
    return isset($trusted_browsers[$trusted_browser_cookie]) 
      and 
      ($trusted_browsers[$trusted_browser_cookie] - time() < sfConfig::get('app_authentication_2fa_trusted_browser_validity', 2592000))
      ;
  }
  
  public function addTrustedBrowser(sfWebResponse $response)
  {
    $trusted_browsers = $this->getTrustedBrowsers();
    $new_browser_cookie=sha1(rand());
    $expiry = time() + sfConfig::get('app_authentication_2fa_trusted_browser_validity', 2592000);
    
    $response->setCookie(
      $this->_getCookieName(),
      $new_browser_cookie,
      $expiry
      );
    $trusted_browsers[$new_browser_cookie]=$expiry;
    $this->setTrustedBrowsers($trusted_browsers);
    $this->save();
    
    return $this;
  }

  public function getTrustedBrowsers()
  {
    return unserialize($this->getTrustedBrowsersSerialized());
  }

  public function setTrustedBrowsers($trusted_browsers)
  {
    $new=array();
    
    // we remove expired cookies
    foreach($trusted_browsers as $cookie => $expiry)
    {
      if($expiry > time())
      {
        $new[$cookie]=$expiry;
      }
    }
    
    $this->setTrustedBrowsersSerialized(serialize($new));
    
    return $this;
  }

} // sfGuardUserSecurity
