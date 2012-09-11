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
	public function __toString()
  {
    return sprintf('%s %s (%s)', $this->getFirstName(), $this->getLastName(), $this->getSchoolclassId());
  }
  
	public function getFirstName()
	{
	return $this->getsfGuardUser()->getProfile()->getFirstName();
	}
	public function getLastName()
	{
	return $this->getsfGuardUser()->getProfile()->getLastName();
	}


}
