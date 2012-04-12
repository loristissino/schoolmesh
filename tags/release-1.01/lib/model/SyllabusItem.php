<?php

/**
 * SyllabusItem class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SyllabusItem extends BaseSyllabusItem {

  public function getRef()
  {
    $ref=parent::getRef();
    return substr($ref,0,1)=='~' ? '': $ref;
  }

  public function setValues($syllabus_id, $content, $level, $parent_id, $is_selectable=false, $rank=0)
  {
    
    if(strpos($content,'§')>0)
    {
      list($ref,$content)=explode('§', $content);
    }
    else
    {
      $ref=uniqid('~', true);
    }
    
    $this
    ->setSyllabusId($syllabus_id)
    ->setRef($ref)
    ->setContent($content)
    ->setLevel($level)
    ->setParentId($parent_id)
    ->setIsSelectable($is_selectable)
    ->setRank($rank)
    ;
    
    return $this;
    
  }
  
  
	public function getStudentIdsForAppointmentAndTerm($appointment_id, $term_id)
	{
		$c = new Criteria();
		$c->add(StudentSyllabusItemPeer::SYLLABUS_ITEM_ID, $this->getId());
		$c->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $appointment_id);
		$c->add(StudentSyllabusItemPeer::TERM_ID, $term_id);

		$result=StudentSyllabusItemPeer::doSelect($c);
		
		$ids=array();
		foreach($result as $r)
		{
			$ids[]=$r->getUserId();
		}
		
		return $ids;
	}

	public function hasStudentSyllabusItemForAppointment($student_id, $appointment_id, $term_id)
	{
		$c = new Criteria();
		$c->add(StudentSyllabusItemPeer::SYLLABUS_ITEM_ID, $this->getId());
		$c->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $appointment_id);
		$c->add(StudentSyllabusItemPeer::TERM_ID, $term_id);
		$c->add(StudentSyllabusItemPeer::USER_ID, $student_id);

		return (StudentSyllabusItemPeer::doCount($c)==1);
	}



  

} // SyllabusItem
