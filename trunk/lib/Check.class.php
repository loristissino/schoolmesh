<?php 
class Check{
	
	const FAILED = 0;
	const PASSED = 1;
	const WARNING = 2;
	
	
	private $_result;
	private $_message;
	private $_group;
	private $_link_to;
	private $_flash;
	private $_fragment;
	private $_command;
	
	public function __construct($result, $message, $group, array $parameters=array())
		{
			if (!in_array($result, array(self::FAILED, self::WARNING, self::PASSED)))
			{
				throw new Exception('result invalid: '. $result);
			}
			if ($group=='' || is_numeric($group))
			{
				throw new Exception('group invalid: '. $group);
			}

			$this->_result = $result;
			$this->_group = $group;
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

	public function getGroup()
		{
			return $this->_group;
		}
		
	public function getContent()
		{
			/* FIXME this is a duplication, I need to refactor the code for workplans to use getGroup() */
			return $this->getGroup();
			
		}

	public function getResult()
		{
			return $this->_result;
		}

	public function getIsPassed()
	{
		return ($this->_result!=0);
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
			$images=array(
				self::FAILED=>'notdone',
				self::WARNING=>'dubious',
				self::PASSED=>'done'
			);
			return $images[$this->getResult()];
		}
	public function getImageTitle()
		{
			$titles=array(
				self::FAILED=>'failed',
				self::WARNING=>'warning',
				self::PASSED=>'passed'
			);
			return $titles[$this->getResult()];
		}
	};
