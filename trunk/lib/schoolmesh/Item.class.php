<?php
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
/*
$obj=new Item(5, 'prova');
$obj->a='1';
$obj->b='2';

foreach($obj as $key=>$value)
{
	echo $key . ' --> ' . $value . "\n";
}

*/
