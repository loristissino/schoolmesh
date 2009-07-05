<?php 
class Hint{
	
	private $_content;
	private $_id;
	private $_usedIn = Array();
	
	public function __construct($content, $id)
		{
			$this->_content = $content;
			$this->_id = $id;
		}

	public function getContent()
		{
			return $this->_content;
		}

	public function getId()
		{
			return $this->_id;
		}

	public function addUsedIn($usedIn)
		{
			array_push($this->_usedIn, $usedIn);
		}

	public function getUsedIn()
		{
			return $this->_usedIn;
		}
	};
