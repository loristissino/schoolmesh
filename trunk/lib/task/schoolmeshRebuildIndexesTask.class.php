<?php

class schoolmeshRebuildIndexesTask extends sfBaseTask
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

    $this->namespace        = 'schoolmesh';
    $this->name             = 'rebuild-indexes';
    $this->briefDescription = 'Rebuild Lucene indexes from scratch';
    $this->detailedDescription = <<<EOF
This task will re-index all documents and users' data from scratch, removing 
previous indexes.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here

    $profiles=sfGuardUserProfilePeer::retrieveAllSortedByLastName();
    
    $count=0;
    $size=sizeof($profiles);
    
    foreach($profiles as $profile)
    {
      
      $profile->updateLuceneIndex();
      $this->logSection('user', sprintf('%s indexed (%3.2f%%)', $profile->getUsername(), 100*(++$count/$size)), null, 'INFO');
    }

  }

}