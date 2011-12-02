<?php

/**
 * schoolmeshHelloTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshHelloTask extends sfBaseTask
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
    $this->name             = 'hello';
    $this->briefDescription = 'Says hello';
    $this->detailedDescription = <<<EOF
The [schoolmesh:hello|INFO] task does things.
Call it with:

  [php symfony schoolmesh:hello|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    
    $this->log('Hello, world!');

/*	$message=SystemMessagePeer::retrieveByKey('WP_APPROVED');

    $this->log($message->getContent('it'));
    $this->log($message->getContent('en'));
    $this->log($message->getContent());
	
	return;

*/
    $users = sfGuardUserProfilePeer::doSelect(new Criteria());
    foreach($users as $user)
    {
    $this->log($this->formatter->format('  Hello, ' . $user->getFullName(), 'INFO'));
	
	$checkList=new CheckList();
	$availableAccounts=array('posix');
	$user->checkAccounts($availableAccounts, $checkList);
	
/*	$permissions=$user->getsfGuardUser()->getAllPermissionNames();
	if (sizeof($permissions)>0)
		foreach($permissions as $permission)
		{
			$this->log($this->formatter->format('    -> ' . $permission, 'COMMENT'));

		}
*/
    }
/*	
$user=sfGuardUserProfilePeer::retrieveByUsername('john.test');
echo 'Has office permission? ' . ($user->getProfile()->hasPermission('office')?'yes':'no') . "\n";
echo "Adding permission...\n";
$user->addPermissionByName('office');
echo 'Has office permission? ' . ($user->getProfile()->hasPermission('office')?'yes':'no') . "\n";
echo "Revoking permission...\n";
$user->getProfile()->revokeUserPermission('office');
sleep(1);
echo 'Has office permission? ' . ($user->getProfile()->hasPermission('office')?'yes':'no') . "\n";
*/

		foreach($checkList->getAllChecks() as $check)
		{
			echo $check->getCommand() . "\n";			
		}
	}

}
