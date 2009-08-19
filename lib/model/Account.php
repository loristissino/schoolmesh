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
	
	public function __toString()
	{
		return sprintf('Account «%s»', $this->getAccountType()->getName());
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
   public function resetInfo()
	{
		$this->_info=array();
		return $this;
	}

    public function getAccountInfo($key)
	{
		if (array_key_exists($key, $this->_info))
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
		
		$type=ucfirst($this->getAccountType()->getName()). 'Account';		
		$realAccount = new $type();
/*		switch($this->getAccountType()->getName())
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
	*/	
		foreach($this as $key=>$value)
		{
			$realAccount->$key = $value;
		}
		
		$realAccount->_info=unserialize($this->getInfo()); // We need it!!
		$realAccount->_settings=unserialize($this->getSettings()); // We need it!!
		
		$realAccount->setNew(false);
		
		return $realAccount;
	}
	
/**
   * Makes somehow a query to the real world, updating all relevant fields.
   * This function may store information with the setAccountInfo() function.
   * It must take care of updating the info_updated_at field when updating data.
   * Also, if relevant, it must calculate the quota_percentage field.
   *
   * @return self
   */
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
	
  /**
   * Creates the External account
   *
   * @return Boolean true if the account was created, false otherwise
   */
  public function createAccount()
	{
		return false;
	}
	
  /**
   * Informs about whether the account can be definitely removed
   *
   * @return Boolean|String true if the account can be definitely removed, a string with the explanation of the reason otherwise
   */
  public function getIsDeletable()
	{
		return false;
	}

	
}
