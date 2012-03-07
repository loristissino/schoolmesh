<?php

/**
 * WptoolItemTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WptoolItemTypePeer extends BaseWptoolItemTypePeer
{
	
  static public function getByDescription($description)
	{
		$c=new Criteria();
    $c->add(parent::DESCRIPTION, $description);
		return parent::doSelectOne($c);
	}

	static public function getAllNeededForState($state, $appointment_type_id)
	{
		$c=new Criteria();
		$c->add(WptoolItemTypePeer::STATE, $state);
		$c->add(WptoolItemTypePeer::APPOINTMENT_TYPE_ID, $appointment_type_id);
		$c->addAscendingOrderByColumn(WptoolItemTypePeer::RANK);
		return parent::doSelect($c);
	}
	
}
