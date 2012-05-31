<?php

/**
 * passwordreset actions.
 *
 * @package    schoolmesh
 * @subpackage passwordreset
 * @author     Loris Tissino
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
		$this->form = new ChooseUserAccountForm();
		
		
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
		$this->form = new ConfirmUserAccountForm();
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
					$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('You don\'t have the required credential to reset passwords of type %accounttype%.', array('%accounttype%'=>$this->account)));
					$this->redirect('passwordreset/index');
				}
				
				$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
				if ((!$user->getProfile()->getBelongsToGuardGroupByName('student'))&&(!$this->getUser()->hasCredential('admin')))
				{
					$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('You don\'t have the required credential to reset passwords for user %username%', array('%username%'=>$this->username)));
					$this->redirect('passwordreset/index');
				}
				
				if (!$user->getProfile()->hasAccountOfType($this->account))
				{
					$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('User %username% does not have an account of type %account%', array('%username%'=>$this->username, '%account%'=>$this->account)));
					$this->redirect('passwordreset/index');
				}
				
				$user->getProfile()->getAccountByType($this->account)->resetPassword();
				$user->getProfile()
				->addSystemAlert($this->getContext()->getI18n()->__('Password reset by %username%', array('%username%'=>$this->getUser()->getUsername())))
				->save();
				$this->getUser()->setFlash('notice', $this->getContext()->getI18n()->__('Password successfully reset.'));
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
			$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('You don\'t have the required credential to reset passwords of type %accounttype%.', array('%accounttype%'=>$this->account)));
			$this->redirect('passwordreset/index');
		}
		
		$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
		
		if(!$user)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('You must select a user.'));
			$this->redirect('passwordreset/index');
		}
		
		if ((!$user->getProfile()->getBelongsToGuardGroupByName('student'))&&(!$this->getUser()->hasCredential('admin')))
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('You don\'t have the required credential to reset passwords for user %username%', array('%username%'=>$this->username)));
			$this->redirect('passwordreset/index');
		}
		if (!$user->getProfile()->hasAccountOfType($this->account))
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('User %username% does not have an account of type %account%', array('%username%'=>$this->username, '%account%'=>$this->account)));
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
