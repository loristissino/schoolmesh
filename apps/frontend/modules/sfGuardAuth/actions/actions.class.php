<?php
 
require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');
 
class sfGuardAuthActions extends BasesfGuardAuthActions
{
  public function executeSignout($request)
  {
    // this has to be reimplemented in order to delete simplesamlphp's cookie...
    
    $this->getUser()->signOut();
    
    $sso = new SSO();
    $sso->removeCookie('saml');
    
    $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());
    
    $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
  }


}
