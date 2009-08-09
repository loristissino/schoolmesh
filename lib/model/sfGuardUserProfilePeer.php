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

			if ($row==1)
				{
					// We could check whether the field names are correct...
				continue;  // we skip the first line
				}

			if (sizeof($data)!=10)
			{
				$checks[]=new Check(false, 'Invalid data', sprintf('Line %d: ', $row));
				continue;
			}

			list($type,$first_name,$middle_name,$last_name,$gender,$birthdate,$birthplace,$email,$import_code,$group)=$data;
			
			if ($import_code=='')
			{
				$checks[]=new Check(false, 'Import code not set', sprintf('Line %d: ', $row));
				continue;
			}
			
			$profile=sfGuardUserProfilePeer::retrieveByImportCode($import_code);
			
			if($profile)
			{
				if ($profile->getFirstname()!=$first_name or $profile->getLastname()!=$last_name)
				{
					$checks[]=new Check(false, sprintf('name does not match («%s %s» != «%s %s»)', 
						$profile->getFirstname(), $profile->getLastname(),
						$first_name, $last_name),
						 sprintf('Line %d: ', $row)
						); 
				}
				else
				{
					$profile->updateMiddlename($middle_name)
					->setGender($gender)
					->setBirthplace($birthplace)
					->setBirthdate($birthdate)
					->updateEmail($email)
					->save();
					$checks[]=new Check(true, sprintf('updated info for %s (%s)', 
						$profile->getFullName(), $profile->getSfGuardUser()->getUsername()),
						 sprintf('Line %d: ', $row)
						); 
				}
				
			}
			
			else
			{
				$profile=new sfGuardUserProfile();
				$profile
				->setFirstName($first_name)
				->setMiddleName($middle_name)
				->setLastName($last_name)
				->setGender($gender)
				->setBirthplace($birthplace)
				->setBirthdate($birthdate)
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
						break;
						
					$checks[]=new Check(false, 'invalid type', sprintf('Line %d: ', $row));
				}

				if($typeok)
				{
					$user = new sfGuardUser();
					$user
					->setUsername($profile->findGoodUsername())
					->save();
					$profile
					->setUserId($user->getId())
					->save();

					$checks[]=new Check(true, sprintf('created user %s (%s)', $profile->getFullName(), $user->getUsername()), sprintf('Line %d: ', $row));
				}
				else
				{
					$checks[]=new Check(false, 'type not ok', sprintf('Line %d: ', $row));
				}
				
				
			}
			
			
			
			
			$imported++;
//			$checks[] = new Check(true, sprintf('Class «%s» imported', $id), sprintf('Line %d: ', $row));
		}
		
		fclose($handle);
		return $checks;
		
	}



}
