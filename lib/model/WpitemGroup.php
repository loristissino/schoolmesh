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

		public function getUnevaluated()
	{
     $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
	 
$sql = 'SELECT count( * ) AS number
FROM wpitem_group
JOIN wpmodule_item ON wpitem_group.id = wpmodule_item.wpitem_group_id
JOIN wpitem_type ON wpitem_group.wpitem_type_id = wpitem_type.id
WHERE wpitem_group.id = %d
AND wpmodule_item.evaluation IS NULL
AND wpitem_type.evaluation_max >0';

$sql = sprintf($sql, $this->getId());

$statement = $con->prepare($sql);
$statement->execute();

$resultset= $statement->fetch(PDO::FETCH_OBJ);

$number=$resultset->number;

	return $number;
	}

	
}
