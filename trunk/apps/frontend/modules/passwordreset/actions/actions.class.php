<?php

/**
 * passwordreset actions.
 *
 * @package    schoolmesh
 * @subpackage passwordreset
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class passwordresetActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
	{
		$this->available_accounts=sfConfig::get('app_config_accounts');
		$this->form = new ChooseUserForm();
		
		
	}
	
	
  public function executeView(sfWebRequest $request)
	{
		
		$this->forward404unless($this->getUser()->hasFlash('notice'));
		
		$this->username=$request->getParameter('username');
		$this->account=$request->getParameter('account');
		
		
		$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
		$profile=$user->getProfile();
		$this->password=$profile->getAccountByType($this->account)->getTemporaryPassword();
	
	}  
	
  public function executeConfirm(sfWebRequest $request)
	{
		$this->available_accounts=sfConfig::get('app_config_accounts');
		$this->form = new ConfirmUserForm();
		$this->referer=$request->getReferer();
				
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$this->account=$params['account'];
				$this->username=$params['username'];
				if(!($this->getUser()->hasCredential($this->account.'_resetpwd')||($this->getUser()->hasCredential('admin'))))
				{
					$this->getUser()->setFlash('error', sprintf('You don\'t have the required permission to reset passwords of type %s.', $this->account));
					$this->redirect('passwordreset/index');
				}
				
				$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
				if ((!$user->getProfile()->getBelongsToGuardGroupByName('student'))&&(!$this->getUser()->hasCredential('admin')))
				{
					$this->getUser()->setFlash('error', sprintf('You don\'t have the required permission to reset passwords for user %s.', $this->username));
					$this->redirect('passwordreset/index');
				}
				
				if (!$user->getProfile()->hasAccountOfType($this->account))
				{
					$this->getUser()->setFlash('error', sprintf('User %s does not have an account of type %s', $this->username, $this->account));
					$this->redirect('passwordreset/index');
				}
				
				$user->getProfile()->getAccountByType($this->account)->resetPassword();
				$user->getProfile()
				->addSystemAlert(sprintf('password reset by %s', $this->getUser()->getUsername()))
				->save();
				$this->getUser()->setFlash('notice', 'Password successfully reset.');
				$this->redirect('passwordreset/view?username='. $this->username . '&account=' . $this->account);
			}
		}
				
	  $params=$request->getParameter('info');
    if($request->hasParameter('username'))
    {
      $this->username=$request->getParameter('username');
      $this->account=$request->getParameter('account');
    }
    else
    {
      $this->account=$params['account'];
      $this->username=$params['username'];
    }
		
		if(!($this->getUser()->hasCredential($this->account.'_resetpwd')||($this->getUser()->hasCredential('admin'))))
		{
			$this->getUser()->setFlash('error', sprintf('You don\'t have the required creential to reset passwords of type %s', $this->account));
			$this->redirect('passwordreset/index');
		}
		
		$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
		
		if(!$user)
		{
			$this->getUser()->setFlash('error', 'You must select a user');
			$this->redirect('passwordreset/index');
		}
		
		if ((!$user->getProfile()->getBelongsToGuardGroupByName('student'))&&(!$this->getUser()->hasCredential('admin')))
		{
			$this->getUser()->setFlash('error', sprintf('You don\'t have the required permission to reset passwords for user %s.', $this->username));
			$this->redirect('passwordreset/index');
		}
		if (!$user->getProfile()->hasAccountOfType($this->account))
		{
			$this->getUser()->setFlash('error', sprintf('User %s does not have an account of type %s.', $this->username, $this->account));
			$this->redirect('passwordreset/index');
		}

		$this->form->setDefaults(
			array(
				'username' => $this->username,
				'account'=> $this->account,
			)
		);

	
	}
	
	
	
}
