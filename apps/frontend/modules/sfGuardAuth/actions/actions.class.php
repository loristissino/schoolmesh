<?php
 
require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');
 
class sfGuardAuthActions extends BasesfGuardAuthActions
{
  
  public function executeSignin($request)
  // we modify this in order to have 2 factor authentication
  
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->redirect('@homepage');
    }

    if ($request->isXmlHttpRequest())
    {
      $this->getResponse()->setHeaderOnly(true);
      $this->getResponse()->setStatusCode(401);

      return sfView::NONE;
    }

    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->form = new $class();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
                
        $security=sfGuardUserSecurityPeer::retrieveByUsername($values['user']);
        
        // always redirect to a URL set in app.yml
        // or to the referer
        // or to the homepage
        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage'));

        if(!$security or !$security->getInitializationKey()) // the user does not want 2fa
        {
          $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);
          if($values['password']==$this->getUser()->getProfile()->getPlaintextPassword())
          {
            $this->getUser()->setFlash('passwordcheck',
              $this->getContext()->getI18N()->__('Login was successful, but you should remember to change your password.')
              );
          }
          return $this->redirect($signinUrl);
        }
          
        $this->getUser()->setAttribute('user', $values['user']);
        $this->getUser()->setAttribute('remember', $values['user']);
        $this->getUser()->setAttribute('signin_url', $signinUrl);
        return $this->redirect('@2fa');

      }
    }
    else
    {
      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
    
    $this->siblings=(sfConfig::get('app_config_lan_address', '127.0.0.1') == $request->getRemoteAddress()) ? sfConfig::get('app_config_siblings', false) : false;

  }
  
  public function executeSignout($request)
  {
    // this had to be reimplemented in order to delete simplesamlphp's cookie...
    
    $this->getUser()->signOut();
    
    $sso = new SSO();
    
    $this->sso_logout = $sso->removeCookie('saml');
    
    $this->apps = $sso->getFederatedApps('saml');
    
    /* we won't redirect, because Google does not support Single Log-Out and we must inform the user
     * 
    $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());
    $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
    */
    
  }


  public function execute2fa($request)
  {
    $security=sfGuardUserSecurityPeer::retrieveByUsername($this->getUser()->getAttribute('user'));
    
    if($security->getBrowserIsTrusted($this->getRequest()))
    {
      $this->getUser()->signin(
        $this->getUser()->getAttribute('user'),
        $this->getUser()->getAttribute('remember')
        );
      return $this->redirect($this->getUser()->getAttribute('signin_url'));
    }
    
    $this->form = new TwoFactorAuthenticationForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
        
        if($security->get2FACheck($values['code']))
        {
          $this->getUser()->signin(
            $this->getUser()->getAttribute('user'),
            $this->getUser()->getAttribute('remember')
            );
          if($values['remember_browser'])
          {
            $security->addTrustedBrowser($this->getResponse());
          }
          Authentication::storeAuthentication($this->getUser()->getProfile()->getSfGuardUser(), true);
          return $this->redirect($this->getUser()->getAttribute('signin_url'));
        }
        else
        {
          $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('The code you entered didn\'t verify.'));
          return $this->redirect('@2fa');
        }
      }
      
    }
   
  }



}
