<?php

class SSO
{
  
  public function __construct($configfile)
  {
    if($configfile)
    {
      $this->config=sfYaml::load($configfile);
    }
    else
    {
      throw new Exception('configfile not valid');
    }
  }
  
  public function getRedirection(sfWebRequest $request, $username)
  {
    $sso= $request->getParameter('application');
    if(array_key_exists($sso, $this->config['sso']['applications']))
    {
      $url=$this->config['sso']['applications'][$sso]['url'];
      $token=$this->config['sso']['applications'][$sso]['token'];

      return str_replace('%PATTERN%', md5($username.$token), $url);
    }
  }

}