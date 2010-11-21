<?php

class schoolmeshAddAttachmentTask extends sfBaseTask
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
	   new sfCommandOption('object-type', null, sfCommandOption::PARAMETER_REQUIRED, 'Object Type', ''), 
	   new sfCommandOption('object-id', null, sfCommandOption::PARAMETER_REQUIRED, 'Object Id', ''), 
	   new sfCommandOption('owner', null, sfCommandOption::PARAMETER_REQUIRED, 'Owner', ''), 
	   new sfCommandOption('file', null, sfCommandOption::PARAMETER_REQUIRED, 'File path', ''), 
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'add-attachment';
    $this->briefDescription = 'Add an attachment to an object';
    $this->detailedDescription = <<<EOF
This task can be used to attach files to objects of different kinds.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

//          $this->logSection('appoint.', sprintf('%d: fixed %d module(s)', $appointment->getId(), $count), null, 'COMMENT');

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

    $file=new smFileInfo($options['file']);

    $vfile = new sfValidatedFile(
      $file->getFileName(),
      $file->getMimeType(),
      $file->getPathName(), 
      $file->getSize(), 
      $file->getPathName());

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
