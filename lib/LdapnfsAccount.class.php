<?php

class LdapnfsAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('ldapnfs'));
	}
	
	public function updateInfoFromRealWorld()
	{
		return $this;
	}

	public function getImage()
	{
		return 'ldapnfs';
	}


}
