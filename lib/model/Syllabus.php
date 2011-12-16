<?php

/**
 * Syllabus class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Syllabus extends BaseSyllabus {

  private $_parents;
  
  public function __toString()
  {
    return $this->getName();
  }
  
  public function getSyllabusItems($criteria = null, PropelPDO $con = null)
  {
    $c=$criteria?$criteria:new Criteria();
    $c->add(SyllabusItemPeer::SYLLABUS_ID, $this->getId());
    $c->addAscendingOrderByColumn(SyllabusItemPeer::RANK);
    return SyllabusItemPeer::doSelect($c);
  }

  public function getSelectableSyllabusItems($criteria = null, PropelPDO $con = null)
  {
    $c=new Criteria();
    $c->add(SyllabusItemPeer::IS_SELECTABLE, true);
    return $this->getSyllabusItems($c);
  }

  public function saveItems($items=array(), $con=null)
  {
    $this->_rank=1;
    $this->_saveItem($items, 1, $con=null);
  }
  
  private function _saveItem($item, $level, $con)
  {
    if (is_array($item))
    {
      foreach($item as $key=>$value)
      {
        $newlevel=$level;
        if (!is_numeric($key))
        {
          $syllabusItem = new SyllabusItem();
          $syllabusItem->setValues(
            $this->getId(),
            $key,
            $level,
            $level>1 ? $this->_parents[$level-1]: null,
            false,
            $this->_rank++
            )
          ->save($con);
          $this->_parents[$level]=$syllabusItem->getId();
          $newlevel = $level +1;
        }
        $this->_saveItem($value, $newlevel, $con);
      }
    }
    else
    {
      try
      {
        $syllabusItem = new SyllabusItem();
        $syllabusItem->setValues(
          $this->getId(),
          $item,
          $level,
          $level>0 ? $this->_parents[$level-1]: 0,
          true,
          $this->_rank++
          )
        ->save($con);
      }
      catch (PropelException $e)
      {
        throw $e;
        
      }
      
    }
  }

} // Syllabus
