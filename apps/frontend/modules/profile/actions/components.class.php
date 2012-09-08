<?php

class profileComponents extends sfComponents
{
  public function executeInfo()
  {

    if(sfConfig::get('app_authentication_soft_authentication_enabled', false))
    {
      $this->softuser = softUser::getSoftUser();
    }
    
    $this->current_user = $this->getUser()->isAuthenticated() ? $this->getUser()->getGuardUser() : $this->softuser;
    
    if ($this->current_user instanceof sfGuardUser)
    {
      $this->current_user->getProfile()
      ->setLastActionAt(time())
      ->save();
    }
    
  }
  
  
  public function executeGravatar()
  {
    if(!sfConfig::get('app_gravatar_use', false))
    {
      return sfView::NONE;
    }
    $this->hash=md5(strtolower(trim($this->profile->getValidatedEmail())));
    $this->url=str_replace(
      array('%hash%', '%size%'),
      array($this->hash, $this->size),
      sfConfig::get('app_gravatar_url')
    );
  }

}
