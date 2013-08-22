<?php

/**
 * schoolmeshExtractInfoTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshExtractInfoTask extends sfBaseTask
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
	   new sfCommandOption('role', null, sfCommandOption::PARAMETER_REQUIRED, 'User\'s role', ''), 
	   new sfCommandOption('class', null, sfCommandOption::PARAMETER_REQUIRED, 'School class', ''), 
	   new sfCommandOption('state', null, sfCommandOption::PARAMETER_REQUIRED, 'Appointment state', ''), 
	   new sfCommandOption('subject', null, sfCommandOption::PARAMETER_REQUIRED, 'Subject shortcut', ''), 
  	   new sfCommandOption('teacher', null, sfCommandOption::PARAMETER_REQUIRED, 'Teacher\'s username', ''), 

    ));

    $this->addArgument('infotype', sfCommandArgument::REQUIRED, 'The information type requested');


    $this->namespace        = 'schoolmesh';
    $this->name             = 'extract-info';
    $this->briefDescription = 'Extract informarmation from the database';
    $this->detailedDescription = <<<EOF
The [schoolmesh:extract-info|INFO] task can be used to to extract information from the database.
Different options will control the actual output.

Call it with:

   symfony schoolmesh:extract-info --application=frontend --env=prod --year year users|appointments|enrolments

Examples:

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 users
   # extract all users

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 --role allievi users
   # extract all users which have a role with posix name "allievi"

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 --role docenti users
   # extract all users which have a role with posix name "docenti"

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 appointments
   # extract all teaching appointments

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 --teacher john.doe appointments
   # extract all teaching appointments of teacher john.doe

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 enrolments
   # extract all enrolments of students

   symfony schoolmesh:extract-info --application=frontend --env=prod --year 2011/12 --class 1AIG enrolments
   # extract all enrolments of class 1AIG

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

	switch ($arguments['infotype'])
	{
		case 'users':
			$c=new Criteria();
			$c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
			if ($options['role'])
			{
				$c->add(RolePeer::POSIX_NAME, $options['role']);
			}
			
			$users=sfGuardUserProfilePeer::doSelect($c);
			foreach($users as $profile)
			{
          echo implode(':', array(
					$profile->getUsername(), 
					$profile->getFirstName(), 
					$profile->getLastName(), 
					$profile->getRole()->getPosixName(),
          $profile->getValidatedEmail(),
					)) . "\n";
			}
		
			break;
		
		case 'appointments':
			$c=new Criteria();
			$c->add(AppointmentPeer::YEAR_ID, $year);

			if (is_numeric($options['state']))
			{
				$c->add(AppointmentPeer::STATE, $options['state']);
			}
			if ($options['teacher']!='')
			{
				$user=sfGuardUserProfilePeer::retrieveByUsername($options['teacher']);
				if ($user)
				{
					$c->add(AppointmentPeer::USER_ID, $user->getId());
				}
				else
				{
					$this->log($this->formatter->format('Not a valid teacher specified: ' . $options['teacher'], 'ERROR'));
					return false;
				}
			}
			if ($options['subject']!='')
			{
				$subject=SubjectPeer::retrieveByShortcut($options['subject']);
				if ($subject)
				{
					$c->add(AppointmentPeer::SUBJECT_ID, $subject->getId());
				}
			}
			if ($options['class']!='')
			{
				$schoolclass=SchoolclassPeer::retrieveByPK($options['class']);
				if ($schoolclass)
				{
					$c->add(AppointmentPeer::SCHOOLCLASS_ID, $schoolclass->getId());
				}
			}

			$appointments=AppointmentPeer::doSelect($c);
			foreach($appointments as $appointment)
			{
				echo implode(':', array(
					$appointment->getId(), 
					$appointment->getOwner()->getUsername(),
          ($appointment->getAppointmentTypeId() ? $appointment->getAppointmentType()->getShortcut() : ''),
					($appointment->getSubjectId() ? $appointment->getSubject()->getShortcut(): ''),
					$appointment->getSchoolclassId(),
          $appointment->getTeamId(),
					$appointment->getState()
					)) . "\n";
			}
		
			break;
			
		case 'enrolments':
		
			$c=new Criteria();
			$c->add(EnrolmentPeer::YEAR_ID, $year);
			if ($options['class']!='')
			{
				$schoolclass=SchoolclassPeer::retrieveByPK($options['class']);
				if ($schoolclass)
				{
					$c->add(EnrolmentPeer::SCHOOLCLASS_ID, $schoolclass->getId());
				}
			}
		
			$enrolments=EnrolmentPeer::doSelect($c);
			foreach($enrolments as $enrolment)
			{
				echo implode(':', array(
					$enrolment->getSfGuardUser()->getUsername(), 
					$enrolment->getSchoolclassId(),
					$enrolment->getSfGuardUser()->getProfile()->getFirstName(),
					$enrolment->getSfGuardUser()->getProfile()->getLastName(),
					$enrolment->getSfGuardUser()->getProfile()->getBirthdate(),
					$enrolment->getSfGuardUser()->getProfile()->getValidatedEmail(),
					)) . "\n";
			}
			
			break;
		
		default:
			$this->log($this->formatter->format('Not a valid info type requested: ' . $arguments['infotype'], 'ERROR'));
			return false;
		
	}

  }

}
