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

  public function executeUploadgoogleappsdata(sfWebRequest $request)
  {
	$this->form = new UploadForm();
	
	if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('info'), $request->getFiles('info'));
	  
      if ($this->form->isValid())
      {
        $file = $this->form->getValue('file');
		
		$row = 0;
		$this->imported=0;
		$this->skipped=0;
	
		$this->checks=array();
	
		$handle = fopen($file->getTempName(), "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		{
			$row++;
			list($username, $firstname, $lastname, $lastlogin, $firstlogin, $quota)=$data;
			if ($row==1)
			{
					
				if($username!='Username'||$firstname!='FirstName'||$lastname!='LastName'||$lastlogin!='LastLogin'||$firstlogin!='FirstLogin'||$quota!='Quota')
				{
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('File headers are not correct.'));
					$this->redirect('users/uploadgoogleappsdata');
				}
				continue;  // we skip the first line
			}
			
			if ($username!='')
			{
				$this->imported++;

				$user=sfGuardUserProfilePeer::retrieveByUsername($username);
				if($user)
				{
					if ($user->getProfile()->getFirstname()!=$firstname)
					{
						$check = new Check(false, sprintf($this->getContext()->getI18N()->__('first name (%s) do not match with the one stored in the DB (%s)'), $firstname, $user->getProfile()->getFirstname()), $username);
						$this->checks[]=$check;
						continue;
					}
					if ($user->getProfile()->getLastname()!=$lastname)
					{
						$check = new Check(false, sprintf($this->getContext()->getI18N()->__('last name (%s) do not match with the one stored in the DB (%s)'), $lastname, $user->getProfile()->getLastname()), $username);
						$this->checks[]=$check;
						continue;
					}
					else
					{
						$check = new Check(true, 'user found', $username);
						$user->getProfile()->setHasGoogleAppsAccount(true);
						$user->getProfile()->save();
					}
				}
				else
				{
					$check = new Check(false, 'user not found', $username);
				}
				
				$this->checks[]=$check;
			}
			else
			{
				$this->skipped++;
			}
		}
		
	  }
	}


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
		$current_user->setCountFailedChecks(0);
		foreach($current_user->checkPosix() as $check)
		{
			
			$current_user->addCheck($check);
			if ($check->getIsPassed())
			{
				$this->ok++;
			}
			else
			{
				$this->failed++;
				$current_user->incCountFailedChecks();
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
/*
		$this->getUser()->setFlash('notice',
			$this->getContext()->getI18N()->__('Quota information has been updated.')
			);
*/		
		return $this->renderPartial('quotas', array('current_user'=>$this->current_user));
	
	}  

  public function executeUndelete(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod('POST'));
		$this->forward404Unless($this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id')));
		$this->current_user->setIsDeleted(false);
		$this->current_user->save();
		
		return $this->redirect('users/list');
	
	}  


	public function executeSetsortlistpreference(sfWebRequest $request)
	{
		$sortby = $request->getParameter('sortby');
		$this->forward404Unless(in_array($sortby, array('', 'gender', 'username', 'role', 'firstname', 'lastname', 'blocks', 'files')));
		$this->getUser()->setAttribute('sortby', $sortby);
		$this->redirect('users/list');
	}

	public function executeSetfilterlistpreference(sfWebRequest $request)
	{
		$filter = $request->getParameter('filter');
		if ($filter=='reset')
			{
				$this->getUser()->setAttribute('filter', '');
				$this->getUser()->setAttribute('filtered_role_id', '');
			}
		if ($filter=='set')
			{
				$this->getUser()->setAttribute('filter', 'set');
				$this->getUser()->setAttribute('filtered_role_id', $request->getParameter('filtered_role_id'));
				$this->getUser()->setAttribute('filtered_schoolclass_id', $request->getParameter('filtered_schoolclass_id'));
				
			}
			
		$this->redirect('users/list');
	}



  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	
	$sortby=$this->getUser()->getAttribute('sortby');
	
	if (!$filter=$this->getUser()->getAttribute('filter'))
		{
			$filter='';
		}

	if (!$this->filtered_role_id=$this->getUser()->getAttribute('filtered_role_id'))
		{
			$this->filtered_role_id='';
		}
	if (!$this->filtered_schoolclass_id=$this->getUser()->getAttribute('filtered_schoolclass_id'))
		{
			$this->filtered_schoolclass_id='';
		}
	
	$this->userlist = sfGuardUserProfilePeer::retrieveAllUsers($sortby, $filter, $this->filtered_role_id, $this->filtered_schoolclass_id);
  }

  public function executeNew(sfWebRequest $request)
	{
		$this->userform = new UserForm(array(), array('new'=>true));
	}  

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->userform = new UserForm(array(), array('new'=>true));

    $this->processForm($request, $this->userform);

    $this->setTemplate('new');
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
				
				if($this->current_user->getIsDeletable()&&$request->getParameter('delete'))
				{
					$this->current_user->setIsDeleted(true);
				}
				
				if($request->getParameter('undelete'))
				{
					$this->current_user->setIsDeleted(false);
				}

				$this->current_user->setPosixUid($params['posix_uid']);
				$this->current_user->setFirstName($params['first_name']);
				$this->current_user->setMiddleName($params['middle_name']);
				$this->current_user->setLastName($params['last_name']);
				$this->current_user->setPronunciation($params['pronunciation']);
				$this->current_user->setGenderChoice($params['gender']);
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
					
				$this->redirect('users/edit?id='. $params['id']);

				
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
			'gender'=>$this->current_user->getGenderChoice(),
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

	protected function processForm(sfWebRequest $request, sfForm $form)
	  {
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
		  $params = $this->userform->getValues();
		  $current_sfuser = new sfGuardUser();
		  $current_sfuser->setUsername($params['username']);
		  $current_sfuser->save();
		  $current_user = new sfGuardUserProfile();
		  $current_user->setUserId($current_sfuser->getId());
		  $current_user->setRoleId($params['main_role']);  
		  $current_user->save();

		  $this->redirect('users/edit?id='.$current_user->getUserId());
		}
	}


}
