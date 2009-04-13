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

	public function removeTool($user_id, $tool_id)
	{

	$result=Array();

	if ($this->getUserId()!=$user_id)
		{
			$result['result']='error_aux';
			$result['message']='This workplan can be edited only by the owner';
			return $result;
		}

	if ($this->getState()!=Workflow::WP_DRAFT)
		{
			$result['result']='error_aux';
			$result['message']='This action is not allowed for a workplan/report in this state';
			return $result;
		}

	$at=WptoolAppointmentPeer::retrieveByAppointmentIdAndToolId($this->getId(), $tool_id);
	if ($at)
		$at->delete();

	$result['result']='notice_aux';
	$result['message']='The tool was removed';

	return $result;
	
	}

	public function addTool($user_id, $tool_id)
	{

	$result=Array();

	if ($this->getUserId()!=$user_id)
		{
			$result['result']='error_aux';
			$result['message']='This workplan can be edited only by the owner';
			return $result;
		}

	if ($this->getState()!=Workflow::WP_DRAFT)
		{
			$result['result']='error_aux';
			$result['message']='This action is not allowed for a workplan/report in this state';
			return $result;
		}

	$tool= new WptoolAppointment();
	$tool->setAppointmentId($this->getId());
	$tool->setWptoolItemId($tool_id);
	$tool->save();

	$result['result']='notice_aux';
	$result['message']='The tool was added';

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
		$this->save();
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


	public function getTools($onlyChosen=false)
	{

	$c=new Criteria();
	$c->addAscendingOrderByColumn(WptoolItemTypePeer::RANK);
	$t =  WptoolItemPeer::doSelectJoinWptoolItemType($c);
	
	$chosenTools=$this->getWptoolAppointments();

	foreach($chosenTools as $chosenTool)
		{
				$chosen[]=$chosenTool->getWptoolItemId();
		}
	

	foreach($t as $item)
		{
		$group[$item->getWptoolItemTypeId()]['description']=$item->getWptoolItemType()->getDescription();
		$isChosen=@in_array($item->getId(), $chosen);
		if (!$onlyChosen)
			{
			$group[$item->getWptoolItemTypeId()]['elements'][$item->getId()]['description']=$item->getDescription();
			$group[$item->getWptoolItemTypeId()]['elements'][$item->getId()]['chosen']=$isChosen;
			}
		else
			if ($isChosen)
				{
				$group[$item->getWptoolItemTypeId()]['elements'][$item->getId()]['description']=$item->getDescription();
				$group[$item->getWptoolItemTypeId()]['elements'][$item->getId()]['chosen']=$isChosen;
				}
		}
		
	return $group;
/*	
	foreach($availableTools as $group)
	{
			foreach($group as $tool_id=>$tool)
				{
						$tool['chosen']=in_array($tool_id, $chosenTools);
				}
	}
	return $availableTools;
*/
	}
	
   public function isViewableBy($userId)
	{
		
	if ($this->isOwnedBy($userId))
		return true;
		
	if ($this->getState()>Workflow::WP_DRAFT)
		return true;
	

	return false;
	}
	
	
   public function isOwnedBy($userId)
	{
		
	if ($this->getUserId()==$userId)
		return true;
		
	return false;
	}


	public function getCompleteContentAsArray()
	{
	$data['workplan_report']['id']=$this->getId();
	$data['workplan_report']['year']=$this->getYear()->getDescription();
	$data['workplan_report']['teacher']['firstname']=$this->getFirstName();
	$data['workplan_report']['teacher']['lastname']=$this->getLastName();
	$data['workplan_report']['teacher']['id']=$this->getUserId();
	$data['workplan_report']['subject']['description']=$this->getSubject()->getDescription();
	$data['workplan_report']['subject']['id']=$this->getSubjectId();
	$data['workplan_report']['class']['id']=$this->getSchoolclass()->getId();
	$data['workplan_report']['exported_at']=date('r');


	$wpinfos=$this->getWpinfos();
	if (sizeof($wpinfos)>0)
		foreach($this->getWpinfos() as $wpinfo)
			$data['workplan_report']['info'][$wpinfo->getWpinfoType()->getTitle()]=$wpinfo->getContent();
	
	$tools=$this->getTools(true);
		
	if(sizeof($tools)>0)
		foreach($tools as $toolGroup)
			if (@sizeof($toolGroup['elements'])>0)
				{
				foreach($toolGroup['elements'] as $element)
					$chosen[]=$element['description'];
				$data['workplan_report']['tools'][$toolGroup['description']]=$chosen;
				unset($chosen);
				}
				
	$modules=$this->getWpmodules();

	if (@sizeof($modules)>0)
		{
			foreach($modules as $wpmodule)
				{
					$data['workplan_report']['modules'][$wpmodule->getTitle()]['period']=$wpmodule->getPeriod();
					$wpItemGroups=$wpmodule->getWpItemGroups();
					if (@sizeof($wpItemGroups)>0)
						{
							foreach($wpItemGroups as $wpItemGroup)
								{
									$items=$wpItemGroup->getWpmoduleItems();
									if (@sizeof($items)>0)
										{
											foreach($items as $item)
												{
													$info['content']=$item->getContent();
													$info['evaluation']=$item->getEvaluation();
													$info['rank']=$item->getRank();
//													$contents['content'][]=$item->getContent();
//													$contents['evaluation'][]=$item->getEvaluation();
													$contents[]=$info;
												}
											$data['workplan_report']['modules'][$wpmodule->getTitle()]['details'][$wpItemGroup->getWpitemType()->getTitle()]=$contents;
											unset($contents);

										}
								}
						}
				}
		}
/*
ob_start();
$f=fopen('lorislog.txt', 'w');

print_r($modules);
$my_string = ob_get_contents();
fwrite($f, $my_string);

fclose($f);

ob_end_clean();

*/
	return $data;

		
	}


	public function removeEverything()
	{
		foreach ($this->getWpevents() as $item)
			$item->delete();
		
		foreach ($this->getWpinfos() as $item)
			$item->delete();
		
		foreach ($this->getWptoolAppointments() as $item)
			$item->delete();


		$this->removeAllModules();

/* for some obscure reasons, this does not seem to work:

		foreach ($this->getWpmodules() as $item)
			{
			foreach($item->getWpitemGroups() as $subitem)
				{
					echo "  removing submodule ". $subitem->getId() . "\n";
					foreach ($subitem->getWpmoduleItems() as $subsubitem)
						{
							echo "    removing subsubitem " . $subsubitem->getId() . "\n";
							$subsubitem->delete();
							echo "DELETED -- ". $subsubitem->getId() . "\n";
						}
					$subitem->delete();
				}
			echo "removing module ". $item->getId() . "\n";

			$item->delete();
			}

*/

	}

	public function removeAllModules(PropelPDO $con = null)
	{  
	  $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();
	 
		// decrease all the ranks of the page records of the same category with higher rank 
		$sql = 'DELETE FROM '.WpmodulePeer::TABLE_NAME.' WHERE '.WpmodulePeer::APPOINTMENT_ID.' = '.$this->getId();

		$con->query($sql);
	 
		$con->commit();
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }
	
	}

}
