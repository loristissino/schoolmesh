<?php

/**
 * users actions.
 *
 * @package    schoolmesh
 * @subpackage users
 * @author     Loris Tissino
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
/*
	public function executeGoogleappsfile(sfWebRequest $request)
  {
		$this->userlist=sfGuardUserProfilePeer::retrieveUsersForGoogleApps();
  }
  */
  public function executeMoodlefile(sfWebRequest $request)
  {
    $this->userlist=sfGuardUserProfilePeer::retrieveUsersForMoodle();
		$response = $this->getContext()->getResponse();
		$response->setHttpHeader('Content-Type', 'text/csv');
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="MoodleData_upload_'. date('Ymd') . '.csv"');
  }

	public function executeUpload(sfWebRequest $request)
	{
		$this->form = new UploadForm();
		$this->what=$request->getParameter('what');
		$this->forward404Unless(in_array($this->what, array('classes', 'users','appointments','workplan')));
		
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
					$this->checkList=sfGuardUserProfilePeer::importFromCSVFile($file->getTempName());
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
  
  public function executeReassignappointment(sfWebRequest $request)
  {
    $this->forward404Unless($this->appointment=AppointmentPeer::retrieveByPK($request->getParameter('id')));
    //$this->forward404Unless($this->appointment->isReassignable());
    $this->form=new ChooseUserForm(
      array(
        'user_id'=>$this->appointment->getSfGuardUser()->getId()
        ),
      array(
        'peer_method'=>'retrieveTeachers',
        'add_empty'=>'Select a teacher',
        )
      );
      
    if($request->isMethod('post'))
 		{
      $oldOwnerId=$this->appointment->getSfGuardUser()->getId();
      
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();

        if($params['user_id']==$this->appointment->getSfGuardUser()->getId())
        {
          $this->getUser()->setFlash('notice',
            $this->getContext()->getI18N()->__('Appointment left unchanged.')
            );          
        }
        else
        {
          $result=$this->appointment->reassign($this->getUser()->getProfile()->getUserId(), $params, $this->getContext());
          $this->getUser()->setFlash($result['result'],
            $this->getContext()->getI18N()->__($result['message'])
            );
        }
				$this->redirect('users/edit?id='. $oldOwnerId);
			}
    }
      
  }

  public function executeUnlock(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('put') or $request->isMethod('post'));
    $this->forward404Unless($user=sfGuardUserProfilePeer::retrieveByUsername($request->getParameter('username')));
    $this->forward404Unless($account=AccountPeer::retrieveByUserIdAndType($user->getId(), $request->getParameter('account')));
    $result=$account->unlock();
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    $this->redirect('users/edit?id=' . $user->getId());
  }


  public function executeBatch(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $this->getUser()->setAttribute('ids', $ids);
    
    $action=$request->getParameter('batch_action');

    if ($action=='')
      {
        $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must specify an action.'));
        $this->redirect('users/list');
      }
      
    $this->forward('users', $action);
    // if an action is not valid, we get an error anyway, because there is no
    // template BatchSuccess.php
  }  


  protected function _getIds(sfWebRequest $request)
  {
    $this->ids=null;
    if($request->hasParameter('id'))
    {
      $this->ids=array($request->getParameter('id'));
    }
    elseif ($request->hasParameter('ids'))
    {
      if(!is_array($request->getParameter('ids')))
      {
        $this->ids = explode(',', $request->getParameter('ids'));
      }
      else
      {
        $this->ids = $request->getParameter('ids');
      }
    }
    if (!$this->ids)
		{
				$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select some users.'));
				$this->redirect('users/list');
		}
    
    return $this->ids; // we could avoid returning it, since it's available anyway
    
  }
  
  protected function _getPKs($ids)
  {
    $s='';
    foreach($ids as $id)
    {
      $s.='pk:'.$id.' ';
    }
    return $s;
  }

  protected function _changePostToGet(sfWebRequest $request, $action)
  {
    if ($request->isMethod('POST'))
    {
      if($request->hasParameter('id'))
      {
        $this->id=$request->getParameter('id');
        $this->userlist=array($this->id);
      }
      elseif ($request->hasParameter('ids'))
      {
        $ids = $request->getParameter('ids');
        $this->userlist = $ids;
      }

      $this->redirect('users/' . $action . '?ids=' . implode(',', $this->userlist));
    }

  }


  public function executeGetwelcomeletter(sfWebRequest $request)
  {

		set_time_limit(0);
    //$ids=$this->_getIds($request);
    $ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);


		$result=sfGuardUserProfilePeer::getWelcomeLetter($ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('users/list');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('users/list');
		}

  }

  public function executeGetteachingappointmentsletter(sfWebRequest $request)
  {

		set_time_limit(0);
    $ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);

		$result=sfGuardUserProfilePeer::getTeachingAppointmentsLetter($ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('users/list');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('users/list');
		}

  }

  public function executeGetresponsibilityrolechargeletter(sfWebRequest $request)
  {
    
    $this->_changePostToGet($request, 'getresponsibilityrolechargeletter');
    
    $this->ids=$this->_getIds($request);
    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);

    $this->roles=RolePeer::retrieveRolesWithChargeLetterNeeded();
  }
  
  public function executeGetresponsibilityroleconfirmationletter(sfWebRequest $request)
  {
    
    $this->_changePostToGet($request, 'getresponsibilityroleconfirmationletter');
    
    $this->ids=$this->_getIds($request);
    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);

    $this->roles=RolePeer::retrieveRolesWithChargeLetterNeeded();
  }
  

  public function executeConfirmgetresponsibilityrolechargeletter(sfWebRequest $request)
  {

		set_time_limit(0);
    
    $this->ids=$this->_getIds($request);
    $this->role_ids=$request->getParameter('roleids');
    
//    $ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);

		$result=sfGuardUserProfilePeer::getResponsibilityRolesChargeLetter($this->ids, $this->role_ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('users/list');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('users/list');
		}

  }

  public function executeConfirmgetresponsibilityroleconfirmationletter(sfWebRequest $request)
  {

		set_time_limit(0);
    
    $this->ids=$this->_getIds($request);
    $this->role_ids=$request->getParameter('roleids');
    
//    $ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);

		$result=sfGuardUserProfilePeer::getResponsibilityRolesConfirmationLetter($this->ids, $this->role_ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('users/list');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('users/list');
		}

  }




  public function executeGetgoogleappsletter(sfWebRequest $request)
  {

		set_time_limit(0);

    $ids=$this->_getIds($request);
		
		$result=sfGuardUserProfilePeer::getGoogleAppsLetter($ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('users/list');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('users/list');
		}

  }

  public function executeGetsigns(sfWebRequest $request)
  {

		set_time_limit(0);

    $ids=$this->_getIds($request);
		
		$result=sfGuardUserProfilePeer::getSigns($ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('users/list');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('users/list');
		}

  }


  public function executeGetgoogleappsdata(sfWebRequest $request)
  {
		set_time_limit(0);

    $ids=$this->_getIds($request);
    
		$this->userlist=sfGuardUserProfilePeer::retrieveByPKs($ids);
	
    $this->domain=sfConfig::get('app_config_googleapps_domain');
		$response = $this->getContext()->getResponse();
		$response->setHttpHeader('Content-Type', 'text/csv');
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="GoogleAppsData_upload_'. date('Ymd') . '.csv"');
    
    $this->setLayout(false);
    
  }
  
  
  
  public function executeFixgoogleappscredentials(sfWebRequest $request)
  {
    $ids=$this->_getIds($request);
		$this->userlist=sfGuardUserProfilePeer::retrieveByPKs($ids);
    $result=sfGuardUserProfilePeer::fixCredentialsForAccounts($this->userlist, 'googleapps');
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message'], $result['i18nsubs']));
    $this->redirect('users/list');
  }
  
  
  public function executeShowquotastats(sfWebRequest $request)
  {
    $this->_changePostToGet($request, 'showquotastats');
    $this->chart_width=$request->getParameter('chartwidth', sfConfig::get('app_config_posix_chartwidth', 400));
    $this->quota_warning=sfConfig::get('app_config_posix_quotawarning', .8);
    $this->ids=$this->_getIds($request);
    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);
    $this->getUser()->setAttribute('currently_selected', 'pk:'.implode(' pk:', $this->ids));

    $result=AccountPeer::RetrieveAccountInfo('posix', $this->userlist);
    $this->max_blocks=$result['max_blocks'];
    $this->max_files=$result['max_files'];
    $this->max_used_blocks=$result['max_used_blocks'];
    $this->max_used_files=$result['max_used_files'];
    $this->sum_used_blocks=$result['sum_used_blocks'];
    $this->sum_used_files=$result['sum_used_files'];
    $this->accounts = $result['accounts'];

    $this->stats=$result['stats'];
  }
  
  
  public function executeCopyaccountsettings(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    
    $this->forward404Unless($account=AccountPeer::retrieveByPK($request->getParameter('from')));
    $account=$account->getRealAccount();
    
    $result=$account->copySettings($request->getParameter('settings'), $request->getParameter('to'));
    
		$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    return $this->redirect('users/showquotastats?ids='.$result['back']);
  }
  
  public function executeEmail(sfWebRequest $request)
  {

    $this->ids=$this->_getIds($request);
    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);
    
    $this->message=new InformativeMessage($this->userlist, $this->getUser()->getProfile(), $this->getContext());
    
    $this->form = new EmailForm();
    $params=$request->getParameter('email', array());
    if (array_key_exists('send', $params))
		{
      
			$this->form->bind($request->getParameter('email'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
        $this->message
        ->setBody($params['body'])
        ->setSubject($params['email_subject'])
        ->addSchoolMeshHeader($this->getContext());
        
        $mailer=$this->getContext()->getMailer();
        $numSent = $mailer->batchSend($this->message);
        
        if($numSent==0)
        {
          $result['result']='error';
          $result['message']=$this->getContext()->getI18N()->__('No message could be sent.');
        }
        else
        {
          $result['result']='notice';
          $result['message']=$this->getContext()->getI18N()->__('Number of messages correctly sent: %number%.', $numSent);
        }
				
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
        return $this->redirect('users/list?query='.urlencode($this->_getPks($this->ids)));
      }
						
		}


    
    
    $this->form
    ->setDefault('email_subject', $this->message->getSubject())
    ->setDefault('body', $this->message->getBody())
    ->setDefault('send', true)
    ;

    
  }
  
  public function executeGetlist(sfWebRequest $request)
  {
    set_time_limit(0);

    $this->template = $this->getUser()->getAttribute('template', $request->getParameter('template', null));
    
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);

    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);
    $this->getUser()->setAttribute('currently_selected', 'pk:'.implode(' pk:', $this->ids));
    
    if(!$this->template)
    {
      
      //FIXME this should be in the model
      $templates = scandir(sfConfig::get('app_opendocument_template_directory'));
      
      $this->templates=array();
      
      foreach($templates as $template)
      {
        if (strpos($template, 'userlist')!==false)
        {
          $this->templates[]=$template;
        }
      }
      return;
      // the user must choose a template
    }
    
    $result=sfGuardUserProfilePeer::getUserlistDocument($this->template, $this->ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
    
    
    $odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;
		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.' . $this->template));
      $this->getUser()->setAttribute('template', null);
			$this->redirect($this->getRequest()->getReferer());
		}

  }


  public function executeRunuserchecks(sfWebRequest $request)
  {
    $this->user = $this->getUser();
    $this->referer= $request->getReferer();

    set_time_limit(0);
    $this->ids=$this->_getIds($request);
    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);
    $this->getUser()->setAttribute('currently_selected', 'pk:'.implode(' pk:', $this->ids));

    
    $this->checkList = new CheckList();
    
    $availableAccounts=sfConfig::get('app_config_accounts');
    
    foreach($this->userlist as $current_user)
    {
      $current_user->checkAccounts($availableAccounts, $this->checkList);
      $current_user->updateLuceneIndex();
    }
    
    $this->filename=$this->checkList->generateScript();
  
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

  public function executeAdduserstoteam(sfWebRequest $request)
  {
    $this->_changePostToGet($request, 'adduserstoteam');
    
    $this->ids=$this->_getIds($request);
    $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);

    $this->form=new ChooseTeamForm();
    
    $this->form->setDefault('team_id', $this->getUser()->getAttribute('team_id', null));
    $this->form->setDefault('role_id', $this->getUser()->getAttribute('role_id', null));
    $this->form->setDefault('expiry', YearPeer::retrieveByPK(sfConfig::get('app_config_current_year'))->getEndDate('U'));
  }

  public function executeConfirmadduserstoteam(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));

    $this->form=new ChooseTeamForm();
    $this->form->bind($request->getParameter('info'));

    $this->ids=$this->_getIds($request);
    
    if ($this->form->isValid())
    {
			$params = $this->form->getValues();
      $this->forward404Unless($this->team=TeamPeer::retrieveByPK($params['team_id']));
      $this->forward404Unless($this->role=RolePeer::retrieveByPK($params['role_id']));
      $this->expiry=$params['expiry'];
      $this->notes=$params['notes'];
      $this->charge_reference_number=$params['charge_reference_number'];
      $this->confirmation_reference_number=$params['confirmation_reference_number'];
    
      $this->userlist=sfGuardUserProfilePeer::retrieveByPKsSortedByLastnames($this->ids);
      foreach($this->userlist as $user)
      {
        //Generic::logMessage('team_in', $this->expiry);
        $user->addToTeam($this->getUser()->getProfile()->getUserId(), $this->team, $this->role, $this->expiry, $this->notes, $this->charge_reference_number, $this->confirmation_reference_number, $this->getContext());
      }
		
      $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Users successfully added to team.'));
      $this->redirect('users/list');
    }
    $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select a team and a role.'));
    $this->redirect('users/adduserstoteam?ids='.implode(',', $this->ids));
  }
  



	public function executeSetsortlistpreference(sfWebRequest $request)
	{
		$sortby = $request->getParameter('sortby');
		$this->forward404Unless(in_array($sortby, array('', 'gender', 'username', 'importcode', 'role', 'firstname', 'lastname', 'blocks', 'files', 'alerts')));
		$this->getUser()->setAttribute('sortby', $sortby);
		$this->redirect('users/list?query=' . $request->getParameter('query',''));
	}
