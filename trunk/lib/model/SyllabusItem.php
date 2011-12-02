<?php

/**
 * SyllabusItem class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
