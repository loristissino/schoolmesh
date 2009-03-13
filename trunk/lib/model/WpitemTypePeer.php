<?php

class WpitemTypePeer extends BaseWpitemTypePeer
{
	
	
static function retrieveByRank($rank = 1)
{
  $c = new Criteria;
  $c->add(self::RANK, $rank);
  return self::doSelectOne($c); 
}
 
static function getAllByRank()
{
  $c = new Criteria;
  $c->addAscendingOrderByColumn(self::RANK);
  return self::doSelect($c); 
}
 
static function getMaxRank()
{
  $con = Propel::getConnection(self::DATABASE_NAME);
  $sql = 'SELECT MAX('.self::RANK.') AS max FROM '.self::TABLE_NAME; 
  $stmt = $con->prepare($sql);
  $stmt->execute();
 
  $row = $stmt->fetch();
  return $row['max'];
}
}
