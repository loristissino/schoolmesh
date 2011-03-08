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
		
		if ($realAccount->getPasswordIsResettable())
		{
			$realAccount->setTemporaryPassword(rand(1000000,9999999));
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
  
  
  public static function RetrieveAccountInfo($accounttype, $userlist)
  {
    $result=array();
    $result['max_blocks']=0;
    $result['max_files']=0;
    $result['max_used_blocks']=0;
    $result['max_used_files']=0;
    $result['sum_used_blocks']=0;
    $result['sum_used_files']=0;
    $result['accounts'] = array();
    $result['stats']=array();
    
    foreach ($userlist as $user)
    {
      if ($account=$user->getProfile()->getAccountByType($accounttype))
      {
        $info=$account->getQuotaInfo();
        $result['stats'][$user->getUsername()]=$info;
        $result['max_blocks']=max($result['max_blocks'], $info['info_hard_blocks_quota'], $info['setting_hard_blocks_quota']);
        $result['max_files']=max($result['max_files'], $info['info_hard_files_quota'], $info['setting_hard_files_quota']);
        $result['max_used_blocks']=max($result['max_used_blocks'], $info['used_blocks']);
        $result['max_used_files']=max($result['max_used_files'], $info['used_files']);
        $result['sum_used_blocks']+=$info['used_blocks'];
        $result['sum_used_files']+=$info['used_files'];
        
        $result['accounts'][]=$info['id'];
        unset($info);
      }
    }
    
    return $result;

    
  }
	
}
