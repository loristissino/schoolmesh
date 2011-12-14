<?php

/**
 * MoodleAccount class.
 *
 * @package    schoolmesh
 * @subpackage lib.account
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */
class MoodleAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountInfo('message', 'this is a moodle account');
		$this->setAccountType(AccountTypePeer::retrieveByName('moodle'));
	}
	
	public function getImage()
	{
		return 'baby im a moodle account!';
	}
	
	
}
