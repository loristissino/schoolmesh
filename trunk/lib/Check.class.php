<?php 
class Check{
	
	private $_isPassed;
	private $_message;
	private $_content;
	private $_link_to;
	private $_flash;
	private $_fragment;
	private $_command;
	
	public function __construct($isPassed, $message, $content, array $parameters=array())
		{
			$this->_isPassed = $isPassed;
			$this->_content = $content;
			$this->_message = $message;

			foreach($parameters as $key=>$value)
			{
				$keyname='_'.$key;
				$this->$keyname=$value;
			}

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
			return $this->_link_to;
		}

	public function getFlash()
		{
			return $this->_flash;
		}
	public function getFragment()
		{
			return $this->_fragment;
		}
	public function getCommand()
		{
			return $this->_command;
		}
		
	public function getImageTag()
		{
			return $this->getIsPassed()?'done':'notdone';
		}
	public function getImageTitle()
		{
			return $this->getIsPassed()?'passed':'failed';
		}
	};
