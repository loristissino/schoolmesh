<?php

/**
 * WptoolItem class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WptoolItem extends BaseWptoolItem
{

	public function __toString()
	{
		
			return $this->getDescription() ;
	}

}
