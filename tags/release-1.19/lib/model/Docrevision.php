<?php

require 'lib/model/om/BaseDocrevision.php';


/**
 * Skeleton subclass for representing a row from the 'docrevision' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Docrevision extends BaseDocrevision {


  public function activate($approver_id, $sf_context=null)
  {
    $Document=$this->getDocument();
    
    $con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    
    $now=time();
    
    try
    {
      $Document
      ->setDocrevisionId($this->getId())
      ->save($con)
      ;
      $this
      ->setApproverId($approver_id)
      ->setApprovedAt($now)
      ->save($con)
      ;
      $Document->getDoctype()
      ->setRevisionNumber($Document->getDoctype()->getRevisionNumber()+1)
      ->setRevisionedAt($now)
      ->save($con)
      ;
      
      $con->commit();
      
      $result['result']='notice';
      $result['message']='Revision successfully activated.';
      return $result;
      
    }
    catch (Exception $e)
    {
      $result['result']='error';
      $result['message']='The revision could not be activated.';
      return $result;
    }
    
  }
  
  public function updateFromForm($params, sfValidatedFile $source_file=null, sfValidatedFile $published_file=null, $sf_context=null)
  {
        
    $con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because it depends on the state
    Generic::updateObjectFromForm($this, array(
      'document_id',
      'title',
      'uploader_id',
      'revision_number',
      'revisioned_at',
      'revision_grounds',
      'content',
      'content_type',
      ), $params);

    try
    {
      if($source_file)
      {
        $result=AttachmentFilePeer::addAttachment($con, $this, 'docrevision', $this->getUploaderId(), $source_file, $result);
        $this->setSourceAttachmentId($result['attachment_id']);
      }
      if($published_file)
      {
        $result=AttachmentFilePeer::addAttachment($con, $this, 'docrevision', $this->getUploaderId(), $published_file, $result);
        $this->setPublishedAttachmentId($result['attachment_id']);
      }
      
      $this->save($con);
        
      // FIXME -- we have to add the logging here...
      
      $con->commit();
      $result['docrevision_id']=$this->getId();
      $result['result']='notice';
      $result['message']='Revision successfully updated.';
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='Revision not updated, some error occured.';
    }
      
    return $result;
  }

  public function getAttachmentFiles()
  {
    return AttachmentFilePeer::retrieveByClassAndId(get_class($this), $this->getId());
  }
  
  public function hasAttachmentFiles()
  {
    return sizeof($this->getAttachmentFiles())>0;
  }

  public function getSourceAttachment()
  {
    return AttachmentFilePeer::retrieveByPK($this->getSourceAttachmentId());
  }

  public function getPublishedAttachment()
  {
    return AttachmentFilePeer::retrieveByPK($this->getPublishedAttachmentId());
  }


} // Docrevision
