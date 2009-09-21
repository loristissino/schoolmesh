<?php

class Wpmodule extends BaseWpmodule
{


	public function unlink($context, PropelPDO $con = null)
	{
	/* FIXME: I should check if this is invoked by the owner */



	  if (!$this->getIsDeletable())
		{
			return false;
		}
		
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
		$this->setAppointmentId(null);
		$this->save();
	 
		$con->commit();
		return true;
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }
	}

	}


	public function link($workplan, $context, PropelPDO $con = null)
	{
	/* FIXME: I should check if this is invoked by the owner */

	$this->setAppointment($workplan);
	$this->setRank($this->getAppointment()->countWpmodules()+1);
	$this->save();
	/* FIXME: Put this actions in a transaction... */
	
	
	}



	public function getIsDeletable()
	{
		
	return ($this->countUneditableItems()==0);	
		
	}
	
	
	public function countUneditableItems()
	{
		
     $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);

	$sql = 'SELECT count(*) as number
FROM wpmodule
JOIN wpitem_group ON wpmodule.id = wpitem_group.wpmodule_id
JOIN wpmodule_item ON wpitem_group.id = wpmodule_item.wpitem_group_id
WHERE wpmodule.id = %d
AND wpmodule_item.is_editable = FALSE';

$sql = sprintf($sql, $this->getId());

$statement = $con->prepare($sql);
$statement->execute();

$resultset= $statement->fetch(PDO::FETCH_OBJ);

$number=$resultset->number;

	return $number;


	}
	
	
	public function getUnevaluated()
	{
     $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
	 
$sql = 'SELECT count( * ) AS number
FROM wpmodule
JOIN wpitem_group ON wpmodule.id = wpitem_group.wpmodule_id
JOIN wpmodule_item ON wpitem_group.id = wpmodule_item.wpitem_group_id
JOIN wpitem_type ON wpitem_group.wpitem_type_id = wpitem_type.id
WHERE wpmodule.id = %d
AND wpmodule_item.evaluation IS NULL
AND wpitem_type.evaluation_max >0';

$sql = sprintf($sql, $this->getId());

$statement = $con->prepare($sql);
$statement->execute();

$resultset= $statement->fetch(PDO::FETCH_OBJ);

$number=$resultset->number;

	return $number;
	}
	
	public function getToBeEvaluated()
	{
     $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
	 
$sql = 'SELECT count( * ) AS number
FROM wpmodule
JOIN wpitem_group ON wpmodule.id = wpitem_group.wpmodule_id
JOIN wpmodule_item ON wpitem_group.id = wpmodule_item.wpitem_group_id
JOIN wpitem_type ON wpitem_group.wpitem_type_id = wpitem_type.id
WHERE wpmodule.id = %d
AND wpitem_type.evaluation_max >0';

$sql = sprintf($sql, $this->getId());

$statement = $con->prepare($sql);
$statement->execute();

$resultset= $statement->fetch(PDO::FETCH_OBJ);

$number=$resultset->number;

	return $number;
	}
	
	
	
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
	
/*	
    public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{

	    $c = new Criteria();
		$c->add(WpmoduleItemPeer::WPMODULE_ID, $this->getId());
		$c->addAscendingOrderByColumn(WpitemTypePeer::RANK);
		$c->addAscendingOrderByColumn(WpmoduleItemPeer::RANK);
		$t = WpmoduleItemPeer::doSelectJoinAll($c);
		return $t;

	}
	
*/
	public function getOwner()
	{
	    $c = new Criteria();
		$c->add(sfGuardUserProfilePeer::USER_ID, $this->getUserId());
		$t = sfGuardUserProfilePeer::doSelectOne($c);
		return $t;
	}
	
	
	public function isOwnedBy($userId)
	{
		return ($this->getUserId()==$userId);
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
			{
//			echo "How many: ". $this->getAppointment()->countWpmodules() . "\n";
			$this->setRank($this->getAppointment()->countWpmodules()+1);
			}
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


    public function publish($context, $shared=true)
	{
		
	/* FIXME: I should check if this is invoked by the owner */
	
	$this->setIsPublic($shared);
	$this->save();
		
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
				if ($group->getIsRequired())
					{
						$newWpmoduleItem=new WpmoduleItem();
						$newWpmoduleItem->setWpitemGroupId($newgroup->getId());
						$newWpmoduleItem->setContent('---');
						$newWpmoduleItem->setIsEditable(true);
						$newWpmoduleItem->save();
					}
			}
	}

	public function delete(PropelPDO $con = null)
	{  
	
	  if (!$this->getIsDeletable())
		{
			return false;
		}
		
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
//		echo "DELETED!\n";
	 
		$con->commit();
		return true;
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }
	
	 }
		
	}
	

}
