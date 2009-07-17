<?php

class WptoolItemTypePeer extends BaseWptoolItemTypePeer
{
	
		static public function getByDescription($description)
	{
		$c=new Criteria();
	    $c->add(parent::DESCRIPTION, $description);
		return parent::doSelectOne($c);
	}

	static public function getAllNeededForState($state)
	{
		$c=new Criteria();
		$c->add(WptoolItemTypePeer::STATE, $state);
		$c->addAscendingOrderByColumn(WptoolItemTypePeer::RANK);
		return parent::doSelect($c);
	}
	
}
