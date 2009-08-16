<?php

class SambaAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountInfo('message', 'this is a samba account');
		$this->setAccountType(AccountTypePeer::retrieveByName('samba'));
	}
	
	public function getImage()
	{
		return 'baby im a samba account!';
	}

}
