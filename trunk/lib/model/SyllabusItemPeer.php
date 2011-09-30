<?php

require 'lib/model/om/BaseSyllabusItemPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'syllabus_item' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SyllabusItemPeer extends BaseSyllabusItemPeer {

  public static function retrieveBySyllabusIdAndRef($syllabusId, $ref)
  {
    $c = new Criteria();
    $c->add(self::SYLLABUS_ID, $syllabusId);
    $c->add(self::REF, $ref);
    return self::doSelectOne($c);
  }


} // SyllabusItemPeer
