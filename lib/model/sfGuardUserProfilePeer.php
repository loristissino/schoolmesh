<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
	
	public static function retrieveByUsername($username)
	{
	$c=new Criteria();
	$c->add(sfGuardUserPeer::USERNAME, $username);
	$t = sfGuardUserPeer::doSelectOne($c);
	return $t;
	}

	public static function retrieveByImportCode($importCode)
	{
	$c=new Criteria();
	$c->add(self::IMPORT_CODE, $importCode);
	$t = self::doSelectOne($c);
	return $t;
	}

	public static function retrieveUsersForGoogleApps()
	{
		$c = new Criteria();
		$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
		$c->add(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD, '', Criteria::GREATER_THAN);
		$c->add(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_APPROVED_AT, 0, Criteria::GREATER_THAN);
		$t = self::doSelectJoinsfGuardUser($c);
		
		return $t;
	}

	public static function retrieveAllUsers($sortby='', $filter='', $filtered_role_id='', $filtered_schoolclass_id='')
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
			$c->add(EnrolmentPeer::YEAR_ID, 2008);
			$c->add(EnrolmentPeer::SCHOOLCLASS_ID, $filtered_schoolclass_id);
		}
	}


	switch($sortby)
	{
		case 'gender': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::GENDER); break;
		case 'username': 	$c->addAscendingOrderByColumn(sfGuardUserPeer::USERNAME); break;
		case 'firstname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME); break;
		case 'lastname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME); break;
		case 'role': 	$c->addAscendingOrderByColumn(RolePeer::DESCRIPTION); break;
		case 'blocks': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_BLOCKS); break;
		case 'files': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_FILES); break;
		case 'alerts': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::SYSTEM_ALERTS); break;

		default: $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
	}
	$t = self::doSelectJoinAll($c);
	return $t;
		
	}


	public static function retrieveTeachersWithAppointments()
	{
	$c = new Criteria();
	$c->addJoin(AppointmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
	$c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
	$t = self::doSelect($c);
	return $t;
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
		$checks=array();
		
		$culture=sfConfig::get('app_config_culture');
						
		if (!is_readable($file))
		{
			$checks[] = new Check(false, 'file not readable', $file);
			return $checks;
		}

		$row = 0;
		$imported=0;
		$skipped=0;
		
		$handle = fopen($file, "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			//$num = count($data);
			//echo "$num fields in line $row:\n";
			
			$row++;
			$checkgroup=sprintf('Line %d: ', $row);

			if ($row==1)
				{
					// We could check whether the field names are correct...
				continue;  // we skip the first line
				}

			if (sizeof($data)!=10)
			{
				$checks[]=new Check(false, 'Invalid data', $checkgroup);
				continue;
			}

			list($type,$first_name,$middle_name,$last_name,$gender,$birthdate,$birthplace,$email,$import_code,$group)=$data;
			
			if ($import_code=='')
			{
				$checks[]=new Check(false, 'Import code not set', $checkgroup);
				continue;
			}
			
			$profile=sfGuardUserProfilePeer::retrieveByImportCode($import_code);
			
			if($profile)
			{
				$profile->updateMiddlename($middle_name)
				->setGender($gender)
				->updateBirthplace($birthplace)
//				->updateBirthdate($birthdate)
				->updateEmail($email)
				->save();
				$checks[]=new Check(true, sprintf('updated info for %s (%s)', 
					$profile->getFullName(), $profile->getSfGuardUser()->getUsername()),
					 $checkgroup
					); 
				
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
		//		->setBirthdate($birthdate)
				->setEmail($email)
				->setImportCode($import_code);
				
				$typeok=false;
				switch($type)
				{
					case('T'):
						// found a teacher
						$role=RolePeer::retrieveByPosixName(sfConfig::get('app_config_teachers_default_posix_group'));
						$profile->setRole($role);
						$typeok=true;
						break;
					
					case('S'):
						// found a student
						$role=RolePeer::retrieveByPosixName(sfConfig::get('app_config_students_default_posix_group'));
						$profile->setRole($role);
						$typeok=true;
						break;
					
					case('O'):
						// found another kind of user
						$typeok=true;
						$profile->addSystemAlert('no role assigned');
						break;
						
					$checks[]=new Check(false, 'invalid type', $checkgroup);
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

					$checks[]=new Check(true, sprintf('created user %s (%s)', $profile->getFullName(), $user->getUsername()), $checkgroup);
				}
				else
				{
					$checks[]=new Check(false, 'type not ok', $checkgroup);
				}
				

				switch($type)
				{
					case('T'):
						// it's a teacher
						$team=TeamPeer::retrieveByPosixName($group);
						$role=RolePeer::retrieveByPosixName(sfConfig::get('app_config_default_teams_role'));
						if($team && $role)
						{
							$profile->addToTeam($team, $role);
							$checks[]=new Check(true, sprintf('added to team %s', $group), $checkgroup);
						}
						else
						{
							$profile->addSystemAlert('missing team');
						}
						
						$guardgroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName('teacher');
						$profile->addToGuardGroup($guardgroup);
						break;
					
					case('S'):
						// found a student
						$schoolclass=SchoolclassPeer::retrieveByPK($group);
						if($schoolclass)
						{
							$enrolment=new Enrolment();
							$enrolment
							->setSchoolclassId($schoolclass->getId())
							->setUserId($user->getId())
							->setYearId(sfConfig::get('app_config_current_year'))
							->save();
							$checks[]=new Check(true, 'set class', $checkgroup);
						}
						else
						{
							$profile->addSystemAlert('missing class');
						}
						break;
					
				}





			}
			
			
			$imported++;
//			$checks[] = new Check(true, sprintf('Class «%s» imported', $id), sprintf('Line %d: ', $row));
		}
		
		fclose($handle);
		return $checks;
		
	}



}
