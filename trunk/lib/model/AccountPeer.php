<?php

class AccountPeer extends BaseAccountPeer
{
	
	public static function createAccountOfType($type)
	{
		switch($type)
		{
			case 'posix':
				$realAccount=new PosixAccount();
				break;
			case 'samba':
				$realAccount=new SambaAccount();
				break;
			case 'moodle':
				$realAccount=new MoodleAccount();
				break;
			case 'login':
				$realAccount=new LoginAccount();
				break;
			case 'googleapps':
				$realAccount=new GoogleappsAccount();
				break;
			case 'ldapnfs':
				$realAccount=new LdapnfsAccount();
				break;
			default:
				throw new Exception ('not a valid account type given: ' . $ype);
		}
	
		return $realAccount;
		
	}
	
}
