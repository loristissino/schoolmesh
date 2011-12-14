<?php

/**
 * schoolmeshDeactivateAccountsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshDeactivateAccountsTask extends sfBaseTask
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


    ));


    $this->namespace        = 'schoolmesh';
    $this->name             = 'deactivate-accounts';
    $this->briefDescription = 'Deactivate accounts for teachers with no-appointments and students not enrolled.';
    $this->detailedDescription = <<<EOF
This task will set is_active to false for teachers with no appointments and students not enrolled.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	$year=YearPeer::retrieveByDescription($options['year']);
	if (!$year)
	{
		$this->log($this->formatter->format('Not a valid year specified: ' . $options['year'], 'ERROR'));
		return false;
	}

			$profiles=sfGuardUserProfilePeer::retrieveTeachers();
			foreach($profiles as $profile)
			{
        $appointments=$profile->getCurrentAppointments();
        if (!sizeof($appointments))
        { 
          $profile->getSfGuardUser()->setIsActive(false)->save();
          $this->logSection('user!', $profile->getUsername(), null, 'COMMENT');
        }
			}
      
      unset($profiles);
			$profiles=sfGuardUserProfilePeer::retrieveStudents();
			foreach($profiles as $profile)
			{
        $enrolment=$profile->getCurrentEnrolment();
        if (!$enrolment)
        { 
          $profile->getSfGuardUser()->setIsActive(false)->save();
          $this->logSection('user!', $profile->getUsername(), null, 'COMMENT');
        }
			}
      
		
		

  }

}
