<?php

/**
 * schoolmeshShowAccountsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshShowAccountsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('user', sfCommandArgument::REQUIRED, 'Username'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'show-accounts';
    $this->briefDescription = 'Shows the account of a user';
    $this->detailedDescription = "";
  }

  protected function execute($arguments = array(), $options = array())
  {
	
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    
    $user=sfGuardUserProfilePeer::retrieveByUsername($arguments['user']);
    if(!$user)
    {
      $this->logSection('user', sprintf('%s not found', $arguments['user']), null, 'ERROR'); 
    }
    else
    {
      $accounts=$user->getProfile()->getAccounts();
      if (sizeof($accounts)>0)
      {
        $i=0;
        foreach($accounts as $account)
        {
          echo sprintf("Account # %d: %s\n", $i++, $account->getAccountType());
        }
      }
      else
      {
        echo "No accounts.\n";
      }
    }
  }
  
}
