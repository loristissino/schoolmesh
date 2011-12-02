<?php

/**
 * RecuperationHint class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class RecuperationHint extends BaseRecuperationHint {

	public function getStudentIdsForAppointmentAndTerm($appointment_id, $term_id)
	{
		$c = new Criteria();
		$c->add(StudentHintPeer::RECUPERATION_HINT_ID, $this->getId());
		$c->add(StudentHintPeer::APPOINTMENT_ID, $appointment_id);
		$c->add(StudentHintPeer::TERM_ID, $term_id);

		$result= StudentHintPeer::doSelect($c);
		
		$ids=array();
		foreach($result as $r)
		{
			$ids[]=$r->getUserId();
		}
		
		return $ids;
	}

	public function hasStudentHintForAppointment($student_id, $appointment_id, $term_id)
	{
		$c = new Criteria();
		$c->add(StudentHintPeer::RECUPERATION_HINT_ID, $this->getId());
		$c->add(StudentHintPeer::APPOINTMENT_ID, $appointment_id);
		$c->add(StudentHintPeer::TERM_ID, $term_id);
		$c->add(StudentHintPeer::USER_ID, $student_id);

		return (StudentHintPeer::doCount($c)==1);
	}




	public function getIsEditable()
	{
		return ($this->getUserId()<>null);
	}


	public function setCheckedContent($value)
	{
		$value=ltrim(rtrim($value));
		
		$this->setContent($value==''?'...':$value);
		return $this;
	}


} // RecuperationHint
