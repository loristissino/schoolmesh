<?php

/**
 * schoolmeshSendRemindersTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class schoolmeshSendRemindersTask extends sfBaseTask
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
    $this->name             = 'send-reminders';
    $this->briefDescription = 'Sends reminders about actions to perform';
    $this->detailedDescription = <<<EOF
The [schoolmesh:send-file|INFO] task sends reminders by email to the users that need to do something with the application.
Call it with:

  [php symfony schoolmesh:send-reminders|INFO]
EOF;
  }

  private function _sendWarningsForAppointmentsWaitingApproval($state, $permission, $base)
  {
    $appointments=AppointmentPeer::retrieveByStateYear($state);
    
    if (sizeof($appointments)>0)
    {
      $text='';
      foreach($appointments as $appointment)
      {
        $text.=$appointment . "\n";
      }
      
      $users=sfGuardUserProfilePeer::retrieveByPermission($permission);
      
      $addressees='';
      if (sizeof($users)>1)
      {
        foreach($users as $user)
        {
          $addressees.=$user->getFullName()."\n";
        }
      }
      
      foreach($users as $user)
      {
        $user->sendWorkflowConfirmationMessage($this->context, $base, array(
          '%number%'=>sizeof($appointments),
          '%appointments%'=>$text,
          '%addressees%'=>($addressees=='' ? '' : $this->context->getI18N()->__('This message has been sent to:') . "\n" . $addressees)
          ));
        $this->logSection('mail@', sprintf('%s (%d) - %s (%d)', 
          $user->getUsername(), 
          sizeof($appointments),
          $base,
          $state
          ), null, 'NOTICE');
      }
    }
    
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here

    $this->context = sfContext::createInstance($this->configuration);

    $this->_sendWarningsForAppointmentsWaitingApproval(Workflow::WP_WADMC, 'wp_adm_ok', 'workplans_waiting');
    $this->_sendWarningsForAppointmentsWaitingApproval(Workflow::WP_WSMC, 'wp_sm_ok', 'workplans_waiting');
    $this->_sendWarningsForAppointmentsWaitingApproval(Workflow::FR_WADMC, 'fr_adm_ok', 'finalreports_waiting');
    $this->_sendWarningsForAppointmentsWaitingApproval(Workflow::FR_WSMC, 'fr_sm_ok', 'finalreports_waiting');
 
  }
}
