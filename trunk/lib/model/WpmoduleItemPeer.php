<?php

class WpmoduleItemPeer extends BaseWpmoduleItemPeer
{
	
	public function retrieveByRank($rank=1, $workplan=1, $type=1)
	{
	$c = new Criteria;
    $c->add(self::RANK, $rank);
    $c->add(self::WPMODULE_ID, $workplan);
    $c->add(self::WPITEM_TYPE_ID, $type);
	return self::doSelectOne($c); 	
	
	}
/*	
	static function getAllByRank($workplan=1)
	{
	  $c = new Criteria;
      $c->add(self::WPMODULE_ID, $workplan);
	  $c->addAscendingOrderByColumn(self::RANK);
	  return self::doSelectJoinAll($c); 
	}
 */
   static function getMaxRank($workplan=1, $type=1)
	{
	  $con = Propel::getConnection(self::DATABASE_NAME);
	  $sql = 'SELECT MAX('.self::RANK.') AS max FROM '.self::TABLE_NAME . ' WHERE '.self::WPMODULE_ID.'='.$workplan .' AND '.self::WPITEM_TYPE_ID.'='.$type;
	  $stmt = $con->prepare($sql);
	  $stmt->execute();
	 
	  $row = $stmt->fetch();
	  return $row['max'];
	}
	
}
