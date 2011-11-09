<?php

require 'lib/model/om/BaseProjResourcePeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'proj_resource' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjResourcePeer extends BaseProjResourcePeer {

  public static function retrieveAllForYearAndRole($year, $role_id)
	{
		$c=new Criteria();
    $c->addJoin(self::SCHOOLPROJECT_ID, SchoolprojectPeer::ID);
    $c->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID);
    $c->addJoin(self::PROJ_RESOURCE_TYPE_ID, ProjResourceTypePeer::ID);
		$c->add(SchoolprojectPeer::YEAR_ID, $year);
    $c->add(ProjResourceTypePeer::ROLE_ID, $role_id);
    $c->add(SchoolprojectPeer::STATE, Workflow::PROJ_SUBMITTED, Criteria::GREATER_EQUAL);
    $c->addAscendingOrderByColumn(ProjCategoryPeer::RANK);
    $c->addAscendingOrderByColumn(SchoolprojectPeer::TITLE);
		return self::doSelectJoinAll($c);
	}


} // ProjResourcePeer
