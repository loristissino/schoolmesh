<?php

/**
 * Subclass for representing a row from the 'schoolclass' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Schoolclass extends BaseSchoolclass
{

  public function __toString()
  {
        return $this->getShortcut(); 
  }
  
  public function getShortcut()
  {
        return $this->getId();
//        return $this->getGrade() . $this->getSection() . $this->getAddress(); 
 
  }

  public function getFullDescription()
  {
        return $this->getGrade() . $this->getSection() . $this->getAddress()->getFullDescription(); 
 
  }

}
