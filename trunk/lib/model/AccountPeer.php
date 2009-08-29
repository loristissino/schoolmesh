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
	
	
	
	public static function retrieveByUserIdAndType($userId, $type)
	{
		$c=new Criteria();
		$c->add(AccountPeer::USER_ID, $userId);
		$c->addJoin(AccountTypePeer::ID, AccountPeer::ACCOUNT_TYPE_ID);
		$c->add(AccountTypePeer::NAME, $type);
		$t=AccountPeer::doSelectOne($c);
		if ($t)
		{
			return $t->getRealAccount();
		}
		else
		{
			return null;
		}
	}
	
}
