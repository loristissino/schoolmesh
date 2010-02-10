<?php

require 'lib/model/om/BaseSchoolprojectPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'schoolproject' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SchoolprojectPeer extends BaseSchoolprojectPeer {


    public static function retrieveAllForYear($year)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addAscendingOrderByColumn(self::PROJ_CATEGORY_ID);
		return self::doSelectJoinAll($c);
		
	}

	public static function retrieveByTitleAndYear($title, $yearId)
	{
		$c=new Criteria();
		$c->add(self::TITLE, $title);
		$c->add(self::YEAR_ID, $yearId);
		return self::doSelectOne($c);
	}


} // SchoolprojectPeer
