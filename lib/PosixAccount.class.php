<?php

class PosixAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountInfo('message', 'posix account');
		$this->setAccountType(AccountTypePeer::retrieveByName('posix'));
	}
	
	public function updateInfoFromRealWorld()
	{
		$info=Generic::executeCommand(sprintf('posixaccount_getinfo %s %s', $this->getUsername(), sfConfig::get('app_config_posix_basefolder')));
		foreach($info as $key=>$value)
		{
			$this->setAccountInfo($key, $value);
		}
//		$this->save();
		return $this;
	}

	public function getImage()
	{
		return 'posix';
	}

	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		
		$this->updateInfoFromRealWorld();
		
		$role=RolePeer::retrieveByPK($this->getProfile()->getRoleId());
		
		if ($this->getAccountInfo('found')==0)
		{
			$checkList->addCheck(new Check(Check::FAILED, 'posix: account not found', $checkGroup, array(
				'command'=>sprintf('schoolmesh_posixaccount_create %s "%s" %s "%s" "%s"',
					$this->getUsername(),
					sfConfig::get('app_config_posix_homedir'),
					$role->getPosixName(),
					$this->getProfile()->getFullName(),
					sfConfig::get('app_config_posix_basefolder'))
				)));
			return $this;
		}

		if ($this->getAccountSetting('uid')===null)
		{
			// we save the UID for future reference
			$this->setAccountSetting('uid', $this->getAccountInfo('uid'));
			$checkList->addCheck(new Check(Check::WARNING, 'posix: UID saved for future reference', $checkGroup));
		}
		else
		{
			if($this->getAccountSetting('uid')==$this->getAccountInfo('uid'))
			{
				$checkList->addCheck(new Check(Check::PASSED, 'posix: UIDs match', $checkGroup));
			}
			else
			{
				$checkList->addCheck(new Check(Check::WARNING, 'posix: UIDs do not match', $checkGroup));
			}
		}
		
		
		$checks=array(
			array(
				'field'=>'group',
				'match'=>$role->getPosixName(),
				'true'=>'group is ok',
				'false'=>'group does not match',
				),
			array(
				'field'=>'gecos',
				'match'=>$this->getProfile()->getFullName(),
				'true'=>'full name is ok',
				'false'=>'full name does not match'
				),
			array(
				'field'=>'homedir_user',
				'match'=>$this->getUsername(),
				'true'=>sprintf('homedir is owned by «%s»', $this->getUsername()),
				'false'=>'homedir is not owned by the user'
				),
			array(
				'field'=>'homedir_filetype',
				'match'=>'directory',
				'true'=>'homedir exists and is a directory',
				'false'=>'homedir does not exist or is not a directory'
				),
			array(
				'field'=>'homedir_permissions',
				'match'=>711,
				'true'=>'homedir permissions are ok',
				'false'=>'homedir permissions are not ok'
				),
			array(
				'field'=>'homedir_group',
				'match'=>'root',
				'true'=>'homedir group is root',
				'false'=>'homedir group is not root'
				),
			array(
				'field'=>'shell',
				'match'=>$this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false',
				'true'=>sprintf('shell is correctly set to «%s»', $this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false'),
				'false'=>sprintf('shell is not set to «%s»', $this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false')
				),
			array(
				'field'=>'basefolder_found',
				'match'=>1,
				'true'=>'basefolder was found',
				'false'=>'basefolder was not found',
				),
			array(
				'field'=>'basefolder_user',
				'match'=>'root',
				'true'=>'basefolder owner is ok',
				'false'=>'basefolder owner is not ok',
				),
			array(
				'field'=>'basefolder_group',
				'match'=>'root',
				'true'=>'basefolder group is ok',
				'false'=>'basefolder group is not ok',
				),
			array(
				'field'=>'basefolder_permissions',
				'match'=>'755',
				'true'=>'basefolder permissions are ok',
				'false'=>'basefolder permissions are not ok',
				),
			array(
				'field'=>'basefolder_lsattr',
				'match'=>'',
				'true'=>'basefolder extended attributes are ok',
				'false'=>'basefolder extended attributes are not ok',
				),
			);

			foreach($checks as $check)
			{
				if ($this->getAccountInfo($check['field'])==$check['match'])
				{
					$checkList->addCheck(new Check(Check::PASSED, 'posix: '. $check['true'], $checkGroup));
				}
				else
				{
					$checkList->addCheck(new Check(Check::WARNING, 'posix: '. $check['false'] . sprintf(' (got «%s», expected «%s»)', $this->getAccountInfo($check['field']), $check['match']), $checkGroup));
				}
			}

//		$checkList->addCheck(new Check(Check::PASSED, 'posix: ok1 - '. $this->getUsername(), $this->getUsername()));

		$this->save();
		return $this;
	}

}
