<?php

/**
 * schoolmeshAddUsersToTeamTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshAddUsersToTeamTask extends sfBaseTask
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
      new sfCOmmandOption('dont-import', null, sfCommandOption::PARAMETER_REQUIRED, 'A comma-separated list of details that should not be imported in details field', ''),
    ));


    $this->addArgument('team-id', sfCommandArgument::REQUIRED, 'The id of the team to add the users to');
    $this->addArgument('role-id', sfCommandArgument::REQUIRED, 'The id of the role to use');
    
    $this->addArgument('key', sfCommandArgument::REQUIRED, 'The field to be used for retrieval of users (looking in import_code field');
    $this->addArgument('filename', sfCommandArgument::REQUIRED, 'The yaml file to read data from');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'add-users-to-team';
    $this->briefDescription = 'Adds users to a team, reading data from a yaml file.';
    $this->detailedDescription = <<<EOF
This task will read some information about users from a yaml file and populate a team with them.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $team=TeamPeer::retrieveByPK($arguments['team-id']);
    
    if(!$team)
    {
      $this->logSection('team', 'Team ' . $arguments['team-id'] . ' does not exist', null, 'ERROR');
      return 1;
    }

    $role=RolePeer::retrieveByPK($arguments['role-id']);
    
    if(!$role)
    {
      $this->logSection('role', 'Role ' . $arguments['role-id'] . ' does not exist', null, 'ERROR');
      return 1;
    }
    
    $key=$arguments['key'];

    $filename=$arguments['filename'];
    
    if (!file_exists($filename))
    {
      $this->logSection('file', 'File ' . $filename . ' does not exist', null, 'ERROR');
      return 1;
    }
        
    $document = sfYaml::load($filename);
    
    $dont_import=$options['dont-import'];
    if($dont_import != '')
    {
      if(strpos($dont_import, ','))
      {
        $fields_to_remove=explode(',', $dont_import);
      }
      else
      {
        $fields_to_remove=array($dont_import);
      }
    }
        
    foreach($document['users'] as $user)
    {
      $profile=sfGuardUserProfilePeer::retrieveByImportCode($user[$key]);
      if($profile)
      {
        $this->logSection($user[$key], 'found', null, 'COMMENT');
        $profile->addToTeam(null, $team, $role, null, '', '', '',  $this->context);
        
        if(($profile->getEmailStateDescription()=='undefined') and isset($user['email']))
        {
          $profile
          ->setEmail($user['email'])
          ->setEmailState(sfGuardUserProfilePeer::EMAIL_UNVERIFIED)
          ->save($con)
          ;
          $this->logSection('email+', 'added email address of ' . $profile->getFullName(), null, 'NOTICE');
        }
        
        $this->logSection($team->getPosixName() . '+', 'user ' . $profile->getFullName() . ' added to team', null, 'NOTICE');
        $userteam = UserTeamPeer::retrieveUserTeam($profile->getSfGuardUser(), $team);
        unset($user[$key]);
        foreach($fields_to_remove as $field_to_remove)
        {
          unset($user[$field_to_remove]);
        }
        $userteam->setDetails(serialize($user))->save();
        $profile->updateLuceneIndex();
      }
      else
      {
        $this->logSection($user[$key], 'not found', null, 'ERROR');
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
