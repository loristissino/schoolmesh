<?php

class LoginAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('login'));
	}
	
	public function updateInfoFromRealWorld()
	{
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
