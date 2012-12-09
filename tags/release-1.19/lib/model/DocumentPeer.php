<?php

require 'lib/model/om/BaseDocumentPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'document' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class DocumentPeer extends BaseDocumentPeer {

  public static function retrieveByDoctypeId($id)
  {
    $c=new Criteria();
    $c->add(self::IS_ACTIVE, true);
    $c->add(self::DOCTYPE_ID, $id);
    $c->addAscendingOrderByColumn(self::CODE);
    $c->addJoin(self::DOCREVISION_ID, DocrevisionPeer::ID);
    return self::doSelectJoinDocrevision($c);
  }

} // DocumentPeer
