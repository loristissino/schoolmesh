<?php

/**
 * schoolmeshResetDBPasswordTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

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
      new sfCommandOption('base64', null, sfCommandOption::PARAMETER_NONE, 'Whether the password is encoded in base64'),
      new sfCommandOption('generate', null, sfCommandOption::PARAMETER_NONE, 'Whether the password has to be stored in plaintext in the profile'),
      // add your own options here
    ));
    
    $this->addArgument('username', sfCommandArgument::REQUIRED, 'The user you must reset the password for');
    $this->addArgument('password', sfCommandArgument::REQUIRED, 'The password');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'reset-db-password';
    $this->briefDescription = 'Resets the DB password of the user for the main Schoolmesh account';
    $this->detailedDescription = <<<EOF
This task is can be used to set or generate a password for the user 
specified.
The password can be given, like when you must synchronize it from 
another application, or can be generated randomly.
If it is given, you may chose to have it encoded in base64, to avoid 
problems with spaces or quotes.
When it is generated, the password is stored on the database in 
plaintext (and the one given on command line is ignored). This is 
useful when you want to retrieve the passwords later, to generate 
welcome letters or email messages.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    if (!$user=sfGuardUserPeer::retrieveByUsername($arguments['username']))
    {
      $this->logSection($arguments['username'], 'User not found', null, 'ERROR');
      return 1;
    }

    if($options['generate'])
    {
      $password=Authentication::generateRandomPassword();
      $message='Password generated and stored: «'. $password . '»';
    }
    else
    {
      if($options['base64'])
      {
        $password=base64_decode($arguments['password']);
      }
      else
      {
        $password=$arguments['password'];
      }
      $message='Password changed: '. $password;
    }
    
    $user->setPassword($password);
    $user->save();

    if($options['generate'])
    {
      $user->getProfile()
      ->setPlaintextPassword($password)
      ->setStoredEncryptedPassword($password)
      ->save();
    }

    $this->logSection($arguments['username'], $message, null, 'NOTICE');
  
  } // execute function

}  // class
