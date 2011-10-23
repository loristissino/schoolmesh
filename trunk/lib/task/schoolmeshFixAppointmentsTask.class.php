<?php

class schoolmeshFixAppointmentsTask extends sfBaseTask
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
	    new sfCommandOption('subject', null, sfCommandOption::PARAMETER_REQUIRED, 'Subject shortcut', ''), 
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'whether the command will be executed leaving the db intact'),

    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'fix-appointments';
    $this->briefDescription = 'Fix appointments, making all needed checks';
    $this->detailedDescription = <<<EOF
This task will be used for several general checks and fixes about appointments.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $year=YearPeer::retrieveByDescription($options['year']);
    if (!$year)
    {
      $this->log($this->formatter->format('Not a valid year specified: ' . $options['year'], 'ERROR'));
      return false;
    }

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $c=new Criteria();
    $c->add(AppointmentPeer::YEAR_ID, $year);
//    $c->add(AppointmentPeer::STATE, Workflow::WP_WSMC, Criteria::GREATER_THAN);


    $appointments=AppointmentPeer::doSelect($c);
    foreach($appointments as $appointment)
    {
      if($appointment->getState()>Workflow::WP_WSMC)
      {
        $count=0;
        foreach($appointment->getWpmodules() as $wpmodule)
        {
          $date=$wpmodule->getUpdatedAt();
            
          if(strpos($wpmodule->getTitle(), '---') or strpos($wpmodule->getPeriod(), '---'))
          {
            echo $wpmodule->getId() . ' # ' . $wpmodule->getTitle() . ' # ' . $wpmodule->getPeriod() . "\n";
            $wpmodule
            ->setTitle(str_replace('---', '', $wpmodule->getTitle()))
            ->setPeriod(str_replace('---', '', $wpmodule->getPeriod()))
            ->save();
            $wpmodule
            ->setUpdatedAt($date)
            ->save($con)
            ;
            echo "REPLACED WITH\n" . $wpmodule->getTitle() . ' # ' . $wpmodule->getPeriod() . "\n";
          }
          
          if($appointment->getState()>=Workflow::IR_DRAFT)
          {
            if(!$wpmodule->getIsPublic())
            {
              // It seems that it happened, we must introduce transactions to avoid this problem
              $wpmodule
              ->setIsPublic(true)
              ->save($con)
              ;
              $wpmodule
              ->setUpdatedAt($date)
              ->save($con)
              ;
              
              echo "FIXED Wpmodule " . $wpmodule->getId() . " public bit\n"; 
            }
          }
          
          foreach($wpmodule->getWpItemGroups() as $WpitemGroup)
          {
            foreach($WpitemGroup->getWpmoduleItems() as $Wpitem)
            {
              if(strpos($Wpitem->getContent(), '---') or strpos($Wpitem->getContent(), "\n"))
              {
                echo $Wpitem->getId() . ' # ' . $Wpitem->getContent() . "\n";
                $Wpitem
                ->setContent(str_replace('---', '', $Wpitem->getContent()))
                ->setContent(str_replace("\r\n", ' ', $Wpitem->getContent()))
                ->setContent(str_replace("\n", ' ', $Wpitem->getContent()))
                ->setContent(str_replace("\r", ' ', $Wpitem->getContent()))
                ->setContent(str_replace('  ', ' ', $Wpitem->getContent()))
                ->save($con);
                echo "REPLACED WITH\n" . $Wpitem->getContent() . "\n";
                
              }
            }
          }
        }
        if($count>0)
        {
          $this->logSection('appoint.', sprintf('%d: fixed %d module(s)', $appointment->getId(), $count), null, 'COMMENT');
        }
      }
      
	  }  // appointment loop
    
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