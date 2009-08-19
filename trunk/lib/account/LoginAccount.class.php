<?php

class LoginAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('login'));
	}
	
	public function updateInfoFromRealWorld()
	{
		$this->resetInfo();
		$info=Generic::executeCommand(sprintf('loginaccount_getinfo %s', $this->getUsername()));
		
		// first, we retrieve the values...
		foreach($info as $key=>$value)
		{
			$this->setAccountInfo($key, $value);
		}
		// second, we copy them in the settings if they are empty (but only editable ones)
		foreach(array(
			'soft_blocks_quota',
			'hard_blocks_quota',
			'soft_files_quota',
			'hard_files_quota',
		) as $key)
		{
			if(!$this->getAccountSetting($key))
			{
				$this->setAccountSetting($key, $this->getAccountInfo($key));
			}
		}
		$this->setInfoUpdatedAt(time());
		
		if ($this->getAccountInfo('soft_blocks_quota')>0)
		{
			$this->setQuotaPercentage(100 * $this->getAccountInfo('used_blocks')/$this->getAccountInfo('soft_blocks_quota'));
		}
		else
		{
			$this->setQuotaPercentage(null);
		}

		$this->setExists($this->getAccountInfo('found')==1);
		$this->setIsLocked($this->getAccountInfo('user_locked')==1);
		
		return $this;
	}

	public function getImage()
	{
		return 'login';
	}

	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		return $this;
	}

}
