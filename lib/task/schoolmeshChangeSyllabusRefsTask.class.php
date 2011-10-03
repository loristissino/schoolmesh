<?php

class schoolmeshChangeSyllabusRefsTask extends sfBaseTask
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
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'whether the command will be executed leaving the db intact'),

    ));
    
    $this->addArgument('from', sfCommandArgument::REQUIRED, 'Base Syllabus Id');
    $this->addArgument('to', sfCommandArgument::REQUIRED, 'Target Syllabus Id');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'change-syllabus-refs';
    $this->briefDescription = 'Change syllabus references, after a new syllabus is imported';
    $this->detailedDescription = <<<EOF
This task will can be used when a new syllabus is imported, updating a previous 
one. All references to the old syllabus must be updated to meet the new one 
(using refs to find the right items)
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


    if (!$SyllabusFrom=SyllabusPeer::retrieveByPk($arguments['from']))
    {
      $this->log($this->formatter->format('Not a valid Syllabus specified as "from" argument: ' . $arguments['from'], 'ERROR'));
      return false;
    }
    
    if (!$SyllabusTo=SyllabusPeer::retrieveByPk($arguments['to']))
    {
      $this->log($this->formatter->format('Not a valid Syllabus specified as "to" argument: ' . $arguments['from'], 'ERROR'));
      return false;
    }


    $c=new Criteria();
    $c->add(AppointmentPeer::YEAR_ID, $year);

    $appointments=AppointmentPeer::doSelect($c);
    foreach($appointments as $appointment)
    {
      if($appointment->getSyllabusId()==$arguments['from'])
      {
        foreach($appointment->getWpmodules() as $wpmodule)
        {
          foreach($wpmodule->getWpmoduleSyllabusItems() as $WpmoduleSyllabusItem)
          {
            echo $WpmoduleSyllabusItem->getId() . ' - ';
            echo $WpmoduleSyllabusItem->getWpmodule()->getTitle() . ' - ';
            echo $WpmoduleSyllabusItem->getSyllabusItem()->getRef() . "\n";
            
            $targetSyllabusItem=SyllabusItemPeer::retrieveBySyllabusIdAndRef($arguments['to'], $WpmoduleSyllabusItem->getSyllabusItem()->getRef());
            
            if($targetSyllabusItem)
            {
              $newWpmoduleSyllabusItem = new WpmoduleSyllabusItem();
              $newWpmoduleSyllabusItem
              ->setWpmodule($wpmodule)
              ->setSyllabusItemId($targetSyllabusItem->getId())
              ->setContribution($WpmoduleSyllabusItem->getContribution())
              ->setEvaluation($WpmoduleSyllabusItem->getEvaluation())
              ->save($con);
              
              $this->logSection('item+', $newWpmoduleSyllabusItem->getSyllabusItem()->getRef(), null, 'INFO');
              
              $this->logSection('item-', $WpmoduleSyllabusItem->getSyllabusItem()->getRef(), null, 'INFO');
              $WpmoduleSyllabusItem->delete($con);
            }
            
          }
          
        }
        
        $appointment
        ->setSyllabusId($arguments['to'])
        ->save($con);
        $this->logSection('appointment@', $appointment->__toString(), null, 'INFO');

      }
      
	  }  // appointment loop

    foreach($SyllabusFrom->getWpitemTypes() as $WpitemType)
    {
      $WpitemType
      ->setSyllabus($SyllabusTo)
      ->save($con);
      $this->logSection('wpitemtype@', $WpitemType->getTitle(), null, 'INFO');
    }

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