<?php

/**
 * schoolmeshAddAttachmentTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */
class schoolmeshAddAttachmentTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
	   new sfCommandOption('object-type', null, sfCommandOption::PARAMETER_REQUIRED, 'Object Type', ''), 
	   new sfCommandOption('object-id', null, sfCommandOption::PARAMETER_REQUIRED, 'Object Id', ''), 
	   new sfCommandOption('owner', null, sfCommandOption::PARAMETER_REQUIRED, 'Owner', ''), 
	   new sfCommandOption('file', null, sfCommandOption::PARAMETER_REQUIRED, 'File path', ''), 
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'add-attachment';
    $this->briefDescription = 'Adds an attachment to an object';
    $this->detailedDescription = <<<EOF
The [schoolmesh:add-attachment|INFO] task can be used to attach files to objects of different kinds.
Use it whenever you need to attach files to objects in a batch procedure.

Call it with:

   symfony schoolmesh:add-attachment --application=frontend --env=prod object-type object-id owner file-path

Examples:

   symfony schoolmesh:add-attachment --application=frontend --env=prod Appointment 145 john.doe /tmp/myfile.odt
   symfony schoolmesh:add-attachment --application=frontend --env=prod Schoolproject 14 john.doe /tmp/myfile.odt
   symfony schoolmesh:add-attachment --application=frontend --env=prod ProjDeadline 156 john.doe /tmp/myfile.odt

EOF;


  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    if(!(file_exists($options['file']) && is_readable($options['file'])))
    {
      $this->logSection('file*', sprintf('File «%s» could not be read.', $options['file']), null, 'ERROR');
      return;
    }
    
    $user=sfGuardUserProfilePeer::retrieveByUsername($options['owner']);
    
    if(!$user)
    {
      $this->logSection('user*', sprintf('User «%s» does not exist.', $options['owner']), null, 'ERROR');
      return;
    }

    $vfile=Generic::getValidatedFile($options['file']);

    $table_id=AttachmentFilePeer::getBaseTableId($options['object-type']);
    if(!$table_id)
    {
      $this->logSection('type*', sprintf('Type «%s» does not allow attachments.', $options['object-type']), null, 'ERROR');
      return;
    }

    $result = AttachmentFilePeer::addAttachmentRoughly(
      $connection, 
      $options['object-id'], 
      $table_id,
      AttachmentFilePeer::getPrefix($options['object-type']), 
      $user->getId(), 
      $vfile);
    
    if($result['result']=='notice')
    {
      $this->logSection('file+', sprintf('File «%s» attached to object %d (%s).', $vfile->getOriginalName(), $options['object-id'], $options['object-type']), null, 'NOTICE');
    }
    else
    {
      $this->logSection('file*', sprintf('File «%s» not attached to object %d (%s).', $vfile->getOriginalName(), $options['object-id'], $options['object-type']), null, 'ERROR');
      echo $result['message'] . "\n";
    }
  }
    

}
