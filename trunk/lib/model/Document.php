<?php

require 'lib/model/om/BaseDocument.php';


/**
 * Skeleton subclass for representing a row from the 'document' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Document extends BaseDocument {

  const
    CONTENT_TYPE_PLAIN=2,
    CONTENT_TYPE_HTML=3,
    CONTENT_TYPE_MARKDOWN=4;

	/**
	 * Initializes internal state of Document object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
  
  public function getRevisionNumber()
  {
    if($this->getDocrevisionId())
    {
      return $this->getDocrevision()->getRevisionNumber();
    }
    return null;
  }
  
  public function getRevisionedAt($format)
  {
    if($this->getDocrevisionId())
    {
      return $this->getDocrevision()->getRevisionedAt($format);
    }
    return null;
  }
  
  public function getContent()
  {
    if($this->getDocrevisionId())
    {
      return $this->getDocrevision()->getContent();
    }
    return null;
  }
  
  public function getTitle()
  {
    if($this->getDocrevisionId())
    {
      return $this->getDocrevision()->getTitle();
    }
    return null;
  }

  public function getContentType()
  {
    if($this->getDocrevisionId())
    {
      return $this->getDocrevision()->getContentType();
    }
    return null;
  }
  
  public function hasInlineContent()
  {
   return (in_array($this->getContentType(), array(Document::CONTENT_TYPE_HTML, Document::CONTENT_TYPE_MARKDOWN)));
  }

  public function getDownloadableAttachmentId()
  {
    if($this->getDocrevisionId())
    {
      if($this->getIsForm())
      {
        return $this->getDocrevision()->getSourceAttachmentId();
      }
      else
      {
        return $this->getDocrevision()->getPublishedAttachmentId();
      }
    }
    return null;
  }
  
  public function hasDownloadableAttachment()
  {
    return null!=$this->getDownloadableAttachmentId();
  }
  

  public function __toString()
  {
    return $this->getCode() . ' - ' . $this->getTitle();
  }


	public function getDocrevisions($criteria = null, PropelPDO $con = null)
  {
    if(!$criteria)
    {
      $criteria=new Criteria();
    }
    $criteria->addDescendingOrderByColumn(DocrevisionPeer::REVISION_NUMBER);
    return parent::getDocrevisions($criteria, $con);
  }


} // Document
