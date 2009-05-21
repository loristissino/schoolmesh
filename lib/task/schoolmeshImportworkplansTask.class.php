<?php

class schoolmeshImportworkplansTask extends sfBaseTask
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
	  new sfCommandOption('replace', null, sfCommandOption::PARAMETER_REQUIRED, 'Should existing workplans be replaced?', 'false'), 
	  new sfCommandOption('importer', null, sfCommandOption::PARAMETER_REQUIRED, 'Importer username?', ''),  
  
    ));

	$this->addArgument('dir', sfCommandArgument::OPTIONAL, 'The directory where to look for workplans', 'web/uploads/workplans');


    $this->namespace        = 'schoolmesh';
    $this->name             = 'import-workplans';
    $this->briefDescription = 'Import workplans from yaml files';
    $this->detailedDescription = <<<EOF
The [schoolmesh:importworkplans|INFO] imports workplans from yaml files.
Call it with:

  [php symfony schoolmesh:importworkplans|INFO] directory --replace=[true|false] --importer=username
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	$this->logSection('import-workplans', 'Importing workplans from '. $arguments['dir'] . '... (replacing: '.$options['replace'] . ')');
	$files= scandir($arguments['dir']);
	
	if ($options['importer']==null)
		{
		$this->log($this->formatter->format('No importer specified', 'ERROR'));
		return false;
		}
	$importer=sfGuardUserProfilePeer::retrieveByUsername($options['importer']);
	if ($importer==null)
		{
		$this->log($this->formatter->format('Importer not found', 'ERROR'));
		return false;
		}
	
	foreach($files as $file)
		{
			$content_chunks = explode(".",$file);
            $ext = $content_chunks[count($content_chunks) - 1];
			if ($ext=='yaml' || $ext=='yml')
				$this->processFile($arguments['dir'].'/'.$file, $options['replace'], $importer->getId(), $connection);
		}

  }

	protected function processFile($file, $replace,  $user_id, $connection)
	{

	$this->log($this->formatter->format($file, 'INFO'));

	$content=sfYaml::load($file);

//	print_r($content);
	
	if (!isset($content['workplan_report']['id']))
		{
			// We just assume that if the ID is not set we will replace the content
			$result = AppointmentPeer::doImport($content, $replace, $user_id);
			$this->log($this->formatter->format(sprintf('   Correctly imported: %d', $result['oks']), 'INFO'));
			if ($result['fails']>0)
				{
				$this->log($this->formatter->format(sprintf('   Not imported: %d', $result['fails']), 'ERROR'));
				$this->log($this->formatter->format(chop($result['errors']), 'ERROR'));
				}
			
		}
	else
		{
			$this->log($this->formatter->format('   Skipped'), 'ERROR');
			
		}
	
	
	
	}

}
