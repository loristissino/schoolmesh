<?php

/**
 * schoolmeshGenerateAppointmentDocsIndexTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshGenerateAppointmentDocsIndexTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('type', sfCommandArgument::REQUIRED, 'wp=workplan or fr=report'),
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
    $this->name             = 'generate-appointment-docs-index';
    $this->briefDescription = 'Generates appointment docs index file from attachments';
    $this->detailedDescription = "Call it like this:

php symfony schoolmesh:generate-appointment-docs-index --application=frontend --env=prod wp data/documents/workplans2011-12.yml workplans2011-12 --year=2011/12

The destination directory must exist; the output file is overwritten, if it already exists.

";
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

    $type=strtoupper($arguments['type']);
    switch($type)
    {
      case 'W':
      case 'WP':
        $title=$this->context->getI18N()->__('Workplans of year %year%', array('%year%'=>$year->getDescription()));
        $state=(string)Workflow::WP_APPROVED;
        break;
      case 'R':
      case 'FR':
        $title=$this->context->getI18N()->__('Final reports of year %year%', array('%year%'=>$year->getDescription()));
        $state=(string)Workflow::FR_APPROVED;
        break;
      default:
        $this->log($this->formatter->format('Not a valid type specified ' . $arguments['type'], 'ERROR'));
        return false;
    }


    $dirname=$arguments['directory'];
    

    $symlinksdir=sfConfig::get('app_documents_main_directory').'/'.$dirname;
    $attachmentsdir=sfConfig::get('app_documents_attachments');
    
    $yaml=array();
    $yaml['basedir']=sfConfig::get('app_documents_main_directory') . '/';
    $yaml['title']=$title;

    if(!file_exists($symlinksdir))
    {
      mkdir($symlinksdir);
    }

    $count=0;
    foreach(AppointmentPeer::retrieveByYear($year) as $Appointment)
    {
      foreach($Appointment->getAttachmentFiles() as $AttachmentFile)
      {
        if($AttachmentFile->getIsPublic() && strpos($AttachmentFile->getOriginalFileName(), $state))
        // FIXME -- we should put the state in the DB, attachments table...
        {
          $count++;
          $linkpath=$symlinksdir.'/'.$AttachmentFile->getOriginalFileName();
          symlink($attachmentsdir.'/'.$AttachmentFile->getUniqid(), $linkpath);
          $yaml['sections'][$Appointment->getSchoolclassId()]['title']=$Appointment->getSchoolclassId();
          $yaml['sections'][$Appointment->getSchoolclassId()]['links'][$count]=array(
            'title'=>$AttachmentFile->getOriginalFileName(),
            'file'=>$dirname.'/'.$AttachmentFile->getOriginalFileName(),
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
