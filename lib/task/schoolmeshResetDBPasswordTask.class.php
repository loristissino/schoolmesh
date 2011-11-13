<?php

class schoolmeshResetDBPasswordTask extends sfBaseTask
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
    
    $this->addArgument('username', sfCommandArgument::REQUIRED, 'The user you must reset the password for');
    $this->addArgument('password', sfCommandArgument::REQUIRED, 'The password');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'reset-db-password';
    $this->briefDescription = 'Reset the DB password of the user for the main Schoolmesh account';
    $this->detailedDescription = <<<EOF
This task is useful only if you do not set an external authentication method.
It is not secure, since we pass the password on the command line.
(But we do not need security here at the moment)
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    if (!$user=sfGuardUserPeer::retrieveByUsername($arguments['username']))
    {
      echo "user not found\n";
      return 1;
    }
    
    $user->setPassword($arguments['password']);
    $user->save();
    
    echo "password changed\n";
  
  } // execute function

}  // class