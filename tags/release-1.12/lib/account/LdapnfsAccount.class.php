<?php

/**
 * LdapnfsAccount class.
 *
 * @package    schoolmesh
 * @subpackage lib.account
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */
class LdapnfsAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('ldapnfs'));
	}
	
	public function updateInfoFromRealWorld()
	{
		return $this;
	}

	public function getImage()
	{
		return 'ldapnfs';
	}

	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		return $this;
	}


}
