<?php

/**
 * WpinfoTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpinfoTypePeer extends BaseWpinfoTypePeer
{
	
	static public function getByTitle($title)
	{
		$c=new Criteria();
	    $c->add(WpinfoTypePeer::TITLE, $title);
		return parent::doSelectOne($c);

	}

	static public function getAll()
	{
		$c=new Criteria();
		return parent::doSelect($c);
	}

	static public function getAllNeededForAppointment(Appointment $appointment)
	{
    
		$c=new Criteria();
		$c->add(self::STATE_MIN, $appointment->getState(), Criteria::LESS_EQUAL);
		$c->add(self::STATE_MAX, $appointment->getState(), Criteria::GREATER_EQUAL);
		$c->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $appointment->getAppointmentTypeId());
		$c->add(self::GRADE_MIN, $appointment->getSchoolclass()->getGrade(), Criteria::LESS_EQUAL);
		$c->add(self::GRADE_MAX, $appointment->getSchoolclass()->getGrade(), Criteria::GREATER_EQUAL);
		$c->addAscendingOrderByColumn(WpinfoTypePeer::RANK);
		return parent::doSelect($c);
	}




}
