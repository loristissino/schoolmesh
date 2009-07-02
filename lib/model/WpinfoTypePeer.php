<?php

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

	static public function getAllNeededForState($state)
	{
		$c=new Criteria();
		$c->add(WpinfoTypePeer::STATE, $state);
		$c->addAscendingOrderByColumn(WpinfoTypePeer::RANK);
		return parent::doSelect($c);
	}

/*
	static public function getNeededForWorkplan($id)
	{
		$c=new Criteria();

		$c->addJoin(WpinfoTypePeer::ID, WpinfoPeer::WPINFO_TYPE_ID, Criteria::LEFT_JOIN);
		$c->add(WpinfoPeer::APPOINTMENT_ID, $id);
		$t = WpinfoTypePeer::doSelect($c);
		return $t;
	}
*/



}
