<?php

class MoodleAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountInfo('message', 'this is a moodle account');
		$this->setAccountType(AccountTypePeer::retrieveByName('moodle'));
	}
	
}
