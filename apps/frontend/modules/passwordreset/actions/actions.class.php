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
		
		
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$this->account=$params['account'];
				$this->username=$params['username'];
				if(!$this->getUser()->hasPermission($this->account.'_resetpwd'))
				{
					$this->getUser()->setFlash('error', sprintf('You don\'t have the required permission to reset passwords of type %s.', $this->account));
					$this->redirect('passwordreset/index');
				}
				
				$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
				if (!$user->getProfile()->getBelongsToGuardGroupByName('student'))
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
				$this->getUser()->setFlash('notice', 'Password successfully reset.');
				$this->redirect('passwordreset/view?username='. $this->username . '&account=' . $this->account);
			}
		}
				

		
	
		$this->account=$request->getParameter('info[account]');
		$this->username=$request->getParameter('info[username]');
		
		if(!$this->getUser()->hasPermission($this->account.'_resetpwd'))
		{
			$this->getUser()->setFlash('error', sprintf('You don\'t have the required permission to reset passwords of type %s', $this->account));
			$this->redirect('passwordreset/index');
		}
		
		$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
		
		if (!$user->getProfile()->getBelongsToGuardGroupByName('student'))
		{
			$this->getUser()->setFlash('error', sprintf('You don\'t have the required permission to reset passwords for user %s', $this->username));
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
