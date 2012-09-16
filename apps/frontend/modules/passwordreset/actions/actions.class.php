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
    
    if($this->account=='main')
    {
      $this->password=$profile->getPlaintextPassword();
    }
    else
    {
      $this->password=$profile->getAccountByType($this->account)->getTemporaryPassword();
    }
    
    $this->user_id=$profile->getUserId();
	
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
        
				$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
				
        $result = $user->getProfile()->resetPassword($this->getUser(), $this->account, $this->getContext());
      
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18n()->__($result['message']));
        if($result['result']=='notice')
        {
          $this->redirect('passwordreset/view?username='. $this->username . '&account=' . $this->account);
        }
        $this->redirect('passwordreset/index');
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
		
		$user=sfGuardUserProfilePeer::retrieveByUsername($this->username);
		
		if(!$user)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('You must select a user.'));
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
