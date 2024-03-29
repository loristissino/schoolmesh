<?php

/**
 * WpitemType class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpitemType extends BaseWpitemType
{
	
	public function __toString()
	{
	return $this->getTitle();
	}
	
	public function swapWith($item)
{
  $con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME);
  try
  {
    $con->beginTransaction();

    $rank = $this->getRank();  
    $this->setRank($item->getRank());
    $this->save();
    $item->setRank($rank);
    $item->save();
 
    $con->commit();
  }
  catch (Exception $e)
  {
    $con->rollback();
    throw $e;
  }
} 
	
	public function save(PropelPDO $con = null)
{
  // New records need to be initialized with rank = maxRank +1
  if(!$this->getId())
  {
    $con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
 
      $this->setRank(WpitemTypePeer::getMaxRank()+1);
      parent::save();
 
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }
  else
  {
    parent::save(); 
  }
} 
 
public function delete(PropelPDO $con = null)
{  
  $con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME);
  try
  {
    $con->beginTransaction();
 
    // decrease all the ranks of the page records of the same category with higher rank 
    $sql = 'UPDATE '.WpitemTypePeer::TABLE_NAME.' SET '.WpitemTypePeer::RANK.' = '.WpitemTypePeer::RANK.' - 1 WHERE '.WpitemTypePeer::RANK.' > '.$this->getRank();
    $con->executeQuery($sql);
    // delete the item
    parent::delete();
 
    $con->commit();
  }
  catch (Exception $e)
  {
    $con->rollback();
    throw $e;
  }
}
	
}
