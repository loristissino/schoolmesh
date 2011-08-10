<?php

/**
 * Subclass for representing a row from the 'schoolclass' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Schoolclass extends BaseSchoolclass
{

  public function __toString()
  {
        return $this->getShortcut(); 
  }
  
  public function getShortcut()
  {
        return $this->getId();
//        return $this->getGrade() . $this->getSection() . $this->getAddress(); 
 
  }

  public function getFullDescription()
  {
        return $this->getGrade() . $this->getSection() . $this->getAddress()->getFullDescription(); 
 
  }

	public function getCurrentEnrolments()
	{
		
		$c=new Criteria();
		$c->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->getId());
		$c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
		$c->addJoin(EnrolmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
		return EnrolmentPeer::doSelectJoinAll($c);
	}

	public function getCurrentAppointments()
	{
		
		$c=new Criteria();
		$c->add(AppointmentPeer::SCHOOLCLASS_ID, $this->getId());
		$c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
		$c->addAscendingOrderByColumn(SubjectPeer::RANK);
		$c->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID);
		return AppointmentPeer::doSelectJoinAll($c);
	}


  public function getSyllabusContributions()
  {
    $c=new Criteria();
    $c->clearSelectColumns();
    $c->addSelectColumn(SyllabusItemPeer::ID);
    $c->addSelectColumn(WpmodulePeer::APPOINTMENT_ID);
    $c->addSelectColumn(WpmoduleSyllabusItemPeer::WPMODULE_ID);
    $c->addSelectColumn(WpmodulePeer::TITLE);
    $c->addSelectColumn(WpmoduleSyllabusItemPeer::CONTRIBUTION);
    $c->addJoin(SyllabusItemPeer::ID, WpmoduleSyllabusItemPeer::SYLLABUS_ITEM_ID);
    $c->addJoin(WpmoduleSyllabusItemPeer::WPMODULE_ID, WpmodulePeer::ID);
    $c->addJoin(WpmodulePeer::APPOINTMENT_ID, AppointmentPeer::ID);
    $c->add(AppointmentPeer::SCHOOLCLASS_ID, $this->getId());
    $c->setDistinct();
    
    $stmt=SyllabusItemPeer::doSelectStmt($c);

    $contributions=array();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        $contributions[$row->ID][$row->APPOINTMENT_ID][]=array(
          'id'=>$row->WPMODULE_ID,
          'title'=>$row->TITLE,
          'contribution'=>$row->CONTRIBUTION
          );
    };

    return $contributions;
    

  }


}