/*
//This is not useful anymore, since we use Lucene index now...
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

*/
  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser();
  $this->query = $request->getParameter('query', '');
  
  $this->user->setAttribute('users_search_history',
    array_merge(
      $this->user->getAttribute('users_search_history', array()),
      array($this->query=>'users/list?query=')
      ));

  $this->pager = sfGuardUserProfilePeer::getForLuceneQuery(
    $this->query,
    sfConfig::get('app_config_users_max_per_page', 10),
    $request->getParameter('page', 1),
    $this->getUser()->getAttribute('sortby')
  );

/*
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
	$this->pager = sfGuardUserProfilePeer::retrieveAllUsers(sfConfig::get('app_config_users_max_per_page'), $page, $sortby, $filter, $this->filtered_role_id, $this->filtered_schoolclass_id);
*/
	}

  public function executePrenew(sfWebRequest $request)
	{
		$this->userform = new UserForm(array(), array('prenew'=>true));
    
  	if ($request->isMethod('post'))
		{
			$this->userform->bind($request->getParameter('userinfo'));
			if ($this->userform->isValid())
			{
				$params = $this->userform->getValues();
        
        $profile=new sfGuardUserProfile();
        $profile
        ->setFirstName($params['first_name'])
        ->setLastName($params['last_name'])
        ;
        
        $data = $profile->findGoodUsername();
        
        $this->getUser()->setAttribute('first_name', $params['first_name']);
        $this->getUser()->setAttribute('last_name', $params['last_name']);
        
				$this->redirect('users/new?username='. $data['username']);
			}
    }
	}

  public function executeNew(sfWebRequest $request)
	{
		$this->userform = new UserForm(array(), array('new'=>true));
    $this->userform->setDefault('username', $request->getParameter('username', ''));
    
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
    
    if($this->getUser()->hasAttribute('first_name'))
    // this happens when a new user is created with users/prenew action
    {
      // this is not very clean, because we do save something in a GET action
      // any idea on how to do it better is appreciated
      
      $password=Authentication::generateRandomPassword();
      
      $this->current_user
      ->setFirstName($this->getUser()->getAttribute('first_name'))
      ->setLastName($this->getUser()->getAttribute('last_name'))
      ->setPreferredFormat('odt')
      ->setPreferredCulture(sfConfig::get('app_config_culture'))
      ->setPlaintextPassword($password)
      ->setStoredEncryptedPassword($password)
      ->save();
      $this->current_user->getSfGuardUser()->setPassword($password);
      $this->current_user->getSfGuardUser()->save();
      
      $this->current_user->updateLuceneIndex();
      
      $this->getUser()->getAttributeHolder()->remove('first_name');
      $this->getUser()->getAttributeHolder()->remove('last_name');
    }
    
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
          ->updateFromForm($params, $this->getUser(), $this->getContext())
          ->setSystemAlerts('')
          ->save();
          
          $role=RolePeer::retrieveByPK($params['role_id']);
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
          'lettertitle' => $this->current_user->getLetterTitle(),
          'username' => $this->current_user->getUsername(),
          'is_active'=> $this->current_user->getsfGuardUser()->getIsActive(),
          'old_username' => $this->current_user->getUsername(),
          'import_code' => $this->current_user->getImportCode(),
          'first_name'=>$this->current_user->getFirstName(),
          'middle_name'=>$this->current_user->getMiddleName(),
          'last_name'=>$this->current_user->getLastName(),
          'pronunciation'=>$this->current_user->getPronunciation(),
          'gender'=>$this->current_user->getGenderChoice(),
          'email'=>$this->current_user->getEmail(),
          'email_state'=>$this->current_user->getEmailState(),
          'website'=>$this->current_user->getWebsite(),
          'office'=>$this->current_user->getOffice(),
          'ptn_notes'=>$this->current_user->getPtnNotes(),
          'birthdate' => $this->current_user->getBirthdate(),
          'birthplace' => $this->current_user->getBirthplace(),
          'role_id'=>$this->current_user->getRoleId(),
          'preferred_format'=>$this->current_user->getPreferredFormat(),
          'prefers_richtext'=>$this->current_user->getPrefersRichtext(),
        )
      );
      
  
  }

  public function executeRemovefromteam(sfWebRequest $request)
  {
	
    $this->forward404Unless($request->isMethod('delete'));
    
    $this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
    $this->team = TeamPeer::retrieveByPK($request->getParameter('team'));
    
    $this->current_user->removeFromTeam($this->getUser()->getProfile()->getUserId(), $this->team, $this->getContext());
    $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('User successfully removed from team.'));
    if($request->hasParameter('referer'))
    {
      $this->redirect(Generic::b64_unserialize($request->getParameter('referer')));
    }
    $this->redirect('users/edit?id='. $this->current_user->getUserId());
	}


  public function executeUnenrol(sfWebRequest $request)
  {
	
	$this->forward404Unless($request->isMethod('delete'));
	
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	$this->enrolment = EnrolmentPeer::retrieveByPK($request->getParameter('enrolment'));
	
	$result=$this->current_user->unenrol($this->enrolment);
	$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
	$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

  public function executeRemoveappointment(sfWebRequest $request)
  {
	
	$this->forward404Unless($request->isMethod('delete'));
	
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
	$this->appointment = AppointmentPeer::retrieveByPK($request->getParameter('appointment'));
	
	$result=$this->current_user->removeAppointment($this->appointment);
	$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
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
	$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Credential successfully removed.'));
	$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

public function executeEditjoining(sfWebRequest $request)
  {

	$this->form = new UserTeamForm();
  $values=false;
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$this->current_user=sfGuardUserProfilePeer::retrieveByPK($params['user_id']);
        $this->team = TeamPeer::retrieveByPK($params['team_id']);
				$this->userteam=UserTeamPeer::retrieveUserTeam($this->current_user->getSfGuardUser(), $this->team);
				$this->role=RolePeer::retrieveByPk($params['role_id']);
				
				$this->current_user
				->changeRoleInTeam($this->getUser()->getProfile()->getUserId(), $this->userteam->getTeam(), $this->role, $params, $this->getContext());
				
				$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Team joining successfully changed.'));
        $this->redirect(Generic::b64_unserialize($request->getParameter('referer')));
			}
      else
      {
        Generic::logMessage('recupero i valori', 'here');
        
        $params=$request->getParameter('info');
  
        $this->current_user=sfGuardUserProfilePeer::retrieveByPk($params['user_id']);
        $this->team = TeamPeer::retrieveByPK($params['team_id']);
        $values=true;
      }
		}

  if(!$values)
  {
    $this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('id'));
    $this->team = TeamPeer::retrieveByPK($request->getParameter('team'));
  }
	$this->userteam=UserTeamPeer::retrieveUserTeam($this->current_user->getSfGuardUser(), $this->team);
	$this->form->setDefaults(
		array(
			'user_id' => $this->current_user->getUserId(),
			'team_id' => $this->team->getId(),
			'role_id'=> $this->userteam->getRoleId(),
      'expiry'=> $this->userteam->getExpiry(),
      'notes'=>$this->userteam->getNotes(),
      'charge_reference_number'=>$this->userteam->getChargeReferenceNumber(),
      'confirmation_reference_number'=>$this->userteam->getConfirmationReferenceNumber(),
		)
	);
  
  $this->referer= $request->getReferer();
		
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

