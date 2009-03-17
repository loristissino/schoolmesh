<?php

class WpmoduleItem extends BaseWpmoduleItem
{
	
	public function __toString()
	{
			return $this->getContent();
		
	}
	
	
	public function getMaxRank()
	{
	// return the max rank of a record with the same module id and the same type
    return WpmoduleItemPeer::getMaxRank($this->getWpmoduleId(), $this->getWpitemTypeId());	
	}
	
	public function save(PropelPDO $con = null)
	{
	  // New records need to be initialized with rank = maxRank +1
	  if(!$this->getId())
	  {
		$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME);
		try
		{
		  $con->beginTransaction();
	 
		  $this->setRank(WpmoduleItemPeer::getMaxRank($this->getWpmoduleId(), $this->getWpitemTypeId())+1);
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
	  $con = Propel::getConnection(PagePeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();
	 
		// decrease all the ranks of the page records of the same category with higher rank 
		$sql = 'UPDATE '.WpmoduleItemPeer::TABLE_NAME.' SET '.WpmoduleItemPeer::RANK.' = '.WpmoduleItemPeer::RANK.' - 1 WHERE '.WpmoduleItemPeer::RANK.' > '.$this->getRank() . ' AND ' . WpmoduleItemPeer::WPMODULE_ID .'='. $this->getWorkplanId() .' AND '. WpmoduleItemPeer::WPITEM_TYPE_ID.'='.$this->getWpitemTypeId();
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
