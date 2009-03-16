<?php

class Workplan extends BaseWorkplan
{
	
public function __toString()
	{
			return $this->getSubject() . ' (' . $this->getSchoolclass() . ', ' . $this->getYear() . ')';
	}


}
