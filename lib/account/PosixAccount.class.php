<?php

class PosixAccount extends Account
{
	
	protected $config;
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('posix'));
		
//		$config=parse_ini_file('/var/schoolmesh/config/schoolmesh.ini');
//		print_r($config);
		// It would be better not to have it hardcoded here, but I am not sure where to set the location...
	}
	
/**
   * Makes somehow a query to the real world, updating all relevant fields.
   * This function may store information with the setAccountInfo() function.
   * It must take care of updating the info_updated_at field when updating data.
   * Also, if relevant, it must calculate the quota_percentage field.
   *
   * @return self
   */
	public function updateInfoFromRealWorld()
	{
		$this->resetInfo();
		$info=Generic::executeCommand(sprintf('posixaccount_getinfo %s', $this->getUsername()));
		
		// first, we retrieve the values...
		foreach($info as $key=>$value)
		{
			$this->setAccountInfo($key, $value);
		}
		// second, we copy them in the settings if they are empty (but only editable ones)
		foreach(array(
			'soft_blocks_quota',
			'hard_blocks_quota',
			'soft_files_quota',
			'hard_files_quota',
		) as $key)
		{
			if(!$this->getAccountSetting($key))
			{
				$this->setAccountSetting($key, $this->getAccountInfo($key));
			}
		}
		$this->setInfoUpdatedAt(time());
		
		if ($this->getAccountInfo('soft_blocks_quota')>0)
		{
			$this->setQuotaPercentage(100 * $this->getAccountInfo('used_blocks')/$this->getAccountInfo('soft_blocks_quota'));
		}
		else
		{
			$this->setQuotaPercentage(null);
		}

		$this->setExists($this->getAccountInfo('found')==1);
		$this->setIsLocked($this->getAccountInfo('user_locked')==1);
		
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
				'command'=>sprintf('schoolmesh_posixaccount_create %s %s "%s"',
					$this->getUsername(),
					$role->getPosixName(),
					$this->getProfile()->getFullName())
				)));
			$this->save();
			return $this;
		}

		if ($this->getAccountSetting('uid')===null)
		{
			// we save the UID for future reference
			$this->setAccountSetting('uid', $this->getAccountInfo('uid'));
			$checkList->addCheck(new Check(Check::PASSED, 'posix: UID saved for future reference', $checkGroup));
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
				'command'=>sprintf('schoolmesh_posixaccount_changegroup %s %s', $this->getUsername(), $role->getPosixName()),
				),
			array(
				'field'=>'gecos',
				'match'=>$this->getProfile()->getFullName(),
				'true'=>'full name is ok',
				'false'=>'full name does not match',
				'command'=>sprintf('schoolmesh_posixaccount_changefullname %s "%s"', $this->getUsername(), $this->getProfile()->getFullName()),
				),
			array(
				'field'=>'homedir_found',
				'match'=>'1',
				'true'=>'homedir found',
				'false'=>'homedir not found',
				'command'=>sprintf('schoolmesh_posixaccount_createhomedir %s', $this->getUsername()),
				),
			array(
				'field'=>'homedir_user',
				'match'=>$this->getUsername(),
				'true'=>sprintf('homedir is owned by «%s»', $this->getUsername()),
				'false'=>'homedir is not owned by the user',
				'command'=>sprintf('schoolmesh_posixaccount_repairhomedir %s # (user)', $this->getUsername()),
				),
			array(
				'field'=>'homedir_permissions',
				'match'=>711,
				'true'=>'homedir permissions are ok',
				'false'=>'homedir permissions are not ok',
				'command'=>sprintf('schoolmesh_posixaccount_repairhomedir %s # (permission)', $this->getUsername()),
				),
			array(
				'field'=>'homedir_group',
				'match'=>'root',
				'true'=>'homedir group is root',
				'false'=>'homedir group is not root',
				'command'=>sprintf('schoolmesh_posixaccount_repairhomedir %s # (group)', $this->getUsername()),
				),
			array(
				'field'=>'shell',
				'match'=>$this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false',
				'true'=>sprintf('shell is correctly set to «%s»', $this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false'),
				'false'=>sprintf('shell is not set to «%s»', $this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false'),
				'command'=>sprintf('schoolmesh_posixaccount_changeshell %s "%s"', $this->getUsername(), $this->getProfile()->hasPermission('login')?'/bin/bash':'/bin/false'),
				),
			array(
				'field'=>'basefolder_found',
				'match'=>1,
				'true'=>'basefolder was found',
				'false'=>'basefolder was not found',
				'command'=>sprintf('schoolmesh_posixaccount_createbasefolder %s', $this->getUsername()),
				),
			array(
				'field'=>'basefolder_user',
				'match'=>'root',
				'true'=>'basefolder owner is ok',
				'false'=>'basefolder owner is not ok',
				'command'=>sprintf('schoolmesh_posixaccount_repairbasefolder %s # (user)', $this->getUsername()),
				),
			array(
				'field'=>'basefolder_group',
				'match'=>'root',
				'true'=>'basefolder group is ok',
				'false'=>'basefolder group is not ok',
				'command'=>sprintf('schoolmesh_posixaccount_repairbasefolder %s # (group)', $this->getUsername()),
				),
			array(
				'field'=>'basefolder_permissions',
				'match'=>'755',
				'true'=>'basefolder permissions are ok',
				'false'=>'basefolder permissions are not ok',
				'command'=>sprintf('schoolmesh_posixaccount_repairbasefolder %s # (permissions)', $this->getUsername()),
				),
			array(
				'field'=>'basefolder_attr',
				'match'=>'----i--------------',
				'true'=>'basefolder extended attributes are ok',
				'false'=>'basefolder extended attributes are not ok',
				'command'=>sprintf('schoolmesh_posixaccount_repairbasefolder %s # (attr)', $this->getUsername()),
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
					$checkList->addCheck(new Check(Check::WARNING, 'posix: '. $check['false'] . sprintf(' (got «%s», expected «%s»)', $this->getAccountInfo($check['field']), $check['match']), $checkGroup, 
					
					isset($check['command'])? array('command'=>$check['command']) : array()
					
					));
				}
			}

		$this->save();
		return $this;
	}


	public function setFormDefaults(&$form)
	{
		if (! $form instanceof PosixAccountForm)
		{
			throw new Exception('The form must be a PosixAccountForm instance');
		}


	$form->setDefaults(
		array(
			'id' => $this->getId(),
			'used_files' => $this->getAccountInfo('used_files'),
			'used_blocks' => $this->getAccountInfo('used_blocks'),
			'soft_blocks_quota' => $this->getAccountSetting('soft_blocks_quota'),
			'hard_blocks_quota' => $this->getAccountSetting('hard_blocks_quota'),
			'soft_files_quota' => $this->getAccountSetting('soft_files_quota'),
			'hard_files_quota' => $this->getAccountSetting('hard_files_quota'),
			)
		);
	}

}
