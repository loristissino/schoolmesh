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

  public function getRef()
  {
    $ref=parent::getRef();
    return substr($ref,0,1)=='~' ? '': $ref;
  }

  public function setValues($syllabus_id, $content, $level, $parent_id, $is_selectable=false, $rank=0)
  {
    
    if(strpos($content,'§')>0)
    {
      list($ref,$content)=explode('§', $content);
    }
    else
    {
      $ref=uniqid('~', true);
    }
    
    $this
    ->setSyllabusId($syllabus_id)
    ->setRef($ref)
    ->setContent($content)
    ->setLevel($level)
    ->setParentId($parent_id)
    ->setIsSelectable($is_selectable)
    ->setRank($rank)
    ;
    
    return $this;
    
  }

} // SyllabusItem
