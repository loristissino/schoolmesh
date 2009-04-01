<?php

class Wpmodule extends BaseWpmodule
{
	
	public function swapWith($item)
	{
	  $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
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


	public function __toString()
	{
			return $this->getTitle(); 
	}
	
	
    public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{

	    $c = new Criteria();
		$c->add(WpmoduleItemPeer::WPMODULE_ID, $this->getId());
		$c->addAscendingOrderByColumn(WpitemTypePeer::RANK);
		$c->addAscendingOrderByColumn(WpmoduleItemPeer::RANK);
		$t = WpmoduleItemPeer::doSelectJoinAll($c);
		return $t;

	}
	
	
	public function getOwner()
	{
	    $c = new Criteria();
		$c->add(sfGuardUserProfilePeer::USER_ID, $this->getUserId());
		$t = sfGuardUserProfilePeer::doSelectOne($c);
		return $t;
	}
	
		public function save(PropelPDO $con = null)
	{
	  // New records need to be initialized with rank = maxRank +1
	  
	  if(!$this->getId())
	  {
		$con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
		try
		{
		  $con->beginTransaction();

		  if($this->getAppointmentId()!=NULL)
			$this->setRank($this->getAppointment()->countWpmodules()+1);
		  else
			$this->setRank(NULL);
		  parent::save();
		
		
		// We need to prepare the groups of module items...
		
		
	 
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


	public function applyDefaultValues()
	{
		  if($this->getAppointmentId()!=NULL)
			$this->setRank($this->getAppointment()->countWpmodules()+1);
		  else
			$this->setRank(NULL);
		$this->setTitle('---');
		$this->setPeriod('---');

	}

	public function createWpitemGroups()

{
		$groups=WpitemTypePeer::getAllByRank();
		foreach($groups as $group)
			{
				$newgroup=new WpitemGroup();
				$newgroup->setWpmoduleId($this->getId());
				$newgroup->setWpitemTypeId($group->getId());
				$newgroup->save();
			}
	}

	public function delete(PropelPDO $con = null)
	{  
	  $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
	
	  if ($this->getRank()!==NULL)
	{  
	  try
	  {
		$con->beginTransaction();
	 
		// decrease all the ranks of the page records of the same category with higher rank 
		$sql = 'UPDATE '.WpmodulePeer::TABLE_NAME.' SET '.WpmodulePeer::RANK.' = '.WpmodulePeer::RANK.' - 1 WHERE '.WpmodulePeer::RANK.' > '.$this->getRank() . ' AND ' . WpmodulePeer::APPOINTMENT_ID .'='. $this->getAppointmentId();
		$con->query($sql);
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
	

}
