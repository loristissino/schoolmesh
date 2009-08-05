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


  public function executeRunuserchecks(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	$this->userlist = sfGuardUserProfilePeer::retrieveAllUsers();
	
	$this->checks=array();
	$this->ok=0;
	$this->failed=0;
	foreach($this->userlist as $current_user)
	{
		foreach($current_user->checkPosix() as $check)
		{
			$this->checks[]=$check;
			if ($check->getIsPassed())
			{
				$this->ok++;
			}
			else
			{
				$this->failed++;
			}
		}
	}
	
	if ($request->getRequestFormat()=='txt')
		{
			$this->setLayout(false);
			$this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="posixscript.sh"');
			$this->getResponse()->setContentType('application/x-shellscript; charset=utf-8');
		}

	
  }
  public function executeUpdatequota(sfWebRequest $request)
	{
		
		$this->forward404Unless($this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id')));
		
		$this->current_user->updateQuotaInfo();

		$this->getUser()->setFlash('notice',
			$this->getContext()->getI18N()->__('Quota information has been updated.')
			);
		
		$this->redirect('users/edit?id='. $request->getParameter('id'));
	
	
	
	}  


  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	
	$this->userlist = sfGuardUserProfilePeer::retrieveAllUsers();
  }

  public function executeEdit(sfWebRequest $request)
  {
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	
	$this->userform = new UserForm();
	
	if ($request->isMethod('post'))
		{
			$this->userform->bind($request->getParameter('userinfo'));
			if ($this->userform->isValid())
			{
				$params = $this->userform->getValues();
				$this->current_user=sfGuardUserProfilePeer::retrieveByPk($params['id']);

				if (!$this->current_user->isValidUsername($params['username']))
				{
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('The username could not be changed because the one you proposed is reserved or already in use.')
					);
					$this->redirect('users/edit?id='. $params['id']);
				}

				$this->current_user->setPosixUid($params['posix_uid']);
				$this->current_user->setFirstName($params['first_name']);
				$this->current_user->setMiddleName($params['middle_name']);
				$this->current_user->setLastName($params['last_name']);
				$this->current_user->setPronunciation($params['pronunciation']);
				$this->current_user->setEmail($params['email']);
				$this->current_user->setBirthdate($params['birthdate']);
				$this->current_user->setRoleId($params['main_role']);
				$this->current_user->setEmailState($params['email_state']);
				$this->current_user->setDiskSetSoftBlocksQuota($params['soft_blocks_quota']);
				$this->current_user->setDiskSetHardBlocksQuota($params['hard_blocks_quota']);
				$this->current_user->setDiskSetSoftFilesQuota($params['soft_files_quota']);
				$this->current_user->setDiskSetSoftFilesQuota($params['hard_files_quota']);
				$this->current_user->getSfGuardUser()->setUsername($params['username']);
				$this->current_user->save();
				
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('User information updated.') . ' ' .
					$this->getContext()->getI18N()->__('You might need to run User Checks in order to apply the changes.')
					);
				
			}
			
			
		}

	$this->userform->setDefaults(
		array(
			'id' => $this->current_user->getUserId(),
			'posix_uid' => $this->current_user->getPosixUId(),
			'username' => $this->current_user->getUsername(),
			'old_username' => $this->current_user->getUsername(),
			'first_name'=>$this->current_user->getFirstName(),
			'middle_name'=>$this->current_user->getMiddleName(),
			'last_name'=>$this->current_user->getLastName(),
			'pronunciation'=>$this->current_user->getPronunciation(),
			'email'=>$this->current_user->getEmail(),
			'email_state'=>$this->current_user->getEmailState(),
			'birthdate' => $this->current_user->getBirthdate(),
			'main_role'=>$this->current_user->getRoleId(),
			'soft_blocks_quota' => $this->current_user->getDiskSetSoftBlocksQuota(),
			'hard_blocks_quota' => $this->current_user->getDiskSetHardBlocksQuota(),
			'soft_files_quota' => $this->current_user->getDiskSetSoftFilesQuota(),
			'hard_files_quota' => $this->current_user->getDiskSetHardFilesQuota(),
		)
	);
	
		
	
  }



}
