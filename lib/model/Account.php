<?php

class Account extends BaseAccount
{
	function getRealAccount()
	{
		switch($this->getAccountType()->getName())
		{
			case 'samba':
				$realAccount=new SambaAccount();
				break;
			case 'moodle':
				$realAccount=new MoodleAccount();
				break;
			case 'login':
				return $this;
			case 'googleapps':
				return $this;
			case 'ldapnfs':
				return $this;
			default:
				throw new Exception ('not a valid account type given: ' . $this->getAccountType());
		}
		
		foreach($this as $key=>$value)
		{
			$realAccount->$key = $value;
		}
		
		return $realAccount;
	}
	
	function getHello()
	{
		return "Generic account";
	}

	
}
