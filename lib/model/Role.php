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
        return $this->getMaleDescription();
    }
	
	public function getRoleDescriptionByGender($isMale=true)
	{
		return ($isMale? $this->getMaleDescription(): $this->getFemaleDescription());
	}
}
