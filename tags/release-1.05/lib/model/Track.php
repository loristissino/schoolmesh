<?php

/**
 * Track class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Track extends BaseTrack
{
	public function __toString()
	{
	return $this->getShortcut();	
	}
	
}
