<?php

class WpmoduleItem extends BaseWpmoduleItem
{
	
	public function __toString()
	{
			return $this->getContent();
		
	}
}
