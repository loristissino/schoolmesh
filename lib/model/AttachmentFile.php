<?php

/**
 * AttachmentFile class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class AttachmentFile extends BaseAttachmentFile {

  private
    $_filename;
    
  public function setFilename($v=null)
  {
    if(!$v)
    {
      $v=$this->getUniqId();
    }
    
    $this->_filename=sfConfig::get('app_documents_attachments').'/'. $v;
    return $this;
  }
  
  public function getFilename()
  {
    if(!$this->_filename)
    {
      $this->setFilename();
    }
    return $this->_filename;
  }


  public function isViewableBy($user)
  {
    return 
      $this->getIsPublic()
      ||
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

    $this->setFilename($this->getUniqId());
    
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
