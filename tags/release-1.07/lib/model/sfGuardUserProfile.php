<?php

/**
 * sfGuardUserProfile class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class sfGuardUserProfile extends BasesfGuardUserProfile
{
		
		public function getId()
		{
			return $this->getUserId();
		}
    
    public function getIsActive()
    {
      return $this->getsfGuardUser()->getIsActive();
    }
    
    public function getAgeStatus()
    {
      
      if (!($bd=$this->getBirthdate('U')))
      {
        return null;
      }
      else
      {
        $today=getdate();
        $ubd=getdate($bd);
        
//        var_dump($ubd);
//        die();
        if($ubd['year'] < ($today['year']-18)) // FIXME: this 18 should be read in config file
        {
          return 'major' . $ubd['year'];
        }
        if($ubd['year'] > ($today['year']-18))
        {
          return 'minor';
        }
        if($ubd['yday'] > $today['yday'])
        {
          return 'minor';
        }
        else
        {
          return 'major';
        }
      }
    }
    
		public function sendEmailVerification(sfContext $sfContext)
		{
			$this->setEmailVerificationCode(sha1(rand(10000000,99999999)));
//			$this->addSystemAlert('should send email verification');

			$message=new EmailChangeConfirmationMessage($this, $sfContext);
			$mailer=$sfContext->getMailer();
			$mailer->send($message);

			$this
			->setEmailState(sfGuardUserProfilePeer::EMAIL_WAITINGVALIDATION)
			->save();
			
			return $this;
		}
		
		public function validateEmail($code)
		{
			if ($code==$this->getEmailVerificationCode())
			{
				if ($this->getHasValidatedEmail())
				{
					return 2;
				}
				else
				{
					$this
					->setEmailState(sfGuardUserProfilePeer::EMAIL_VERIFIED)
					->save();
					return 1;
				}
			}
			else
			{
				return 0;
			}
			
		}
		
		public function getHasValidatedEmail()
		{
			return $this->getEmailState()==sfGuardUserProfilePeer::EMAIL_VERIFIED;
		}
    
    public function getValidatedEmail()
    {
		
      if ($this->getHasValidatedEmail())
      {
        return $this->getEmail();
      }
      else
      {
        return '';
      }
    }
    
    public function getEmailStateDescription()
    {
      switch($this->getEmailState())
      {
        case sfGuardUserProfilePeer::EMAIL_UNDEFINED:
          return 'undefined';
        case sfGuardUserProfilePeer::EMAIL_UNVERIFIED:
          return 'unverified';
        case sfGuardUserProfilePeer::EMAIL_VERIFIED:
          return 'verified';
        case sfGuardUserProfilePeer::EMAIL_FAULTY:
          return 'faulty';
        default:
          return 'unknown';
      }
    }
    
    public function getInstitution()
    {
      return sfConfig::get('app_school_name');
    }
    
    public function getDepartment()
    {
      $dep=$this->getRole();
      
      $schoolclass=$this->getCurrentSchoolclassId();
      if($schoolclass)
      {
        $dep.= '_' . $schoolclass;
      }
      return $dep;
    }
    
    public function getFakeEmail()
    {
      // useful for moodle accounts, that can't go without...
      return $this->getUsername() . '@example.com';
    }
    
    public function getFakePassword()
    {
      // useful for moodle accounts, since we login from within schoolmesh
      // FIXME this is unsecure, must be fixed!!
      return 'Mo:'.substr(md5(sfConfig::get('app_config_moodle_key').$this->getUsername()),1,7);
    }
    
    public function getTempGooglePassword()
    {
      // FIXME this is unsecure, must be fixed!!
      return 'G' .substr(md5(sfConfig::get('app_config_googleapps_key').$this->getUsername()),1,7);
    }
    
    public function getToken($key, sfWebRequest $request=null)
    {
      // useful for external authentication (e.g. Moodle)
      if ($key=='')
      {
        throw new Exception('Key is not defined');
      }
      
      if($request)
      {
        return md5(
          $this->getUsername() .
          date('Yz') .
          $key
        );
      }
      else
      {
        return null;
      }
      
    }
		
		
		public function sendWorkflowConfirmationMessage($sfContext, $base, $arguments, $cc=null)
		{
			// This is used to send different kinds of messages to the user
			
			if ($this->getHasValidatedEmail())
			{
				try
				{
					$message=new WorkflowConfirmationMessage($this, $sfContext, $base, $arguments, $cc);
					$sfContext->getMailer()
					->send($message);
					return true;
				}
				catch (Exception $e)
				{
					return false;
				}
			}
			else
			{
				return false;
			}
			
		}
				
		public function addAccount(Account $account)
		{
/*			if (!$account instanceof Account)
			{
				throw new Exception('expected an Account instance');
			}
	*/		
			if ($this->hasAccountOfType($account->getAccountType()->getName()))
			{
				return $this;
			}

			$account
			->setUserId($this->getUserId())
			->save();
			
			return $this;
		
		}

		public function removeAccountByName($type)
		{
	        $c = new Criteria();
			$c->add(AccountPeer::USER_ID, $this->getUserId());
			$c->addJoin(AccountPeer::ACCOUNT_TYPE_ID, AccountTypePeer::ID);
			$c->add(AccountTypePeer::NAME, $type);
			$account = AccountPeer::doSelectOne($c);
			// For some reason, I've got a Foreign Key violation if I use AccountPeer::delete($c);
			
			if ($account)
			{
				$account->delete();
			}
			return $this;
		}


		public function getBelongsToGuardGroup(sfGuardGroup $group)
		{
			$c=new Criteria();
			$c->add(sfGuardUserGroupPeer::USER_ID, $this->getUserId());
			$c->add(sfGuardUserGroupPeer::GROUP_ID, $group->getId());
			if ($user_group = sfGuardUserGroupPeer::doSelectOne($c))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		public function getBelongsToGuardGroupByName($groupname)
		{
			$group=sfGuardGroupProfilePeer::retrieveByName($groupname);
			return $this->getBelongsToGuardGroup($group);
		}
		
		public function getGuardGroups($options=array())
		{
			$c=new Criteria();
			$c->add(sfGuardUserGroupPeer::USER_ID, $this->getUserId());
			$c->addJoin(sfGuardUserGroupPeer::GROUP_ID, sfGuardGroupPeer::ID);
			$t = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($c);
      
      if(array_key_exists('astext', $options) and $options['astext'])
      {
        $r=array();
        foreach($t as $usergroup)
        {
          $r[]=$usergroup->getsfGuardGroup()->getName();
        }
        return implode(',', $r);
      }
			return $t;
      
		}
		

		public function addToGuardGroup(sfGuardGroup $group)
		{
			if ($this->getBelongsToGuardGroup($group))
			{
				return $this;
			}
			
			$usergroup = new sfGuardUserGroup();
			$usergroup
			->setUserId($this->getUserId())
			->setGroupId($group->getId())
			->save();
			
			return $this;
		}

		public function removeFromGuardGroup(sfGuardGroup $group)
		{
			$c=new Criteria();
			$c->add(sfGuardUserGroupPeer::USER_ID, $this->getUserId());
			$c->add(sfGuardUserGroupPeer::GROUP_ID, $group->getId());
			$user_group = sfGuardUserGroupPeer::doSelectOne($c);
			if ($user_group)
			{
				$user_group->delete();
			}
			return $this;
		}



		public function getWebPermissions($options=array())
		{
      
      if(array_key_exists('astext', $options) and $options['astext'])
      {
        return implode(',', $this->getsfGuardUser()->getAllPermissionNames());
      }
			return $this->getsfGuardUser()->getAllPermissionNames();
		}
		
		public function hasPermission($value)
		{
			// similar to sfGuardUser::hasCredential(), that only works for authenticated users
			return in_array($value, $this->getWebPermissions());
		}
		
		public function hasCheckedPermission($value)
		{
			if ($value)
			{
				return $this->hasPermission($value);
			}
			return false;
		}
		
		
    public function canViewConfidentialInfo()
    {
      return $this->hasOneOfPermissions(array('wp_adm_ok', 'fr_adm_ok', 'wp_sm_ok', 'fr_sm_no'));
    }
    
    public function hasOneOfPermissions($permissions_required=array())
    {
      foreach($this->getWebPermissions() as $permission_available)
      {
        foreach($permissions_required as $permission_required)
        {
          if($permission_required==$permission_available)
          {
            return true;
          }
        }
      }
      return false;
    }    
    
		public function addUserPermission($value)
		{
			$this->getSfGuardUser()->addPermissionByName($value);
			return $this;
		}

		public function revokeUserPermission($value)
		{
			if (!$this->hasPermission($value))
			{
				return $this;
			}
/*
			$permission=sfGuardUserProfilePeer::retrievePermissionByName($value);
			if (!$permission)
			{
				throw new Exception(sprintf('The permission %s does not exist', $value));
			}

			$c=new Criteria();
			$c->add(sfGuardUserPermissionPeer::PERMISSION_ID, $permission->getId());
			$c->add(sfGuardUserPermissionPeer::USER_ID, $this->getUserId());
			$user_permission=sfGuardUserPermissionPeer::doDelete($c);
*/			
			$user_permission=$this->getUserPermission($value);
			
			if ($user_permission)
			{
				$user_permission->delete();
			}
			
//			sfGuardUserPermissionPeer::doDelete($c);
			
			return $this;
			
		}
		
		public function getUserPermission($value)
		{
			$permission=sfGuardUserProfilePeer::retrievePermissionByName($value);
			if (!$permission)
			{
				throw new Exception(sprintf('The permission %s does not exist', $value));
			}

			$c=new Criteria();
			$c->add(sfGuardUserPermissionPeer::PERMISSION_ID, $permission->getId());
			$c->add(sfGuardUserPermissionPeer::USER_ID, $this->getUserId());
			$user_permission=sfGuardUserPermissionPeer::doSelectOne($c);
			
			return $user_permission;
		}
		
		
		public function hasUserPermission($value)
		{
			return is_object($this->getUserPermission($value));
		}


		public function findGoodUsername()
		{
			
			$try=Generic::slugify($this->getFirstName().'.'.$this->getLastname());
			
			if ($this->getUsernameIsValid($try))
			{
				return array('username'=>$try, 'invented'=>false);
			}
			
			else
			{
				$try=sprintf('u%d%u', rand(1000,9999), crc32($try));
			}
			
				return array('username'=>$try, 'invented'=>true);
					
		}
		
		
		public function addSystemAlert($alert, $only_if=true)
		{
			if($only_if)
			{
				if (FALSE===strpos($this->getSystemAlerts(), $alert))
				{
					// we don't add the alert twice //FIXME Something broken here
					$previous= ($this->getSystemAlerts()=='') ? '' : $this->getSystemAlerts() . ' - ';
					$this->setSystemAlerts($previous.$alert);
				}
			}
			return $this;
		}
		
		public function updateMiddlename($middlename)
		{
			if ($this->getMiddlename()=='')
			{
				$this->setMiddlename($middlename);
			}
			return $this;
		}
			
		public function updateEmail($value)
		{
			if ($this->getEmail()=='')
			{
				$this->setEmail($value);
			}
			return $this;
		}

		public function updateBirthplace($value)
		{
			if ($this->getBirthplace()=='')
			{
				$this->setBirthplace($value);
			}
			return $this;
		}
		public function updateBirthdate($value)
		{
			if ($this->getBirthdate()=='')
			{
				$this->setBirthdate($value);
			}
			return $this;
		}
		
		public function getTextBirthdate()
		{
			return date('d/m/Y', $this->getBirthdate());
		}

		public function getGenderChoice()
		{
			switch($this->getGender())
			{
				case 'M': return 1;
				case 'F': return 0;
				default: return 2;
			}
		}

		public function setGenderChoice($gender)
		{
			switch($gender)
			{
				case 1: $this->setGender('M'); break;
				case 0: $this->setGender('F'); break;
				default: $this->setGender(null);
			}
			return $this;
		}
    
    public function getGenderValueFromParameter($parameter)
    {
			switch($parameter)
			{
				case 1: return 'M';
				case 0: return 'F';
				default: return null;
			}
    }
    
    
		public function __toString()
		{
				return $this->getFullName();
		}
    public function getFullName($maxLength=0)
    {
			if ($maxLength==0)
			{
                return $this->getFirstName() . ' ' . $this->getLastName();
			}

			$try=$this->getFullName(0);
			if (strlen($try)<=$maxLength)
			{
				return $try;
			}
				
			$try=substr($this->getFirstName(), 0, 1) . '. '. $this->getLastName();
			if (strlen($try)<=$maxLength)
      {
        return $try;
      }
			return substr($try, 0, $maxLength-1) . '…';
    }
		
		public function getSalutation($sfContext=null)
		{
			$greeting=$this->getIsMale()?'Dear %malename%,':'Dear %femalename%,';

			if ($sfContext)
			{
				$greeting=$sfContext->getI18n()->__($greeting, array('%femalename%'=>$this->getFirstName(), '%malename%'=>$this->getFirstName()));
			}
			else
			{
				$greeting = str_replace(array('%femalename%', '%malename%'), $this->getFirstName(), $greeting);
			}
			
			return $greeting;
		}
    
    public function getFullNameWithTitle()
    {
      if (!$this->getLetterTitle())
      {
        return $this->getFullName();
      }
      return $this->getLetterTitle() . ' ' . $this->getFullName();
    }
		
    public function getUsername()
    {
            return $this->getsfGuardUser()->getUsername();
    }

    public function getRoleDescription()
    {
			if ($this->getRole())
			{
				return $this->getRole()->getRoleDescriptionByGender($this->getIsMale());
			}
                return null;
    }


		public function getIsDeletable()
		{
			if (AppointmentPeer::countAppointmentsOfUser($this->getUserId())>0)
			{
				return false;
			}
			
			if (EnrolmentPeer::countCurrentEnrolmentsOfUser($this->getUserId())>0)
			{
				return false;
			}
	
			foreach($this->getAccounts() as $account)
			{
				if (!$account->getIsDeletable())
				{
					return false;
				}
			}
			
			return true;
		}

		public function getCurrentSchoolclassId()
		{
      $c = new Criteria();
			$c->add(EnrolmentPeer::USER_ID, $this->getUserId());
			$c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
			$t = EnrolmentPeer::doSelectOne($c);
			
			if($t)
			{
				return $t->getSchoolclassId();
			}
			else
			{
				return false;
			}
		}
    
		public function getCurrentGrade()
		{
      $s=$this->getCurrentSchoolclassId();
      if(!$s)
      {
        return false;
      }
      
      if($cl=SchoolclassPeer::retrieveByPK($s))
      {
        return $cl->getGrade();
      }
      else
      {
        return false;
      }
      
		}
    

    public function getAccounts($options=array())
    {
      $c = new Criteria();
			$c->add(AccountPeer::USER_ID, $this->getUserId());
			$c->addJoin(AccountPeer::ACCOUNT_TYPE_ID, AccountTypePeer::ID);
			$c->addAscendingOrderByColumn(AccountTypePeer::RANK);
			$t = AccountPeer::doSelect($c);

      $r=array();
      
      if(array_key_exists('astext', $options) and $options['astext'])
      {
        
        foreach($t as $account)
        {
          $r[]=$account->getRealAccount()->getAccountType();
        }
        return implode(',', $r);
      }

			foreach($t as $account)
			{
        $account=$account->getRealAccount();
        {
          $r[]=$account;
        }
        
			}
      
			return $r;
    }
    
		
		public function hasAccountOfType($type)
		{
      $c = new Criteria();
			$c->add(AccountPeer::USER_ID, $this->getUserId());
			$c->addJoin(AccountPeer::ACCOUNT_TYPE_ID, AccountTypePeer::ID);
			$c->add(AccountTypePeer::NAME, $type);
			return AccountPeer::doCount($c);
		}

		public function getAccountByType($type)
		{
      $c = new Criteria();
			$c->add(AccountPeer::USER_ID, $this->getUserId());
			$c->addJoin(AccountPeer::ACCOUNT_TYPE_ID, AccountTypePeer::ID);
			$c->add(AccountTypePeer::NAME, $type);
			$t = AccountPeer::doSelectOne($c);
			if ($t)
			{
				return $t->getRealAccount();
			}
			else
			{
				return null;
			}
			
			
		}

        public function getEnrolments()
        {
	        $c = new Criteria();
			$c->add(EnrolmentPeer::USER_ID, $this->getUserId());
			$c->addAscendingOrderByColumn(EnrolmentPeer::YEAR_ID);
			$t = EnrolmentPeer::doSelectJoinAllExceptsfGuardUser($c);
			return $t;
        }

        public function getCurrentEnrolment()
        {
	        $c = new Criteria();
			$c->add(EnrolmentPeer::USER_ID, $this->getUserId());
			$c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
			$t = EnrolmentPeer::doSelectOne($c);
			return $t;
        }

		public function modifyEnrolment($enrolmentId, $schoolclassId, $yearId)
		{
			
			$result=array();
			
			$enrolment=EnrolmentPeer::retrieveByPK($enrolmentId);
			$year=YearPeer::retrieveByPk($yearId);
			$schoolclass=SchoolclassPeer::retrieveByPk($schoolclassId);

			try
			{
				$enrolment
				->setSchoolclass($schoolclass)
				->setYear($year)
				->save();
				
				$result['result']='notice';
				$result['message']='Enrolment successfully saved.';
			}
			
			catch (Exception $exception)
			{
				$result['result']='error';
				$result['message']='Enrolment could not be saved.';
			}

			return $result;
			
		}
		
		public function modifyAppointment($appointmentId, $params)
		{
			
			$result=array();
			
			$appointment=AppointmentPeer::retrieveByPK($appointmentId);
			try
			{
				Generic::updateObjectFromForm(
          $appointment,
          array('schoolclass_id', 'year_id', 'subject_id', 'appointment_type_id', 'team_id', 'syllabus_id', 'hours'),
          $params);
          
        $appointment->save();
				
				$result['result']='notice';
				$result['message']='Appointment successfully saved.';
			}
			
			catch (Exception $exception)
			{
				$result['result']='error';
				$result['message']='Appointment could not be saved.';
			}

			return $result;
			
		}

	public function addEnrolment($schoolclassId, $yearId)
		{
			
			$result=array();
			
			$enrolment=new Enrolment();
			$year=YearPeer::retrieveByPk($yearId);
			$schoolclass=SchoolclassPeer::retrieveByPk($schoolclassId);

			try
			{
				$enrolment
				->setUserId($this->getUserId())
				->setSchoolclass($schoolclass)
				->setYear($year)
				->save();
				
				$result['result']='notice';
				$result['message']='Enrolment successfully saved.';
			}
			
			catch (Exception $exception)
			{
				$result['result']='error';
				$result['message']='Enrolment could not be saved.';
			}

			return $result;
			
		}
	public function addAppointment($params)
		{
			
			$result=array();
			
			$appointment=new Appointment();
			try
			{
        
        Generic::updateObjectFromForm(
          $appointment, 
          array('schoolclass_id', 'year_id', 'subject_id', 'appointment_type_id', 'syllabus_id', 'hours'),
          $params
          );
				$appointment
				->setUserId($this->getUserId())
        ->setState(Workflow::AP_ASSIGNED)
        ->save();
								
				$result['result']='notice';
				$result['message']='Appointment successfully saved.';
			}
			
			catch (Exception $exception)
			{
				$result['result']='error';
				$result['message']='Appointment could not be saved.' . $exception;
			}

			return $result;
			
		}

    public function getCurrentAppointments($criteria=null, $sortcolumns=array())
    {
      if(!$criteria)
      {
        $criteria = new Criteria();
      }
			$criteria->add(AppointmentPeer::USER_ID, $this->getUserId());
			$criteria->add(AppointmentPeer::STATE, Workflow::AP_ASSIGNED, Criteria::GREATER_THAN);
			$criteria->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
      if(sizeof($sortcolumns)==0)
      {
        $criteria->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID);
      }
      else
      {
        foreach($sortcolumns as $sortcolumn=>$ascending)
        {
          if($ascending)
          {
            $criteria->addAscendingOrderByColumn($sortcolumn);
          }
          else
          {
            $criteria->addDescendingOrderByColumn($sortcolumn);
          }
        }
      }
			$t = AppointmentPeer::doSelectJoinAllExceptsfGuardUser($criteria);
			return $t;
    }

    public function getCurrentAppointmentsWithTeachingHours()
    {
      $criteria=new Criteria();
			$criteria->add(AppointmentPeer::HOURS, 0, Criteria::GREATER_THAN);
			return self::getCurrentAppointments($criteria);
    }

    public function getCurrentCharges()
    {
      return array();
      $criteria = new Criteria();
			$criteria->add(AppointmentPeer::USER_ID, $this->getUserId());
			$criteria->add(AppointmentPeer::STATE, Workflow::AP_ASSIGNED, Criteria::GREATER_THAN);
			$criteria->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
      if(sizeof($sortcolumns)==0)
      {
        $criteria->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID);
      }
      else
      {
        foreach($sortcolumns as $sortcolumn=>$ascending)
        {
          if($ascending)
          {
            $criteria->addAscendingOrderByColumn($sortcolumn);
          }
          else
          {
            $criteria->addDescendingOrderByColumn($sortcolumn);
          }
        }
      }
			$t = AppointmentPeer::doSelectJoinAllExceptsfGuardUser($criteria);
			return $t;
    }


		
    public function getCurrentSchoolclasses()
    {
			$appointments=$this->getCurrentAppointments();
			
			$schoolclasses=Array();
			
			foreach($appointments as $appointment)
			{
				@$schoolclasses[$appointment->getSchoolclassId()]++;
			}
			
			ksort($schoolclasses);
			return $schoolclasses;
    }
		
		

    public function getWorkplans()
    {
			$c = new Criteria();
			$c->add(AppointmentPeer::USER_ID, $this->getUserId());
			$c->addDescendingOrderByColumn(AppointmentPeer::YEAR_ID);
			$c->addAscendingOrderByColumn(AppointmentPeer::STATE);
			$c->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID);
			$c->addAscendingOrderByColumn(AppointmentPeer::SUBJECT_ID);
			$t = AppointmentPeer::doSelectJoinAll($c);
			return $t;
    }

    public function getTeams($options=array())
    {
      $c = new Criteria();
			$c->add(UserTeamPeer::USER_ID, $this->getUserId());
      $c->addAscendingOrderByColumn(TeamPeer::DESCRIPTION);
			$t = UserTeamPeer::doSelectJoinAllExceptsfGuardUser($c);
      
      if(array_key_exists('astext', $options) and $options['astext'])
      {
        $teams=array();
        foreach($t as $ut)
        {
          if($ut->getTeam()->getIsPublic() or (array_key_exists('privatetoo', $options) and $options['privatetoo']))
          {
            $teams[]=$ut->getTeam()->getPosixName();
          }
        }
        return implode(',', $teams);
      }
      
      
			return $t;
    }

    public function getRolesPlayed($options=array())
    {
      
      $c = new Criteria();
			$c->add(UserTeamPeer::USER_ID, $this->getUserId());
      $c->add(RolePeer::QUALITY_CODE, null, Criteria::ISNOTNULL);
      
      if(array_key_exists('ids', $options))
      {
        $c->add(RolePeer::ID, $options['ids'], Criteria::IN);
      }

			$t = UserTeamPeer::doSelectJoinAllExceptsfGuardUser($c);
      
      if(array_key_exists('astext', $options) and $options['astext'])
      {
        $keyroles=array();
        foreach($t as $ut)
        {
          if($ut->getRole()->getQualityCode())
          {
            $keyroles[$ut->getRole()->getId()]=$ut->getRole()->getQualityCode();
          }
        }
        return sizeof($keyroles)?implode(',', $keyroles):false;
      }
			return $t;
    }

    public function getBelongsToTeam($posixname)
    {
      if(!$posixname)
      {
        return false;
      }
      $c = new Criteria();
			$c->add(UserTeamPeer::USER_ID, $this->getUserId());
			$c->addJoin(UserTeamPeer::TEAM_ID, TeamPeer::ID);
			$c->add(TeamPeer::POSIX_NAME, $posixname);
			$t = UserTeamPeer::doSelectOne($c);
			
			if ($t)
			{
				return true;
			}
			else
			{
				return false;
			}
			;
    }
    
    public function getBelongsToTeamById($team_id)
    {
      $c = new Criteria();
			$c->add(UserTeamPeer::USER_ID, $this->getUserId());
			$c->add(UserTeamPeer::TEAM_ID, $team_id);
			$t = UserTeamPeer::doSelectOne($c);
			
			if ($t)
			{
				return true;
			}
			else
			{
				return false;
			}
			;
    }
    
		
		public function addToTeam($caller_id, Team $team, Role $role, $expiry=null, $notes='', $reference_number='',  $sf_context=null)
		{
			if (!$this->getBelongsToTeam($team->getPosixName()))
			{
        
        $con = Propel::getConnection(UserTeamPeer::DATABASE_NAME);
        $con->beginTransaction();
        
				try
				{
					$userteam=new UserTeam();
					$userteam
					->setUserId($this->getUserId())
					->setTeam($team)
					->setRole($role)
          ->setExpiry($expiry)
          ->setNotes($notes)
          ->setReferenceNumber($reference_number)
					->save($con);
          $team->addWfevent($caller_id,
            'Added user %user% to team, with role «%role%» and expiry %expiry%',
            array('%user%'=>$this->getFullname(), '%role%'=>$this->getIsMale()?$role->getMaleDescription():$role->getFemaleDescription(), '%expiry%'=>$expiry?$expiry:'-'),
            0,
            $sf_context,
            $con
            );
          $con->commit();
				}
				catch(Exception $e)
				{
          $con->rollback();
				}
			}
			else
			{
				$this->addSystemAlert(sprintf('user not added to team «%s»', $team->getPosixName()));
			}
			return $this;
		}


		public function removeFromTeam($caller_id, Team $team, $sf_context=null)
		{
			
			$userteam=UserTeamPeer::retrieveUserTeam($this->getSfGuardUser(), $team);
			if ($userteam)
			{
        $con = Propel::getConnection(UserTeamPeer::DATABASE_NAME);
        $con->beginTransaction();
        try
        {
          $userteam->delete($con);
          $userteam->getTeam()->addWfevent($caller_id,
            'Removed user %user% from team',
            array('%user%'=>$this->getFullname()),
            0,
            $sf_context,
            $con
            );

          $con->commit();
        }
        catch (Exception $e)
        {
          $con->rollback();
        }
			}
			
			return $this;
		}

		public function unenrol(Enrolment $enrolment)
		{
			
			$result=Array();

			try
			{
				if ($enrolment)
				{
					$enrolment->delete();
				}
			}
			catch (Exception $exception)
			{
				$result['result']='error';
				$result['message']='The enrolment could not be deleted';
				return $result;
			}
			
			$result['result']='notice';
			$result['message']='The enrolment was successfully deleted';
			
			return $result;
		}

		public function removeAppointment(Appointment $appointment)
		{
			
			$result=Array();
			
			try {
				if ($appointment)
				{
					$appointment->delete();
				}
				
			}
			
			catch (Exception $exception)
			{
				$result['result']='error';
				$result['message']='The appointment could not be deleted';
				return $result;
			}
			
			$result['result']='notice';
			$result['message']='The appointment was successfully deleted';
			
			return $result;
		}

		public function changeRoleInTeam($caller_id, Team $team, Role $role, $params=array(), $sf_context=null)
		{
      
      $con = Propel::getConnection(UserTeamPeer::DATABASE_NAME);
		  $con->beginTransaction();
      
	    $c = new Criteria();
			$c->add(UserTeamPeer::USER_ID, $this->getUserId());
			$c->add(UserTeamPeer::TEAM_ID, $team->getId());
			$t = UserTeamPeer::doSelectOne($c);
			if ($t)
			{
        $dirty=false;
        if($t->getRoleId()!=$role->getId())
        {
          $t->setRoleId($role->getId());
          $dirty=true;
        }
        if(array_key_exists('expiry', $params))
        {
          if($t->getExpiry()!=$params['expiry'])
          {
            $t->setExpiry($params['expiry']);
            $dirty=true;
          }
        }
        if(array_key_exists('notes', $params))
        {
          if($t->getNotes()!=$params['notes'])
          {
            $t->setNotes($params['notes']);
            $dirty=true;
          }
        }
        if(array_key_exists('reference_number', $params))
        {
          if($t->getReferenceNumber()!=$params['reference_number'])
          {
            $t->setReferenceNumber($params['reference_number']);
            $dirty=true;
          }
        }
        if($dirty)
        {
          try
          {
            $t->save($con);
            $t->getTeam()->addWfevent($caller_id,
              'Edited joining of %user%, set role to «%role%», with notes «%notes%»',
              array('%user%'=>$this->getFullname(), '%role%'=>$this->getIsMale()?$t->getRole()->getMaleDescription():$t->getRole()->getFemaleDescription(), '%notes%'=>$t->getNotes()),
              0,
              $sf_context,
              $con
              );
            $con->commit();
          }
          catch (Exception $e)
          {
            $con->rollback();
          }  
        }
			}
			return $this;
		}



		public function getIsMale()
        {
            return $this->getGender()=='M' ? 1: 0;
        }


		protected function addGoogleappsAccountAlerts()
		{
			if($this->getGoogleappsAccountApprovedAt())
			{
				// The account is approved, we assume that the user should have it
				if($this->getGoogleappsAccountStatus()==0)
				{
					$this->addSystemAlert('googleapps account missing');
				}
			}
			else
			{
				// The account is not approved, so the user should not have it
				if($this->getGoogleappsAccountStatus()>0)
				{
					$this->addSystemAlert('googleapps account active but not approved');
				}
			}
		}

		public function GoogleappsEnable()
		{
			$temporaryPassword=rand(1000000,9999999);
			$this
			->setGoogleappsAccountApprovedAt(time())
			->setGoogleappsAccountTemporaryPassword($temporaryPassword)
			->save();
			return $this;
		}

		public function GoogleappsDisable()
		{
			$this->setGoogleappsAccountApprovedAt(null)
			->setGoogleappsAccountTemporaryPassword(null)
			->save();
		}

        protected function posix_getpwnam($username)
        {
			// We can't use posix_getpwnam() here, because it doesn't support /etc/nsswithc.conf setup
			// So we fallback to the old getent passwd as an external command

			$result=array();
			$return_var=0;
			$cmd = 'getent passwd ' . $username;
			exec($cmd, $result, $return_var);
			
			if ($return_var!=0)
			{
				return false;
			}

			$userinfo=array();

			list($userinfo['name'], $userinfo['passwd'], $userinfo['uid'], $userinfo['gid'], $userinfo['gecos'], $userinfo['dir'], $userinfo['shell'])=explode(':', $result[0]);

			$result=array();
			$cmd = sprintf('id -gn ' .$username);
			exec($cmd, $result, $return_var);

			$userinfo['group']=$result[0];
			return $userinfo;
			
		}

        public function posix_getpwuid($uid)
        {
			// We can't use posix_getpwnam() here, because it doesn't support /etc/nsswitch.conf setup
			// So we fallback to the old getent passwd as an external command

			$result=array();
			$return_var=0;
			$cmd = sprintf('getent passwd | gawk \'BEGIN {FS=":"} {if ($3==%d) print $0}\' ', $uid);
			exec($cmd, $result, $return_var);
			
			if ($return_var!=0)
			{
				return false;
			}

			if (!isset($result[0]))
			{
				return false;
			}
			$userinfo=array();

			@list($userinfo['name'], $userinfo['passwd'], $userinfo['uid'], $userinfo['gid'], $userinfo['gecos'], $userinfo['dir'], $userinfo['shell'])=@explode(':', $result[0]);
			
			
			return $userinfo;
			
		}

