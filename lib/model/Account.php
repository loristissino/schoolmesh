<?php

class Account extends BaseAccount
{
	
	private $_info = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->_info=unserialize($this->getInfo());
	}
	
	public function getUsername()
	{
		return 'john.test';
		$c=new Criteria();
		$c->add(sfGuardUserPeer::ID, $this->getUserId());
		$t=sfGuardUserPeer::doSelectOne($c);
		return $t->getUsername();
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
			case 'posix':
				$realAccount=new PosixAccount();
				break;
			case 'samba':
				$realAccount=new SambaAccount();
				break;
			case 'moodle':
				$realAccount=new MoodleAccount();
				break;
			case 'login':
				$realAccount=new LoginAccount();
				break;
			case 'googleapps':
				$realAccount=new GoogleappsAccount();
				break;
			case 'ldapnfs':
				$realAccount=new LdapnfsAccount();
				break;
			default:
				throw new Exception ('not a valid account type given: ' . $this->getAccountType());
		}
		
		foreach($this as $key=>$value)
		{
			$realAccount->$key = $value;
		}
		
		$realAccount->setNew(false);
		
		return $realAccount;
	}
	
	public function updateInfoFromRealWorld()
	{
		throw new Exception('This function must be implemented in a derived class');
		return $this;
	}
	
	public function getChecks()
	{
		throw new Exception('This function must be implemented in a derived class');
	}
	
	public function getImage()
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
	}
	
	public function getBasicInfo()
	{
		return '';
	}
	
}
