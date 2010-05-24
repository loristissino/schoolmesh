<?php

require 'lib/model/om/BaseRecuperationHintPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'recuperation_hint' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class RecuperationHintPeer extends BaseRecuperationHintPeer {
	
	
	public static function retrieveAllByRankForTeacher($UserId)
	{
		
		// we also return common Hints (the ones that do not have a user id set)
		$c=new Criteria();
		$c1 = $c->getNewCriterion(self::USER_ID, null, Criteria::ISNULL);
		$c1->addOr($c->getNewCriterion(self::USER_ID, $UserId));
		$c->add($c1);
    $c->add(self::IS_SELECTABLE, true);
		$c->addAscendingOrderByColumn(self::RANK);
		return self::doSelect($c);
	}


} // RecuperationHintPeer
