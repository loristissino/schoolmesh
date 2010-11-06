<?php

class SambaAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountInfo('message', 'this is a samba account');
		$this->setAccountType(AccountTypePeer::retrieveByName('samba'));
	}
	
	public function getImage()
	{
		return 'samba';
	}
	
	public function updateInfoFromRealWorld()
	{
		$this->resetInfo();
		$info=Generic::executeCommand(sprintf('sambaaccount_getinfo %s', $this->getUsername()), false);
		
		// first, we retrieve the values...
		foreach($info as $key=>$value)
		{
			$this->setAccountInfo($key, $value);
		}
		$this->setInfoUpdatedAt(time());

		$this->setExists($this->getAccountInfo('found')==1);
		$this->setIsLocked(strpos($this->getAccountInfo('account_flags'), 'D')!=0);
		
		// second, we copy them in the settings if they are empty (but only editable ones)
		foreach(array(
		) as $key)
		{
			if(!$this->getAccountSetting($key))
			{
				$this->setAccountSetting($key, $this->getAccountInfo($key));
			}
		}

		
		if($this->getAccountInfo('lastlogin_known')==1)
		{
			$this->setLastKnownLoginAt($this->getAccountInfo('lastlogin_at'));
		}
		else
		{
			$this->setLastKnownLoginAt(null);
		}
		
		
		return $this;
	}

	public function setFormDefaults(SambaAccountForm &$form)
	{

/*	$form->setDefaults(
		array(
			'id' => $this->getId(),
			'shell' => $this->getAccountSetting('shell')
			)
		);

*/
	}


	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		
		$this->updateInfoFromRealWorld();
		
		if ($this->getAccountInfo('found')==0)
		{
			$checkList->addCheck(new Check(Check::FAILED, 'samba: account not found', $checkGroup, array(
				'command'=>sprintf('schoolmesh_sambaaccount_create %s "%s" "%s"',
					$this->getUsername(),
					$this->getProfile()->getFullName(),
					$this->getTemporaryPassword())
				)));
			$this->save();
			return $this;
		}
		else
		{
			$checkList->addCheck(new Check(Check::PASSED, 'samba: account found', $checkGroup));
		}

		
		$checks=array(
			array(
				'field'=>'fullname',
				'match'=>$this->getProfile()->getFullName(),
				'true'=>'full name is ok',
				'false'=>'full name does not match',
				'command'=>sprintf('schoolmesh_sambaaccount_changefullname %s "%s"', $this->getUsername(), $this->getProfile()->getFullName()),
				),
			);

		$this->makeComparisons($checkList, $checks, $checkGroup);
		$this->save();
		return $this;
	}


  public function changePassword($password, $is_reset=false)
	{
		Generic::executeCommand(sprintf('sambaaccount_setpassword %s "%s"', $this->getUsername(), $password), false);
		if($is_reset)
		{
			$this
			->setTemporaryPassword(null)
			->save();
		}
		return $this;
	}
	
  
  public function getPasswordIsResettable()
	{
		return true;
	}


}
