<?php

/**
 * schoolmeshPublishWorkplansTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshPublishWorkplansTask extends sfBaseTask
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
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'publish-workplans';
    $this->briefDescription = 'Publish teacher\'s workplans as attachments';
    $this->detailedDescription = <<<EOF
This task will publish teachers' workplans for archiviation purposes.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);

    $appointments=AppointmentPeer::retrieveByStateYear(Workflow::WP_APPROVED);  // we'll use the current year
    foreach($appointments as $appointment)
    {
      
      $this->logSection('appoint.', $appointment->__toString(), null, 'COMMENT');
      
      $format='odt';
      $con->beginTransaction();
      
      $done=true;
      
      foreach (array(true, false) as $complete)
      {
        try
        {
          $appointment->createAttachment($complete, $this->context, $options['format']);
          $this->logSection('attachment+', sprintf('complete? %s', $complete?'true':'false') , null, 'INFO');
          if ($options['format']!='odt')
          {
            sleep(5);  // otherwise unoconv complains about memory leaks... hoping this works!
          }
        }
        catch (Exception $e)
        {
          $this->logSection('attachment', 'Could not create attachment.', null, 'INFO');
          $done=false;
        }
      }
      if($done)
      {
        $appointment
        ->setState(Workflow::IR_DRAFT)
        ->save($con)
        ;
        $con->commit();
      }
      else
      {
        $con->rollback();
      }
      
    }
  } // execute function

}  // class
