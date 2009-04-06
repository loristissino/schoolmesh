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
/*
	public function getState()
	{
		if ($this->getLastLog())
			return $this->getLastLog()->getState();
		else
			return FALSE;
	}
*/
	protected function markSubItems($newstate, $con)
	{
		
	 
//		$sql = 'UPDATE '.WpmoduleItemPeer::TABLE_NAME.' SET '.WpmoduleItemPeer::IS_EDITABLE.' = FALSE WHERE '.WpmoduleItemPeer::RANK.' > '.$this->getRank() . ' AND ' . WpmoduleItemPeer::WPITEM_GROUP_ID .'='. $this->getWpitemGroupId();

// this should be made portable using Peer constants...

$sql = 'UPDATE  `wpmodule_item`

 JOIN `wpitem_group` ON `wpmodule_item`.`wpitem_group_id` = `wpitem_group`.`id`

JOIN `wpmodule` ON `wpitem_group`.`wpmodule_id`

JOIN `appointment` ON `wpmodule`.`appointment_id` = `appointment`.`id`

SET `is_editable` = ' . $newstate . '

WHERE `appointment`.`id` = ' . $this->getId();

$con->query($sql);
		
		
	}

	public function Approve($user_id, $permissions)
	{
		
	$result=Array();
	
	$steps=Workflow::getWpfrSteps();
	
	if (!array_key_exists('approve', $steps[$this->getState()]['actions']))
		{
			$result['result']='error';
			$result['message']='This workplan/report has not been submitted yet.';
			return $result;
		}

	if (!in_array($steps[$this->getState()]['actions']['approve']['permission'], $permissions))
		{
			$result['result']='error';
			$result['message']='The user has not the credentials to approve this workplan/report.';
			return $result;
		}

	$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();

		if($steps[$this->getState()]['actions']['approve']['submitExtraAction']!='')
			$this->$steps[$this->getState()]['actions']['approve']['submitExtraAction']($steps[$this->getState()]['actions']['approve']['submitExtraParameters'], $con);
		
		$message=$steps[$this->getState()]['actions']['approve']['submitDoneAction'];
		// we need to save the message before adding a line in the log...
		
		$this->addEvent($user_id, $steps[$this->getState()]['actions']['approve']['submitDoneAction'], $steps[$this->getState()]['actions']['approve']['submitNextState']);
		
		$con->commit();
		
		$result['result']='notice';
		$result['message']=$message;

		return $result;
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }

	}

	public function Reject($user_id, $permissions)
	{
		
	$result=Array();
	
	$steps=Workflow::getWpfrSteps();
	
	if (!array_key_exists('reject', $steps[$this->getState()]['actions']))
		{
			$result['result']='error';
			$result['message']='This workplan/report has not been submitted yet.';
			return $result;
		}

	if (!in_array($steps[$this->getState()]['actions']['reject']['permission'], $permissions))
		{
			$result['result']='error';
			$result['message']='The user has not the credentials to reject this workplan/report.';
		}

	$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();

		if($steps[$this->getState()]['actions']['reject']['submitExtraAction']!='')
			$this->$steps[$this->getState()]['actions']['reject']['submitExtraAction']($steps[$this->getState()]['actions']['reject']['submitExtraParameters'], $con);
		
		$message=$steps[$this->getState()]['actions']['reject']['submitDoneAction'];
		// we need to save the message before adding a line in the log...
		
		$this->addEvent($user_id, $steps[$this->getState()]['actions']['reject']['submitDoneAction'], $steps[$this->getState()]['actions']['reject']['submitNextState']);

		$con->commit();
		
		$result['result']='notice';
		$result['message']=$message;

		return $result;
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
	$possibleAction=$steps[$this->getState()]['owner']['submitAction'];

	if ($possibleAction=='')
		{
			$result['result']='error';
			$result['message']='This action is not allowed for a workplan/report in this state';
			return $result;
		}

	$result['result']='notice';
	$result['message']=$steps[$this->getState()]['owner']['submitDoneAction'];

	$this->addEvent($user_id, $steps[$this->getState()]['owner']['submitDoneAction'], $steps[$this->getState()]['owner']['submitNextState']);
		
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
		$this->setState($state);
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
