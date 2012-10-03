<?php

/**
 * schoolmeshAddPermissionTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshAddPermissionTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('user', sfCommandArgument::REQUIRED, 'User'),
       new sfCommandArgument('permission', sfCommandArgument::REQUIRED, 'Permission'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'add-permission';
    $this->briefDescription = 'Adds a permission to a user';
    $this->detailedDescription = <<<EOF
The [schoolmesh:add-permission|INFO] task can be used to add a permission to a user.

Call it with:

   symfony schoolmesh:add-permission --application=frontend --env=prod user permission

Examples:

   symfony schoolmesh:add-permission --application=frontend --env=prod john.doe proj_view

EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $user=sfGuardUserProfilePeer::retrieveByUsername($arguments['user']);
    if(!$user)
    {
      $this->logSection('user', sprintf('%s not found', $arguments['user']), null, 'ERROR'); 
    }
    else
    {
      $user->addPermissionByName($arguments['permission']);
      $this->logSection('user', sprintf('Permission %s added', $arguments['permission']), null, 'NOTICE'); 
    }

  }
}
