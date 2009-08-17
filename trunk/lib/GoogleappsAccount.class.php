<?php

class GoogleappsAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('googleapps'));
	}
	
	public function updateInfoFromRealWorld()
	{
		return $this;
	}

	public function getImage()
	{
		return 'googleapps';
	}
	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		return $this;
	}


}
