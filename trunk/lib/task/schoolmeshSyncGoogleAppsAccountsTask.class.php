<?php

class schoolmeshSyncGoogleAppsAccountsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

	$this->addArgument('file', sfCommandArgument::REQUIRED, 'The spreadsheet to import appointments from');


    $this->namespace        = 'schoolmesh';
    $this->name             = 'sync-googleapps-accounts';
    $this->briefDescription = 'Sesynchronizes google apps accounts';
    $this->detailedDescription = <<<EOF
The [schoolmesh:sync-googleappas-accounts|INFO] task syncronizes google apps accounts.
Call it with:

  [php symfony schoolmesh:sync-googleapps-accounts|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
  
  
//	$this->logSection(sfContext::getInstance()->getI18N()->__('Workplan'), 'COMMENT');
	
	
//	return;
	
	$file=$arguments['file'];
	
  $domain=sfConfig::get('app_config_googleapps_domain');
  
	$this->logSection('sync-googleapps-accounts', 'Synchronizing accounts from '. $file . '.');
  $this->logSection('domain', $domain);
  
	
	if (!is_readable($file))
		{
			$this->log($this->formatter->format(sprintf('File %s is not readable', $file), 'ERROR'));
			return 1;
		}

	$row = 0;
	$synchronized=0;
	$skipped=0;
  $unknown_usernames=array();
	
	$handle = fopen($file, "r");
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		//$num = count($data);
		//echo "$num fields in line $row:\n";

		$row++;

		if ($row==1)
			{
				// We could check whether the field names are correct...
			continue;  // we skip the first line
			}

    $account_name = $data[2];
    $date=$data[0];
    
    $username = substr($account_name, 0, strlen($account_name)-strlen($domain )-1);
    
    //echo $row . ": ", $username . ":";
    
    $user=sfGuardUserProfilePeer::retrieveByUsername($username);
    
    if($user)
    {
//      echo $user->getProfile()->getFullName();
      $account=$user->getProfile()->getAccountByType('googleapps');
      if (!$account)
      {
        $account= new GoogleappsAccount();
        $account
        ->setUserId($user->getId());
        $added=true;
      }
      else
      {
        $added=false;
      }
      
      if($date<$account->getAccountInfo('date'))
      {
        $account
        ->updateInfoFromDataLine($data)
        ->save();
        $this->logSection('account'.($added?'+':''), $user->getProfile()->getFullName(), null, 'INFO');
        $synchronized++;
      }
      else
      {
        $this->logSection('account'.($added?'+':''), $user->getProfile()->getFullName() . ' (already up to date)', null, 'COMMENT');
        $skipped++;
      }
    
      unset($user);
      
    }
    else
    {
      $unknown_usernames[]=$username;
    }
    
    
	}


	fclose($handle);

	$this->log($this->formatter->format(sprintf('Synchronized %d accounts, skipped %d', $synchronized, $skipped), 'COMMENT'));

  foreach ($unknown_usernames as $username)
  {
    $this->logSection('unknown', $username, null, 'COMMENT');
  }
	
  }
}
