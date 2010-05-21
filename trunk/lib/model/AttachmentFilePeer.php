<?php

require 'lib/model/om/BaseAttachmentFilePeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'attachment_file' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class AttachmentFilePeer extends BaseAttachmentFilePeer {

  public static function getBaseTableId($classname)
  {
    
    switch($classname)
    {
      case 'ProjDeadline':
        return 1;
      default:
        return 0;
    }
  }

  public static function retrieveByClassAndId($classname, $id)
  {
    $c=new Criteria();
    $c->add(self::BASE_TABLE, self::getBaseTableId($classname));
    $c->add(self::BASE_ID, $id);
    return self::doSelect($c);
  }


} // AttachmentFilePeer
