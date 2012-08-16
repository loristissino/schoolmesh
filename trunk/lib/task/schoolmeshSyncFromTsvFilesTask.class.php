<?php

/**
 * schoolmeshSyncFromTsvFilesTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshSyncFromTsvFilesTask extends sfBaseTask
{
  protected function configure()
  {

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
    ));
    
    $this->addArgument('type', sfCommandArgument::REQUIRED, 'The information type to update');
    $this->addArgument('file', sfCommandArgument::REQUIRED, 'The tsv file to read information from');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'sync-from-tsv-files';
    $this->briefDescription = 'Synchronizes DB from information read by tab-separated-values files.';
    $this->detailedDescription = <<<EOF
This task will update the database taking information from TSV files properly formatted.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $type=$arguments['type'];
    
    $validtypes=array('users', 'enrolments', 'appointments');

    if(!in_array($type, $validtypes))
    {
      throw new Exception("Not a valid type specified. Should be one of the following:\n  -" . implode ("\n  -", $validtypes));
    }
    
    $tsvfile=$arguments['file'];
    
    if(!is_readable($tsvfile))
    {
      throw new Exception('File not readable: ' . $tsvfile);
    }
    
    $tsv=new smTsvReader($tsvfile);
    $tsv->open();
    while($v=$tsv->fetchAssoc())
    {
      print_r($v);
    }
    
    echo "Doing something...\n";

    
    if ($options['dry-run'])
    {
      echo "Rolled back!\n";
      $con->rollback();
    }
    else
    {
      echo "Executed!\n";
      $con->commit();
    }

  }

}
