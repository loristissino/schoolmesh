<?php

/**
 * Subclass for representing a row from the 'year' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Year extends BaseYear
{
  public function __toString()
  {
        return $this->getDescription(); 
  }


}
