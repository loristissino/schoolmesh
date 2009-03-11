<?php

/**
 * Subclass for representing a row from the 'subject' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Subject extends BaseSubject
{

  public function __toString()
  {
        return $this->getDescription(); 
  }


}
