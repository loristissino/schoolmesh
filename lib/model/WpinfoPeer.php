<?php

class WpinfoPeer extends BaseWpinfoPeer
{
	
	public static function retrieveByAppointmentIdAndType($appointmentId, $wpinfotypeId)
		{
			$c=new Criteria();
			$c->add(WpinfoPeer::APPOINTMENT_ID, $appointmentId);
			$c->add(WpinfoPeer::WPINFO_TYPE_ID, $wpinfotypeId);
			$t = WpinfoPeer::doSelectOne($c);
			return $t;
		}
}
