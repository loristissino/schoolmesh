<?php

class Appointment extends BaseAppointment
{
    
    public function getFirstName()
    {
    return $this->getsfGuardUser()->getProfile()->getFirstName();    
    }

    public function getLastName()
    {
    return $this->getsfGuardUser()->getProfile()->getLastName();    
    }

    public function getFullName()
    {
    return $this->getFirstName(). ' ' . $this->getLastName();    
    }


	public function __toString()
	{
			return $this->getSubject() . ' (' . $this->getSchoolclass() . ', ' . $this->getYear() . ')';
	}


    public function getLastLog()
	{


	if ($t=$this->getWorkflowLogs())
		return $t[0];
	else
		return FALSE;

	}

	public function getState()
	{
		if ($this->getLastLog())
			return $this->getLastLog()->getState();
		else
			return FALSE;
	}

	public function schoolmasterApprove($user_id)
	{
		
	$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();
	 
	 
//		$sql = 'UPDATE '.WpmoduleItemPeer::TABLE_NAME.' SET '.WpmoduleItemPeer::IS_EDITABLE.' = FALSE WHERE '.WpmoduleItemPeer::RANK.' > '.$this->getRank() . ' AND ' . WpmoduleItemPeer::WPITEM_GROUP_ID .'='. $this->getWpitemGroupId();

// this should be made portable using Peer constants...

$sql = 'UPDATE  `wpmodule_item`

 JOIN `wpitem_group` ON `wpmodule_item`.`wpitem_group_id` = `wpitem_group`.`id`

JOIN `wpmodule` ON `wpitem_group`.`wpmodule_id`

JOIN `appointment` ON `wpmodule`.`appointment_id` = `appointment`.`id`

SET `is_editable` = FALSE

WHERE `appointment`.`id` = ' . $this->getId();

$con->query($sql);

	
		$con->commit();
		
		$this->addEvent($user_id, 'approved (***)', 30);
		
		return true;
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }

	}

	public function schoolmasterReject($user_id)
	{
		
	$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();
	 
	 
//		$sql = 'UPDATE '.WpmoduleItemPeer::TABLE_NAME.' SET '.WpmoduleItemPeer::IS_EDITABLE.' = FALSE WHERE '.WpmoduleItemPeer::RANK.' > '.$this->getRank() . ' AND ' . WpmoduleItemPeer::WPITEM_GROUP_ID .'='. $this->getWpitemGroupId();

// this should be made portable using Peer constants...

$sql = 'UPDATE  `wpmodule_item`

 JOIN `wpitem_group` ON `wpmodule_item`.`wpitem_group_id` = `wpitem_group`.`id`

JOIN `wpmodule` ON `wpitem_group`.`wpmodule_id`

JOIN `appointment` ON `wpmodule`.`appointment_id` = `appointment`.`id`

SET `is_editable` = TRUE

WHERE `appointment`.`id` = ' . $this->getId();

$con->query($sql);

	
		$con->commit();
		
		$this->addEvent($user_id, 'rejected (***)', 0);
		
		return true;
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }

	}


	public function teacherSubmit($user_id)
	{

	$result=Array();

	if ($this->getUserId()!=$user_id)
		{
			$result['result']='error';
			$result['message']='This workplan can be submitted only by the owner';
			return $result;
		}

	$steps=Workflow::getWpfrSteps();
	$possibleAction=$steps[$this->getState()]['submitAction'];

	if ($possibleAction=='')
		{
			$result['result']='error';
			$result['message']='This action is not allowed for a workplan/report in this state';
			return $result;
		}

	$result['result']='notice';
	$result['message']=$steps[$this->getState()]['submitDoneAction'];

	$this->addEvent($user_id, $steps[$this->getState()]['submitDoneAction'], $steps[$this->getState()]['submitNextState']);
		
	return $result;
	
	}



protected function addEvent($user_id, $comment='', $state=0)
{
		$wpevent = new Wpevent();
		$wpevent->setUserId($user_id);
		$wpevent->setAppointmentId($this->getId());
		$wpevent->setComment($comment);
		$wpevent->setState($state);
		$wpevent->save();
}

public function getWorkflowLogs()
	{
		$c = new Criteria();
		$c->add(WpeventPeer::APPOINTMENT_ID, $this->getId());
		$c->addDescendingOrderByColumn(WpeventPeer::CREATED_AT);
		$t = WpeventPeer::doSelectJoinAll($c);
		if ($t)
			return $t;
		else
			return NULL;
	}

	public function getWpmodules($criteria = null, PropelPDO $con = null)
	{

	if (is_null($criteria))
		{
				$criteria=new Criteria();
		}
	else
		{
				$criteria = clone $criteria;
		}

		$criteria->addAscendingOrderByColumn(WpmodulePeer::RANK);
		
		return parent::getWpmodules($criteria, $con);
	}


}
