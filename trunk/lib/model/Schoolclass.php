<?php

/**
 * Schoolclass class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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

	public function getCurrentAppointments($appointment_type_id=null)
	{
		
		$c=new Criteria();
		$c->add(AppointmentPeer::SCHOOLCLASS_ID, $this->getId());
		$c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
    if($appointment_type_id)
    {
      $c->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $appointment_type_id);
    }
		$c->addAscendingOrderByColumn(SubjectPeer::RANK);
		$c->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, Criteria::LEFT_JOIN);
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
    $c->addSelectColumn(SubjectPeer::DESCRIPTION);
    $c->addJoin(SyllabusItemPeer::ID, WpmoduleSyllabusItemPeer::SYLLABUS_ITEM_ID);
    $c->addJoin(WpmoduleSyllabusItemPeer::WPMODULE_ID, WpmodulePeer::ID);
    $c->addJoin(WpmodulePeer::APPOINTMENT_ID, AppointmentPeer::ID);
    $c->add(AppointmentPeer::SCHOOLCLASS_ID, $this->getId());
    $c->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID);
    $c->setDistinct();
    
    $stmt=SyllabusItemPeer::doSelectStmt($c);

    $contributions=array();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        $contributions[$row->ID][$row->APPOINTMENT_ID][]=array(
          'id'=>$row->WPMODULE_ID,
          'title'=>$row->TITLE,
          'contribution'=>$row->CONTRIBUTION,
          'subject'=>$row->DESCRIPTION,
          );
    };

    return $contributions;
    

  }

	public function getOdf($doctype, sfContext $sfContext=null, $params=array())
	{
    $template=sprintf('schoolclass_info.odt');
    
    Generic::logMessage('using template', $template);
    Generic::logMessage('creating odf for schoolclass', $this->getId());

		try
		{
			$odf=new OdfDoc($template, $this->__toString(). '.' . $doctype, $doctype);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		
		$odfdoc->setVars('schoolclass',  $this->getId());
    $odfdoc->setVars('date', date('d/m/Y'));
    
    $infos=$odfdoc->setSegment('infos');
    foreach($params['wpinfotypes'] as $wpinfotype)
    {
      $infos->infoTitle($wpinfotype->getTitle());
      $infos->infoDescription($wpinfotype->getDescription());
      
      foreach($params['appointments'] as $appointment)
      {
        $wpinfo=$appointment->getWpinfo($wpinfotype->getId());
        if(!$wpinfo or !$wpinfo->getContent() or $appointment->getState() <= $wpinfotype->getStateMin())
        {
          continue;
        }
        $infos->appointments->appointmentSubject($appointment->getSubject());
        $infos->appointments->appointmentTeacher($appointment->getTeacherNameWithTitle());
        $infos->appointments->appointmentContent($wpinfo);
        $infos->appointments->merge();
      }
      
      $infos->merge();
    }

    $odfdoc->mergeSegment($infos);
    
    Generic::logMessage('document', 'prepared');
		return $odf;
	}

}
