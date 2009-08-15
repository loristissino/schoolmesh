<?php

class Account extends BaseAccount
{
	
	private $_info = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->_info=unserialize($this->getInfo());
	}
	
	public function save(PropelPDO $con = null)
	{
		$this->setInfo(serialize($this->_info));
		parent::save();
	}
	
   public function setAccountInfo($key, $value)
	{
		$this->_info[$key]=$value;
	}

    public function getAccountInfo($key)
	{
		return @$this->_info[$key];
	}
	
	
	function getRealAccount()
	{
		switch($this->getAccountType()->getName())
		{
			case 'samba':
				$realAccount=new SambaAccount();
				break;
			case 'moodle':
				$realAccount=new MoodleAccount();
				break;
			case 'login':
				return $this;
			case 'googleapps':
				return $this;
			case 'ldapnfs':
				return $this;
			default:
				throw new Exception ('not a valid account type given: ' . $this->getAccountType());
		}
		
		foreach($this as $key=>$value)
		{
			$realAccount->$key = $value;
		}
		
		return $realAccount;
	}
	
	
}
