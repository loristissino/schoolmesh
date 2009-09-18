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
				
				case('appointments'):
				{
					$this->checkList=AppointmentPeer::importFromCSVFile($file->getTempName());
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


  public function executeBatch(sfWebRequest $request)
{
	
	
	$action=$request->getParameter('batch_action');

	if ($action=='')
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must specify an action.'));
			$this->redirect('users/list');
		}
		
	switch($action)
	{
		case 'runuserchecks':
			$this->forward('users', 'runuserchecks');
		case 'getletter':
			$this->forward('users', 'getletter');
	}
	
	
}  

	public function executeXml(sfWebRequest $request)
	{
		$this->user = $this->getUser();
		$this->referer= $request->getReferer();
		
		if($request->hasParameter('id'))
		{
			$this->id=$request->getParameter('id');
			$this->forward404Unless($this->current_user=sfGuardUserProfilePeer::retrieveByPk($this->id));
			$this->userlist=array($this->current_user);
		}
		elseif ($request->hasParameter('ids'))
		{
			$ids = $request->getParameter('ids');
			$this->userlist = sfGuardUserProfilePeer::retrieveByPKs($ids);
		}
		else
		{
				$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select some users.'));
				$this->redirect('users/list');
		}
		
		set_time_limit(0);
		
		$this->available_accounts=sfConfig::get('app_config_accounts');
		
		$this->profiles=array();
		
		foreach($this->userlist as $current_user)
		{
			$this->profiles[]=$current_user;
		}
		
		$this->setLayout('odt_content');

		
	}


  public function executeGetletter(sfWebRequest $request)
  {
	
	$document = new Opendocument('mattiussirq', 'letter');  // the second parameter is the document name
	$document->setHeader($this->getController()->getPresentationFor('headers', 'letter'));
	$document->setContent($this->getController()->getPresentationFor('users', 'xml'));
	$document->setResponse($this->getContext()->getResponse());
	return sfView::NONE;

  }




  public function executeRunuserchecks(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	$this->referer= $request->getReferer();
	
	if($request->hasParameter('id'))
	{
		$this->id=$request->getParameter('id');
		$this->forward404Unless($this->current_user=sfGuardUserProfilePeer::retrieveByPk($this->id));
		$this->userlist=array($this->current_user);
	}
	elseif ($request->hasParameter('ids'))
	{
		$ids = $request->getParameter('ids');
		$this->userlist = sfGuardUserProfilePeer::retrieveByPKs($ids);
	}
	else
	{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select some users.'));
			$this->redirect('users/list');
	}
	
	set_time_limit(0);
	
	$this->checkList = new CheckList();
	
	$availableAccounts=sfConfig::get('app_config_accounts');
	
	foreach($this->userlist as $current_user)
	{
		$current_user->checkAccounts($availableAccounts, $this->checkList);
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
			
		$flash=$this->checkList()->getTotalResults(Check::FAILED)==0? 'notice': 'error';

		$this->getUser()->setFlash($flash, 
				sprintf($this->getContext()->getI18N()->__('Commands successfully executed: %d'), $this->checkList()->getTotalResults(Check::PASSED)) . '. ' . 
				sprintf($this->getContext()->getI18N()->__('Warnings: %d'), $this->checkList()->getTotalResults(Check::WARNING)) . '. ' .
				sprintf($this->getContext()->getI18N()->__('Commands failed: %d'), $this->checkList()->getTotalResults(Check::FAILED))
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

  public function executeRunteamchecks(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	$this->referer= $request->getReferer();
	
	if($request->hasParameter('id'))
	{
		$this->id=$request->getParameter('id');
		$this->forward404Unless($this->team=TeamPeer::retrieveByPk($this->id));
		$this->teamlist=array($this->team);
	}
	else
	{
		$this->teamlist = TeamPeer::doSelect(new Criteria());
	}
	
	$this->checkList = new CheckList();
	
	foreach($this->teamlist as $team)
	{
		$team->checkTeam($this->checkList);
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
		->setIsScheduledForDeletion(false)
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

		if ($request->hasParameter('schoolclass'))
		{
			$filtered_schoolclass_id=$request->getParameter('schoolclass');
			$this->getUser()->setAttribute('filtered_schoolclass_id', $filtered_schoolclass_id);
			$this->redirect('users/list');
		}
		else
		{
			$this->getUser()->setAttribute('filtered_schoolclass_id', '');
		}

		$this->roles=RolePeer::retrieveMainRoles();
		$role = $request->getParameter('role');
		if ($role=='all')
			{
				$this->getUser()->setAttribute('filter', '');
				$this->getUser()->setAttribute('filtered_role_id', '');
			}
		elseif ($filtered_role=RolePeer::retrieveByPK($role))
			{
				$this->getUser()->setAttribute('filter', 'set');
				$this->getUser()->setAttribute('filtered_role_id', $role);
				$this->filtered_role_id=$role;
				
				if($filtered_role->getPosixName()==sfConfig::get('app_config_students_default_posix_group'))
				{
					$schoolclasses=SchoolclassPeer::retrieveCurrentSchoolclasses();
					return $this->renderPartial('filter2', array('filtered_role_id'=>$this->filtered_role_id, 'roles'=>$this->roles, 'schoolclasses'=>$schoolclasses));
				}
			}
			
		return $this->redirect('users/list');
	}

  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser();
	
	$page=$request->getParameter('page', 1);
	
	$sortby=$this->getUser()->getAttribute('sortby');
	
	$this->roles=RolePeer::retrieveMainRoles();
	$this->schoolclasses=SchoolclassPeer::retrieveCurrentSchoolclasses();
	
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
	
//	$this->userlist = sfGuardUserProfilePeer::retrieveAllUsers($sortby, $filter, $this->filtered_role_id, $this->filtered_schoolclass_id);
	$this->pager = sfGuardUserProfilePeer::retrieveAllUsers($page, $sortby, $filter, $this->filtered_role_id, $this->filtered_schoolclass_id);


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
	$this->accounts = $this->current_user->getAccounts();
	$this->available_accounts=sfConfig::get('app_config_accounts');
	
	$this->userform = new UserForm();
	
	if ($request->isMethod('post'))
		{
			$this->userform->bind($request->getParameter('userinfo'));
			if ($this->userform->isValid())
			{
				$params = $this->userform->getValues();
				$this->current_user=sfGuardUserProfilePeer::retrieveByPk($params['id']);
				if($this->current_user->getIsDeletable()&&$request->getParameter('delete'))
				{
					$this->current_user
					->setIsScheduledForDeletion(true);
				}
				
				if($request->getParameter('undelete'))
				{
					$this->current_user
					->setIsScheduledForDeletion(false);
				}

				$this->current_user
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
				->setSystemAlerts('')
				->save();
				$this->current_user
				->getSfGuardUser()->setUsername($params['username'])
				->setIsActive($params['is_active'])
				->save();
				
				$role=RolePeer::retrieveByPK($params['main_role']);
				if ($role->getDefaultGuardGroup())
				{
					$group=sfGuardGroupProfilePeer::retrieveGuardGroupByName($role->getDefaultGuardGroup());
					$this->current_user->addToGuardGroup($group);
				}

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
			'username' => $this->current_user->getUsername(),
			'is_active'=> $this->current_user->getsfGuardUser()->getIsActive(),
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
		)
	);
	
  }

  public function executeRemovefromteam(sfWebRequest $request)
  {
	
	$this->forward404Unless($request->isMethod('delete'));
	
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	$this->team = TeamPeer::retrieveByPK($request->getParameter('team'));
	
	$this->current_user->removeFromTeam($this->team);
	$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('User successfully removed from team.'));
	$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

  public function executeRemovefromguardgroup(sfWebRequest $request)
  {
	$this->forward404Unless($request->isMethod('delete'));
	$this->forward404Unless($this->getUser()->hasCredential('backadmin'));
	
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	$this->guardgroup = sfGuardGroupProfilePeer::retrieveGuardGroupByName($request->getParameter('guardgroup'));
	
	$this->current_user->removeFromGuardGroup($this->guardgroup);
	$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('User successfully removed from team.'));
	$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

  public function executeRevokepermission(sfWebRequest $request)
  {
	$this->forward404Unless($request->isMethod('delete'));
	$this->forward404Unless($this->getUser()->hasCredential('backadmin'));
	
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	
	$this->current_user->revokeUserPermission($request->getParameter('permission'));
	$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Permission successfully removed.'));
	$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

public function executeChangerole(sfWebRequest $request)
  {
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	$this->team = UserTeamPeer::retrieveByPK($request->getParameter('team'));
	
//	$this->forward404Unless($this->team);

	$this->form = new TeamChangeRoleForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$this->current_user=sfGuardUserProfilePeer::retrieveByPK($params['id']);
				$this->team=UserTeamPeer::retrieveByPk($params['team']);
				$this->role=RolePeer::retrieveByPk($params['role']);
				
				$this->current_user
				->changeRoleInTeam($this->team->getTeam(), $this->role);
				
				$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Role successfully changed.'));
				$this->redirect('users/edit?id='. $params['id']);
			}
		}

	$this->form->setDefaults(
		array(
			'id' => $this->current_user->getUserId(),
			'team' => $this->team->getId(),
			'role'=> $this->team->getRoleId(),
		)
	);
		
	}

public function executeEditenrolment(sfWebRequest $request)
  {
	$this->enrolment=EnrolmentPeer::retrieveByPK($request->getParameter('id'));
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($this->enrolment->getUserId());
	
	$this->form = new EditEnrolmentForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$this->enrolment=EnrolmentPeer::retrieveByPK($request->getParameter('id'));
				$current_user=$this->enrolment->getsfGuardUser()->getProfile();
				
				$result=$current_user->modifyEnrolment($this->enrolment->getId(), $params['class'], $params['year']);
				
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
				
				if ($result['result']=='notice')
				{
					$this->redirect('users/edit?id='. $current_user->getUserId());
				}
				else
				{
					$this->redirect('users/editenrolment?id='. $this->enrolment->getId());
				}
			}

		}

	$this->form->setDefaults(
		array(
			'year' => $this->enrolment->getYear()->getId(),
			'class'=> $this->enrolment->getSchoolclass(),
		)
	);
		
	}

