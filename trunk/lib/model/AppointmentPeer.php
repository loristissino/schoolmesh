<?php

class AppointmentPeer extends BaseAppointmentPeer
{
	
	public static function getSubmitted($state)
	{
		
	$c=new Criteria();
	$c->add(AppointmentPeer::STATE, $state);
	return parent::doSelect($c);

	}
}
