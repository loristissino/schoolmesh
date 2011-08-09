<?php

require 'lib/model/om/BaseSyllabus.php';


/**
 * Skeleton subclass for representing a row from the 'syllabus' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Syllabus extends BaseSyllabus {

  private $_parents;
  
  public function __toString()
  {
    return $this->getName();
  }

  public function saveItems($items=array())
  {
    $this->_saveItem($items, 1);
  }
  
  private function _saveItem($item, $level)
  {
    if (is_array($item))
    {
      foreach($item as $key=>$value)
      {
        $newlevel=$level;
        if (!is_numeric($key))
        {
          //echo $level . " NONFIN: " . $key . "\n";
          $syllabusItem = new SyllabusItem();
          $syllabusItem->setValues(
            $this->getId(),
            $key,
            $level,
            $level>1 ? $this->_parents[$level-1]: null
            )
          ->save();
          $this->_parents[$level]=$syllabusItem->getId();
          $newlevel = $level +1;
        }
        $this->_saveItem($value, $newlevel);
      }
    }
    else
    {
      //echo $level . " FINALE: " . $item . "\n";
      $syllabusItem = new SyllabusItem();
      $syllabusItem->setValues(
        $this->getId(),
        $item,
        $level,
        $level>0 ? $this->_parents[$level-1]: 0,
        true
        )
      ->save();
      
    }
  }

} // Syllabus
