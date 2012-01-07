<?php

/**
 * schoolmeshShowPermissionTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshShowPermissionTask extends sfBaseTask
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
    $this->name             = 'show-permission';
    $this->briefDescription = 'Shows if a user has a permission';
    $this->detailedDescription = <<<EOF
The [schoolmesh:hello|INFO] task does things.
Call it with:

  [php symfony schoolmesh:addPermission|INFO]
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
      $this->log(sprintf('Has %s permission? %s.', $arguments['permission'], ($user->getProfile()->hasPermission($arguments['permission'])?'yes':'no')));
    }

  }
}
