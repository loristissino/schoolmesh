<?php

class schoolmeshImportUsersTask extends sfBaseTask
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
	
	$this->addArgument('file', sfCommandArgument::OPTIONAL, 'The spreadsheet to import users from', 'web/uploads/users.csv');


    $this->namespace        = 'schoolmesh';
    $this->name             = 'import-users';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [schoolmesh:importUsers|INFO] task import users from a CSV file.
Call it with:

  [php symfony schoolmesh:import-users|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	$file=$arguments['file'];
	
	$this->logSection('import-users', 'Importing users from '. $file . '.');
	
	if (!is_readable($file))
		{
			$this->log($this->formatter->format(sprintf('File %s is not readable', $file), 'ERROR'));
			return 1;
		}

	$row = 0;
	$imported=0;
	$skipped=0;
	
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

		list($first_name, $middle_name, $last_name, $username, $sex, $role, $birthdate, $birthplace, $email, $import_code)=$data; 

		$this->log($this->formatter->format(sprintf('Importing %s (%s %s)', $username, $first_name, $last_name), 'COMMENT'));
		
		
		$sfUser= sfGuardUserProfilePeer::retrieveByUsername($username);
		if($sfUser)
			{
				$this->log($this->formatter->format(sprintf('   Username %s already exists, skipping', $username), 'COMMENT'));
				$skipped++;
				continue;
			}
			
		$myrole = RolePeer::retrieveByDescription($role);
		if(!$myrole)
			{
				$this->log($this->formatter->format(sprintf('   Role %s does not exist', $role), 'ERROR'));
				$skipped++;
				continue;
			}

		if ($sex!='M' and $sex!='F')
			{
				$this->log($this->formatter->format(sprintf('   Sex %s is not valid', $sex), 'ERROR'));
				$skipped++;
				continue;
			}

		$user = new sfGuardUser();
		$user->setUsername($username);
		$user->setPassword($first_name . 'p');
		$user->save();
		
		$userprofile = new sfGuardUserProfile();
		$userprofile->setUserId($user->getId());
		$userprofile->setFirstName($first_name);
		$userprofile->setMiddleName($middle_name);
		$userprofile->setLastName($last_name);
		$userprofile->setBirthdate($birthdate);
		$userprofile->setBirthplace($birthplace);
		$userprofile->setEmail($email);
		$userprofile->setSex($sex);
		$userprofile->setRole($myrole);
		$userprofile->save();
		
		$imported++;
		$this->log($this->formatter->format(sprintf('   Username %s imported', $username), 'INFO'));
		
	}
	fclose($handle);

	$this->log($this->formatter->format(sprintf('Imported correctly %d users, skipped %d', $imported, $skipped), 'COMMENT'));


  }
}
