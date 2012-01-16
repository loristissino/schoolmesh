<?php

/**
 * schoolmeshFixTeamsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshFixTeamsTask extends sfBaseTask
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
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
    ));


    $this->namespace        = 'schoolmesh';
    $this->name             = 'fix-teams';
    $this->briefDescription = 'Fixes teams, removing expired items and creating new needed teams.';
    $this->detailedDescription = <<<EOF
This task will remove people for teams when expiry is reached and create/populate new teams if needed.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $teams=TeamPeer::doSelect(new Criteria());
    foreach($teams as $team)
    {
      $this->logSection('team', sprintf('== %s ==', $team), null, 'COMMENT'); 
      $components=$team->getComponents();
      foreach($components as $component)
      {
        if($component->getExpiry('U') && (time() > $component->getExpiry('U')))
        {
          $component->delete($con);
          $this->logSection('userteam-', $component->getsfGuardUser()->getUsername(), null, 'NOTICE'); 
        }
      }
    }
    
    $prefix=sfConfig::get('app_config_class_teachersteam_prefix');
    $description=sfConfig::get('app_config_class_teachersteam_name');
    $qualitycode=sfConfig::get('app_config_class_teachersteam_quality_code', strtoupper($prefix));
    
    $depconfig=sfYaml::load(sfConfig::get('app_config_departments_config'));
    if(!$depconfig['departments'])
    {
      throw new Exception('Missing or invalid departments configuration file');
    }
    
    foreach($depconfig['departments']['list'] as $depkey=>$dep)
    {
      foreach($dep['subjects'] as $key=>$subj)
      {
        $depconfig['departments']['subjects'][$subj]=$depkey;
      }
    }
    
    $role=RolePeer::retrieveByPosixName(sfConfig::get('app_config_default_teams_role'));
    
    $teamscache=array();
    
    foreach(sfGuardUserProfilePeer::retrieveTeachers() as $profile)
    {
      echo $profile->getFullname() . "\n";
      $departments=array();
      foreach($profile->getCurrentAppointments() as $appointment)
      {
        echo '  ' . $appointment . "\n";
        $teamname=$prefix.$appointment->getSchoolclassId();
        if (!array_key_exists($teamname, $teamscache))
        {
          $team=TeamPeer::retrieveByPosixName($teamname);
          if(!$team)
          {
            $team=new Team();
            $team
            ->setPosixName($teamname)
            ->setDescription($description. ' '. $appointment->getSchoolclass())
            ->setQualityCode($qualitycode)
            ->save($con)
            ;
            $this->logSection('team+', $teamname, null, 'NOTICE');
            $teamscache[$teamname]=$team;
          }
        }
        else
        {
          $team=$teamscache[$teamname];
        }
				$profile->addToTeam($team, $role, $appointment->getYear()->getEndDate());
        if(array_key_exists($appointment->getSubject()->getShortcut(), $depconfig['departments']['subjects']))
        {
          $departments[$depconfig['departments']['subjects'][$appointment->getSubject()->getShortcut()]]=1;
        }
      }
      if (sizeof($departments)>0)
      {
        foreach($departments as $key=>$value)
        {
          $teamname=$key;
          if (!array_key_exists($teamname, $teamscache))
          {
            $team=TeamPeer::retrieveByPosixName($teamname);
            if(!$team)
            {
              $team=new Team();
              $team
              ->setPosixName($teamname)
              ->setDescription($depconfig['departments']['list'][$teamname]['description'])
              ->setQualityCode($depconfig['departments']['config']['quality_code'])
              ->setNeedsMailingList($depconfig['departments']['config']['needs_mailing_list'])
              ->setNeedsFolder($depconfig['departments']['config']['needs_folder'])
              ->save($con)
              ;
              $this->logSection('team+', $teamname, null, 'NOTICE');
              $teamscache[$teamname]=$team;
            }
          }
          else
          {
            $team=$teamscache[$teamname];
          }
          $profile->addToTeam($team, $role, $appointment->getYear()->getEndDate());
          
        }
        
      }
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


  }

}
