<?php

/**
 * Suggestion class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Suggestion extends BaseSuggestion {


	public function getStudentIdsForAppointmentAndTerm($appointment_id, $term_id)
	{
		$c = new Criteria();
		$c->add(StudentSuggestionPeer::SUGGESTION_ID, $this->getId());
		$c->add(StudentSuggestionPeer::APPOINTMENT_ID, $appointment_id);
		$c->add(StudentSuggestionPeer::TERM_ID, $term_id);

		$result= StudentSuggestionPeer::doSelect($c);
		
		$ids=array();
		foreach($result as $r)
		{
			$ids[]=$r->getUserId();
		}
		
		return $ids;
	}

	public function hasStudentSuggestionForAppointment($student_id, $appointment_id, $term_id)
	{
		$c = new Criteria();
		$c->add(StudentSuggestionPeer::SUGGESTION_ID, $this->getId());
		$c->add(StudentSuggestionPeer::APPOINTMENT_ID, $appointment_id);
		$c->add(StudentSuggestionPeer::TERM_ID, $term_id);
		$c->add(StudentSuggestionPeer::USER_ID, $student_id);

		return (StudentSuggestionPeer::doCount($c)==1);
	}


} // Suggestion
