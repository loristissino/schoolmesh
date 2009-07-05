<?php 
class Check{
	
	private $_isPassed;
	private $_content;
	private $_message;
	private $_linkTo;
	
	public function __construct($isPassed, $message, $content='', $linkTo='')
		{
			$this->_isPassed = $isPassed;
			$this->_content = $content;
			$this->_message = $message;
			$this->_linkTo=$linkTo;
			
		}

	public function getMessage()
		{
			return $this->_message;
		}

	public function getContent()
		{
			return $this->_content;
		}

	public function getIsPassed()
		{
			return $this->_isPassed;
		}

	public function getLinkTo()
		{
			return $this->_linkTo;
		}

	};
