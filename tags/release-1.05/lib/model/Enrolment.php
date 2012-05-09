<?php

/**
 * Enrolment class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class Enrolment extends BaseEnrolment
{
	
	public function getFirstName()
	{
	return $this->getsfGuardUser()->getProfile()->getFirstName();
	}
	public function getLastName()
	{
	return $this->getsfGuardUser()->getProfile()->getLastName();
	}


}
