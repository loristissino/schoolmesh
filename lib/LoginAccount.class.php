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
		return 'baby im a login account!';
	}


}