public function executeEditappointment(sfWebRequest $request)
  {
	$this->appointment=AppointmentPeer::retrieveByPK($request->getParameter('id'));
	
	$this->forward404Unless($this->getUser()->hasCredential('admin') or $this->appointment->getState()==Workflow::AP_ASSIGNED);
	
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($this->appointment->getUserId());
	
	$this->form = new EditAppointmentForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$current_user=$this->appointment->getsfGuardUser()->getProfile();
				
				$result=$current_user->modifyAppointment($this->appointment->getId(), $params);
				
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
				
				if ($result['result']=='notice')
				{
					$this->redirect('users/edit?id='. $current_user->getUserId());
				}
				else
				{
					$this->redirect('users/editappointment?id='. $this->appointment->getId());
				}
			}

		}

	$this->form->setDefaults(
		array(
			'year_id' => $this->appointment->getYear()->getId(),
			'schoolclass_id'=> $this->appointment->getSchoolclass(),
			'team_id'=> $this->appointment->getTeamId(),
			'subject_id'=> $this->appointment->getSubjectId() ? $this->appointment->getSubjectId() : null,
      'syllabus_id' => $this->appointment->getSyllabusId(),
      'appointment_type_id' => $this->appointment->getAppointmentTypeId(),
			'hours'=>$this->appointment->getHours()
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
			'year' => sfConfig::get('app_config_current_year')
		)
	);
		
	}

