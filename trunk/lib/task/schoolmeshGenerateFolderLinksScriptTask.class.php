<?php

/**
 * schoolmeshGenerateFolderLinksScriptTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshGenerateFolderLinksScriptTask extends sfBaseTask
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
	    new sfCommandOption('folder', null, sfCommandOption::PARAMETER_REQUIRED, 'Basic folder', 'School'), 
	    new sfCommandOption('sambadir', null, sfCommandOption::PARAMETER_REQUIRED, 'Samba shared folder', '/var/myschool/teachers'), 

    ));
    
    $this->addArgument('teacher', sfCommandArgument::REQUIRED, 'Teacher\'s username');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'generate-folder-links-script';
    $this->briefDescription = 'Generates a bash script for folder links between students\' and teachers\'s home directories';
    $this->detailedDescription = <<<EOF

EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $year=YearPeer::retrieveByPK(sfConfig::get('app_config_current_year'));

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
    
    $teacher=sfGuardUserProfilePeer::retrieveByUsername($arguments['teacher']);
    
    if(!$teacher)
    {
      $this->logSection('teacher?', sprintf('%s has not been found', $arguments['teacher']), null, 'ERROR');
      return 1;
    }

    if($teacher->getProfile()->getRole()->getPosixName()!=sfConfig::get('app_config_teachers_default_posix_group'))
    {
      $this->logSection('teacher?', sprintf('%s is not a teacher', $arguments['teacher']), null, 'ERROR');
      return 1;
    }
    
    if(!$teacher->getIsActive())
    {
      $this->logSection('teacher?', sprintf('%s is not active', $arguments['teacher']), null, 'ERROR');
      return 1;
    }
    
    $folder=$options['folder'];
    
    echo "#!/bin/bash\n";
    
    $teacherfolder=sprintf('~%s/%s', $teacher->getUsername(), $folder);
    echo sprintf('sudo chattr -V -i %s || exit 1', $teacherfolder) . "\n";
    
    $sambafolder=sprintf('%s/%s',
      $options['sambadir'],
      $teacher->getUsername()
      );
    
    echo sprintf('  if [[ ! -d %s ]]; then', $sambafolder) . "\n";
    
    echo sprintf('    sudo mkdir %s %s/public',
      $sambafolder,
      $teacherfolder
      ) . "\n";
    echo sprintf('    sudo chown %s %s',
      $teacher->getUsername(),
      $sambafolder
      ) . "\n";

    echo sprintf('  fi', $sambafolder) . "\n";

    
    foreach($teacher->getProfile()->getCurrentAppointments() as $appointment)
    {
      echo '# ' . $appointment->getSchoolclassId() . "\n";
      
      $classdirname=str_replace('/', '-', $year). '/'. $appointment->getSchoolclassId();
      
      echo sprintf('  sudo mkdir -p %s/"%s"  || exit 2', $teacherfolder, $classdirname) . "\n";
      echo sprintf('  sudo chown %s %s/"%s" || exit 3', $teacher->getUsername(), $teacherfolder, $classdirname) . "\n";
      echo sprintf('  sudo find %s/"%s" -type l -exec rm {} \;', $teacherfolder, $classdirname) . "\n";
      
      $schoolclass=SchoolclassPeer::retrieveByPK($appointment->getSchoolclassId());
      $enrolments=$schoolclass->getCurrentEnrolments();
      
      $i=0;
      foreach($enrolments as $enrolment)
      {if(!$appointment->getTeamId() or $enrolment->getsfGuardUser()->getProfile()->getBelongsToTeamById($appointment->getTeamId()))
        {
          $studentdirname=sprintf('%02d %s', ++$i, $enrolment->getsfGuardUser()->getProfile());
          echo sprintf('     sudo ln -sfv ~%s %s/"%s/%s" || exit 4', $enrolment->getsfGuardUser()->getUsername(), $teacherfolder, $classdirname, $studentdirname) . "\n";
          echo sprintf('     sudo chattr -i ~%s/%s || exit 5', $enrolment->getsfGuardUser()->getUsername(), $folder) . "\n";
          echo sprintf('     sudo setfacl -R -m user:%s:rx ~%s || exit 6', $teacher->getUsername(), $enrolment->getsfGuardUser()->getUsername()) . "\n";
          echo sprintf('     sudo chattr +i ~%s/%s || exit 5', $enrolment->getsfGuardUser()->getUsername(), $folder) . "\n";
        }
      }
    }
    
    echo sprintf('sudo chattr -V +i ~%s/%s || exit 1', $teacher->getUsername(), $folder) . "\n";

  } // execute function

}  // class
