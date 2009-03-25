<?php

class WpitemGroup extends BaseWpitemGroup
{
	public function __toString()
	{
	return $this->getId();	
	}
	
}
