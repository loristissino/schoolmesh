<?php

/**
 * schoolmeshGenerateWorkplansIndexTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshGenerateWorkplansIndexTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('outputfile', sfCommandArgument::REQUIRED, 'Output file'),
       new sfCommandArgument('directory', sfCommandArgument::REQUIRED, 'Directory for symlinks'),
     ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
      
 	   new sfCommandOption('year', null, sfCommandOption::PARAMETER_REQUIRED, 'School year', ''), 
            
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'generate-workplans-index';
    $this->briefDescription = 'Generate workplans index file from attachments';
    $this->detailedDescription = "";
  }

  protected function execute($arguments = array(), $options = array())
  {
	
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    // add your code here
    
    $year=YearPeer::retrieveByDescription($options['year']);
    if (!$year)
    {
      $this->log($this->formatter->format('Not a valid year specified: ' . $options['year'], 'ERROR'));
      return false;
    }

    $dirname=$arguments['directory'];

    $symlinksdir=sfConfig::get('app_documents_main_directory').'/'.$dirname;
    $attachmentsdir=sfConfig::get('app_documents_attachments');
    
    $yaml=array();
    $yaml['basedir']=sfConfig::get('app_documents_main_directory') . '/';
    $yaml['title']=$this->context->getI18N()->__('Workplans of year %year%', array('%year%'=>$year->getDescription()));

    if(!file_exists($symlinksdir))
    {
      mkdir($symlinksdir);
    }

    $count=0;
    foreach(AppointmentPeer::retrieveByYear($year) as $Appointment)
    {
      foreach($Appointment->getAttachmentFiles() as $AttachmentFile)
      {
        if($AttachmentFile->getIsPublic())
        {
          $count++;
          $linkpath=$symlinksdir.'/'.$AttachmentFile->getUniqid();
          symlink($attachmentsdir.'/'.$AttachmentFile->getUniqid(), $linkpath);
          $yaml['sections'][$Appointment->getSchoolclassId()]['title']=$Appointment->getSchoolclassId();
          $yaml['sections'][$Appointment->getSchoolclassId()]['links'][$count]=array(
            'title'=>$AttachmentFile->getOriginalFileName(),
            'file'=>$dirname.'/'.$AttachmentFile->getUniqId(),
            'date'=>date('U')
            );
          
          $this->logSection('file+', $linkpath, null, 'NOTICE');
        }
      }
    }
    
    $fp=fopen($arguments['outputfile'], 'w');
    fwrite($fp, sfYaml::dump($yaml, 5));
    fclose($fp);
    $this->logSection('file+', $arguments['outputfile'], null, 'NOTICE');

  }
  
}
