<?php

/**
 * WptoolItemType class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WptoolItemType extends BaseWptoolItemType
{
	
	public function __toString()
	{
		return $this->getDescription();
	}
}