public function executeAddenrolment(sfWebRequest $request)
  {
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
	
	$this->form = new EditEnrolmentForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$result=$this->current_user->addEnrolment($params['class'], $params['year']);
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
				
				if ($result['result']=='notice')
				{
					$this->redirect('users/edit?id='. $this->current_user->getUserId());
				}
				else
				{
					$this->redirect('users/addenrolment?user='. $this->current_user->getUserId());
				}
				
				
				
			}
		}

	$this->form->setDefaults(
		array(
			'year' => sfConfig::get('app_config_students_default_posix_group')
		)
	);
		
	}



  public function executeAddtoteam(sfWebRequest $request)
  {
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
	
	if ($request->isMethod('post'))
	{

		if ($request->getParameter('role')==-1)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select a role.'));
			$this->redirect('users/addtoteam?user='. $this->current_user->getUserId());
		}

		$this->forward404Unless($role=RolePeer::retrieveByPK($request->getParameter('role')));

		$ids=$request->getParameter('id[]');
		
		foreach($ids as $id)
		{
			$team=TeamPeer::retrieveByPK($id);
			$this->current_user->addToTeam($team, $role);
		}
		
		$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('User successfully added to team.'));
		$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

	$this->teams=TeamPeer::doSelect(new Criteria());
	
	$roles=RolePeer::doSelect(new Criteria());

	$this->roles=Array(-1=>'select one');
	foreach($roles as $role)
	{
		$this->roles[$role->getId()]=$this->current_user->getIsMale()? $role->getMaleDescription(): $role->getFemaleDescription();
    }

	}

  public function executeAddtoguardgroup(sfWebRequest $request)
  {
	
	$this->forward404Unless($this->getUser()->hasCredential('backadmin'));

	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
	
	if ($request->isMethod('post'))
	{
		$ids=$request->getParameter('id[]');
		
		foreach($ids as $id)
		{
			$group=sfGuardGroupProfilePeer::retrieveByPK($id);
			$this->current_user->addToGuardGroup($group);
		}
		
		$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('User successfully added to guardgroup.'));
		$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

	$this->guardgroups=sfGuardGroupProfilePeer::doSelect(new Criteria());
	
	}

  public function executeAddcredential(sfWebRequest $request)
  {
	
	$this->forward404Unless($this->getUser()->hasCredential('backadmin'));

	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
	
	if ($request->isMethod('post'))
	{
		$ids=$request->getParameter('id[]');
		
		foreach($ids as $id)
		{
			$credential=sfGuardPermissionPeer::retrieveByPK($id);
			$this->current_user->addUserPermission($credential->getName());
		}
		
		$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Credential successfully given to user.'));
		$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

	$this->credentials=sfGuardPermissionPeer::doSelect(new Criteria());
	
	}

  public function executeEditaccount(sfWebRequest $request)
  {
	$this->account=AccountPeer::retrieveByPk($request->getParameter('id'));
	
	$this->account=$this->account->getRealAccount();
	$type=$this->account->getAccountType();
	
	$this->profile=$this->account->getProfile();
	
	$form=ucfirst($type) . 'AccountForm';
	
	$this->form = new $form();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('accountinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
#				$this->account=sfGuardUserProfilePeer::retrieveByPk($params['id']);

				$this->account->saveSettings($params);

				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('User information updated.') . ' ' .
					$this->getContext()->getI18N()->__('You might need to run User Checks in order to apply the changes.')
					);
					
				$this->redirect('users/editaccount?id='. $params['id']);
			}
		}
	$this->account->setFormDefaults($this->form);
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
