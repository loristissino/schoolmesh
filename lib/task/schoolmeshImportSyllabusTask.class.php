<?php

class schoolmeshImportSyllabusTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('filename', sfCommandArgument::REQUIRED, 'File name'),
     ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
      
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'import-syllabus';
    $this->briefDescription = 'Imports a syllabus from YML file into DB';
    $this->detailedDescription = "";
  }

  protected function execute($arguments = array(), $options = array())
  {
	
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    //$this->context = sfContext::createInstance($this->configuration);

    // add your code here
    
    $filename=$arguments['filename'];
    
    if (!file_exists($filename))
    {
      $this->logSection('file', 'File ' . $filename . ' does not exist', null, 'ERROR');
      return 1;
    }
        
    try
    {
      $document = sfYaml::load($filename);
      $fileok=true;
    }
    catch(Exception $e)
    {
      $this->logSection('syllabus', $e->getMessage(), null, 'ERROR');
      $fileok=false;
    }
    
    if($fileok)
    {
      $con = Propel::getConnection(SyllabusPeer::DATABASE_NAME);

      print_r($document);

      try
      {
        $con->beginTransaction();

        $syllabus = new Syllabus();
        $syllabus
        ->setName($document['syllabus']['name'])
        ->setVersion($document['syllabus']['version'])
        ->setAuthor($document['syllabus']['author'])
        ->setHref($document['syllabus']['href'])
        ->save($con)
        ;
        
        $syllabus->saveItems($document['syllabus']['items'], $con);
        $con->commit();
        $this->logSection('syllabus+', $syllabus->getName(), null, 'NOTICE');

      }
      catch (PropelException $e)
      {
        $con->rollback();
        $this->logSection('syllabus', $e->getCause()->getMessage(), null, 'ERROR');
        $this->logSection('syllabus', 'Syllabus not imported', null, 'ERROR');
      }
    }

  }
  
}
