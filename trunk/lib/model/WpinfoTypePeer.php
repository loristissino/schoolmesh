<?php

/**
 * WpinfoTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpinfoTypePeer extends BaseWpinfoTypePeer
{
	
	static public function getByTitle($title)
	{
		$c=new Criteria();
	    $c->add(WpinfoTypePeer::TITLE, $title);
		return parent::doSelectOne($c);

	}

	static public function getAll()
	{
		$c=new Criteria();
		return parent::doSelect($c);
	}

	static public function getAllNeededForState($state, $appointment_type_id)
	{
		$c=new Criteria();
		$c->add(WpinfoTypePeer::STATE, $state);
		$c->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $appointment_type_id);
		$c->addAscendingOrderByColumn(WpinfoTypePeer::RANK);
		return parent::doSelect($c);
	}




}
