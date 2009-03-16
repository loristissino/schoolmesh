<?php

class Wpmodule extends BaseWpmodule
{
	public function __toString()
	{
			return $this->getTitle(); 
	}
	
	
    public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{
		/*
		if (is_null($criteria))
		{
			$criteria = new Criteria();
		}
		else
		{
				$criteria = clone $criteria;
		}
*/

	    $c = new Criteria();
		$c->add(WpmoduleItemPeer::WPMODULE_ID, $this->getId());
		$c->addAscendingOrderByColumn(WpitemTypePeer::RANK);
		$c->addAscendingOrderByColumn(WpmoduleItemPeer::RANK);
		$t = WpmoduleItemPeer::doSelectJoinAll($c);
		return $t;

	}
}
