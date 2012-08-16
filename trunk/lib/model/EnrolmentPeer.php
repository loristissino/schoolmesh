<?php

/**
 * EnrolmentPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class EnrolmentPeer extends BaseEnrolmentPeer
{
  public static function countCurrentEnrolmentsOfUser($userId)
	{
    $c=new Criteria();
    $c->add(EnrolmentPeer::USER_ID, $userId);
    $c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
    $enr =  parent::doCount($c);
    return $enr;
	}
		
  public static function retrieveByImportCode($import_code)
	{
    $c=new Criteria();
    $c->addJoin(EnrolmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->add(sfGuardUserProfilePeer::IMPORT_CODE, $import_code);
    $c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
    
    return self::doSelectOne($c);
	}



}
