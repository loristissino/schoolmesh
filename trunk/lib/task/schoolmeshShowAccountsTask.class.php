<?php

class schoolmeshShowAccountsTask extends sfBaseTask
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
    
	$user=sfGuardUserProfilePeer::retrieveByUsername('john.test');
	
	$accounts=$user->getProfile()->getAccounts();
	
	if (sizeof($accounts)>0)
	{
		
		$i=0;
		foreach($accounts as $account)
		{
			echo "Account # " .$i++ . "\n";
			$account->sayHallo();
			echo $account->getAccountType() . "\n";
		}
	}
	else
	{
		echo "No accounts\n";
	}

  }
  
}
