<?php

/**
 * ProjCategory class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class ProjCategory extends BaseProjCategory {

	public function __toString()
	{
		return $this->getTitle();
	}

} // ProjCategory
