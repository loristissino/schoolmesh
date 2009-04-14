<?php

class schoolmeshImportclassesTask extends sfBaseTask
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
    ));

	$this->addArgument('file', sfCommandArgument::OPTIONAL, 'The spreadsheet to import classes from', 'web/uploads/classes.csv');


    $this->namespace        = 'schoolmesh';
    $this->name             = 'import-classes';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [schoolmesh:import-classes|INFO] task import classes.
Call it with:

  [php symfony schoolmesh:import-classes|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	
	$file=$arguments['file'];
	
	$this->logSection('import-classes', 'Importing classes from '. $file . '.');
	
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

		list($id, $grade, $section, $track, $description)=$data; 

		$this->log($this->formatter->format(sprintf('Importing class %s', $id), 'COMMENT'));
		
		$mytrack = TrackPeer::retrieveByShortcut($track);
		if(!$mytrack)
			{
				$this->log($this->formatter->format(sprintf('   Track %s does not exist, skipping', $track), 'ERROR'));
				$skipped++;
				continue;
			}

		$schoolclass=SchoolclassPeer::retrieveByPK($id);
		if($schoolclass)
			{
				$this->log($this->formatter->format(sprintf('   Class %s already exists, skipping', $id), 'ERROR'));
				$skipped++;
				continue;
			}

		$schoolclass=new Schoolclass();
		$schoolclass->setId($id);
		$schoolclass->setGrade($grade);
		$schoolclass->setSection($section);
		$schoolclass->setTrack($mytrack);
		$schoolclass->setDescription($description);
		$schoolclass->save();

		$imported++;
		$this->log($this->formatter->format(sprintf('   Class %s imported', $id), 'INFO'));
	}
	fclose($handle);

	$this->log($this->formatter->format(sprintf('Imported correctly %d classes, skipped %d', $imported, $skipped), 'COMMENT'));
	
  }
}
