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
	
	$file='./'. $file;
	
	$this->logSection('import-classes', 'Importing classes from '. $file . '.');
	
	$checks=SchoolclassPeer::importFromCSVFile($file);
	
	$this->logSection('import-classes', 'Imported classes from '. $file . '.');
	
	foreach($checks as $check)
	{
			$this->log($this->formatter->format(sprintf('File %s is not readable', $file), $check->getIsPassed()? 'COMMENT':'ERROR'));
	}
	
  }
}
