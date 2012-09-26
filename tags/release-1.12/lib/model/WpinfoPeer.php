<?php

/**
 * WpinfoPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


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
    
    
	public static function retrieveByAppointmentIdAndCode($appointmentId, $code)
		{
			$c=new Criteria();
			$c->add(WpinfoPeer::APPOINTMENT_ID, $appointmentId);
			$c->addJoin(WpinfoPeer::WPINFO_TYPE_ID, WpinfoTypePeer::ID);
			$c->add(WpinfoTypePeer::CODE, $code);
			$t = WpinfoPeer::doSelectOne($c);
			return $t;
		}

}
