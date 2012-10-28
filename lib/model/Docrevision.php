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

  public function updateFromForm($params, sfValidatedFile $source_file=null, sfValidatedFile $published_file=null, $sf_context=null)
  {
    
/*        document_id: { type: integer, foreignTable: document, foreignReference: id, onDelete: restrict, onUpdate: cascade, required: true }
    revision_number: { type: integer, required: true }
    revisioned_at: timestamp
    uploader_id:  { type: integer, foreignTable: sf_guard_user, foreignReference: id, onDelete: restrict, onUpdate: cascade, required: true }
    revision_grounds: { type: longvarchar, required: true }
    content: { type: longvarchar, required: false }
    content_type: integer  # 1=null (use attachment)   2=text/plain   3=text/html    4=text/x-web-markdown
    # the content can be set even if the document is stored in an attachment, for lucene indexes
    source_attachment_id: { type: integer, foreignTable: attachment_file, foreignReference: id, onDelete: restrict, onUpdate: cascade, required: false }
    published_attachment_id: { type: integer, foreignTable: attachment_file, foreignReference: id, onDelete: restrict, onUpdate: cascade, required: false }
*/
    
    $con = Propel::getConnection(ProjDeadlinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because it depends on the state
    Generic::updateObjectFromForm($this, array(
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
