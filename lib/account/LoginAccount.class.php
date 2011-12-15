<?php

/**
 * LoginAccount class.
 *
 * @package    schoolmesh
 * @subpackage lib.account
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */
class LoginAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('login'));
	}
	
	public function updateInfoFromRealWorld()
	{
		$this->resetInfo();
		$info=Generic::executeCommand(sprintf('loginaccount_getinfo %s', $this->getUsername()), false);
		
		// first, we retrieve the values...
		foreach($info as $key=>$value)
		{
			$this->setAccountInfo($key, $value);
		}
		$this->setInfoUpdatedAt(time());

		$posixAccount=$this->getSiblingAccountByType('posix');

		$this->setExists($posixAccount->getExists());
		$this->setIsLocked($posixAccount->getIsLocked());
		$this->setAccountInfo('shell', $posixAccount->getAccountInfo('shell'));
		
		// second, we copy them in the settings if they are empty (but only editable ones)
		foreach(array(
			'shell',
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

	public function getImage()
	{
		return 'login';
	}

	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		$this->updateInfoFromRealWorld();
		
		$checks=array(
			array(
				'field'=>'shell',
				'match'=>$this->getAccountSetting('shell'),
				'true'=>'shell is correctly set',
				'false'=>'shell is not correctly set',
				'command'=>sprintf('schoolmesh_loginaccount_changeshell %s "%s"', $this->getUsername(), $this->getAccountSetting('shell')),
				),
			);

		$this->makeComparisons($checkList, $checks, $checkGroup);
		$this->save();
		return $this;
	}
	
	public function saveSettings($params)
	{
		
		$this
		->setAccountSetting('shell', $params['shell'])
		->save();
		return $this;
	}

	public function setFormDefaults(LoginAccountForm &$form)
	{

	$form->setDefaults(
		array(
			'id' => $this->getId(),
			'shell' => $this->getAccountSetting('shell')
			)
		);
	}

	public function getIsDeletable()
	{
		return $this->getAccountInfo('shell')=='/bin/false';
	}


  public function changePassword($password, $is_reset=false)
	{
		Generic::executeCommand(sprintf('loginaccount_setpassword %s "%s"', $this->getUsername(), $this->getTemporaryPassword()));
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


