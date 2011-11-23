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
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
      new sfCommandOption('also-not-submitted', null, sfCommandOption::PARAMETER_NONE, 'Whether the documents not yet submitted must be considered'),

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
      $this->logSection('appoint. '.$appointment->getId(), 'under check...', null, 'COMMENT');
      
      if($appointment->getState()>Workflow::WP_DRAFT)
      {
        $dateA=$appointment->getUpdatedAt();
        
        $dirtyA=false;
        
        if(!$appointment->getIsPublic())
        {
          $appointment
          ->setIsPublic(true)
          ->save($con);
          $dirtyA=true;
        }
        
        if($dirtyA)
        {
          $appointment
          ->setUpdatedAt($dateA)
          ->save($con);
          $this->logSection('appoint. '.$appointment->getId(), 'fixed public bit', null, 'COMMENT');
        }
      }
      if($options['also-not-submitted'] || $appointment->getState()>Workflow::WP_DRAFT)
      {
        $count=0;

        foreach($appointment->getWpinfos() as $wpinfo)
        {
          $dirty=false;
          
          $date=$wpinfo->getUpdatedAt();
          
          
          $old=$wpinfo->getContent();
          $new=ltrim(rtrim($old));
          if($old!=$new)
          {
            $wpinfo->setContent($new);
            $dirty=true;
          }
          
          if($wpinfo->getContent() && $wpinfo->getWpinfoType()->getState()>$appointment->getState())
          {
            $this->logSection('wpinfo-', sprintf('%d, removed content «%s» ', $wpinfo->getId(), $new), null, 'INFO');
            $wpinfo->setContent('');
            $dirty=true;
          }
          
          if($dirty)
          {
            $wpinfo->save($con);
            $wpinfo
            ->setUpdatedAt($date)
            ->save($con)
            ;
          }
          
        }


        foreach($appointment->getWpmodules() as $wpmodule)
        {
          $date=$wpmodule->getUpdatedAt();
          
          $dirtyW=false;
          
          if(strpos($wpmodule->getTitle(), '---')!==false)
          {
            $old=$wpmodule->getTitle();
            $new=str_replace('---', '', $old);
            $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'COMMENT');
            $wpmodule->setTitle($new);
            $dirtyW=true;
          }
          
          $old=$wpmodule->getTitle();
          $new=ltrim(rtrim($old));
          if($old!=$new)
          {
            $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'COMMENT');
            $wpmodule->setTitle($new);
            $dirtyW=true;
          }


          if(strpos($wpmodule->getPeriod(), '---')!==false)
          {
            $old=$wpmodule->getPeriod();
            $new=str_replace('---', '', $old);
            $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'COMMENT');
            $wpmodule->setPeriod($new);
            $dirtyW=true;
          }
          if($dirtyW)
          {
            $wpmodule->save($con);
            $wpmodule
            ->setUpdatedAt($date)
            ->save($con)
            ;
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
              
              $this->logSection('wpmodule ' . $wpmodule->getId(), 'fixed public bit', null, 'COMMENT'); 
            }
          }
          
          foreach($wpmodule->getWpItemGroups() as $WpitemGroup)
          {
            if($WpitemGroup->getWpitemType()->getState()>$appointment->getState())
            {
              // imported by error
              if($WpitemGroup->countWpmoduleItems())
              {
                $this->logSection('wpitemgroup-', 'removed children items (id=' . $WpitemGroup->getId() . ')', null, 'NOTICE');
                $WpitemGroup->deleteItems($con);
              }
            }
            
            foreach($WpitemGroup->getWpmoduleItems() as $Wpitem)
            {
              $old=$Wpitem->getContent();
              $new=$old;
              $new=str_replace('---', '', $new);
              $new=str_replace(array("\r\n", "\n", "\r", '  '), ' ', $new);

              if($new!=$old)
              {
                $Wpitem
                ->setContent($new)
                ->save($con);
                $this->logSection('wpitem ' . $Wpitem->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'COMMENT');
                echo "»»» OLD TEXT «««\n";
                echo $old . "\n";
                echo "»»» NEW TEXT «««\n";
                echo $new . "\n";
                echo "^^^^^^^^^^^^^^^^\n";
              }
            }
          }
        }
        if($count>0)
        {
          $this->logSection('appoint.', sprintf('%d: fixed %d module(s)', $appointment->getId(), $count), null, 'COMMENT');
        }
      }
      
      
      $checkList=$appointment->getChecks($con);
      
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
