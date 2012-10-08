<?php

/**
 * sfGuardUserProfilePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
	
	const EMAIL_UNDEFINED=0;
	const EMAIL_UNVERIFIED=1;
	const EMAIL_VERIFIED=2;
  const EMAIL_FAULTY=3;
	
	public static function retrievePermissionByName($value)
	{
		$c=new Criteria();
		$c->add(sfGuardPermissionPeer::NAME, $value);
		return sfGuardPermissionPeer::doSelectOne($c);
	}
	
	public static function retrieveByUsername($username)
	{
    $c=new Criteria();
    $c->add(sfGuardUserPeer::USERNAME, $username);
    $t = sfGuardUserPeer::doSelectOne($c);
    return $t;
	}


	public static function retrieveProfileByUsername($username)
	{
    $c=new Criteria();
    $c->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID);
    $c->add(sfGuardUserPeer::USERNAME, $username);
    $t = sfGuardUserProfilePeer::doSelectOne($c);
    return $t;
	}


	public static function retrieveByImportCode($importCode)
	{
    if(!$importCode)
    {
      return null; 
    }
    $c=new Criteria();
    $c->add(self::IMPORT_CODE, $importCode);
    $t = self::doSelectOne($c);
    return $t;
	}

	public static function retrieveByNames($first_name, $last_name)
	{
    $c=new Criteria();
    $c->add(self::FIRST_NAME, $first_name);
    $c->add(self::LAST_NAME, $last_name);
    $t = self::doSelect($c);
    if(sizeof($t)==1)
    {
      return $t[0];
    }
    
    if(sizeof($t)==0)
    {
      return null;
    }

    if(sizeof($t)>0)
    {
      return sizeof($t);
    }
	}

	public static function retrieveUsersForGoogleApps()
	{
    /* FIXME this must be re-implemented taking accounts in consideration...
		$c = new Criteria();
		$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
		$c->addJoin(sfGuardUserPeer::ID, AccountPeer::USER_ID);
    $c->addJoin(AccountPeer::ACCOUNT_TYPE_ID, AccountTypePeer::ID);
    $c->add(AccountTypePeer::NAME, 'googleapps');
		$t = self::doSelectJoinAll($c);
		return $t;
		*/
    
    return self::retrieveUsersForMoodle();
    // for now, it's not different...
    
    
	}

	public static function retrieveUsersForMoodle()
	{
		$c = new Criteria();
		$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
    $c->add(sfGuardUserProfilePeer::IS_SCHEDULED_FOR_DELETION, false);
    $c->add(sfGuardUserPeer::IS_ACTIVE, true);
		$t = self::doSelectJoinAll($c);
		return $t;
	}



	public static function retrieveUsersOfGuardGroup($guardgroupName)
	{
		$c=new Criteria();
		$c->addJoin(sfGuardUserGroupPeer::GROUP_ID, sfGuardGroupPeer::ID);
		$c->add(sfGuardGroupPeer::NAME, $guardgroupName);
		$c->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserGroupPeer::USER_ID);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
		$t = sfGuardUserGroupPeer::doSelectJoinAll($c);
		return $t;
	}
	

	public static function retrieveAllUsers($max_per_page, $page, $sortby='', $filter='', $filtered_role_id='', $filtered_schoolclass_id='')
	{
	$c = new Criteria();
	$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
	$c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, Criteria::LEFT_JOIN);
	
	if ($filter=='set')
	{
		if ($filtered_role_id!='')
		{
			$c->add(sfGuardUserProfilePeer::ROLE_ID, $filtered_role_id);
		}
		if ($filtered_schoolclass_id!='')
		{
			$c->addJoin(sfGuardUserProfilePeer::USER_ID, EnrolmentPeer::USER_ID, Criteria::LEFT_JOIN);
			$c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
			$c->add(EnrolmentPeer::SCHOOLCLASS_ID, $filtered_schoolclass_id);
		}
	}


	switch($sortby)
	{
		case 'gender': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::GENDER); break;
		case 'username': 	$c->addAscendingOrderByColumn(sfGuardUserPeer::USERNAME); break;
		case 'importcode': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::IMPORT_CODE); break;
		case 'firstname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME); break;
		case 'lastname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME); break;
		case 'role': 	$c->addAscendingOrderByColumn(RolePeer::MALE_DESCRIPTION); break;
		case 'blocks': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_BLOCKS); break;
		case 'files': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_FILES); break;
		case 'alerts': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::SYSTEM_ALERTS); break;

		default: $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
	}
	
	$pager = new sfPropelPager('sfGuardUserProfile', $max_per_page);
	$pager->setCriteria($c);
	$pager->setPage($page);
	$pager->init();
	
	return $pager;
	}

	public static function retrieveAllButStudents()
	
	{
		$c = new Criteria();
		$c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
		$c->add(RolePeer::POSIX_NAME, sfConfig::get('app_config_students_default_posix_group'), Criteria::NOT_EQUAL);
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
		
		return parent::doSelect($c);
	}

	public static function retrieveStudents()
	
	{
		$c = new Criteria();
		$c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
		$c->add(RolePeer::POSIX_NAME, sfConfig::get('app_config_students_default_posix_group'), Criteria::EQUAL);
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
    $c->add(sfGuardUserPeer::IS_ACTIVE, true);
		
		return parent::doSelect($c);
	}

	public static function retrieveAllSortedByLastName($c=null)
	{
    if(!$c)
    {
      $c = new Criteria();
    }
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
		
		return parent::doSelect($c);
	}


	public static function retrieveTeachers($criteria=null, $year=0)
	{
    $c=$criteria;
    if(!$c)
    {
      $c = new Criteria();
    }

    if ($year==0)
    {
      $c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
      $c->add(RolePeer::POSIX_NAME, sfConfig::get('app_config_teachers_default_posix_group'));
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
      $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
      $c->add(sfGuardUserPeer::IS_ACTIVE, true);
      
      return parent::doSelect($c);
    }
    else
    {
      $c->setDistinct();
      $c->addJoin(AppointmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
      $c->add(AppointmentPeer::YEAR_ID, $year);
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
      $t = self::doSelect($c);
      return $t;

    }

	}

	public static function retrieveAllActiveByRole($role)
	{
      $c = new Criteria();
      $c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
      $c->add(RolePeer::POSIX_NAME, $role);
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
      $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
      $c->add(sfGuardUserPeer::IS_ACTIVE, true);
      
      return parent::doSelect($c);
	}

  public static function retrieveUsersWithStoredEncryptedPasswords()
  {
      $c = new Criteria();
      $c->add(sfGuardUserProfilePeer::ENCRYPTED_PASSWORD, null, Criteria::ISNOTNULL);
      $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
      $c->add(sfGuardUserPeer::IS_ACTIVE, true);
      return parent::doSelect($c);
  }


	public static function resetGoogleAppsAccountInfoForAll()
	{
		$connection = Propel::getConnection();
		$sql = 'UPDATE ' . sfGuardUserProfilePeer::TABLE_NAME . ' SET googleapps_account_status = 0';
		$statement = $connection->prepare($sql);
		$statement->execute();
	}

	public static function importFromCSVFile($file)
	{
//		$checks=array();
		
		$checkList=new CheckList();

		
		$culture=sfConfig::get('app_config_culture');
						
		if (!is_readable($file))
		{
			$checkList->addCheck(new Check(Check::FAILED, 'File not readable', $file));
			return $checks;
		}

		$row = 0;
		$groupName= sprintf('Line %d: ', $row);

		$imported=0;
		$skipped=0;
		
    $teacherRole=RolePeer::retrieveByPosixName(sfConfig::get('app_config_teachers_default_posix_group'));
    $teacherGuardGroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName($teacherRole->getDefaultGuardGroup());
		$studentRole=RolePeer::retrieveByPosixName(sfConfig::get('app_config_students_default_posix_group'));
    $studentGuardGroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName($studentRole->getDefaultGuardGroup());
    
    
		$handle = fopen($file, "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			//$num = count($data);
			//echo "$num fields in line $row:\n";
			
			$row++;
			$groupName= sprintf('Line %d: ', $row);

			if ($row==1)
				{
					// We could check whether the field names are correct...
				continue;  // we skip the first line
				}

			if (sizeof($data)!=11)
			{
				$checkList->addCheck(new Check(Check::FAILED, 'Invalid data', $groupName));
				continue;
			}

			list($type,$first_name,$middle_name,$last_name,$gender,$birthdate,$birthplace,$email,$import_code,$group, $info)=$data;


      $first_name=ltrim(rtrim($first_name));
      $middle_name=ltrim(rtrim($middle_name));
      $last_name=ltrim(rtrim($last_name));
      
//			$checkList->addCheck(new Check(Check::FAILED, 'Type is ' . $type, $groupName));

			if ($import_code=='')
			{
				$checkList->addCheck(new Check(Check::FAILED, 'Import code not set', $groupName));
				continue;
			}
			
			if (!in_array($type, array('S', 'T', 'O')))
			{
				$checkList->addCheck(new Check(Check::FAILED, sprintf('Not a valid type: %s', $type), $groupName));
				continue;
			}
			
			$profile=sfGuardUserProfilePeer::retrieveByImportCode($import_code);
			
			if($profile)
			{
				$checkList->addCheck(new Check(Check::PASSED, sprintf('found user with import code %d', $import_code), $groupName));
				
				$foundLastname=$profile->getLastName();
				$readLastname=Generic::clever_ucwords($culture, $last_name);
				
				if ($foundLastname!=$readLastname)
				{
					$checkList->addCheck(new Check(Check::WARNING, sprintf('last name does not match: have «%s», got «%s»', $foundLastname, $readLastname), $groupName));
				}
				
				$profile->updateMiddlename($middle_name)
				->setGender($gender)
				->setBirthplace($birthplace)
				->setBirthdate(Generic::clever_date($culture, $birthdate))
				->updateEmail($email)
				->save();
				
				$checkList->addCheck(new Check(Check::PASSED, sprintf('updated info for %s (%s)', 
					$profile->getFullName(), $profile->getSfGuardUser()->getUsername()), $groupName));
					
				switch($type)
				{
					case('T'):
						break;
					
					case('S'):
						// found a student
						
						$enrolment=$profile->getCurrentEnrolment();
						
						if ($enrolment)
						{
							if($enrolment->getSchoolclassId()!=$group)
							{
								$result=$profile->modifyEnrolment($enrolment->getId(), $group, sfConfig::get('app_config_current_year'));
								if ($result['result']=='notice')
								{
									$checkList->addCheck(new Check(Check::WARNING, sprintf('class updated for %s (%s)', 
										$profile->getFullName(), $group), $groupName));
								}
								else
								{
									$checkList->addCheck(new Check(Check::FAILED, sprintf('could not set class for %s (%s)', 
										$profile->getFullName(), $group) .  '   type is '. $type, $groupName));
								}
							}
							else
							{
								$checkList->addCheck(new Check(Check::PASSED, sprintf('class maintained for %s (%s)', 
									$profile->getFullName(), $group), $groupName));
							}
						}
						else
						{
							$result=$profile->addEnrolment($group, sfConfig::get('app_config_current_year'));
							if ($result['result']=='notice')
							{
							$checkList->addCheck(new Check(Check::WARNING, sprintf('class set for %s (%s)', 
								$profile->getFullName(), $group), $groupName));
							}
							else
							{
							$checkList->addCheck(new Check(Check::FAILED, sprintf('could not set class for %s (%s)', 
								$profile->getFullName(), $group).  '   type is '. $type, $groupName));
							}
						}
						
						break;
					
				}

			}
			
			else
			{
				$profile=new sfGuardUserProfile();
				
				
				$profile
				->setFirstName(Generic::clever_ucwords($culture, $first_name))
				->setMiddleName(Generic::clever_ucwords($culture, $middle_name))
				->setLastName(Generic::clever_ucwords($culture, $last_name))
				->setGender($gender)
				->setBirthplace(Generic::clever_ucwords($culture, $birthplace))
				->setBirthdate(Generic::clever_date($culture, $birthdate))
				->setEmail($email)
				->setImportCode($import_code);
				
				$typeok=false;
				switch($type)
				{
					case('T'):
						// found a teacher
						$profile->setRole($teacherRole);
            $profile->setLettertitle($profile->getIsMale()? sfConfig::get('app_config_default_male_teachertitle', 'Mr'): sfConfig::get('app_config_default_male_teachertitle', 'Ms'));
						$typeok=true;
						break;
					
					case('S'):
						// found a student
						$profile->setRole($studentRole);
						$typeok=true;
						break;
					
					case('O'):
						// found another kind of user
						$typeok=true;
						$profile->addSystemAlert('no role assigned');
						break;
						
					$checkList->addCheck(new Check(Check::FAILED, 'invalid type', $groupName));
			}

				if($typeok)
				{
					$user = new sfGuardUser();
					$username_found=$profile->findGoodUsername();
					$user
					->setUsername($username_found['username'])
					->save();
					$profile
					->setUserId($user->getId())
					->addSystemAlert('username invented', $username_found['invented'])
					->save();

					$checkList->addCheck(new Check(Check::PASSED, sprintf('created user %s (%s)', $profile->getFullName(), $user->getUsername()), $groupName));
				
        
          // we do this now, because we could not before, since the object was not yet saved
          switch($type)
          {
            case('T'):
              // found a teacher
              $profile->addToGuardGroup($teacherGuardGroup);
              break;
            
            case('S'):
              // found a student
              $profile->addToGuardGroup($studentGuardGroup);
              break;
          }

				}
				
				switch($type)
				{
					case('T'):
						// it's a teacher
						$guardgroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName('teacher');
						$profile->addToGuardGroup($guardgroup);
						break;
					
					case('S'):
						// found a student
						$schoolclass=SchoolclassPeer::retrieveByPK($group);
            // FIXME... This should be cached...
            
						if($schoolclass)
						{
							$enrolment=new Enrolment();
							$enrolment
							->setSchoolclassId($schoolclass->getId())
							->setUserId($user->getId())
							->setYearId(sfConfig::get('app_config_current_year'))
							->save();
							$checkList->addCheck(new Check(Check::PASSED, sprintf('enrolled to class %s', $group), $groupName));
						}
						else
						{
							$profile->addSystemAlert('missing class');
						}
						
						$guardgroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName('student');
						$profile->addToGuardGroup($guardgroup);
						break;
					
				}
			}
			
			
			$imported++;
//			$checks[] = new Check(true, sprintf('Class «%s» imported', $id), sprintf('Line %d: ', $row));
		}
		
		fclose($handle);
		return $checkList;
		
	}
	
	
	public static function retrieveOnLine()
	{
    /*
    Generic::logMessage('logdir', session_save_path());
    $dir=scandir(session_save_path());
    */
		$c=new Criteria();
		$timelimit=time() - 3*60;
		$c->add(sfGuardUserProfilePeer::LAST_ACTION_AT, $timelimit, Criteria::GREATER_THAN);
		return parent::doSelect($c);
	}
  
  
  
	/*
	public static function getListdocument($ids, $filetype='odt', $templatename, $context=null)
  {
		$result=Array();
		try
		{
			$odf=new OdfDoc($templatename, 'Users list', $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
/*		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($users as $user)
		{
			$count++;
			
			if($context)
			{
				if ($user->getIsMale())
				{
					$salutation=$context->getI18n()->__('Dear %malename%', array('%malename%'=>$user->getFirstName()));
				}
				else
				{
					$salutation=$context->getI18n()->__('Dear %femalename%', array('%femalename%'=>$user->getFirstName()));
				}
			}
			else
			{
				$salutation='Dear '. $user->getFirstName();
			}
			
			$letters->userSalutation($salutation);
			$letters->userUsername($user->getUsername());
			$letters->userFullName($user->getFullName());
			$letters->userSchoolclass($user->getCurrentSchoolclassId());
			$letters->userBirthdate($user->getBirthdate('d/m/Y'));
			$letters->userImportCode($user->getImportCode());
			
			
			$sambaAccount=$user->getAccountByType('samba');
			if (is_object($sambaAccount))
			{
				$letters->userSambaPassword($sambaAccount->getTemporaryPassword());
			}
			else
			{
				$letters->userSambaPassword('ERROR');
			}
			
			
			$letters->letterDate(date('d/m/Y'));
			$pagebreak=($count<sizeof($users))?'<pagebreak>':'';
			$letters->pagebreak($pagebreak);
			$letters->merge();
		}
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;
    
  }
*/  
	public static function getWelcomeLetter($ids, $filetype='odt', $context=null)
	{
		$result=Array();

		$usertypes=Array();
		
		$users=self::retrieveByPks($ids);
		foreach($users as $user)
		{
			@$usertypes[$user->getRoleId()]++;
		}
        
		
		if (sizeof($usertypes)!=1)
		{
			$result['result']='error';
			$result['message']='It is not possible to get welcome letters for users with different roles.'. serialize($usertypes);
			return $result;
		}
		
		
		try
		{
			$templatename='welcomeletter_' . $users[0]->getRole()->getPosixName() .'.odt';
			$odf=new OdfDoc($templatename, 'Welcome letter', $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($users as $user)
		{
			$count++;
			
			if($context)
			{
				if ($user->getIsMale())
				{
					$salutation=$context->getI18n()->__('Dear %malename%', array('%malename%'=>$user->getFirstName()));
				}
				else
				{
					$salutation=$context->getI18n()->__('Dear %femalename%', array('%femalename%'=>$user->getFirstName()));
				}
			}
			else
			{
				$salutation='Dear '. $user->getFirstName();
			}
			
			$letters->userSalutation($salutation);
			$letters->userUsername($user->getUsername());
			$letters->userFullName($user->getFullName());
			$letters->userSchoolclass($user->getCurrentSchoolclassId());
			$letters->userBirthdate($user->getBirthdate('d/m/Y'));
			$letters->userImportCode($user->getImportCode());
			
			/* we won't use Samba password here anymore
			$sambaAccount=$user->getAccountByType('samba');
			if (is_object($sambaAccount))
			{
				$letters->userSambaPassword($sambaAccount->getTemporaryPassword());
			}
			else
			{
				$letters->userSambaPassword('ERROR');
			}
      */
      
      $letters->userPassword($user->getPlaintextPassword());
			
			$letters->letterDate(date('d/m/Y'));
			$pagebreak=($count<sizeof($users))?'<pagebreak>':'';
			$letters->pagebreak($pagebreak);
			$letters->merge();
		}
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}


	public static function getTeachingAppointmentsLetter($ids, $filetype='odt', $context=null)
	{
		$result=Array();

		$users=self::retrieveByPksSortedByLastnames($ids);
		
		try
		{
			$templatename='teachingappointmentsletter.odt';
			$odf=new OdfDoc($templatename, 'Teaching appointments letter', $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
    $currentYear=YearPeer::retrieveByPK(sfConfig::get('app_config_current_year'));
    
		$odfdoc=$odf->getOdfDocument();
		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($users as $user)
		{
			$count++;
      
      $hoursTotal=0;

      $appointments=$user->getCurrentAppointmentsWithTeachingHours();
      if(sizeof($appointments)==0)
      {
        continue;
      }
      foreach($appointments as $appointment)
      {
        $letters->appointments->appointmentClass($appointment->getSchoolclass()->getDescription());
        $letters->appointments->appointmentSubject($appointment->getSubject()->getDescription());
        $letters->appointments->appointmentType($appointment->getAppointmentType()->getDescription());
        $hours=$appointment->getWeeklyHours();
        $hoursTotal+=$hours;
        $letters->appointments->appointmentHours($hours);
        $letters->appointments->merge();
      }
			
			$letters->userTitle($user->getLetterTitle());
			$letters->userFullName($user->getFullName());
			$letters->year($currentYear->__toString());
			$letters->letterDate(date('d/m/Y'));
			$letters->hoursTotal($hoursTotal);
      $letters->schoolPrincipal(sfConfig::get('app_school_principal', 'missing Principal name in config file'));
      
			$pagebreak=($count<sizeof($users))?'<pagebreak>':'';
			$letters->pagebreak($pagebreak);
			$letters->merge();
		}
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}

	private static function _getResponsibilityRolesGenericLetter($type, $ids, $role_ids, $filetype='odt', $context=null)
	{
    
    if(!in_array($type, array('charge', 'confirmation')))
    {
      throw new Exception('Not a valid type');
    }
    
    switch($type)
    {
      case 'charge':
        $filename='Responsibility role charge letters';
        break;
      case 'confirmation':
        $filename='Responsibility role confirmation letters';
    }
    if($context)
    {
      $filename=$context->getI18N()->__($filename);
    }
    
		$result=Array();

		$users=self::retrieveByPksSortedByLastnames($ids);
		
		try
		{
			$templatename=sprintf('responsibilityroles%sletter.odt', $type);
      
			$odf=new OdfDoc($templatename, $filename, $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
    $currentYear=YearPeer::retrieveByPK(sfConfig::get('app_config_current_year'));
    
		$odfdoc=$odf->getOdfDocument();
		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($users as $user)
		{
			$count++;
      
      $charges=$user->getRolesPlayed(array('ids'=>$role_ids));  // we get an array of UserTeam objects
      if(sizeof($charges)==0)
      {
        continue;
      }

      $reference_numbers=array();
      $havingregardto_notes=array();
      $final_notes=array();

      foreach($charges as $charge)
      {
        $letters->charges->chargeDescription($user->getIsMale()?$charge->getRole()->getMaleDescription():$charge->getRole()->getFemaleDescription());
        $letters->charges->chargeContext($charge->getTeam()->getDescription());
        $letters->charges->chargeExpiry($charge->getExpiry('d/m/Y'));
        //$letters->charges->chargeNotes($charge->getNotes());
        
        switch($type)
        {
          case 'charge':
            $rn=$charge->getChargeReferenceNumber();
            $hrtnotes=explode("\n", $charge->getRole()->getChargeHavingregardto());
            $fnotes=$charge->getRole()->getChargeNotes();
            break;
          case 'confirmation':
            $rn=$charge->getConfirmationReferenceNumber();
            $hrtnotes=explode("\n", $charge->getRole()->getConfirmationHavingregardto());
            $fnotes=$charge->getRole()->getConfirmationNotes();
            break;
        }
        
        foreach($hrtnotes as $hrtnote)
        {
          if($hrtnote && !in_array(chop($hrtnote), $havingregardto_notes))
          {
            $havingregardto_notes[]=chop($hrtnote);
          }
        }
        
        if($fnotes && !in_array($fnotes, $final_notes))
        {
          $final_notes[]=$fnotes;
        }
        
        if($rn && !in_array($rn, $reference_numbers))
        {
          $reference_numbers[]=$rn;
        }
        $letters->charges->merge();
      }
			
			$letters->userTitle($user->getLetterTitle());
			$letters->userFullName($user->getFullName());
			$letters->year($currentYear->__toString());
			$letters->letterDate(date('d/m/Y'));
      $letters->schoolPrincipal(sfConfig::get('app_school_principal', 'missing Principal name in config file'));
      
      natsort($reference_numbers);
      $letters->referenceNumber(sizeof($reference_numbers)?implode(', ', $reference_numbers):'____');

      $letters->havingregardtoNotes(OdfDocPeer::textvalue2odt(
        sizeof($havingregardto_notes)?implode('<br />', $havingregardto_notes):sfConfig::get('app_charges_default_note', 'Having regard to...')
      ));

      $letters->finalNotes(OdfDocPeer::textvalue2odt(
        sizeof($final_notes)?implode('<br /><br />', $final_notes):sfConfig::get('app_charges_default_note', '')
      ));
      
			$pagebreak=($count<sizeof($users))?'<pagebreak>':'';
			$letters->pagebreak($pagebreak);
			$letters->merge();
		}
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}



	public static function getResponsibilityRolesChargeLetter($ids, $role_ids, $filetype='odt', $context=null)
	{
    return self::_getResponsibilityRolesGenericLetter('charge', $ids, $role_ids, $filetype, $context);
	}


	public static function getResponsibilityRolesConfirmationLetter($ids, $role_ids, $filetype='odt', $context=null)
	{
    return self::_getResponsibilityRolesGenericLetter('confirmation', $ids, $role_ids, $filetype, $context);
  }
	
	public static function getGoogleAppsLetter($ids, $filetype='odt', $context=null)
	{
		$result=Array();

		$usertypes=Array();
		
		$users=self::retrieveByPks($ids);
		foreach($users as $user)
		{
			@$usertypes[$user->getRoleId()]++;
		}
		
		if (sizeof($usertypes)!=1)
		{
			$result['result']='error';
			$result['message']='It is not possible to get welcome letters for users with different roles.';
			return $result;
		}
		
		
		try
		{
			$templatename='googleappsletter_' . $users[0]->getRole()->getPosixName() .'.odt';
			$odf=new OdfDoc($templatename, 'Google Apps letter', $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($users as $user)
		{
			$count++;
			
			if($context)
			{
				if ($user->getIsMale())
				{
					$salutation=$context->getI18n()->__('Dear %malename%', array('%malename%'=>$user->getFirstName()));
				}
				else
				{
					$salutation=$context->getI18n()->__('Dear %femalename%', array('%femalename%'=>$user->getFirstName()));
				}
			}
			else
			{
				$salutation='Dear '. $user->getFirstName();
			}

      $useragestatus = $user->getAgeStatus();
      if($useragestatus=='major')
      {
        $useragestatus='';
      }
      if($context)
      {
        $useragestatus=$context->getI18n()->__($useragestatus);
      }
      if($useragestatus)
      {
        $useragestatus='('. $useragestatus . ')';
      }
      
      // we want the notice for minor aged only...

			$letters->userSalutation($salutation);
			$letters->userAgeStatus($useragestatus);
			$letters->userUsername($user->getUsername());
			$letters->userFullName($user->getFullName());
			$letters->userBirthdate($user->getBirthdate('d/m/Y'));
      
			
			
      $letters->userGoogleAppsPassword($user->getTempGooglePassword());
			
			$letters->letterDate(date('d/m/Y'));
			$pagebreak=($count<sizeof($users))?'<pagebreak>':'';
			$letters->pagebreak($pagebreak);
			$letters->merge();
		}
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}
  

	public static function getSigns($ids, $filetype='odt', $context=null)
	{
		$result=Array();

		$usertypes=Array();
		
		$users=self::retrieveByPksSortedByLastnames($ids);
		
		try
		{
			$templatename='teachers_signs.odt';
			$odf=new OdfDoc($templatename, 'Teachers signs', $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		$signs=$odfdoc->setSegment('signs');
		$count=0;
		foreach($users as $user)
		{
			$count++;

      $appointments=$user->getCurrentAppointments(null, array(AppointmentPeer::SUBJECT_ID=>true));

			$signs->userTitle($user->getLettertitle());
			$signs->userFirstName($user->getFirstName());
			$signs->userLastName($user->getLastName());
      $signs->userOffice($user->getOffice());
      $signs->userPtnNotes($user->getPtnNotes());
			
      $oldsubject='';
      
      if($appointments)
      {
        foreach($appointments as $appointment)
        {
          $signs->appointments->schoolclass($appointment->getSchoolclassId());
          $signs->appointments->subject($oldsubject==$appointment->getSubject()? '': $appointment->getSubject());
          $oldsubject=$appointment->getSubject();
          $signs->appointments->merge();
        }
      }
      else
      {
        $signs->appointments->schoolclass('');
        $signs->appointments->subject('');
        $signs->appointments->merge();
      }
      
			$pagebreak=($count<sizeof($users))?'<pagebreak>':'';
			$signs->pagebreak($pagebreak);
			$signs->merge();
		}
		
		$odfdoc->mergeSegment($signs);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}


	public static function getUserlistDocument($template, $ids, $filetype='odt', $context=null)
	{
    
		$result=Array();

		$users=self::retrieveByPksSortedByLastnames($ids);

		try
		{
			$templatename=$template;
			$odf=new OdfDoc($templatename, 'Userlist Document', $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		$profiles=$odfdoc->setSegment('profiles');
		$count=0;
		foreach($users as $user)
		{
			$count++;
			
      $useragestatus = $user->getAgeStatus();
      if($useragestatus=='major')
      {
        $useragestatus='';
      }
      if($context)
      {
        $useragestatus=$context->getI18n()->__($useragestatus);
      }
      if($useragestatus)
      {
        $useragestatus='('. $useragestatus . ')';
      }
      
      // we want the notice for minor aged only...

			$profiles->userUsername($user->getUsername());
//      $profiles->userAgeStatus($useragestatus);

			$profiles->userPosition($count);
      $profiles->userEmail($user->getEmail());
      $profiles->userEmailStateDescription($user->getEmailStateDescription());
			$profiles->userFullName($user->getFullName());
			$profiles->userFirstname($user->getFirstName());
			$profiles->userLastname($user->getLastName());
			$profiles->userImportCode($user->getImportCode());
			$profiles->userBirthplace($user->getBirthplace());
			$profiles->userBirthdate($user->getBirthdate('d/m/Y'));
      
			$profiles->merge();
		}
		
		$odfdoc->mergeSegment($profiles);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}
  
  

	public static function registerLogin(sfEvent $event)
	{

// There are two problems for registering logouts:
// first, the event does not say who actually logged out;
// second, users get logged out by timeout and this wouldn't be tracked
// I read on the mailing list that the preferred method is to update a db entry for every action
// and assume that users are on line when they performed an action in the last XX seconds.

// Anyway, this solution works only if logging is enabled -- which is not always true.
/*
		$parameters=$event->getParameters();
		if ($parameters[0]=='User is authenticated')
		{
			
			$ah=$event->getSubject()->getAttributeHolder();
			
			$user_id=$ah->get('user_id', null, 'sfGuardSecurityUser');
			
			$profile=sfGuardUserProfilePeer::retrieveByPK($user_id);
			$profile
			->setLastLoginAt(time())
			->save();
			
		}
*/				
	}


/*
	public static function createMissingAccounts($availableAccounts)
	{
	
	$checkList=new CheckList();
	
	if (sizeof($availableAccounts)==0)
	{
		$checkList->addCheck(
			new Check(Check::WARNING, 'no available accounts', 'config')
			);
		return $checkList;
	}
	
	$profiles=self::retrieveAllUsers();
	
	foreach($profiles as $profile)
	{
		$user=$profile->getsfGuardUser();
		$currentAccounts=$profile->getAccounts();
		$profile->setSystemAlerts('');
		
//		echo 'working on '. $user->getUsername() . sprintf(" (%s accounts) -- %s\n", sizeof($currentAccounts), $user->getIsActive()?'true':'false');
		if(!$user->getIsActive())
		{
			if(sizeof($currentAccounts)>0)
				{
					$profile
					->addSystemAlert('user not active with accounts')
					->save();
					$checkList->addCheck(
						new Check(Check::WARNING, sprintf('not active, but with %d account(s)', sizeof($currentAccounts)), $profile->getUsername())
						);
				}
			continue;
		}
	
	
		foreach($availableAccounts as $availableAccount)
		{
			if($profile->hasPermission($availableAccount))
			{
				if($profile->hasAccountOfType($availableAccount))
				{
					$checkList->addCheck(
						new Check(Check::PASSED, sprintf('account %s exists', $availableAccount), $profile->getUsername())
					);
					
				}
				else
				{
					$account = AccountPeer::createAccountOfType($availableAccount);
					$profile->addAccount($account);
					$checkList->addCheck(
						new Check(Check::WARNING, sprintf('account %s created', $availableAccount), $profile->getUsername())
					);
					
				}
			}
			
		}
		
		$currentAccounts=$profile->getAccounts();
		
		foreach($currentAccounts as $currentAccount)
		{
			if (!in_array($currentAccount->getAccountType(), $availableAccounts))
			{
				$profile
				->addSystemAlert(sprintf('extra account %s', $currentAccount->getAccountType()))
				->save();
				$checkList->addCheck(
					new Check(Check::WARNING, sprintf('account %s should not be available', $currentAccount->getAccountType()), $profile->getUsername())
				);
			}
			
		}
		
		
	}
	
			return $checkList;
		
		
	}

*/

  public static function compareUsersByLastFirst($a, $b)
  {
    $a=$a->getProfile();
    $b=$b->getProfile();
    if ($a->getLastName()==$b->getLastName())
    {
      if ($a->getFirstName()==$b->getFirstName())
      {
        return 0;
      }
      return $a->getFirstName()<$b->getFirstName() ? -1: 1;
    }
    return $a->getLastName()<$b->getLastName() ? -1: 1;
  }
  
  public static function retrieveByPksSortedByLastnames($ids)
  {
    
    $c=new Criteria();
    $c->add(sfGuardUserPeer::ID, $ids, Criteria::IN);
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
    return self::doSelect($c);
    
    $users=sfGuardUserPeer::retrieveByPks($ids);
    @usort($users, 'self::compareUsersByLastFirst');
    // if I don't put the silence operator here above, I getallheaders
    // Warning: usort(): Array was modified by the user comparison function
    return $users;
  }

  public static function getLuceneIndex()
  {
    return Generic::getLuceneIndex('users');
  }

  static public function getForLuceneQuery($query, $max_results, $page, $sortby='lastname')
  {
    try
    {
      // Lucene outputs a notice if the query is malformed... 
      $hits = @self::getLuceneIndex()->find($query);
    }
    catch (Exception $e)
    {
      return new sfPropelPager('sfGuardUserProfile');
    }

    $pks = array();
    foreach ($hits as $hit)
    {
      $pks[] = $hit->pk;
    }
   
    $c = new Criteria();
    $c->add(self::USER_ID, $pks, Criteria::IN);
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
    $c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, Criteria::LEFT_JOIN);

    switch($sortby)
    {
      case 'gender': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::GENDER); break;
      case 'username': 	$c->addAscendingOrderByColumn(sfGuardUserPeer::USERNAME); break;
      case 'importcode': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::IMPORT_CODE); break;
      case 'firstname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME); break;
      case 'lastname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME); break;
      case 'role': 	$c->addAscendingOrderByColumn(RolePeer::MALE_DESCRIPTION); break;
      case 'blocks': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_BLOCKS); break;
      case 'files': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_FILES); break;
      case 'alerts': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::SYSTEM_ALERTS); break;

      default: $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    }



    $pager = new sfPropelPager(
      'sfGuardUserProfile',
      $max_results
    );
    
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();
    
    return $pager;
  }


  public static function fixCredentialsForAccounts($profiles, $accountType)
  {
    $todo=sizeof($profiles);
    $done=0;
    foreach($profiles as $profile)
    {
      if ($profile->fixCredentialForAccount($accountType))
      {
        $done++;
      }
    }
    $result['result']='notice';
    $result['message']='Credentials fixed (number of actions needed: %number%).';
    $result['i18nsubs']=array('%number%'=>$done);
    return $result;
  }


  public static function retrieveByPermission($value)
  {
    // FIXME; this could be done by querying the tables, but we should
    // look for inherited permissions too...
    $users=array();
    foreach(self::retrieveAllSortedByLastName() as $user)
    {
      if ($user->hasPermission($value))
      {
        $users[]=$user;
      }
    }
    return $users;
  }
  
  public static function retrieveUsersAllowedToProject()
  {
    
    //FIXME We should select some of these users...
    return self::retrieveAllButStudents();
  }
  
  public static function getFullNameWithHTMLClasses($firstname, $lastname)
  {
    return sprintf('<span class="firstname">%s</span> <span class="lastname">%s</span>', $firstname, $lastname);
  }

}
