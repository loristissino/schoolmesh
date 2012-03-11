<?php

/**
 * WptoolItemTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WptoolItemTypePeer extends BaseWptoolItemTypePeer
{
	
  static public function getByDescription($description)
	{
		$c=new Criteria();
    $c->add(parent::DESCRIPTION, $description);
		return parent::doSelectOne($c);
	}

	static public function getAllNeededForAppointment(Appointment $appointment)
	{
		$c=new Criteria();
		$c->add(WptoolItemTypePeer::APPOINTMENT_TYPE_ID, $appointment->getAppointmentTypeId());
		$c->add(self::STATE_MIN, $appointment->getState(), Criteria::LESS_EQUAL);
		$c->add(self::STATE_MAX, $appointment->getState(), Criteria::GREATER_EQUAL);
		$c->add(self::GRADE_MIN, $appointment->getSchoolclass()->getGrade(), Criteria::LESS_EQUAL);
		$c->add(self::GRADE_MAX, $appointment->getSchoolclass()->getGrade(), Criteria::GREATER_EQUAL);
		$c->addAscendingOrderByColumn(WptoolItemTypePeer::RANK);
		return parent::doSelect($c);
	}
	
}
