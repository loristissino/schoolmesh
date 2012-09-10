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
    if(sfConfig::get('app_config_accept_gpl_license', false)!=true)
    {
      $this->redirect('@homepage');
    }
    
    $this->accounts=$this->getUser()->getProfile()->getAccounts();
    $this->teams=$this->getUser()->getProfile()->getTeams();
    $this->getUser()->setCulture($this->getUser()->getProfile()->getPreferredCulture());
  }
  
  public function executeTeams(sfWebRequest $request)
  {
    $this->Teams=$this->getUser()->getProfile()->getTeams();
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

  public function executeSendverificationcode(sfWebRequest $request)
  {
    $this->getUser()->getProfile()->sendEmailVerification($this->getContext());
    $this->address=$this->getUser()->getProfile()->getEmail();
    $this->setLayout('popup_layout');
  }

  public function executeViewaccount(sfWebRequest $request)
	{
    $availableAccounts=sfConfig::get('app_config_accounts');
    $type=$request->getParameter('type');
    
    $user=$this->getUser();
    $profile=$user->getProfile();
    
    $this->account=$profile->getAccountByType($type);
    
    $this->forward404unless($this->account);
    
    if(!$this->getUser()->hasCredential($type))
    {
      return sfView::ERROR;
    }
    
    $this->info=$this->account->getBasicInfo();
    if($this->account->getAccountType()=='posix')
    {
      $this->stats=array($user->getProfile()->getUsername()=>$this->account->getQuotaInfo());
    }
	
	}
  
  public function executeChangepassword(sfWebRequest $request)
  {
    $action = sfConfig::get('app_sf_guard_plugin_change_password_action');
    if(!$action)
    {
      throw new Exception('You must specify a change password action in your app.yml file');
    }
    return $this->redirect($action);
  }

  public function executeChangeaccountpassword(sfWebRequest $request)
	{
		$availableAccounts=sfConfig::get('app_config_accounts');
		$type=$request->getParameter('type', 'main');
    
		$user=$this->getUser();
		$profile=$user->getProfile();
		
		$this->form=new ChangePasswordForm();

		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('userinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$type=isset($params['type'])?$params['type']:'main';
				
        $callable = sfConfig::get('app_sf_guard_plugin_check_password_callable');
        
				if (call_user_func_array($callable, array($user->getUsername(), $params['current_password'])))
        /* first, we check if the owner knows his/her password */
        
				{
          if($type=='main')
          {
            $sfguarduser=sfGuardUserPeer::retrieveByUsername($user->getUsername());
            $sfguarduser->setPassword($params['password']);
            $sfguarduser->save();
            
            //Generic::logMessage('store', $params['password']);
            $sfguarduser->getProfile()->storeEncryptedPassword($params['password']);
          }
          else
          {
            $this->account->changePassword($params['password'], true);
          }
            
          $this->getUser()->setFlash('notice',
            $this->getContext()->getI18N()->__('Password successfully changed.')
            );
          
				}
				else
				{
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('The password could not be changed, due to authentication failure.')
						);
				}
        if($type=='main')
        {
          $this->redirect('profile/editprofile');
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

    if($type!='main')
    {
      $this->forward404Unless($this->account=$profile->getAccountByType($type));
      $this->forward404Unless($this->account->getPasswordIsResettable());
      $this->form->setDefaults(
        array(
          'type'=>$this->account->getAccountType(),
        )
      );
    }
    else
    {
      $this->form->setDefaults(
        array(
          'type'=>'main'
        )
      );
    }
	
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

  public function executeCredentials(sfWebRequest $request)
  {

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
        ->setPrefersRichtext($params['prefers_richtext'])
        ->setPreferredFormat($params['preferred_format'])
        ->setPreferredCulture($params['preferred_culture'])
        ->setWebsite($params['website'])
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
					
				$this->redirect('profile/index');
			}
		}

		$this->form->setDefaults(
			array(
				'pronunciation'=>$this->profile->getPronunciation(),
				'email'=>$this->profile->getEmail(),
				'website'=>$this->profile->getWebsite(),
        'prefers_richtext'=>$this->profile->getPrefersRichtext(),
        'preferred_format'=>$this->profile->getPreferredFormat(),
        'preferred_culture'=>$this->profile->getPreferredCulture(),
			)
		);
	
	}  

  public function executeSsologin(sfWebRequest $request)
  {
    $this->forward404Unless($sso=new SSO(sfConfig::get('app_sso_applications', null)));
    $this->forward404Unless($federated_app=$sso->getFederatedApp('saml', $request->getParameter('app')));
    
    return $this->redirect($federated_app['start_url']);
    
  }


  public function executeClearhistory(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->getUser()->setAttribute($request->getParameter('name'), array());
    $this->redirect($request->getReferer());
  }
  
  public function executeSso(sfWebRequest $request)
  {
    $this->forward404Unless($sso=new SSO(sfConfig::get('app_sso_applications', null)));
    $url=$sso->getRedirection($request, $this->getUser()->getProfile()->getUsername());
    $this->redirect($sso->getRedirection($request, $this->getUser()->getProfile()->getUsername()));
  }

  public function executeEnable2fa(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->forward404Unless(sfConfig::get('app_authentication_2fa_enabled', false));
    
    if(time() - $this->getUser()->getProfile()->getLastLoginAt('U') > sfConfig::get('app_authentication_security_timewindow', 60))
    {
      $this->getUser()->signOut();
      return $this->redirect('profile/editsecurity');
    }
    
    $security=sfGuardUserSecurityPeer::retrieveByUsername($this->getUser()->getProfile()->getUsername());
    
    if(!$security)
    {
      $security=new sfGuardUserSecurity();
      $security->setUserId($this->getUser()->getProfile()->getUserId());
    }
    $security
    ->setInitializationKey(Google2FA::generate_secret_key())
    ->setTrustedBrowsers(array())
    ->save()
    ;

    $this->getUser()->setFlash('notice',
      $this->getContext()->getI18N()->__('Two-factor authentication currently enabled.')
      );
    $this->redirect($request->getReferer());
    
  }

  public function executeDisable2fa(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->forward404Unless(sfConfig::get('app_authentication_2fa_enabled', false));

    if(time() - $this->getUser()->getProfile()->getLastLoginAt('U') > sfConfig::get('app_authentication_security_timewindow', 60))
    {
      $this->getUser()->signOut();
      return $this->redirect('profile/editsecurity');
    }
    
    $this->forward404Unless($this->sec=sfGuardUserSecurityPeer::retrieveByUsername($this->getUser()->getProfile()->getUsername()));
  
    $this->sec
    ->setInitializationKey(null)
    ->setTrustedBrowsers(array())
    ->save()
    ;
    
    $this->getUser()->setFlash('notice',
      $this->getContext()->getI18N()->__('Two-factor authentication currently disabled.')
      );

    $this->redirect($request->getReferer());
  }
  
  public function executeAuthenticator(sfWebRequest $request)
  {
    $this->forward404Unless(sfConfig::get('app_authentication_2fa_enabled', false));
    $this->forward404Unless($this->sec=sfGuardUserSecurityPeer::retrieveByUsername($this->getUser()->getProfile()->getUsername()));
    $this->forward404Unless($this->initialization_key=$this->sec->getInitializationKey());

    if(time() - $this->getUser()->getProfile()->getLastLoginAt('U') > sfConfig::get('app_authentication_security_timewindow', 60))
    {
      $this->getUser()->signOut();
      return $this->redirect('profile/authenticator');
    }
    
    $account = urlencode($this->getUser()->getProfile()->getUsername() . '@' . sfConfig::get('app_authentication_2fa_name', 'schoolmesh'));
    $data = "otpauth://totp/" . $account . "?secret=" . $this->initialization_key;
    
    $this->image_url= "https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=". $data;
    
  }
  
  public function executeEditsecurity(sfWebRequest $request)
  {
    $this->forward404Unless(sfConfig::get('app_authentication_2fa_enabled', false));
    // we cannot use the variable name 'security'

    $this->sec=sfGuardUserSecurityPeer::retrieveByUsername($this->getUser()->getProfile()->getUsername());
    
    if(time() - $this->getUser()->getProfile()->getLastLoginAt('U') > sfConfig::get('app_authentication_security_timewindow', 60))
    {
      $username=$this->getUser()->getProfile()->getUsername();
      $this->getUser()->signOut();
      return $this->redirect('profile/editsecurity?loginas=' .$username);
    }
   
  }

  
}


