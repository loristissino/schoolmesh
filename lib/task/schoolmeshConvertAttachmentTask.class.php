<?php

/**
 * schoolmeshConvertAttachmentTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshConvertAttachmentTask extends sfBaseTask
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
      new sfCommandOption('id', null, sfCommandOption::PARAMETER_OPTIONAL, 'The id of the attachment file', 0),
      new sfCommandOption('uniqid', null, sfCommandOption::PARAMETER_OPTIONAL, 'The unique identifier of the attachment file', ''),
      new sfCommandOption('format', null, sfCommandOption::PARAMETER_OPTIONAL, 'The format to use', 'pdf'),
    ));


    $this->namespace        = 'schoolmesh';
    $this->name             = 'convert-attachment';
    $this->briefDescription = 'Changes the format of an attachment, specified either by id or uniqid';
    $this->detailedDescription = <<<EOF
This task will remove an attachment, placing in its place the equivalent 
in another format, and updating the db consequently.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $format=$options['format'];
    if(!in_array($format, array('odt', 'doc', 'pdf', 'rtf')))
    {
      throw new OdfDocFiletypeException('Not a valid file type specified: '. $format);
    }

    $Attachment=AttachmentFilePeer::retrieveByPK($options['id']);
    if (!$Attachment)
    {
      $Attachment=AttachmentFilePeer::retrieveByUniqId($options['uniqid']);
    }
    if (!$Attachment)
    {
      throw new Exception('Attachment not identified or not found');
    }
    
    $this->logSection('test', $Attachment->getFilename() . $Attachment->getOriginalFileName());

    try
    {
      $oldfile=$Attachment->getFilename();
      $pathinfo_oldfile = pathinfo($oldfile);
      
      $filename=$pathinfo_oldfile['filename'].'.'.$format;
      $newfile=$pathinfo_oldfile['dirname'].'/'.$filename;
      
      OdfDocPeer::convertDocument(
        $format,
        $oldfile,
        $newfile
        );
        
      $fileinfo=new smFileInfo($newfile);
      
      $md5sum=$fileinfo->getMd5Sum();
      
      if($md5sum)
      {

        $ofn=$Attachment->getOriginalFileName();
        list($fn, $ext)=explode('.', $ofn);
        $ofn=$fn . '.'. $format;
        
        $Attachment
        ->setInternetMediaType($fileinfo->getMimeType())
        ->setFileSize($fileinfo->getSize())
        ->setUniqId($filename)
        ->setOriginalFileName($ofn)
        ->setMd5Sum($md5sum)
        ->save()
        ;
        
        rename($oldfile, $oldfile. '.deleted');
        $this->logSection('file-', $oldfile, null, 'NOTICE');
        $this->logSection('file+', $newfile, null, 'NOTICE');
      }
      
    }
    catch (Exception $e)
    {
      throw $e;
    }

  }

}
