<?php

class AppointmentPeer extends BaseAppointmentPeer
{
	
	public static function getSubmitted($state)
	{
		
	$c=new Criteria();
	$c->add(AppointmentPeer::STATE, $state);
	return parent::doSelect($c);

	}
	
	
	public static function doImport($content, $replace)
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
					echo "... not replacing\n";
					return;
				}
			else
				$workplan->removeEverything();
		}
	else
		{
		
		// Here I should look for teacher, schoolclass, year, subject, and eventually create the appointment
		// Perhaps it doesn't make sense, it's better to create the appointments separately.
//		$workplan = new Appointment();
		
		echo "I don't create new appointments here\n";
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
				$import['errors'].='Error importing: '. $key. "\n";
	
			}
		}

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
							$import['errors'].='Error importing: '. $item. "\n";
						}
					}
					
					
				}
			else
				{
				$import['fails']++;
				$import['errors'].='Error importing: '. $key. "\n";
					
				}

		}

	
	$wpmodules=$workplan->getWpmodules();
/*	foreach($wpmodules as $wpmodule)
		echo ".... Wpmodule: " .$wpmodule->getId(). "\n";
	*/
	foreach($content['workplan_report']['modules'] as $key=>$value)
		{
		$wpmodule = new Wpmodule();
		$wpmodule->setPeriod($value['period']);
		$wpmodule->setAppointmentId($workplan->getId());
		$wpmodule->setUserId($workplan->getUserId());
		$wpmodule->setTitle($key);
		$wpmodule->save();
		
		
		foreach($value['details'] as $ig)
			{
//			print_r($detail);
			foreach ($ig as $dkey=>$dvalue)
				{
					
//				echo "I should build an object for " . $dkey . "\n";
				$myItemType=WpitemTypePeer::retrieveByTitle($dkey);
				
				if ($myItemType)
					{
//					echo "        ----> Got: ". $myItemType->getId() . "  " . $myItemType->getTitle(). "\n";	
						
					$wpitemGroup = new WpitemGroup();
					$wpitemGroup->setWpitemTypeId($myItemType->getId());
					$wpitemGroup->setWpmoduleId($wpmodule->getId());
					$wpitemGroup->save();

					foreach($dvalue as $sdkey=>$sdvalue)
						{
//							echo "$dkey .. $sdkey - " . $sdvalue['content'] . "\n";
							$wpmoduleItem = new WpmoduleItem();
							$wpmoduleItem->setWpitemGroupId($wpitemGroup->getId());
							$wpmoduleItem->setContent($sdvalue['content']);
							$wpmoduleItem->setIsEditable(true);
							$wpmoduleItem->save();
							$import['oks']++;

						}


					}
				else
					{
						$import['fails']++;
						$import['errors'].='Error importing: '. $dkey. "\n";
						
						
					}
				
				
				}
			}
		
		
		unset($wpmodule);
		}


	
	return $import;
	
	}


	public static function retrieveByTeacherSchoolclassSubjectYear($teacherFirstName, $teacherLastName, $schoolclass, $subject, $year)
	{
	
	echo "Looking for: $teacherFirstName, $teacherLastName, $schoolclass, $subject, $year \n";
	
	$c=new Criteria();
	$c->add(sfGuardUserProfilePeer::FIRST_NAME, $teacherFirstName);
	$c->add(sfGuardUserProfilePeer::LAST_NAME, $teacherLastName);
	$c->add(AppointmentPeer::SCHOOLCLASS_ID, $schoolclass);
	$c->add(AppointmentPeer::YEAR_ID, $year);
	$c->add(SubjectPeer::DESCRIPTION, $subject);

	$app =  parent::doSelectJoinAll($c);
	return $app[0];

	}


}
