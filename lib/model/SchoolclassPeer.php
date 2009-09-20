<?php

/**
 * Subclass for performing query and update operations on the 'schoolclass' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SchoolclassPeer extends BaseSchoolclassPeer
{
		
	public static function retrieveCurrentSchoolclasses()
	{
		$c=new Criteria();
		$c->addJoin(SchoolclassPeer::TRACK_ID, TrackPeer::ID);
		$c->addAscendingOrderByColumn(TrackPeer::DESCRIPTION);
		$c->addAscendingOrderByColumn(SchoolclassPeer::ID);

		return self::doSelectJoinAll($c);
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

			if (sizeof($data)!=5)
			{
				$checks[]=new Check(false, 'Invalid data', sprintf('Line %d: ', $row));
				continue;
			}

			list($id, $grade, $section, $track, $description)=$data; 
			$mytrack = TrackPeer::retrieveByShortcut($track);
			if(!$mytrack)
				{
					$checks[]=new Check(false, sprintf('Track «%s» does not exist', $track), sprintf('Line %d: ', $row));
					$skipped++;
					continue;
				}

			$schoolclass=SchoolclassPeer::retrieveByPK($id);
			if($schoolclass)
				{
					$checks[] = new Check(false, sprintf('Class «%s» already exists', $id), sprintf('Line %d: ', $row));
					$skipped++;
					continue;
				}

			$schoolclass=new Schoolclass();
			$schoolclass
			->setId($id)
			->setGrade($grade)
			->setSection($section)
			->setTrack($mytrack)
			->setDescription($description)
			->save();
			
			$teamname = sfConfig::get('app_config_class_teachersteam_prefix') . Generic::slugify($id);
			$team = TeamPeer::retrieveByPosixName($teamname);
			if($team)
			{
				$checks[] = new Check(true, sprintf('Team «%s» already exists', $team), sprintf('Line %d: ', $row));
			}
			else
			{
				$team = new Team();
				$team
				->setDescription(sfConfig::get('app_config_class_teachersteam_name') . ' ' . $id)
				->setPosixName($teamname)
				->setNeedsFolder(true)
				->setNeedsMailingList(false)
				->save();
				$checks[] = new Check(true, sprintf('Team «%s» created', $team), sprintf('Line %d: ', $row));
				
			}
			

			$imported++;
			$checks[] = new Check(true, sprintf('Class «%s» imported', $id), sprintf('Line %d: ', $row));
		}
		fclose($handle);
		return $checks;
		
	}


}
