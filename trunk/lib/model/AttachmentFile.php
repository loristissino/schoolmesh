<?php

require 'lib/model/om/BaseAttachmentFile.php';


/**
 * Skeleton subclass for representing a row from the 'attachment_file' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class AttachmentFile extends BaseAttachmentFile {

  public function setFile($prefix, sfValidatedFile $file)
  {
    $uniqid=uniqid($prefix . '_', true) . $file->getExtension();

    $filename=sfConfig::get('app_documents_attachments').'/'.$uniqid;
    
    try
    {
      $file->save($filename);
    }
    catch (Exception $e)
    {
      return false;
    }
    $md5=md5_file($filename);
    if(!$md5)
    {
      return false;
    }
    
    $this
    ->setOriginalFileName($file->getOriginalName())
    ->setFileSize($file->getSize())
    ->setInternetMediaType($file->getType())
    ->setUniqId($uniqid)
    ->setMd5sum($md5)
    ;
    
    return true;
  }


} // AttachmentFile
