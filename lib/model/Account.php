<?php

class Account extends BaseAccount
{
	
	protected $_info = array();
	protected $_settings = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->_info=unserialize($this->getInfo());
		if ($this->getInfo())
		{
			$this->_info=unserialize($this->getInfo());
		}
		else
		{
			$this->_info=array();
		}
		if ($this->getSettings())
		{
			$this->_settings=unserialize($this->getSettings());
		}
		else
		{
			$this->_settings=array();
		}
	}
	
	public function getUsername()
	{
		$c=new Criteria();
		$c->add(sfGuardUserPeer::ID, $this->getUserId());
		$t=sfGuardUserPeer::doSelectOne($c);
		return $t->getUsername();
	}
	
	public function getProfile()
	{
		$c=new Criteria();
		$c->add(sfGuardUserProfilePeer::USER_ID, $this->getUserId());
		$t=sfGuardUserProfilePeer::doSelectOne($c);
		return $t;
	}
	
	public function save(PropelPDO $con = null)
	{
		$this->setInfo(serialize($this->_info));
		$this->setSettings(serialize($this->_settings));
		parent::save();
	}
	
   public function setAccountInfo($key, $value)
	{
		$this->_info[$key]=$value;
		return $this;
	}

    public function getAccountInfo($key)
	{
		if (@array_key_exists($key, $this->_info))
		{
			return $this->_info[$key];
		}
		else
		{
			return null;
		}
	}
		
   public function setAccountSetting($key, $value)
	{
		$this->_settings[$key]=$value;
		$this->save();


		return $this;
	}

    public function getAccountSetting($key)
	{
		$this->_settings=unserialize($this->getSettings());
		if (array_key_exists($key, $this->_settings))
		{
			return $this->_settings[$key];
		}
		else
		{
			return null;
		}
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
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
		return $this;
	}
	
	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
		return $this;
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
