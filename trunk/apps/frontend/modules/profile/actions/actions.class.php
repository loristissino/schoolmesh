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
		$this->profile = $this->getUser()->getProfile();
        $this->name = $this->profile->getFullName();
		
//        $this->appointments = $this->getUser()->getProfile()->getCurrentAppointments();

        $this->teams=$this->getUser()->getProfile()->getTeams();
	
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
				
				$this->account->changePassword($params['password'], true);
				
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Password successfully changed.')
					);
					
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
				if ($old_email!=$params['email'])
				{
					$email_warning=$this->getContext()->getI18N()->__('An email was sent to you to verify your email address.');
					$this->profile->sendEmailVerification($this->getContext());
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


