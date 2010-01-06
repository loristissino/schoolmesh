<?php

class schoolmeshImportprojectsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
	   new sfCommandOption('year', null, sfCommandOption::PARAMETER_REQUIRED, 'School year', ''), 
  
    ));
	$this->addArgument('categories_filename', sfCommandArgument::REQUIRED, 'The CSV projects file name');
	$this->addArgument('projects_filename', sfCommandArgument::REQUIRED, 'The CSV projects file name');
	$this->addArgument('deadlines_filename', sfCommandArgument::REQUIRED, 'The CSV deadlines file name');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'import-projects';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [schoolmesh:import-projects|INFO] task does things.
Call it with:

  [php symfony schoolmesh:import-projects|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	$year=YearPeer::retrieveByDescription($options['year']);
	if (!$year)
	{
		$this->log($this->formatter->format('Not a valid year specified: ' . $options['year'], 'ERROR'));
		return false;
	}


	$file=$arguments['categories_filename'];
	
	$this->logSection('import-categories', 'Importing categories from '. $file . '.');
	
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

		print_r($data);

		list($rank, $title)=$data; 

		$this->log($this->formatter->format(sprintf('Importing category %s (rank %d)', $title, $rank), 'COMMENT'));
		
		$category=new ProjCategory();
		$category
		->setRank($rank)
		->setTitle($title)
		->save();
		
		$imported++;
		$this->log($this->formatter->format('Done', 'INFO'));

	}
	fclose($handle);

	$this->log($this->formatter->format(sprintf('Imported correctly %d categories, skipped %d', $imported, $skipped), 'COMMENT'));
	
	// PROJECTS
	
	$file=$arguments['projects_filename'];
	
	$this->logSection('import-projects', 'Importing projects from '. $file . '.');
	
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

		print_r($data);

		list($category, $user, $title, $hours)=$data; 

		$this->log($this->formatter->format(sprintf('Importing project %s', $title), 'COMMENT'));
		
		if (!$mycategory=ProjCategoryPeer::retrieveByTitle($category))
			{
				$skipped++;
				continue;
			}
		if (!$myuser=sfGuardUserProfilePeer::retrieveByUsername($user))
			{
				$skipped++;
				continue;
			}
		
		$project=new Schoolproject();
		$project
		->setProjCategoryId($mycategory->getId())
		->setYearId($year->getId())
		->setUserId($myuser->getId())
		->setTitle($title)
		->setHoursApproved($hours)
		->save();
		
		$imported++;
		$this->log($this->formatter->format('Done', 'INFO'));

	}
	fclose($handle);

	$this->log($this->formatter->format(sprintf('Imported correctly %d projects, skipped %d', $imported, $skipped), 'COMMENT'));


	// DEADLINES
	
	$file=$arguments['deadlines_filename'];
	
	$this->logSection('import-projects', 'Importing deadlines from '. $file . '.');
	
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

		print_r($data);

		list($user, $title, $duedate, $description)=$data; 

		$this->log($this->formatter->format(sprintf('Importing deadline %s', $title), 'COMMENT'));
		
		if (!$myproject=SchoolprojectPeer::retrieveByTitleAndYear($title, $year->getId()))
			{
				$skipped++;
				continue;
			}
		if (!$myuser=sfGuardUserProfilePeer::retrieveByUsername($user))
			{
				$skipped++;
				continue;
			}
		
		$deadline=new ProjDeadline();
		$deadline
		->setSchoolprojectId($myproject->getId())
		->setUserId($myuser->getId())
		->setDescription($description)
		->setOriginalDeadlineDate(Generic::clever_date('it', $duedate))
		->save();
		
		$imported++;
		$this->log($this->formatter->format('Done', 'INFO'));

	}
	fclose($handle);

	$this->log($this->formatter->format(sprintf('Imported correctly %d deadlines, skipped %d', $imported, $skipped), 'COMMENT'));

	
  }
}
