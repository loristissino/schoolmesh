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

  private
    $_filename;
    
  public function setFilename($v)
  {
    $this->_filename=$v;
    return $this;
  }
  
  public function getFilename()
  {
    return $this->_filename;
  }


  public function isViewableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getUserId() 
      || 
      $user->hasCredential('wpfr_view') 
      || 
      $user->hasCredential('admin')
      ;
  }

  public function setFile($prefix, sfValidatedFile $file)
  {
    $this->setUniqId(uniqid($prefix . '_', true) . $file->getExtension());

    $this->setFilename(sfConfig::get('app_documents_attachments').'/'.$this->getUniqId());
    
    try
    {
      $file->save($this->getFilename());
    }
    catch (Exception $e)
    {
      return false;
    }
    $md5=md5_file($this->getFilename());
    if(!$md5)
    {
      return false;
    }
    
    $this
    ->setOriginalFileName($file->getOriginalName())
    ->setFileSize($file->getSize())
    ->setInternetMediaType($file->getType())
    ->setMd5sum($md5)
    ;
    
    return true;
  }
  
  
  public function setMessage($message)
  {
    // to parse the file, later, we could use
    // http://code.google.com/p/php-mime-mail-parser/
    
    $this->setUniqId(uniqid('mail_', true) . '.txt');

    $this->setFilename(sfConfig::get('app_documents_attachments').'/'.$this->getUniqId());
    
    $filetext=$message->toString();
    
    try
    {
      file_put_contents($this->getFilename(), $filetext);
    }
    catch (Exception $e)
    {
      return false;
    }
    $md5=md5_file($this->getFilename());
    if(!$md5)
    {
      return false;
    }
    
    $this
    ->setOriginalFileName($this->getUniqId())
    ->setFileSize(strlen($filetext))
    ->setInternetMediaType('message/rfc822')
    ->setMd5sum($md5)
    ;
    
    
  }


} // AttachmentFile
