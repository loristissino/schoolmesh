<?php

/**
 * Subclass for representing a row from the 'role' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Role extends BaseRole
{
    public function __toString()
    {
        return $this->getDescription();
    }
    
}
