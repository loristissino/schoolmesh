<?php 
class Check{
	
	private $_isPassed;
	private $_content;
	private $_message;
	private $_linkTo;
	private $_flash;
	private $_fragment;
	
	public function __construct($isPassed, $message, $content='', $linkTo='', $flash='', $fragment='')
		{
			$this->_isPassed = $isPassed;
			$this->_content = $content;
			$this->_message = $message;
			$this->_linkTo=$linkTo;
			$this->_flash=$flash;
			$this->_fragment=$fragment;
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

	public function getFlash()
		{
			return $this->_flash;
		}
	public function getFragment()
		{
			return $this->_fragment;
		}
	};
