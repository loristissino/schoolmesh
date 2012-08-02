<?php

/**
 * SSO class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SSO
{
  
  public function __construct($configfile=null)
  {
    
    if(!$configfile)
    {
      $configfile=sfConfig::get('app_sso_applications');
    }
    
    $this->config=sfYaml::load($configfile);
    
    if(!is_array($this->config))
    {
      throw new Exception('invalid configfile');
    }
    
  }
  
  public function getRedirection(sfWebRequest $request, $username)
  {
    $application= $request->getParameter('application');
    if(array_key_exists($application, $this->config['sso']['applications']))
    {
      $url=$this->config['sso']['applications'][$application]['url'];
      $token=$this->config['sso']['applications'][$application]['token'];

      return str_replace('%PATTERN%', md5($username.$token), $url);
    }
  }
  
  public function removeCookie($application)
  {
    if(array_key_exists($application, $this->config['sso']['applications']))
    {
      if(array_key_exists('cookie_name', $this->config['sso']['applications'][$application]))
      {
        $cookie_name = $this->config['sso']['applications'][$application]['cookie_name'];

        if(array_key_exists($cookie_name, $_COOKIE))
        {
          $save_path = session_save_path();
          $file=$save_path . '/sess_' . $_COOKIE[$cookie_name];
          if(file_exists($file))
          {
            unlink($file);
            return true;
          }
        }
      }
    }
    return false;
  }

  public function sessionExists($application)
  {
    if(array_key_exists($application, $this->config['sso']['applications']))
    {
      if(array_key_exists('cookie_name', $this->config['sso']['applications'][$application]))
      {
        $cookie_name = $this->config['sso']['applications'][$application]['cookie_name'];

        if(array_key_exists($cookie_name, $_COOKIE))
        {
          return true;
        }
      }
    }
    return false;
  }

  public function getFederatedApps($application)
  {
    if(array_key_exists($application, $this->config['sso']['applications']))
    {
      return $this->config['sso']['applications'][$application]['federated_apps'];
    }
    return false;
  }

  public function getAuthKey($application)
  {
    
    if(array_key_exists($application, $this->config['sso']['applications']))
    {
      if(array_key_exists('auth_key', $this->config['sso']['applications'][$application]))
      {
        return $this->config['sso']['applications'][$application]['auth_key'];
      }
    }
    return false;
  }



}