/*
		public function getQuotaInfo()
		{
		
			$result=array();
			$return_var=0;
			$cmd='schoolmesh_user_quotaget ' . $this->getUsername();
			exec($cmd, $result, $return_var);
			
			if(isset($result[0]))
				{
					$quotainfo=array();
					list(
						$quotainfo['used_blocks'],
						$quotainfo['soft_blocks_quota'],
						$quotainfo['hard_blocks_quota'],
						$quotainfo['blocks_grace'],
						$quotainfo['used_files'],
						$quotainfo['soft_files_quota'],
						$quotainfo['hard_files_quota'],
						$quotainfo['files_grace']
						) = explode(':', $result[0]);
					
					return $quotainfo;
				}
			else
			{
				return false;
			}

		}

		public function updateQuotaInfo()
		{

			$quotainfo=$this->getQuotaInfo();

			$this->setDiskUsedBlocks($quotainfo['used_blocks']);
			$this->setDiskUsedFiles($quotainfo['used_files']);
			$this->setDiskUpdatedAt(time());
			if($quotainfo['soft_blocks_quota']==0||$quotainfo['soft_files_quota']==0)
			{
				$this->addSystemAlert('disk quota not set');
			}
			elseif($quotainfo['used_blocks']>$quotainfo['soft_blocks_quota']*.8||$quotainfo['used_files']>$quotainfo['soft_files_quota']*.8)
			{
				$this->addSystemAlert('disk quota nearly reached');
			}
			$this->save();
			return $quotainfo;
			
		}

*/
		public function getUsernameIsAlreadyUsed($username, $ignoreself=true)
		
		{

			if ($ignoreself && ($username==$this->getUsername()))
			{
				return false;
			}
				
			if(ReservedUsernamePeer::retrieveByUsername($username))
			{
				return true;
			}
			
			if(sfGuardUserProfilePeer::retrieveByUsername($username))
			
			{
				return true;
			}
			
			return false;
			
		}


		public function getUsernameIsValid($try='')
		{
			
		if ($try!='')
			{
				$username=$try;
				$ignoreself=false;
			}
			else
			{
				$username=$this->getUsername();
				$ignoreself=true;
			}
			
			if ($this->getUsernameIsAlreadyUsed($username, $ignoreself))
			{
				return false;
			}
			
			if (preg_match('/^[a-z][a-z0-9\.]{3,19}$/', $username))
			{
				return true;
			}
			
			return false;
			
		}

		public function checkAccounts($availableAccounts, &$checkList=null)
		{
			if (!$checkList instanceof CheckList)
			{
				$checkList=new CheckList();
			}
			
			$checkGroup=$this->getUsername();
			
			$this->setSystemAlerts('');

			if (sizeof($availableAccounts)==0)
			{
				$checkList->addCheck(
					new Check(Check::WARNING, 'no available accounts', 'schoolmesh')
					);
				return $this;
			}
	
			$role=RolePeer::retrieveByPK($this->getRoleId());
			
			// First thing, we see if the username is less than 20 characters long and matches a Regexp
			// Input form does this checks, but data could be changed in other manners (or badly uploaded)
			
			if (!$this->getUsernameIsValid())
				{
					$checkList->addCheck(new Check(Check::FAILED, 'schoolmesh: username is not valid', $checkGroup));
					$this
					->addSystemAlert('username not valid')
					->save();
					return $this;
				}
			
			if (!$role)
				{
					$checkList->addCheck(new Check(Check::FAILED, 'schoolmesh: role is not set', $checkGroup));
					$this
					->addSystemAlert('role not set')
					->save();
					return $this;
				}

/* FIXME When a user is set to a role, we must add them to the right sfGuardGroup */

			$currentAccounts=$this->getAccounts();
		
			if(!$this->getsfGuardUser()->getIsActive())
			{
				if(sizeof($currentAccounts)>0)
					{
						$this
						->addSystemAlert('user not active with accounts');
						$checkList->addCheck(
							new Check(Check::FAILED, sprintf('schoolmesh: user not active, but with %d account(s)', sizeof($currentAccounts)), $checkGroup)
							);
					}
				return $this;
			}
	
			foreach($availableAccounts as $availableAccount)
			{
				if($this->hasPermission($availableAccount))
				{
					if($this->hasAccountOfType($availableAccount))
					{
						$checkList->addCheck(
							new Check(Check::PASSED, sprintf('schoolmesh: «%s» account exists', $availableAccount), $checkGroup)
						);
						
					}
					else
					{
						$account = AccountPeer::createAccountOfType($availableAccount);
						$this->addAccount($account);
						$checkList->addCheck(
							new Check(Check::WARNING, sprintf('schoolmesh: «%s» account created', $availableAccount), $checkGroup)
						);
						
					}
				}
			}
		
			$currentAccounts=$this->getAccounts();
			
			foreach($currentAccounts as $currentAccount)
			{
				if (!in_array($currentAccount->getAccountType(), $availableAccounts))
				{
					$this
					->addSystemAlert(sprintf('extra account %s', $currentAccount->getAccountType()));
					$checkList->addCheck(
						new Check(Check::WARNING, sprintf('schoolmesh: account «%s» should not be available', $currentAccount->getAccountType()), $checkGroup)
					);
				}
				elseif (!$this->hasPermission($currentAccount->getAccountType()))
				{
					$this
					->addSystemAlert(sprintf('no credential for account %s', $currentAccount->getAccountType()));
					$checkList->addCheck(
						new Check(Check::WARNING, sprintf('schoolmesh: the user does not have the credential for account «%s»', $currentAccount->getAccountType()), $checkGroup)
					);
				}
				else
				{
					$alerts='';
					$currentAccount->getChecks($checkGroup, $checkList, $alerts);
					$this->addSystemAlert($alerts, $alerts!='');
				}
			}
			
			$this->save();
			return $this;
		}


		public function checkPosix()
		{
			$this->setSystemAlerts(null);
			
			$checks=array();
			
			$role=RolePeer::retrieveByPK($this->getRoleId());
			
			// First thing, we see if the username is less than 20 characters long and matches a Regexp
			// Input form does this checks, but data could be changed in other manners (or badly uploaded)
			
			if (!$this->getUsernameIsValid())
				{
					$checks[]=new Check(false, 'username is not valid', $this->getFullName());
					$this
					->addSystemAlert('username not valid')
					->save();
					return $checks;
				}
			
			if (!$role)
				{
					$checks[]=new Check(false, 'role is not set', $this->getFullName());
					$this
					->addSystemAlert('role not set')
					->save();
					return $checks;
				}
			

			// Second, we see if there is a Posix account

			$userinfo = $this->posix_getpwnam($this->getUsername());
						
			if (!$userinfo)
				{
					
					if(!$this->getIsDeleted())
					{
						// maybe the username has been changed
						
						if ($this->getPosixUid() && $userinfo= $this->posix_getpwuid($this->getPosixUid()))
						{
							
							// user exists, but username has been changed
							$checks[]=new Check(false, 'username has been changed', $this->getFullName(),
								array('command'=>sprintf(
									'schoolmesh_user_changeusername %s "%s" %s', 
									$this->getUsername(), 
									sfConfig::get('app_config_posix_homedir'), 
									$userinfo['name'])
									));
						}
						else
						{
							$checks[]=new Check(false, 'user does not exists', $this->getFullName(),
								array('command'=>sprintf(
									'schoolmesh_user_add %s "%s" %s "%s"',
									$this->getUsername(),
									sfConfig::get('app_config_posix_homedir'),
									$role->getPosixName(),
									$this->getFullname()
									))
							);
						}
					}
					
				return $checks;
				}
				
			// From now on, we know that the user exists, since we got $userinfo
				
			$checks[]=new Check(true, 'user exists', $this->getFullName(), array('link_to'=>'users/edit?id='.$this->getsfGuardUser()->getId()));
			
			$this->setSystemAlerts('');
			
			if ($this->getIsScheduledForDeletion())
			{
				if($this->getIsDeletable())
				{
					$this
					->addSystemAlert('deleted but still there')
					->save();
					$checks[]=new Check(false, 'user must be deleted', $this->getFullName(),
						array('command'=>sprintf('schoolmesh_user_del %s', 
						$this->getUsername()
						))
						);
					return $checks;

				}
				else
				{
					$this->addSystemAlert('deleted but undeletable');
				}
			}
			
			// Let's check the UID
			
			if($this->getPosixUid()>0)
			{
				if($userinfo['uid']!=$this->getPosixUid())
				{
					$checks[]=new Check(false, 'UIDs do not match', $this->getFullName());
					$this->addSystemAlert(sprintf('system UID is %d', $userinfo['uid']));
				}
				else
				{
					$checks[]=new Check(true, 'UIDs match', $this->getFullName());
				}
			}
			else
			{
				$checks[]=new Check(true, 'UID saved', $this->getFullName());
				$this->setPosixUid($userinfo['uid']);
				$this->save();
			}
			
			if ($this->getFullName()==$userinfo['gecos'])
			{
				$checks[]=new Check(true, 'full name is ok', $this->getFullName());
			}
			else
			{
					$checks[]=new Check(false, 'full name is not ok', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_changefullname "%s" %s', 
						$this->getFullname(),
						$this->getUsername()
						))
					);
				
			}
			
			if ($role->getPosixName()==$userinfo['group'])
			{
				$checks[]=new Check(true, 'main group is ok', $this->getFullName());
			}
			else
			{
					$checks[]=new Check(false, 'main group is not ok', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_changegroup %s %s', 
						$role->getPosixName(),
						$this->getUsername()
						))
					);
				
			}
			
			if ($this->getGender()!='M' && $this->getGender()!='F')
			{
				$this->addSystemAlert('gender not set');
			}
			
			$this->addGoogleappsAccountAlerts();
			
			
			$dir=sfConfig::get('app_config_posix_homedir') . '/' . $this->getUsername();
			$result=array();
			$return_var=0;
			$cmd = 'sudo stat -c "%F:%u:%g:%a" "'. $dir .'"';

			exec($cmd, $result, $return_var);
			// here we expect a result like "directory:<uid>:0:711"

			if ($return_var!=0)
			{
				$checks[]=new Check(false, 'missing home directory', $this->getFullName(),
				array('command'=>'sudo mkdir "' . $dir . '"'));
				
				return $checks;
				
			}
			
			list($type, $uid, $gid, $access)=explode(':', $result[0]);
			
			if ($type!='directory')
			{
				$checks[]=new Check(false, 'home directory is not a directory', $this->getFullName(),
					array('command'=>'echo "not a directory:"  "' . $dir . '"'));
				
				return $checks;
				
			}

			// Since now on, we assume that the directory exists

			$checks[]=new Check(true, 'home directory is correctly set', $this->getFullName());
				
			if ($access!='711')
			{
				$checks[]=new Check(false, 'home directory has not proper permissions', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeperms 711 "%s"', $dir)));
			}
			else
			{
				$checks[]=new Check(true, 'home directory has proper permissions', $this->getFullName());
			}
				
			if ($uid!=$this->getPosixUid() || $gid!=0)
			{
				$checks[]=new Check(false, 'home directory does not belong to user:root', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeowner %s "%s"', $this->getUsername(), $dir)));
			}
			else
			{
				$checks[]=new Check(true, 'home directory belongs to user', $this->getFullName());
			}

			$quotainfo=$this->updateQuotaInfo();
			
			if ($quotainfo['soft_blocks_quota']!=$this->getDiskSetSoftBlocksQuota()
				or $quotainfo['hard_blocks_quota']!=$this->getDiskSetHardBlocksQuota()
				or $quotainfo['soft_files_quota']!=$this->getDiskSetSoftFilesQuota()				
				or $quotainfo['soft_blocks_quota']!=$this->getDiskSetSoftBlocksQuota())
			{
				$checks[]=new Check(false, "set quotas do not match", $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_quotaset %s %d %d %d %d %s',
						$this->getUsername(),
						$this->getDiskSetSoftBlocksQuota(),
						$this->getDiskSetHardBlocksQuota(),
						$this->getDiskSetSoftFilesQuota(),
						$this->getDiskSetHardFilesQuota(),
						sfConfig::get('app_config_posix_homedir')
						)));
			}
			else
			{
				$checks[]=new Check(true, "set quotas match", $this->getFullName());
			}
				

			$basefolder=sfConfig::get('app_config_posix_homedir') . '/' . $this->getUsername() . '/'. sfConfig::get('app_config_posix_basefolder');
			$cmd = 'sudo stat -c "%F:%u:%g:%a" "'. $basefolder .'"';

			exec($cmd, $result, $return_var);
			// here we expect a result like "directory:<uid>:0:711"

			if ($return_var!=0)
			{
				$checks[]=new Check(false, 'missing basefolder', $this->getFullName(),
				array('command'=>'schoolmesh_dir_create "' . $basefolder . '"'));
				
				return $checks;
				
			}
			
			list($type, $uid, $gid, $access)=explode(':', $result[0]);
			
			if ($type!='directory')
			{
				$checks[]=new Check(false, 'basefolder is not a directory', $this->getFullName(),
					array('command'=>'echo "not a directory:"  "' . $basefolder . '"'));
				
				return $checks;
				
			}

			// Since now on, we assume that the basefolder exists
				
			if ($access!='711')
			{
				$checks[]=new Check(false, 'basefolder has not proper permissions', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeperms 711 "%s"', $basefolder)));
			}
			else
			{
				$checks[]=new Check(true, 'basefolder has proper permissions', $this->getFullName());
			}
				
			if ($uid!=$this->getPosixUid() || $gid!=0)
			{
				$checks[]=new Check(false, 'basefolder does not belong to user:root', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeowner %s "%s"', $this->getUsername(), $basefolder)));
			}
			else
			{
				$checks[]=new Check(true, 'basefolder belongs to user:root', $this->getFullName());
			}
				

			$result=array();
			$cmd = 'sudo lsattr -d "'. $basefolder .'"';

			exec($cmd, $result, $return_var);
			
			if (substr($result[0],4,1)!='i')
			{
				$checks[]=new Check(false, "basefolder has not immutable flag set", $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_extattrset +i "%s"', $basefolder)));
			}
			else
			{
				$checks[]=new Check(true, "basefolder has immutable flag set", $this->getFullName());
			}

			return $checks;
		}
    
    
  public function fixCredentialForAccount($accountType)
  {
    $account=$this->getAccountByType($accountType);
    if($account->getCredentialShouldBeAdded() and !$this->hasPermission($accountType))
    {
      $this->addUserPermission($accountType);
      return true;
    }
    elseif(!$account->getCredentialShouldBeAdded() and $this->hasPermission($accountType))
    {
      $this->revokeUserPermission($accountType);
      return true;
    }
    return false;  // everything was OK, no fix was done
  }

  public function updateFromForm($params, $user=null, $sf_context=null)
  {
    
    if(array_key_exists('gender', $params))
    {
      $params['gender']=$this->getGenderValueFromParameter($params['gender']);
    }
    
    $changedfields = Generic::updateObjectFromForm($this, array(
      'lettertitle',
			'first_name',
			'middle_name',
			'last_name',
      'import_code',
			'pronunciation',
			'gender',
			'email',
			'birthdate',
			'birthplace',
			'role_id',
			'email_state',
      'prefers_richtext',
      'preferred_format',
      'website',
      'office',
      'ptn_notes',
      ), $params);

    $changedfields2 = Generic::updateObjectFromForm($this->getSfGuardUser(), array(
      'username', 
      'is_active'
      ), $params);
      
    $changedfields += $changedfields2;
    
    if($user && $user->getProfile()->getUserId()!=$this->getUserId())
    {
      foreach($changedfields as $field)
      {
        $this->addWfevent($user->getProfile()->getUserId(), 
          'Value for field «%fieldname%» set to «%value%»', 
          array('%fieldname%'=>$field, '%value%'=>$params[$field]),
          null,
          $sf_context);
      }
    }
    
    return $this;
  }

  public function getWorkflowLogs()
	{
		$t = WfeventPeer::retrieveByClassAndId('sfGuardUserProfile', $this->getId(), true);
		if ($t)
			return $t;
		else
			return NULL;
	}

  public function addWfevent($userId, $comment='', $i18n_subs, $state=0, $sf_context=null, $con=null)
  {
    Generic::addWfevent($this, $userId, $comment, $i18n_subs, $state, $sf_context, $con);
    return $this;
  }

  public function updateLuceneIndex()
  {
    
    $index = sfGuardUserProfilePeer::getLuceneIndex();
 
    // remove existing entries
    foreach ($index->find('pk:'.$this->getId()) as $hit)
    {
      $index->delete($hit->id);
    }
  
    $doc = new Zend_Search_Lucene_Document();
   
    $doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getUserId()));
   
    $doc->addField(Zend_Search_Lucene_Field::UnStored('username', $this->getUsername(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('firstname', $this->getFirstName(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('lastname', $this->getLastName(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('roster', $this->getCurrentSchoolclassId(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('grade', $this->getCurrentGrade(), 'utf-8'));
    
    $mainrole=$this->getRoleId()?$this->getRole()->getPosixName():'undefined';
    $doc->addField(Zend_Search_Lucene_Field::UnStored('mainrole', $mainrole, 'utf-8'));
    
    $keyroles=$this->getRolesPlayed(array('astext'=>true));
    
    $doc->addField(Zend_Search_Lucene_Field::UnStored('roles', $keyroles?$keyroles:'none', 'utf-8'));
    
    $doc->addField(Zend_Search_Lucene_Field::UnStored('birthdate', $this->getBirthdate('%Y%m%d'), 'utf-8'));    
    $doc->addField(Zend_Search_Lucene_Field::UnStored('birthday', $this->getBirthdate('%m%d'), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('active', $this->getsfGuardUser()->getIsActive()?'true':'false', 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('gender', $this->getGender(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('validatedemail', $this->getHasValidatedEmail()? $this->getValidatedEmail() : 'none', 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('email', $this->getHasValidatedEmail()? $this->getValidatedEmail() : '@' . $this->getEmail(), 'utf-8'));  // if it's not validated, we add a @ just to be sure it's clear it's not
    $doc->addField(Zend_Search_Lucene_Field::UnStored('emailstatus', $this->getEmailStateDescription(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('importcode', $this->getImportCode(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('accounts', $this->getAccounts(array('astext'=>true)), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('permissions', $this->getWebPermissions(array('astext'=>true)), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('teams', $this->getTeams(array('astext'=>true, 'privatetoo'=>false)), 'utf-8'));
    
    $doc->addField(Zend_Search_Lucene_Field::UnStored('guardgroups', $this->getGuardGroups(array('astext'=>true)), 'utf-8'));
    
    if($posixAccount=$this->getAccountByType('posix'))
    {
      $doc->addField(Zend_Search_Lucene_Field::Text('blocksquota', $posixAccount->getBlocksQuotaPercentage(), 'utf-8'));
      $doc->addField(Zend_Search_Lucene_Field::Text('filesquota', $posixAccount->getFilesQuotaPercentage(), 'utf-8'));
    }
 
    $index->addDocument($doc);
    $index->commit();

  }

}
