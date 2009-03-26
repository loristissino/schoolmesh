<?php

class WpmoduleItemPeer extends BaseWpmoduleItemPeer
{
	
	static function retrieveByRank($rank=1, $wpitemGroupId=1)
	{
	$c = new Criteria;
    $c->add(self::RANK, $rank);
    $c->add(self::WPITEM_GROUP_ID, $wpitemGroupId);
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
/*   static function getMaxRank($workplan=1, $wpitem_group=1)
	{
	  $con = Propel::getConnection(self::DATABASE_NAME);
	  $sql = 'SELECT MAX('.self::RANK.') AS max FROM '.self::TABLE_NAME . ' WHERE '.self::WPMODULE_ID.'='.$workplan .' AND '.self::WPITEM_TYPE_ID.'='.$type;
	  $stmt = $con->prepare($sql);
	  $stmt->execute();
	 
	  $row = $stmt->fetch();
	  return $row['max'];
	}
	*/
}
