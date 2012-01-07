<?php

/**
 * schoolmeshApproveworkplansTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshApproveworkplansTask extends sfBaseTask
{
  protected function configure()
  {

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
	    new sfCommandOption('approver', null, sfCommandOption::PARAMETER_REQUIRED, 'Approver username', ''),  
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'approve-workplans';
    $this->briefDescription = 'Approves workplans';
    $this->detailedDescription = <<<EOF
The [schoolmesh:approve-workplans|INFO] approves all workplans submitted.

Call it with:

  symfony schoolmesh:approve-workplans --application=frontend --env=prod --approver=john.smith
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    
    echo "This code must be reviewed\n";
    return 0;
	
    $this->logSection('approve-workplans', 'Approving all workplans for testing purposes...');

    if ($options['approver']==null)
      {
      $this->log($this->formatter->format('No approver specified', 'ERROR'));
      return false;
      }
    $approver=sfGuardUserProfilePeer::retrieveByUsername($options['approver']);
    if (!$approver)
      {
      $this->log($this->formatter->format('Approver not found', 'ERROR'));
      return false;
      }

    $workplans=AppointmentPeer::getSubmitted(Workflow::WP_WADMC);
    foreach($workplans as $workplan)
      {
      $this->log($this->formatter->format('Considering Workplan ' . $workplan->getId(). ': ' . $workplan->getFullName() . ', '. $workplan->getSchoolclass(), 'INFO'));
      $result=$workplan->Approve($approver->getId(), array('office'));
      $this->log($this->formatter->format('  '.$result['message'], 'INFO'));
      }

    sleep(1);
    $workplans=AppointmentPeer::getSubmitted(Workflow::WP_WSMC);
    foreach($workplans as $workplan)
      {
      $this->log($this->formatter->format('Considering Workplan ' . $workplan->getId(). ': ' . $workplan->getFullName() . ', '. $workplan->getSchoolclass(), 'INFO'));
      $result=$workplan->Approve($approver->getId(), array('schoolmaster'));
      $this->log($this->formatter->format('  '.$result['message'], 'INFO'));
      }

  }
}
