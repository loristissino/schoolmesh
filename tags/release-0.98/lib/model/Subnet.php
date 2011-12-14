<?php

/**
 * Subnet class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Subnet extends BaseSubnet
{
	
	public function __toString()
	{
	return $this->name;	
	}
}
