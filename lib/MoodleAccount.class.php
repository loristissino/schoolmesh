<?php

class MoodleAccount extends Account
{
	
	function __construct()
	{
		$this->setInfo('this is a moodle account');
		$this->setAccountType(AccountTypePeer::retrieveByName('moodle'));
	}
	
	function getHello()
	{
		return "Moodle account";
	}

}
