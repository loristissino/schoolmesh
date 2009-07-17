<?php

class schoolmeshImportappointmentsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

	$this->addArgument('file', sfCommandArgument::OPTIONAL, 'The spreadsheet to import appointments from', 'web/uploads/appointments.csv');


    $this->namespace        = 'schoolmesh';
    $this->name             = 'import-appointments';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [schoolmesh:import-appointments|INFO] task import appointments.
Call it with:

  [php symfony schoolmesh:import-appointments|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	
	$this->logSection(sfContext::getInstance()->getI18N()->__('Workplan'), 'COMMENT');
	
	
	return;
	
	$file=$arguments['file'];
	
	$this->logSection('import-appointments', 'Importing appointments from '. $file . '.');
	
	if (!is_readable($file))
		{
			$this->log($this->formatter->format(sprintf('File %s is not readable', $file), 'ERROR'));
			return 1;
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

		list($username, $schoolclass, $subject, $year)=$data; 

		$this->log($this->formatter->format(sprintf('Importing appointment %s -> %s, %s ( %s)', $username, $schoolclass, $subject, $year), 'COMMENT'));
		
		$sfUser= sfGuardUserProfilePeer::retrieveByUsername($username);
		if(!$sfUser)
			{
				$this->log($this->formatter->format(sprintf('   Username %s does not exist, skipping', $username), 'ERROR'));
				$skipped++;
				continue;
			}
			
		$mysubject = SubjectPeer::retrieveByShortcut($subject);
		if(!$mysubject)
			{
				$this->log($this->formatter->format(sprintf('   Subject %s does not exist', $subject), 'ERROR'));
				$skipped++;
				continue;
			}

		$myclass= SchoolclassPeer::retrieveByPK($schoolclass);
		if(!$myclass)
			{
				$this->log($this->formatter->format(sprintf('   Class %s does not exist, skipping', $schoolclass), 'ERROR'));
				$skipped++;
				continue;
			}

		$myyear= YearPeer::retrieveByPK($year);
		if(!$myyear)
			{
				$this->log($this->formatter->format(sprintf('   Year %s does not exist, skipping', $year), 'ERROR'));
				$skipped++;
				continue;
			}

		$appointment=AppointmentPeer::retrieveByUsernameSchoolclassSubjectYear($username,$schoolclass, $subject, $year);
		if($appointment)
			{
				$this->log($this->formatter->format('   Appointment already exists, skipping', 'ERROR'));
				$skipped++;
				continue;
			}
		
		$appointment=new Appointment();
		
		$appointment->setUserId($sfUser->getId());
		$appointment->setSubject($mysubject);
		$appointment->setSchoolclass($myclass);
		$appointment->setYear($myyear);
		$appointment->save();
		$appointment->getChecks();

		
		$imported++;
		$this->log($this->formatter->format(sprintf('   Appointment %s (%s, %s) imported', $username, $schoolclass, $subject), 'INFO'));

	}
	fclose($handle);

	$this->log($this->formatter->format(sprintf('Imported correctly %d appointments, skipped %d', $imported, $skipped), 'COMMENT'));

	
	
	
	
	
  }
}
