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
          if(!$wpmodule->getIsPublic())
          {
            $date=$wpmodule->getUpdatedAt();
            $wpmodule
            ->setIsPublic(true)
            ->save();
            $wpmodule
            ->setUpdatedAt($date)
            ->save()
            ;
            $count++;
          }
        }
        if($count>0)
        {
          $this->logSection('appoint.', sprintf('%d: fixed %d module(s)', $appointment->getId(), $count), null, 'COMMENT');
        }
      }
      
    }
		

  }

}