<?php

/**
 * Subclass for representing a row from the 'person' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Person extends BasePerson
{
  public function __toString()
    {
      return $this->getName();
    }

}
