<?php

/**
 * WpitemTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpitemTypePeer extends BaseWpitemTypePeer
{
	
static function retrieveByTitle($title)
{
  $c = new Criteria;
  $c->add(self::TITLE, $title);
  return self::doSelectOne($c); 
}


static function retrieveByRank($rank = 1)
{
  $c = new Criteria;
  $c->add(self::RANK, $rank);
  return self::doSelectOne($c); 
}
 
static function getAllByRank(Appointment $appointment)
{
  $c = new Criteria;
  $c->add(self::APPOINTMENT_TYPE_ID, $appointment->getAppointmentTypeId());
  $c->add(self::GRADE_MIN, $appointment->getSchoolclass()->getGrade(), Criteria::LESS_EQUAL);
	$c->add(self::GRADE_MAX, $appointment->getSchoolclass()->getGrade(), Criteria::GREATER_EQUAL);
  $c->addAscendingOrderByColumn(self::RANK);
  return self::doSelect($c); 
}
 
static function getMaxRank()
{
  $con = Propel::getConnection(self::DATABASE_NAME);
  $sql = 'SELECT MAX('.self::RANK.') AS max FROM '.self::TABLE_NAME; 
  $stmt = $con->prepare($sql);
  $stmt->execute();
 
  $row = $stmt->fetch();
  return $row['max'];
}

static function retrieveByCodeAndAppointmentType($code, $appointment_type_id)
{
  $c = new Criteria;
  $c->add(self::CODE, $code);
  $c->add(self::APPOINTMENT_TYPE_ID, $appointment_type_id);
  $c->addAscendingOrderByColumn(self::RANK);
  return self::doSelectOne($c); 
}




}
