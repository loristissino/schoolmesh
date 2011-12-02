<?php

/**
 * SyllabusItemPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
