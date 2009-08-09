<?php

class WptoolItemType extends BaseWptoolItemType
{
	
	public function __toString()
	{
		return $this->getDescription();
	}
}
