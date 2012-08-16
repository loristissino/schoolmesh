<?php

/**
 * AppointmentPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class AppointmentPeer extends BaseAppointmentPeer
{
	
  public static function retrieveByStateYear($state, $year=null)
  {
    if (!$year)
    {
      $year=YearPeer::retrieveByPK(sfConfig::get('app_config_current_year'));
    }
    $c=new Criteria();
    $c->add(AppointmentPeer::STATE, $state);
    $c->add(AppointmentPeer::YEAR_ID, $year->getId());
    return AppointmentPeer::doSelect($c);
  }


  public static function retrieveByYear(Year $year)
  {
    $c=new Criteria();
    $c->add(AppointmentPeer::YEAR_ID, $year->getId());
    return AppointmentPeer::doSelect($c);
  }
  
  public static function retrieveByImportCodeSchoolclassIdSubjectShortcut($user_import_code, $schoolclass_id, $subject_shortcut)
  {
    $c=new Criteria();
    $c->addJoin(AppointmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->add(sfGuardUserProfilePeer::IMPORT_CODE, $user_import_code);
    $c->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID);
    $c->add(SubjectPeer::SHORTCUT, $subject_shortcut);
    $c->add(AppointmentPeer::SCHOOLCLASS_ID, $schoolclass_id);
    $c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));

    return self::doSelectOne($c);
  } 
  

	public static function getSubmitted($state)
	{
    $c=new Criteria();
    $c->add(AppointmentPeer::STATE, $state);
    return parent::doSelect($c);
	}
	
	
	public static function doImport($content, $replace, $user_id)
	{
	
	$workplan=self::retrieveByTeacherSchoolclassSubjectYear(
		$content['workplan_report']['teacher']['firstname'],
		$content['workplan_report']['teacher']['lastname'],
		$content['workplan_report']['class']['id'],
		$content['workplan_report']['subject']['description'],
		$content['workplan_report']['year']
		);
	
	if ($workplan)
		{
			echo "Workplan: " . $workplan->getId() . "\n";
			if ($replace!='true')
				{
					echo "... not replacing (set option replace=true to change this behaviour)\n";
					return;
				}
			else
			{
				$workplan->removeEverything();
				$workplan->setState(70);
				$workplan->save();
				$workplan->addEvent($user_id, 'Imported', 70);
				echo "starting the import\n";
			}
		}
	else
		{
		
		// Here I should look for teacher, schoolclass, year, subject, and eventually create the appointment
		// Perhaps it doesn't make sense, it's better to create the appointments separately.
//		$workplan = new Appointment();
		
		echo "I don't create new appointments here\n";
		return;
		}
	
	
//	print_r($content);
	
	$import['oks']=0;
	$import['fails']=0;
	$import['errors']='';
	
	foreach($content['workplan_report']['info'] as $key=>$value)
		{
//			echo "$key  => $value\n";
			$wpinfoType=WpinfoTypePeer::getByTitle($key);
//			echo "Got: ". $wpinfoType->getId() . "\n";
			if ($wpinfoType)
				{
				$wpinfo=new Wpinfo();	
				$wpinfo->setAppointmentId($workplan->getId());
				$wpinfo->setWpinfoTypeId($wpinfoType->getId());
				$wpinfo->setContent($value);
				$wpinfo->save();
				$import['oks']++;
				
				}
			else
			{
				$import['fails']++;
				$import['errors'].='Error importing infos: '. $key. "\n";
	
			}
		}
	
	// we need to check if some info is missing...
	$allWpinfoTypes=WpinfoTypePeer::getAll();
    foreach($allWpinfoTypes as $wpinfoType)
		{
//		echo "Cerco " .$wpinfoType->getTitle() . "\n";
		$wpinfo=$workplan->getWpinfo($wpinfoType->getId());
		if (!$wpinfo)
			{
				$wpinfo=new Wpinfo();	
				$wpinfo->setAppointmentId($workplan->getId());
				$wpinfo->setWpinfoTypeId($wpinfoType->getId());
				$wpinfo->setContent($wpinfoType->getTemplate());
				$wpinfo->save();
			}
		}
	


if (isset($content['workplan_report']['tools']))
{
	foreach($content['workplan_report']['tools'] as $key=>$value)
		{
			$wptoolItemType=WptoolItemTypePeer::getByDescription($key);
			if ($wptoolItemType)
				{
//				echo " Got: ". $wptoolItemType->getId() . "\n";
				foreach($value as $item)
					{
					$wptoolItem=WptoolItemPeer::getByDescription($item);
					if ($wptoolItem)
						{
//						echo "  Got: ". $wptoolItem->getId() . ' ' .$wptoolItem->getDescription() . "\n";
						$wptoolAppointment= new WptoolAppointment();
						$wptoolAppointment->setAppointmentId($workplan->getId());
						$wptoolAppointment->setWptoolItemId($wptoolItem->getId());
						$wptoolAppointment->save();
						$import['oks']++;
						unset($wptoolItem);
						}
					else
						{
							$import['fails']++;
							$import['errors'].='Error importing tools: '. $item. "\n";
						}
					}
					
					
				}
			else
				{
				$import['fails']++;
				$import['errors'].='Error importing toolgroups: '. $key. "\n";
					
				}

		}
}
	
	$wpmodules=$workplan->getWpmodules();
/*	foreach($wpmodules as $wpmodule)
		echo ".... Wpmodule: " .$wpmodule->getId(). "\n";
	*/
	foreach($content['workplan_report']['modules'] as $key=>$value)
		{
		$wpmodule = new Wpmodule();
		$wpmodule->setPeriod(isset($value['period'])? $value['period']: '---');
		$wpmodule->setAppointmentId($workplan->getId());
		$wpmodule->setUserId($workplan->getUserId());
		$wpmodule->setTitle($key);
		$wpmodule->save();
		
		
		foreach($value['details'] as $ig)
			{
//			print_r($ig);
			foreach ($ig as $dkey=>$dvalue)
				{
					
//				echo "I should build an object for " . $dkey . "\n";
//				print_r($dvalue);
				$myItemType=WpitemTypePeer::retrieveByTitle($dkey);
				
				if ($myItemType)
					{
//					echo "        ----> Got: ". $myItemType->getId() . "  " . $myItemType->getTitle(). "\n";	
						
					$wpitemGroup = new WpitemGroup();
					$wpitemGroup->setWpitemTypeId($myItemType->getId());
					$wpitemGroup->setWpmoduleId($wpmodule->getId());
//					echo "Inserting something here...";
					$wpitemGroup->save();

					if (@sizeof($dvalue)>0)
						{
						foreach($dvalue as $sdkey=>$sdvalue)
							{
	//							echo "$dkey .. $sdkey - " . $sdvalue['content'] . "\n";
								$wpmoduleItem = new WpmoduleItem();
								$wpmoduleItem->setWpitemGroupId($wpitemGroup->getId());
								$wpmoduleItem->setContent($sdvalue['content']);
								$wpmoduleItem->setEvaluation($sdvalue['evaluation']);
								$wpmoduleItem->setIsEditable(true);
								$wpmoduleItem->save();
								$import['oks']++;

							}
					}

					}
				else
					{
						$import['fails']++;
						$import['errors'].='Error importing workplan module items: '. $dkey. "\n";
						
						
					}
				
				
				}
				
				
			}
		
				   $itemtypes=WpitemTypePeer::getAllByRank();
				  // we look for itemgroups not set in the yaml file...   
				   foreach($itemtypes as $itemtype)
						{
						$localWpitemGroup=WpitemGroupPeer::retrieveByModuleAndType($wpmodule->getId(), $itemtype->getid());
						
						if (is_object($localWpitemGroup))
							{
//							echo "Retrieved: ". $localWpitemGroup->getWpitemTypeId() . '   ' .$localWpitemGroup->getWpmoduleId() . "\n";
	
							}

							else
							{
									//echo " I need to insert ". $itemtype->getId() . '  ' . $wpmodule->getId() . "\n";
									$localWpitemGroup = new WpitemGroup();
									$localWpitemGroup->setWpitemType($itemtype);
									$localWpitemGroup->setWpmoduleId($wpmodule->getId());
									$localWpitemGroup->save();
									//echo " Saved: ". $localWpitemGroup->getId() . "\n";
							}
							
						}


		
		
		unset($wpmodule);
		}





	
	return $import;
	
	}


	public static function countAppointmentsOfUser($userId)
	{
		
	$c=new Criteria();
	$c->add(AppointmentPeer::USER_ID, $userId);
	$app =  self::doCount($c);
	return $app;
	}

	public static function retrieveByTeacherSchoolclassSubjectYear($teacherFirstName, $teacherLastName, $schoolclass, $subject, $year)
	{
	
//	echo "Looking for: $teacherFirstName, $teacherLastName, $schoolclass, $subject, $year \n";
	// here there is a bug: FirstName and lastName are not really taken in consideration 
	$c=new Criteria();
	$c->add(sfGuardUserProfilePeer::FIRST_NAME, $teacherFirstName);
	$c->add(sfGuardUserProfilePeer::LAST_NAME, $teacherLastName);
	$c->add(AppointmentPeer::SCHOOLCLASS_ID, $schoolclass);
	$c->add(AppointmentPeer::YEAR_ID, $year);
	$c->add(SubjectPeer::DESCRIPTION, $subject);

	$app =  parent::doSelectJoinAll($c);
	return $app[0];

	}

	public static function retrieveByUsernameSchoolclassSubjectYear($username, $schoolclass, $subject_shortcut, $year)
	{
	
	$c=new Criteria();
	$c->add(sfGuardUserPeer::USERNAME, $username);
	$c->add(AppointmentPeer::SCHOOLCLASS_ID, $schoolclass);
	$c->add(AppointmentPeer::YEAR_ID, $year);
	$c->add(SubjectPeer::SHORTCUT, $subject_shortcut);

	$app =  parent::doSelectJoinAll($c);
	
	if(sizeof($app)>0)
		return $app[0];
	else
		return NULL;

	}

	public static function listWorkplans($max_per_page, $page, $year, $sortby, $filter='', $filter_id=-1)
	{
		$c= new Criteria();
		$c->addJoin(AppointmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
		$c->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, Criteria::LEFT_JOIN);
		$c->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID);
		$c->add(AppointmentPeer::YEAR_ID, $year);

		if ($filter_id>=0)
		{
			switch($filter)
			{
				case 'class': $c->add(AppointmentPeer::SCHOOLCLASS_ID, $filter_id); break;
				case 'teacher': $c->add(AppointmentPeer::USER_ID, $filter_id);	break;
				case 'subject': $c->add(AppointmentPeer::SUBJECT_ID, $filter_id); break;
				case 'state': $c->add(AppointmentPeer::STATE, $filter_id); break;
			}
		}

		switch($sortby)
		{
			case 'class': $c->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID); break;
			case 'teacher': 
				$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
				$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
				break;
      case 'type': $c->addAscendingOrderByColumn(AppointmentTypePeer::RANK); break;
			case 'subject': $c->addAscendingOrderByColumn(SubjectPeer::DESCRIPTION); break;
			case 'hours': $c->addAscendingOrderByColumn(AppointmentPeer::HOURS); break;
			case 'state': $c->addAscendingOrderByColumn(AppointmentPeer::STATE); break;

			default: $c->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID);
		}
		




		$pager = new sfPropelPager('Appointment', $max_per_page);
		$pager->setCriteria($c);
		$pager->setPage($page);
		$pager->init();
	
		return $pager;

	
	
	
	
		/*

	$connection = Propel::getConnection();

$sql = 'SELECT appointment_id as id, first_name, last_name, schoolclass_id, state, subject_id, subject.description as subject, count( wpmodule.id ) AS wpmodules
FROM appointment
JOIN sf_guard_user_profile ON appointment.user_id = sf_guard_user_profile.user_id
JOIN subject ON subject.id = appointment.subject_id
LEFT JOIN wpmodule ON wpmodule.appointment_id = appointment.id
WHERE appointment.year_id =%d
%s
GROUP BY first_name, last_name, schoolclass_id, state, subject_id, subject.description
ORDER BY %s
';


$sqlfilter ='';

if ($filter=='set')
	{


	if ($filtered_user_id!='')
		{
			$sqlfilter='AND appointment.user_id = %d ';
			$sqlfilter=sprintf($sqlfilter, $filtered_user_id);
		}


	}

$sortorder= 'schoolclass_id';

switch ($sortby)
{
	case 'class': $sortorder='schoolclass_id'; break;
	case 'teacher': $sortorder='last_name, first_name'; break;
	case 'state': $sortorder='state'; break;
	case 'subject': $sortorder= 'subject'; break;
	
	$sortorder= 'schoolclass_id';
}

	$sql = sprintf($sql, $year, $sqlfilter, $sortorder);

    $statement = $connection->prepare($sql);
    $statement->execute();
    $resultset = $statement->fetchAll(PDO::FETCH_OBJ);

	return $resultset;

*/


	}

	public static function importFromCSVFile($file)
	{
		$checkList=new CheckList();
				
		if (!is_readable($file))
		{
			$checksList->addCheck(new Check(Check::FAILED, 'file not readable', $file));
			return $checkList;
		}

		$row = 0;
		$imported=0;
		$skipped=0;

		$role=RolePeer::retrieveByPosixName(sfConfig::get('app_config_default_teams_role'));

		$year= sfConfig::get('app_config_current_year');
    $myyear=YearPeer::retrieveByPK($year);

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
				
			if (sizeof($data)!=5)
			{
				$checkList->addCheck(new Check(Check::FAILED, 'Invalid data', $groupName));
				continue;
			}
	
			list($username, $schoolclass, $subject, $hours, $syllabus)=$data;
      
			$sfUser= sfGuardUserProfilePeer::retrieveByUsername($username);
			if(!$sfUser)
				{
					$checkList->addCheck(new Check(Check::FAILED, sprintf('Not a user: %s', $username), $groupName));
					$skipped++;
					continue;
				}
				
			$mysubject = SubjectPeer::retrieveByShortcut($subject);
			if(!$mysubject)
				{
					$checkList->addCheck(new Check(Check::FAILED, sprintf('Not a subject: %s', $mysubject), $groupName));
					$skipped++;
					continue;
				}

			$myclass= SchoolclassPeer::retrieveByPK($schoolclass);
			if(!$myclass)
				{
					$checkList->addCheck(new Check(Check::FAILED, sprintf('Not a class: %s', $myclass), $groupName));
					$skipped++;
					continue;
				}

        
      $mysyllabus=SyllabusPeer::retrieveByPK($syllabus);
      if(!$mysyllabus)
        {
					$checkList->addCheck(new Check(Check::FAILED, sprintf('Not a syllabus: %s', $syllabus), $groupName));
					$skipped++;
					continue;
        }

			$appointment=AppointmentPeer::retrieveByUsernameSchoolclassSubjectYear($username,$schoolclass, $subject, $year);
			if($appointment)
				{
					$checkList->addCheck(new Check(Check::WARNING, sprintf('Appointment already exists: %s,  %s, %s, %s', $username, $mysubject, $myclass, $myyear), $groupName));
					$skipped++;
					continue;
				}
			
			$appointment=new Appointment();
			
			$appointment
			->setUserId($sfUser->getId())
			->setSubject($mysubject)
			->setSchoolclass($myclass)
			->setHours($hours)
			->setYear($myyear)
      ->setSyllabus($mysyllabus)
			->setState(Workflow::AP_ASSIGNED)
			->save();
			
			$appointment->getChecks();
			
			$teamname=sfConfig::get('app_config_class_teachersteam_prefix'). Generic::slugify($schoolclass);
			
			$team=TeamPeer::retrieveByPosixName($teamname);
			
			if ($team)
			{
				$sfUser->getProfile()->addToTeam($team, $role);
			}
			
      unset($appointment);
      
			$imported++;
			$checkList->addCheck(new Check(Check::PASSED, sprintf('   Appointment %s (%s, %s) imported', $username, $schoolclass, $subject),$groupName));

		}
		fclose($handle);
		
		return $checkList;

	}
}
