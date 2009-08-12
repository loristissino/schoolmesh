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

	public function executeGoogleappsfile(sfWebRequest $request)
  {
		$this->userlist=sfGuardUserProfilePeer::retrieveUsersForGoogleApps();
		$response = $this->getContext()->getResponse();
		$response->setHttpHeader('Content-Type', 'text/csv');
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="GoogleAppsData_upload_'. date('Ymd') . '.csv"');
  }

	public function executeUpload(sfWebRequest $request)
	{
		$this->form = new UploadForm();
		$this->what=$request->getParameter('what');
		$this->forward404Unless(in_array($this->what, array('classes', 'users','appointments')));
		
		if ($request->isMethod('post'))
		{
		  $this->form->bind($request->getParameter('info'), $request->getFiles('info'));
		  
		  if ($this->form->isValid())
		  {
			$file = $this->form->getValue('file');
			
			switch($this->what)
			{
			
				case('classes'):
				{
					$this->checks=SchoolclassPeer::importFromCSVFile($file->getTempName());
					break;
				}
				
				case('users'):
				{
					$this->checks=sfGuardUserProfilePeer::importFromCSVFile($file->getTempName());
					break;
				}
				
			}
		}
		
		
		}
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
		
		// FIXME: This should be in the model, not here
		
		
		sfGuardUserProfilePeer::resetGoogleAppsAccountInfoForAll();
		// FIXME: We set the field has_googleapps_account to false for all users assuming that the uploaded file is correct
		
		$row = 0;
		$this->imported=0;
		$this->skipped=0;
	
		$this->checks=array();
	
		$handle = fopen($file->getTempName(), "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		{
			$row++;
			if (sizeof($data)<6)
			{
				$check = new Check(false, 'not enough data', sprintf('Line %d: ', $row));
				continue;
			}
			
			list($username, $firstname, $lastname, $lastlogin, $firstlogin, $quota)=$data;
			
			// NOTE
			/*
			If you ask Google to avoid the 'Accept Terms of Service' page, the field 'firstlogin' will not be set
			Since this is my case,  I'll use lastlogin to see if the account is activated.

			*/
			
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

				if($user=sfGuardUserProfilePeer::retrieveByUsername($username))
				{
					if ($user->getProfile()->getFirstname()!=$firstname)
					{
						$check = new Check(false, sprintf($this->getContext()->getI18N()->__('first name (%s) do not match with the one stored in the DB (%s)'), $firstname, $user->getProfile()->getFirstname()), $username);
					}
					if ($user->getProfile()->getLastname()!=$lastname)
					{
						$check = new Check(false, sprintf($this->getContext()->getI18N()->__('last name (%s) do not match with the one stored in the DB (%s)'), $lastname, $user->getProfile()->getLastname()), $username);
					}
					$check = new Check(true, 'user found', $username);
						
					if ($lastlogin==0)
					{
						$user->getProfile()->setGoogleappsAccountStatus(1);
					}
					else
					{
						$user->getProfile()->setGoogleappsAccountTemporaryPassword(null);
						$user->getProfile()->setGoogleappsAccountStatus(8);
					}
					
					if (Generic::date_difference_from_now($lastlogin) <= 30)
					{
						// last login is more recent than30 days
						$user->getProfile()->setGoogleappsAccountStatus(9);
					}
					
					$user->getProfile()->save();
					
				}
				elseif($user=ReservedUsernamePeer::retrieveByUsername($username))
				{
					$check = new Check(true, 'found in the reserved user list', $username);
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
	
	if($request->hasParameter('id'))
	{
		$this->id=$request->getParameter('id');
		$this->forward404Unless($this->current_user=sfGuardUserProfilePeer::retrieveByPk($this->id));
		$this->userlist=array($this->current_user);
	}
	else
	{
		$this->userlist = sfGuardUserProfilePeer::retrieveAllUsers();
	}
	
	
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
	
	if($request->hasParameter('execute'))
	{
		
		$result=array();
		$return_var=0;
		$count_passed=0;
		$count_failed=0;
        foreach($this->userlist  as $current_user)
		{
			foreach($current_user->getChecks() as $check)
			{
				if ($check->getCommand())
				{
					exec('sudo ' . $check->getCommand(), $result, $return_var);
					if ($return_var==0)
					{
						$count_passed++;
					}
					else
					{
						$count_failed++;
					}

				}
			
			}
		}
			
		$flash=$count_failed==0? 'notice': 'error';

		$this->getUser()->setFlash($flash, 
				sprintf($this->getContext()->getI18N()->__('Commands successfully executed: %d'), $count_passed) . '. ' . 
				sprintf($this->getContext()->getI18N()->__('Commands failed: %d'), $count_failed)
				);

		$this->redirect('users/runuserchecks'  . (isset($this->id)? '?id='. $this->id:''));
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
		return $this->renderPartial('quotas', array('current_user'=>$this->current_user));
	
	}  

  public function executeGoogleapps(sfWebRequest $request)
	{
		
		$this->forward404Unless($this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id')));
		
		if ($request->getParameter('todo')=='enable')
		{
			$this->current_user->GoogleappsEnable();
		}
		elseif($request->getParameter('todo')=='disable')
		{
			$this->current_user->GoogleappsDisable();
		}
		else
		{
			$this->forward404();
		}


		return $this->renderPartial('googleapps', array('current_user'=>$this->current_user));
	
	}  

	public function executeUndelete(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod('post'));
		$this->forward404Unless($user=sfGuardUserPeer::retrieveByPk($request->getParameter('id')));
		$user
		->getProfile()
		->setIsDeleted(false)
		->save();
		
		return $this->redirect('users/list');
	
	}  


	public function executeSetsortlistpreference(sfWebRequest $request)
	{
		$sortby = $request->getParameter('sortby');
		$this->forward404Unless(in_array($sortby, array('', 'gender', 'username', 'role', 'firstname', 'lastname', 'blocks', 'files', 'alerts')));
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
/*
				if (!$this->current_user->isValidUsername($params['username']))
				{
					$this->getUser()->setFlash('error',
						$this->getContext()->getI18N()->__('The username could not be changed because the one you proposed is reserved or already in use.')
					);
					$this->redirect('users/edit?id='. $params['id']);
				}
	*/			
				if($this->current_user->getIsDeletable()&&$request->getParameter('delete'))
				{
					$this->current_user
					->setIsDeleted(true);
				}
				
				if($request->getParameter('undelete'))
				{
					$this->current_user
					->setIsDeleted(false);
				}

				$this->current_user
				->setPosixUid($params['posix_uid'])
				->setFirstName($params['first_name'])
				->setMiddleName($params['middle_name'])
				->setLastName($params['last_name'])
				->setPronunciation($params['pronunciation'])
				->setGenderChoice($params['gender'])
				->setEmail($params['email'])
				->setBirthdate($params['birthdate'])
				->setBirthplace($params['birthplace'])
				->setRoleId($params['main_role'])
				->setEmailState($params['email_state'])
				->setDiskSetSoftBlocksQuota($params['soft_blocks_quota'])
				->setDiskSetHardBlocksQuota($params['hard_blocks_quota'])
				->setDiskSetSoftFilesQuota($params['soft_files_quota'])
				->setDiskSetHardFilesQuota($params['hard_files_quota'])
				->setSystemAlerts('')
				->save();
				$this->current_user
				->getSfGuardUser()->setUsername($params['username'])
				->save();
				
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
			'birthplace' => $this->current_user->getBirthplace(),
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
		  $current_user->setUserId($current_sfuser->getId())
		  ->setRoleId($params['main_role'])
		  ->save();

		  $this->redirect('users/edit?id='.$current_user->getUserId());
		}
	}


}
