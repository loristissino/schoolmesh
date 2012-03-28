<?php

/**
 * Item class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Item implements IteratorAggregate
{
	
	private $_id;
	private $_description;
	
	public function __construct($id, $description)
	{
		$this->_id=$id;
		$this->_description=$description;
	}
	
	public function getId()
	{
		return $this->_id;
	}

	public function __toString()
	{
		return $this->_description;
	}
	
	public function getIterator()
	{
		return new ArrayIterator($this);
	}

}

