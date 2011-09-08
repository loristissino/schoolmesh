<?php

/**
 * profile actions.
 *
 * @package   schoolmesh
 * @subpackage profile
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class profileActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
		/*if ($this->profile = $this->getUser()->getProfile())
    {
      $this->name = $this->profile->getFullName();
      //$this->appointments = $this->getUser()->getProfile()->getCurrentAppointments();
      $this->teams=$this->getUser()->getProfile()->getTeams();
    }
    */
	
  }
  
  public function executeTreeview(sfWebRequest $request)
  {
    
  }
  
  public function executePoll(sfWebRequest $request)
  {
    $this->token = $this->getUser()->getProfile()->getToken(sfConfig::get('app_config_moodle_key'), $request);
    
    $url=sfConfig::get('app_config_moodle_access');
    
    if ($url=='')
    {
      throw new Exception('moodle_access setting is missing in your app.yml file');
    }
    
    $this->url = $url .
      '?action=login' .
      '&username=' . $this->getUser()->getUsername() .
      '&token=' . $this->token;
  }

  public function executeViewaccount(sfWebRequest $request)
	{
	$availableAccounts=sfConfig::get('app_config_accounts');
	$type=$request->getParameter('type');
	
	$user=$this->getUser();
	$profile=$user->getProfile();
	
	$this->account=$profile->getAccountByType($type);
	
	$this->forward404unless($this->account);
	
	$this->info=$this->account->getBasicInfo();
  if($this->account->getAccountType()=='posix')
  {
    $this->stats=array($user->getProfile()->getUsername()=>$this->account->getQuotaInfo());
  }
	
	}  

  public function executeChangeaccountpassword(sfWebRequest $request)
	{
		$availableAccounts=sfConfig::get('app_config_accounts');
		$type=$request->getParameter('type');
		
		$user=$this->getUser();
		$profile=$user->getProfile();
		
		$this->form=new ChangePasswordForm();

		$this->account=$profile->getAccountByType($type);

		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('userinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$type=$params['type'];
				
				$this->account=$profile->getAccountByType($type);
				$this->forward404unless($this->account);
				
				/*FIXME This should be done with a specific Account-class method */
				
				if (Authentication::checkSambaPassword($user->getUsername(), $params['current_password']))
				{
					$this->account->changePassword($params['password'], true);
					
					$this->getUser()->setFlash('notice',
						$this->getContext()->getI18N()->__('Password successfully changed.')
						);
				}
				else
				{
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('Password could not be changed, due to authentication failure.')
						);
				}
				$this->redirect('profile/viewaccount?type=' . $type);
					
			}
			else
			{
				$params=$request->getParameter('userinfo');
				$type=$params['type'];
				$this->account=$profile->getAccountByType($type);
			}
			
		}

		
		$this->forward404unless($this->account);
		
		$this->form->setDefaults(
			array(
				'type'=>$this->account->getAccountType(),
			)
		);

	
	}  

  public function executeSyncaccountpassword(sfWebRequest $request)
	{
		$availableAccounts=sfConfig::get('app_config_accounts');
		$type=$request->getParameter('type');
		
		$user=$this->getUser();
		$profile=$user->getProfile();
		
		$this->form=new SyncPasswordForm();

		$this->account=$profile->getAccountByType($type);

		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('userinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$type=$params['type'];
				
				$this->account=$profile->getAccountByType($type);
				$this->forward404unless($this->account);
				
				/*FIXME This should be done with a specific Account-class method */
				
        if (!$params['accept_terms'])
        {
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('You must accept service terms to proceed.')
						);
          $this->redirect('profile/syncaccountpassword?type=' . $type);

        }
        
        $function=sfConfig::get('app_sf_guard_plugin_check_password_callable');
        $function=$function[0].'::'.$function[1];
        
				if (call_user_func($function, $user->getUsername(), $params['current_password']))
				{
          try
          {
            $this->account->changePassword($params['current_password'], true);
            $this->getUser()->setFlash('notice',
						$this->getContext()->getI18N()->__('Password successfully synchronized.')
						);

					}
          catch (Exception $e)
          {
            $this->getUser()->setFlash('error',
              $this->getContext()->getI18N()->__('The password could not be synchronized at this time, due to technical reasons.') . ' ' . $this->getContext()->getI18N()->__($e->getMessage())
              );
          }
				}
				else
				{
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('The password could not be synchronized, due to authentication failure.')
						);
				}
				$this->redirect('profile/viewaccount?type=' . $type);
					
			}
			else
			{
				$params=$request->getParameter('userinfo');
				$type=$params['type'];
				$this->account=$profile->getAccountByType($type);
			}
			
		}

		
		$this->forward404unless($this->account);
		
		$this->form->setDefaults(
			array(
				'type'=>$this->account->getAccountType(),
			)
		);

	
	}  


  public function executeEditprofile(sfWebRequest $request)
	{
	
		$user=$this->getUser();
		$this->profile=$user->getProfile();
		
		$this->form=new ProfileForm();

		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('userinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();

				$old_email=$this->profile->getEmail();

				$this->profile
				->setPronunciation($params['pronunciation'])
				->setEmail($params['email']);
				
				$email_warning='';
				
				if($params['email']=='')
				{
					$email_warning=$this->getContext()->getI18N()->__('No email address was set.');
					$this->profile
					->setEmailState(sfGuardUserProfilePeer::EMAIL_UNDEFINED);
				}
				else
				{
					if ($params['email']!=$old_email)
					{
						$email_warning=$this->getContext()->getI18N()->__('An email was sent to you to verify your email address.');
						$this->profile->sendEmailVerification($this->getContext());
					}
					
				}
				
				$this->profile->save();
				
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('User profile information updated.'). ' ' . $email_warning
					);
					
				$this->redirect('profile/editprofile');
			}
		}

		$this->form->setDefaults(
			array(
				'pronunciation'=>$this->profile->getPronunciation(),
				'email'=>$this->profile->getEmail(),
			)
		);
	
	}  

  public function executeGoogleapps($request)
  {
	
  }


}


