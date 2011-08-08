<?php

require 'lib/model/om/BaseSyllabusItem.php';


/**
 * Skeleton subclass for representing a row from the 'syllabus_item' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SyllabusItem extends BaseSyllabusItem {

  public function setValues($syllabus_id, $content, $level, $parent_id)
  {
    $this
    ->setSyllabusId($syllabus_id)
    ->setContent($content)
    ->setLevel($level)
    ->setParentId($parent_id)
    ;
    
  }

} // SyllabusItem
