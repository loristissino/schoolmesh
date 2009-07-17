<?php

class WptoolAppointmentPeer extends BaseWptoolAppointmentPeer
{
	
		public static function retrieveByAppointmentIdAndToolId($app_id, $tool_id, PropelPDO $con = null)
	{

		if ($con === null) {
			$con = Propel::getConnection(WptoolAppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(WptoolAppointmentPeer::DATABASE_NAME);
		$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $app_id);
		$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $tool_id);

		$v = WptoolAppointmentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function countToolsOfTypeForAppointment($typeId, $appointmentId)
	
	{
		
	$c = new Criteria();
	
	$c->add(WptoolAppointmentPeer::APPOINTMENT_ID, $appointmentId);
	$c->addJoin(WptoolAppointmentPeer::WPTOOL_ITEM_ID, WptoolItemPeer::ID);
	$c->add(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID, $typeId);
	
	return self::doCount($c);
	
	}
	
	
}
