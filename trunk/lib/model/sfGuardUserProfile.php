<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile
{
	
		public function __toString()
		{
				return $this->getFullName();
		}
        public function getFullName()
        {
                return $this->getFirstName() . ' ' . $this->getLastName();
        }

        public function getUsername()
        {
                return $this->getsfGuardUser()->getUsername();
        }

        public function getCurrentAppointments()
        {
	        $c = new Criteria();
		$c->add(AppointmentPeer::USER_ID, $this->getUserId());
		$c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
		$t = AppointmentPeer::doSelectJoinAllExceptsfGuardUser($c);
		return $t;
        }

        public function getWorkplans()
        {
	    $c = new Criteria();
		$c->add(AppointmentPeer::USER_ID, $this->getUserId());
		$c->addDescendingOrderByColumn(AppointmentPeer::YEAR_ID);
		$c->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID);
		$c->addAscendingOrderByColumn(AppointmentPeer::SUBJECT_ID);
		$t = AppointmentPeer::doSelectJoinAll($c);
		return $t;
        }

        public function getTeams()
        {
	        $c = new Criteria();
		$c->add(UserTeamPeer::USER_ID, $this->getUserId());
		$t = UserTeamPeer::doSelectJoinAllExceptsfGuardUser($c);
		return $t;
        }

        public function getIsMale()
        {
            return $this->getGender()=='M' ? 1: 0;
        }

}
