<?php

require 'lib/model/om/BaseSuggestion.php';


/**
 * Skeleton subclass for representing a row from the 'suggestion' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
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


} // Suggestion
