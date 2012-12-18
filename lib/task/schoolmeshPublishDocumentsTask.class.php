<?php

/**
 * schoolmeshPublishDocumentsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshPublishDocumentsTask extends sfBaseTask
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
      new sfCommandOption('format', null, sfCommandOption::PARAMETER_OPTIONAL, 'The format to use', 'odt'),
      new sfCommandOption('sleep', null, sfCommandOption::PARAMETER_REQUIRED, 'The number of seconds to wait between a profile and the next one', '10'),
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'publish-documents';
    $this->briefDescription = 'Publishes teacher\'s workplans and reports as attachments';
    $this->detailedDescription = <<<EOF
This task will publish, for archiviation purposes:
 - teachers' workplans
 - teachers' final reports.
EOF;
  }

  protected function publishDocumentsConcerningAppointments($appointments, $format='odt', $sleep=10)
  {
      foreach($appointments as $appointment)
      {
        $this->logSection('appoint.', $appointment->__toString(), null, 'COMMENT');
        
        $this->con->beginTransaction();
        foreach (array(true, false) as $complete)
        {
        
          $done=true;
          
          try
          {
            $appointment->createAttachment($complete, $this->context, $format, $this->con);
            $this->logSection('attachment+', sprintf('complete? %s', $complete?'true':'false') , null, 'INFO');
          }
          catch (Exception $e)
          {
            $this->logSection('attachment', 'Could not create attachment.' . ' ' . $e->getMessage(), null, 'ERROR');
            $done=false;
          }
          if($sleep)
          {
            printf("Sleeping for %d second(s)...\n", $sleep);
            sleep($sleep);
          }
        }
          
        if($done)
        {
          switch($appointment->getState())
          {
            case Workflow::WP_APPROVED:
              $appointment->setState(Workflow::IR_DRAFT);
              break;
            case Workflow::FR_APPROVED:
              $appointment->setState(Workflow::FR_ARCHIVED);
              break;
          }
          $appointment->save($this->con);
          
          $this->con->commit();
          printf("Done and committed.\n");
        }
        else
        {
          $this->con->rollback();
        }
      
      
    
    }
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $this->con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);

    $appointments=AppointmentPeer::retrieveByStateYear(Workflow::WP_APPROVED);  // we'll use the current year
    $this->publishDocumentsConcerningAppointments($appointments, $options['format'], $options['sleep']);

    $appointments=AppointmentPeer::retrieveByStateYear(Workflow::FR_APPROVED);  // we'll use the current year
    $this->publishDocumentsConcerningAppointments($appointments, $options['format'], $options['sleep']);

    
  } // execute function

}  // class
