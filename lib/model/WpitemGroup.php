<?php

class WpitemGroup extends BaseWpitemGroup
{
	public function __toString()
	{
	return $this->getId();	
	}
	
	public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{

	if (is_null($criteria))
		{
				$criteria=new Criteria();
		}
	else
		{
				$criteria = clone $criteria;
		}

		$criteria->addAscendingOrderByColumn(WpmoduleItemPeer::RANK);
		
		return parent::getWpmoduleItems($criteria, $con);
	}

	
	
}
