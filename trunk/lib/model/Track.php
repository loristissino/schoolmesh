<?php

class Track extends BaseTrack
{
	public function __toString()
	{
	return $this->getShortcut();	
	}
	
}
