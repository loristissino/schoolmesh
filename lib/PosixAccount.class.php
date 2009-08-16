<?php

class PosixAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountInfo('message', 'posix account');
		$this->setAccountType(AccountTypePeer::retrieveByName('posix'));
	}
	
	public function updateInfoFromRealWorld()
	{
		$info=Generic::executeCommand(sprintf('posixaccount_getinfo %s %s', $this->getUsername(), sfConfig::get('app_config_posix_basefolder')));
		foreach($info as $key=>$value)
		{
			$this->setAccountInfo($key, $value);
		}
		$this->save();
		return $this;
	}

	public function getImage()
	{
		return 'baby im a posix account!';
	}


}
