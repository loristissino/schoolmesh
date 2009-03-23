<?php

class Appointment extends BaseAppointment
{
    
    public function getFirstName()
    {
    return $this->getsfGuardUser()->getProfile()->getFirstName();    
    }

    public function getLastName()
    {
    return $this->getsfGuardUser()->getProfile()->getLastName();    
    }


	public function __toString()
	{
			return $this->getSubject() . ' (' . $this->getSchoolclass() . ', ' . $this->getYear() . ')';
	}


    public function getLastLog()
	{
		// meglio usare la funzione sotto e prendere il primo record...rn 
		/*
		$c = new Criteria();
		$c->add(WpeventPeer::APPOINTMENT_ID, $this->getId());
		$c->addDescendingOrderByColumn(WpeventPeer::CREATED_AT);
		$t = WpeventPeer::doSelectOne($c);
		if ($t)
			return $t;
		else
			return NULL;

*/

	if ($t=$this->getWorkflowLogs())
		return $t[0];
	else
		return FALSE;

	}

    public function getWorkflowLogs()
	{
		$c = new Criteria();
		$c->add(WpeventPeer::APPOINTMENT_ID, $this->getId());
		$c->addDescendingOrderByColumn(WpeventPeer::CREATED_AT);
		$t = WpeventPeer::doSelectJoinAll($c);
		if ($t)
			return $t;
		else
			return NULL;
	}

	public function getWpmodules($criteria = null, PropelPDO $con = null)
	{

	if (is_null($criteria))
		{
				$criteria=new Criteria();
		}
	else
		{
				$criteria = clone $criteria;
		}

		$criteria->addAscendingOrderByColumn(WpmodulePeer::RANK);
		
		return parent::getWpmodules($criteria, $con);
	}


}
