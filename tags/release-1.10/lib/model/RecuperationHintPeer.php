<?php

/**
 * RecuperationHintPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