public function executeAddappointment(sfWebRequest $request)
  {
	$this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
	
	$this->form = new EditAppointmentForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$result=$this->current_user->addAppointment($params);
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
				
				if ($result['result']=='notice')
				{
					$this->redirect('users/edit?id='. $this->current_user->getUserId());
				}
				else
				{
					$this->redirect('users/addappointment?user='. $this->current_user->getUserId());
				}
				
				
				
			}
		}

	$this->form->setDefaults(
		array(
			'year_id' => sfConfig::get('app_config_current_year')
		)
	);
		
	}


  public function executeAddtoteam(sfWebRequest $request)
  {
    $this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
    
    //$this->form= new UserTeamForm();
    
    if ($request->isMethod('post'))
    {

      if ($request->getParameter('role')==-1)
      {
        $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select a role.'));
        $this->redirect('users/addtoteam?user='. $this->current_user->getUserId());
      }

      $this->forward404Unless($role=RolePeer::retrieveByPK($request->getParameter('role')));

      $ids=$request->getParameter('id');
      
      foreach($ids as $id)
      {
        $team=TeamPeer::retrieveByPK($id);
        $this->current_user->addToTeam($this->getUser()->getProfile()->getUserId(), $team, $role, null, null, null, null, $this->getContext());
      }
		
      $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('User successfully added to selected teams.'));
      $this->redirect('users/edit?id='. $this->current_user->getUserId());
    }

    $this->teams=TeamPeer::retrieveAll();
    
    $roles=RolePeer::doSelect(new Criteria());

    $this->roles=Array(-1=>$this->getContext()->getI18N()->__('Select a role'));
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
		$ids=$request->getParameter('id');
		
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
		$ids=$request->getParameter('id');
		
		foreach($ids as $id)
		{
			$credential=sfGuardPermissionPeer::retrieveByPK($id);
			$this->current_user->addUserPermission($credential->getName());
		}
		
		$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Selected credentials successfully granted to the user.'));
		$this->redirect('users/edit?id='. $this->current_user->getUserId());
	}

	$this->credentials=GuardSecurity::retrieveAllPermissionsSorted();
	
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

  public function executeEvents(sfWebRequest $request)
  {
    $this->current_user=sfGuardUserProfilePeer::retrieveByPk($request->getParameter('user'));
	  $this->wfevents=$this->current_user->getWorkflowLogs();
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
		  ->setRoleId($params['role_id'])
		  ->save();

		  $this->redirect('users/edit?id='.$current_user->getUserId());
		}
	}




}
