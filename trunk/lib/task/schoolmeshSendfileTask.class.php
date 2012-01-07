<?php

/**
 * schoolmeshSendfileTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshSendfileTask extends sfBaseTask
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
	
	  new sfCommandOption('subject', null, sfCommandOption::PARAMETER_REQUIRED, 'Subject'), 
	  new sfCommandOption('to', null, sfCommandOption::PARAMETER_REQUIRED, 'To'), 
	  new sfCommandOption('from', null, sfCommandOption::PARAMETER_REQUIRED, 'From'), 
  
    ));

    $this->addArgument('filename', sfCommandArgument::REQUIRED, 'The file to send');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'send-file';
    $this->briefDescription = 'Sends a file by email';
    $this->detailedDescription = <<<EOF
The [schoolmesh:send-file|INFO] task sends a file by email.
Call it with:

  [php symfony schoolmesh:send-file|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here

	$to=$options['to'];
	$from=$options['from']=='' ? array(sfConfig::get('app_mail_bot_address')=>sfConfig::get('app_mail_bot_name')) :  $options['from'];
	$subject=$options['subject']=='' ? 'Attachment sent' : $options['subject'];

	$file=$arguments['filename'];
		
	if(!is_readable($file))
	{
		$this->log($this->formatter->format(sprintf('File "%s" is not readable', $file), 'ERROR'));
		return 1;
	}
	try
	{
		$message=$this->getMailer()
		->compose($from, $to, $subject, '')
		->attach(Swift_Attachment::fromPath($file))
		;
		
		$this->getMailer()->send($message);
	}
	catch (Exception $e)
	{
		$this->log($this->formatter->format(sprintf('File "%s" could not be sent (error: %s)', $file, $e), 'ERROR'));
		return 1;
	}

	$this->log($this->formatter->format(sprintf('File "%s" sent to %s', $file, $to), 'COMMENT'));

  }
}
