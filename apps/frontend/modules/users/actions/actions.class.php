<?php

/**
 * user actions.
 *
 * @package    schoolmesh
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class usersActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

  public function executeIndex(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	
  }


  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	
	$this->userlist = sfGuardUserProfilePeer::retrieveAllUsers();
  }

  public function executeEdit(sfWebRequest $request)
  {
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	
	$this->form = new UserForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('userinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->current_user=sfGuardUserProfilePeer::retrieveByPk($params['old_user_id']);
				$this->current_user->setFirstName($params['first_name']);
				$this->current_user->setMiddleName($params['middle_name']);
				$this->current_user->setLastName($params['last_name']);
				$this->current_user->setEmail($params['email']);
				$this->current_user->setBirthdate($params['birthdate']);
				$this->current_user->getSfGuardUser()->setUsername($params['username']);
				$this->current_user->save();
				
				$this->redirect('users/edit?id='. $params['old_user_id']);
			}
		}
	else
	{

	$this->form->setDefaults(
		array(
			'old_user_id' => $this->current_user->getUserId(),
			'username' => $this->current_user->getUsername(),
			'first_name'=>$this->current_user->getFirstName(),
			'middle_name'=>$this->current_user->getMiddleName(),
			'last_name'=>$this->current_user->getLastName(),
			'email'=>$this->current_user->getEmail(),
			'birthdate' => $this->current_user->getBirthdate(),
		)
	);
	
		
	}
	
  }



}
