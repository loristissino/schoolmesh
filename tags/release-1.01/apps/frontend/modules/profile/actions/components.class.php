<?php

class profileComponents extends sfComponents
{
  public function executeInfo()
  {
    $this->softuser = softUser::getSoftUser();
    
    $this->current_user = $this->getUser()->isAuthenticated() ? $this->getUser()->getGuardUser() : $this->softuser;
    
    if ($this->current_user instanceof sfGuardUser)
    {
      $this->current_user->getProfile()
      ->setLastActionAt(time())
      ->save();
    }
    
      /*
			
			if ($this->getUser()->isAuthenticated())
			{
				if ($this->getUser()->hasCredential('admin'))
				{
					if (!OdfDocPeer::getIsUnoconvActive())
					{
						// FIXME: I must provide a more generic way, in order to allow several alerts...
						$this->getUser()->setFlash('schoolmesh_alerts', 'Unoconv not active!');
					}
				}
			}

			*/
			
			
			
//  $this->softuser = softUser::getSoftUsername();
//  $this->fullname = softUser::getFullname();
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
