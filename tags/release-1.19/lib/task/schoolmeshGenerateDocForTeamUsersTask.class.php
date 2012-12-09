<?php

/**
 * schoolmeshGenerateDocForTeamUsersTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshGenerateDocForTeamUsersTask extends sfBaseTask
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
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
      new sfCommandOption('format', null, sfCommandOption::PARAMETER_REQUIRED, 'The format to use for output', 'odt'),
      new sfCommandOption('sleep', null, sfCommandOption::PARAMETER_REQUIRED, 'The number of seconds to wait between a profile and the next one', '10'),
      new sfCommandOption('email-attachment', null, sfCommandOption::PARAMETER_NONE, 'Whether the generated file should be sent to the user'),
    ));

    $this->addArgument('team-id', sfCommandArgument::REQUIRED, 'The id of the team to generate the doc for');
    
    $this->addArgument('function', sfCommandArgument::REQUIRED, 'The name of the function to call in the custom class');
    
    /*
    $this->addArgument('key', sfCommandArgument::REQUIRED, 'The field to be used for retrieval of users (looking in import_code field');
    $this->addArgument('filename', sfCommandArgument::REQUIRED, 'The yaml file to read data from');
    */
    
    $this->namespace        = 'schoolmesh';
    $this->name             = 'generate-doc-for-team-users';
    $this->briefDescription = 'Generates a document for all the members of a team, and optionally sends it individually by email';
    $this->detailedDescription = <<<EOF
This task will generate a document for all the members of a team.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $team=TeamPeer::retrieveByPK($arguments['team-id']);
    
    if(!$team)
    {
      $this->logSection('team', 'Team ' . $arguments['team-id'] . ' does not exist', null, 'ERROR');
      return 1;
    }
    
    $htmlindex=array('<ul>');
    
    foreach($team->getComponents() as $component)
    {
      $profile = $component->getsfGuardUser()->getProfile();
      $this->logSection($profile->getUsername(), $profile->getFullName(), null, 'COMMENT');
      
      try
      {
        $result = $profile->getCustomResult($arguments['function'], $component->getUnserializedDetails(), array('format'=>$options['format']), $this->context);
        $generated=true;
      }
      catch (Exception $e)
      {
        $generated=false;
      }
      
      if($generated)
        {
        switch($result['result'])
        {
          case 'notice':
            $odf=$result['content'];
            $odf->saveFile();
            rename($odf->getFilename(), $odf->getAttributedFilename());
            $this->logSection('file+', $odf->getAttributedFilename(), null, 'NOTICE');
            break;
          case 'error':
            $this->logSection('template', $result['message'], null, 'ERROR');
            break;
         }
         
         $htmlindex[]=sprintf('<li><a href="%s">%s</a></li>', $odf->getAttributedFilename(), $profile->getFullName());
         
         if($options['format']!='odt')
         {
           echo 'Waiting for ' . $options['sleep'] . " seconds\n";
           sleep($options['sleep']);
         }
         
         if($options['email-attachment'])
         {
           if($profile->getEmail())
           {
             $message = new GeneratedDocMessage($profile, $this->context);
             $message->attach(Swift_Attachment::fromPath($odf->getAttributedFilename()));
           try
              {
                $this->context->getMailer()->send($message);
                $this->logSection('mail@', $profile->getEmail(), null, 'NOTICE');
              }
              catch (Exception $e)
              {
                $this->logSection('mail@', $profile->getEmail(), null, 'ERROR');
              }
           }
           else
           {
              $this->logSection('mail@', 'no email address', null, 'ERROR');
             
           }
         }
       }
      else
      {
        $this->logSection('file', 'The file could not be generated', null, 'ERROR');
      }
       
    }

    $htmlindex[]='</ul>';
    $indexfilename='/tmp/index' . date('d-m-Y-His'). '.html.txt';
    $indexfile=fopen($indexfilename, 'w');
    fwrite($indexfile, implode("\n", $htmlindex));
    fclose($indexfile);
    $this->logSection('file+', $indexfilename, null, 'NOTICE');
    
    if ($options['dry-run'])
    {
      echo "Rolled back!\n";
      $con->rollback();
    }
    else
    {
      echo "Executed!\n";
      $con->commit();
    }


  }

}
