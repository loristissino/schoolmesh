<?php

/**
 * schoolmeshCreateFoldersForTeachersTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class schoolmeshCreateFoldersForTeachersTask extends sfBaseTask
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
    $this->name             = 'create-folders-for-teachers';
    $this->briefDescription = 'Creates folders for teachers\' materials to share with students';
    $this->detailedDescription = <<<EOF
sd
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	echo "#!/bin/bash\n";
	echo "source /var/schoolmesh/config/schoolmesh.rc\n";


	echo 'sudo find "$POSIX_HOMEDIR_USERS" -mindepth 2 -maxdepth 2 -name "$POSIX_BASEFOLDER" -exec chattr -i "{}" \;' . "\n"; 

	$teachers=sfGuardUserProfilePeer::retrieveUsersOfGuardGroup('teacher');
	
	$students_role=RolePeer::retrieveByPosixName('allievi');
	
	foreach($teachers as $teacher)
	{
		$user=$teacher->getsfGuardUser();
		$profile=$user->getProfile();
		$current_appointments=$profile->getCurrentAppointments();
		if (sizeof($current_appointments)>0)
		{
			echo "echo " .$profile->getFullname() . "\n";
			$teacherfolder='$POSIX_HOMEDIR_USERS/' . $user->getUsername() . '/$POSIX_BASEFOLDER';
			echo 'cd "' . $teacherfolder . '"' . "\n";
			foreach ($current_appointments as $appointment)
			{
				$folder=sprintf('Materiali %s (%s)', $appointment->getSchoolclass()->getId(), $appointment->getSubject()->getDescription());
				echo sprintf('[[ -d "%1$s" ]] || sudo mkdir -v "%1$s" && sudo chown  %2$s:root "%1$s" && sudo chmod 700 "%1$s" && msg_ok "Done with folder \'%1$s\'"', $folder, $user->getUsername()) . "\n";
				
				$students=sfGuardUserProfilePeer::retrieveAllUsers('', 'set', $students_role->getId(), $appointment->getSchoolclass()->getId());
				foreach($students as $student)
				{
					$studentfolder='$POSIX_HOMEDIR_USERS/' . $student->getUsername() . '/$POSIX_BASEFOLDER';
					echo 'echo "making link for ' . $student->getUsername() . '..."' . "\n";
					echo sprintf ('sudo ln -sf "%1$s/%2$s" "%3$s/%2$s"', $teacherfolder, $folder, $studentfolder) . "\n";
				}
			}
		}
	}
	echo 'sudo find "$POSIX_HOMEDIR_USERS" -mindepth 2 -maxdepth 2 -name "$POSIX_BASEFOLDER" -exec chattr +i "{}" \;' . "\n"; 

  }

}
