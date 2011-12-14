<?php

/**
 * schoolmeshRevokeAndShowPermissionTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshRevokeAndShowPermissionTask extends sfBaseTask
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
    $this->name             = 'revoke-and-show-permission';
    $this->briefDescription = 'Revokes a permission to a user';
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

    // add your code here
    

	$user=sfGuardUserProfilePeer::retrieveByUsername('john.test');
    $this->log('Revoking permission...');
	$user->getProfile()->revokeUserPermission('office');
	$this->log('Has office permission? ' . ($user->getProfile()->hasPermission('office', 2)?'yes':'no'));
  }


}
