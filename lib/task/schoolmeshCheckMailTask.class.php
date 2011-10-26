<?php

class schoolmeshCheckMailTask extends sfBaseTask
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
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),

    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'check-mail';
    $this->briefDescription = 'Check email of the SchoolMesh bot';
    $this->detailedDescription = <<<EOF
This task will check incoming email, in order to perform mail-based actions.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    if(!$options['application'])
    {
      $this->logSection('config', 'Application not specified', null, 'ERROR');
      return 1;
    }

    $mailreader= new MailReader($options['application'], $options['env']);

    $mailreader->openConnection();
    if($mailreader->isOpen())
    {
      //print_r($mailreader->getStatus());
      
      $msgNo=$mailreader->getNumMessages();
      
      for($i=1; $i<=$msgNo; $i++)
      {
        echo "considering message $i...\n";
        //print_r($mailreader->getHeaderInfo($i));
        echo $mailreader->isNew($i)? 'NEW': 'OLD';
        echo "\n";
        if(!$mailreader->isNew($i))
        {
          continue; // we skip already seen messages...
        }
        echo "here we go...\n";
        $subject=$mailreader->getSubject($i);
        echo $subject . "\n";
        if (strpos($subject, 'verification:code=')!==false)
        {
          $components= preg_split('/verification:code=/', $subject, -1, PREG_SPLIT_OFFSET_CAPTURE);
          $code=substr($components[1][0], 0, -1);
          
          echo "Found, now we look for the user...\n";
          if (!$options['dry-run'])
          {
            $mailreader->markAsSeen($i);
          }
          //$mailreader->deleteMessage($i);
        }
      }
      
      //$mailreader->expunge();
      $mailreader->closeConnection();

    }
    else
    {
      print_r($mailreader->getErrors());
      $this->logSection('mailreader', 'Cannot login', null, 'ERROR');
    }
    
    
    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

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

  } // execute function

}  // class