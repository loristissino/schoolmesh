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
		return 'samba';
	}

	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		return $this;
	}

}
