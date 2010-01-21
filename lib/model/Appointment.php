<?php

class Appointment extends BaseAppointment
{
	
	public function getOwner()
	{
		return $this->getsfGuardUser();
	}
    
    public function getFirstName()
    {
		return $this->getOwner()->getProfile()->getFirstName();    
    }

    public function getLastName()
    {
    return $this->getOwner()->getProfile()->getLastName();    
    }

    public function getFullName()
    {
    return $this->getFirstName(). ' ' . $this->getLastName();    
    }

	public function retrieveImportableWorkplansOfColleagues()
	
	{
		$c=new Criteria();
		$c->add(AppointmentPeer::STATE, Workflow::WP_DRAFT, Criteria::GREATER_THAN);  // must be already published
		$c->add(AppointmentPeer::USER_ID, $this->getUserId(), Criteria::NOT_EQUAL);  // not the same teacher
		$c->add(AppointmentPeer::SUBJECT_ID, $this->getSubjectId());                 // the same subject
		$c->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID);
		$c->add(SchoolclassPeer::GRADE, $this->getSchoolclass()->getGrade());   // the same grade
		$c->addDescendingOrderByColumn(AppointmentPeer::YEAR_ID);   // order by year
		$t = AppointmentPeer::doSelect($c);
		return $t;
	}


	public function retrieveOtherWorkplansOfSameTeacher()
	
	{
		$c=new Criteria();
		$c->add(AppointmentPeer::USER_ID, $this->getUserId());  // the same teacher
		$c->add(AppointmentPeer::ID, $this->getId(), Criteria::NOT_EQUAL);          // not the same Workplan / Appointment
		$c->add(AppointmentPeer::SUBJECT_ID, $this->getSubjectId());                 // the same subject
		$c->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID);
		$c->add(SchoolclassPeer::GRADE, $this->getSchoolclass()->getGrade());   // the same grade
		$c->addDescendingOrderByColumn(AppointmentPeer::YEAR_ID);   // order by year
		$t = AppointmentPeer::doSelect($c);
		return $t;
	}


	public function retrieveOtherModulesOfSameTeacher()
	
	{

	$connection = Propel::getConnection();

	$userId = $this->getUserId();

	$sql = 'SELECT wpmodule.id as id, title, period, schoolclass_id, UNIX_TIMESTAMP(wpmodule.updated_at) as last_update , appointment_id FROM ' . WpmodulePeer::TABLE_NAME .
	' LEFT JOIN ' . AppointmentPeer::TABLE_NAME . ' ON ' . WpmodulePeer::APPOINTMENT_ID . ' = ' . AppointmentPeer::ID .
    ' LEFT JOIN ' . SchoolclassPeer::TABLE_NAME . ' ON ' . AppointmentPeer::SCHOOLCLASS_ID . ' = ' . SchoolclassPeer::ID . 
    ' LEFT JOIN ' . YearPeer::TABLE_NAME . ' ON ' . AppointmentPeer::YEAR_ID . ' = ' . YearPeer::ID .
    ' WHERE ' . WpmodulePeer::USER_ID . ' = %d ' .
    ' ORDER BY ' . WpmodulePeer::UPDATED_AT . ' DESC';


	$sql = sprintf($sql, $userId);

    $statement = $connection->prepare($sql);
    $statement->execute();
    $resultset = $statement->fetchAll(PDO::FETCH_OBJ);


	return $resultset;


}

	public function retrieveImportableModulesOfColleagues()
	
	{

	$connection = Propel::getConnection();

	$userId = $this->getUserId();

	$sql = 'SELECT wpmodule.id as id, title, period, UNIX_TIMESTAMP(wpmodule.updated_at) as last_update , appointment_id, ' . SfGuardUserProfilePeer::LAST_NAME . ' as teacher FROM ' . WpmodulePeer::TABLE_NAME .
	' JOIN ' . SfGuardUserProfilePeer::TABLE_NAME . ' ON ' . WpmodulePeer::USER_ID . ' = ' . SfGuardUserProfilePeer::USER_ID . 
	' LEFT JOIN ' . AppointmentPeer::TABLE_NAME . ' ON ' . WpmodulePeer::APPOINTMENT_ID . ' = ' . AppointmentPeer::ID .
    ' LEFT JOIN ' . SchoolclassPeer::TABLE_NAME . ' ON ' . AppointmentPeer::SCHOOLCLASS_ID . ' = ' . SchoolclassPeer::ID . 
    ' LEFT JOIN ' . YearPeer::TABLE_NAME . ' ON ' . AppointmentPeer::YEAR_ID . ' = ' . YearPeer::ID .
    ' WHERE ' . WpmodulePeer::IS_PUBLIC . ' = TRUE ' .
	' AND ' . WpmodulePeer::USER_ID . ' <> %d ' .
    ' ORDER BY ' . WpmodulePeer::UPDATED_AT . ' DESC';


	$sql = sprintf($sql, $userId);

    $statement = $connection->prepare($sql);
    $statement->execute();
    $resultset = $statement->fetchAll(PDO::FETCH_OBJ);


	return $resultset;


}


	public function getWpinfos($criteria = null, PropelPDO $con = null)
	{
          if (is_null($criteria))
          {
            $criteria = new Criteria();
          }
          else
          {
            $criteria = clone $criteria;
          }

		$criteria->addJoin(WpinfoTypePeer::ID, WpinfoPeer::WPINFO_TYPE_ID);
		$criteria->addAscendingOrderByColumn(WpinfoTypePeer::RANK);
		return parent::getWpinfos($criteria);
		
	}	
	public function __toString()
	{
			return $this->getSubject() . ' (' . $this->getSchoolclass() . ', ' . $this->getYear() . ')';
	}

    public function getDescription()
	{
			return $this->getFullName() . ' » ' . $this->getSubject() . ' (' . $this->getSchoolclass() . ', ' . $this->getYear() . ')';

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
	$state=parent::getState();
	if ($state==NULL)
		$state=0;
	return $state;

	}
	
	
	public function getWpinfo($id)
	{
	
		$c=new Criteria();
//		echo "Cerco con WPINFO con ID=$id e APPOINTMENTID=" . $this->getId() . "\n";
	    $c->add(WpinfoPeer::APPOINTMENT_ID, $this->getId());
	    $c->add(WpinfoPeer::WPINFO_TYPE_ID, $id);
		return WpinfoPeer::doSelectOne($c);

		
	}

	public function markSubItems($newstate, $con=null)
	{
		
		if (!is_string($newstate))
		{
			throw new Exception('state must be a string!');
		}
		
		$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
	 
//		$sql = 'UPDATE '.WpmoduleItemPeer::TABLE_NAME.' SET '.WpmoduleItemPeer::IS_EDITABLE.' = FALSE WHERE '.WpmoduleItemPeer::RANK.' > '.$this->getRank() . ' AND ' . WpmoduleItemPeer::WPITEM_GROUP_ID .'='. $this->getWpitemGroupId();

// this should be made portable using Peer constants...

$sql = 'UPDATE  `wpmodule_item`

 JOIN `wpitem_group` ON `wpmodule_item`.`wpitem_group_id` = `wpitem_group`.`id`

JOIN `wpmodule` ON `wpitem_group`.`wpmodule_id` = `wpmodule`.`id`

JOIN `appointment` ON `wpmodule`.`appointment_id` = `appointment`.`id`

SET `is_editable` = ' . $newstate . '

WHERE `appointment`.`id` = ' . $this->getId();


$con->query($sql);
		
		
	}

	public function Approve($user_id, $permissions, $culture='it')
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

	    $logmessage=SystemMessagePeer::retrieveByKey($steps[$this->getState()]['actions']['approve']['logMessageCode']);
		$text = $logmessage->getContent($culture);

		$this->addEvent($user_id, $text, $steps[$this->getState()]['actions']['approve']['submitNextState']);
				
		$this->getChecks(); // needed to create children objects for the new state...
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

	public function Reject($user_id, $permissions, $comment='')
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
		
		if ($comment=='')
		{
			$message=$steps[$this->getState()]['actions']['reject']['submitDoneAction'];
		}
		else
		{
			$message=$comment;
		}
		// we need to save the message before adding a line in the log...
		
		$this->addEvent($user_id, $message, $steps[$this->getState()]['actions']['reject']['submitNextState']);

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
	
	
	public function getChecks()
	{

		$checkList=new CheckList();

		$wpinfotypes=WpinfoTypePeer::getAllNeededForState($this->getState());
	
				
		foreach($wpinfotypes as $wpinfotype)
			{
				$flash='error_info';
				$wpinfo=WpinfoPeer::retrieveByAppointmentIdAndType($this->getId(), $wpinfotype->getId());
				if (!$wpinfo)
					{
						$wpinfo= new Wpinfo();
						$wpinfo->setAppointmentId($this->getId());
						$wpinfo->setWpinfoTypeId($wpinfotype->getId());
						$wpinfo->save();
					}
					
				if ($wpinfotype->getIsRequired())
						{
							if ($wpinfo->getContent()=='')
								{
								$checkList->addCheck(new Check(
								Check::FAILED,
								'Content cannot be empty',
								$wpinfotype->getDescription(),
								array('link_to'=>'wpinfo/edit?id=' . $wpinfo->getId())));
								/*
								
										$wpinfotype->getTitle(),
										array(
											'link_to'=>'wpinfo/edit?id=' . $wpinfo->getId(),
											'flash'=>$flash)
											)
										);*/
								}
							elseif (!$wpinfo->checkContentAgainstTemplate($wpinfo->getContent(), $wpinfotype->getTemplate()))
								{
									$ckeckList->addCheck(new Check(
										Check::FAILED,
										'Content doesn\'t match template',
										$wpinfotype->getDescription(),
										array('link_to'=>'wpinfo/edit?id=' . $wpinfo->getId())));
/*										$wpinfotype->getTitle(),
										array(
											'link_to'=>'wpinfo/edit?id=' . $wpinfo->getId(),
											'flash'=>$flash)
											)
										);*/
								}
							else
								{
									$checkList->addCheck(new Check(
										Check::PASSED,
										'Filled',
										$wpinfotype->getDescription()));
								}
							}
			}
	
		$modules=$this->getWpmodules();
		
		if (sizeof($modules)==0)
			{
				$checkList->addCheck(new Check(
						Check::FAILED,
						'There must be at least one module',
						'Modules'));
						/*
						array(
							'link_to'=>'plansandreports/fill?id=' . $this->getId()
							)
						));*/
					
			}
			
		else
		{
			
			$neededItemTypes=WpitemTypePeer::getAllByRank();
			
			$titles=Array('---', '');
			$count=0;
			
			foreach($modules as $wpmodule)
				{
					$moduleIsOk=true;
					$count++;
					
					$groupname=sprintf('Mod. %d) %s', $count, $wpmodule->getTitle());
					if(in_array($wpmodule->getTitle(), $titles))
						{
							$checkList->addCheck(new Check(
								Check::FAILED,
								'Invalid or duplicate title for module',
								$groupname,
								array('link_to'=>'wpmodule/view?id=' . $wpmodule->getId())
								));
								/*
									$wpmodule->getTitle(),
									array(
										'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
									)
									));*/
							$moduleIsOk=false;
						}
					else
						{
							array_push($titles, $wpmodule->getTitle());
							// There can't be two modules with the same title.
							// If we make the check here instead of on the database level we let the user have an
							// inconsistent situation until they submit the workplan...
						}
					if(($wpmodule->getPeriod()=='---'||$wpmodule->getPeriod()==''))
						{
							$checkList->addCheck(new Check(
								Check::FAILED,
								'Invalid period specification for module',
								$groupname,
								array('link_to'=>'wpmodule/view?id=' . $wpmodule->getId())
								));
								/*
									$wpmodule->getTitle(),
									array(
										'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
										)
									));*/
								$moduleIsOk=false;
						}
						
					foreach ($neededItemTypes as $it)
						{
							$groupname=sprintf('Mod. %d) %s » %s', $count, $wpmodule->getTitle(), $it->getTitle());
							if ($it->getState()>$this->getState())
								{
									continue;
								}
							$group=WpitemGroupPeer::retrieveByModuleAndType($wpmodule->getId(), $it->getId());
							if (!$group)
								{
									$group=new WpitemGroup();
									$group->setWpitemTypeId($it->getId());
									$group->setWpmoduleId($wpmodule->getId());
									$group->save();
									
									$checkList->addCheck(new Check(
										Check::FAILED,
										'Missing group %s',
										$groupname));
										/*
										
										, $it->getTitle()),
													$wpmodule->getTitle(),
													array(
														'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
														)
													));*/
										$moduleIsOk=false;
										
								}
							else
								{
									$items=$group->getWpmoduleItems();	
									if (sizeof($items)==0 && $it->getIsRequired())
										{
											$wpmoduleItem = new WpmoduleItem();
											$wpmoduleItem->setContent('---');
											$wpmoduleItem->setIsEditable(true);
											$wpmoduleItem->setWpitemGroupId($group->getId());
											$wpmoduleItem->setEvaluation(null);
											$wpmoduleItem->save();
											
											$checkList->addCheck(new Check(
												Check::FAILED,
												'There must be at least an item in group',
												$groupname));
												/*
												
															array(
																'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
																)
															));*/
															$moduleIsOk=false;
												
										}
									else
										{
											foreach($items as $item)
												{
													$groupname=sprintf('Mod. %d) %s » %s :: %s', $count, $wpmodule->getTitle(), $it->getTitle(), $item->getContent());

													if(($item->getContent()=='---'||$item->getContent()==''))
													{
														$checkList->addCheck(new Check(
															Check::FAILED,
															'Invalid text',
															$groupname,
															array('link_to'=>'wpmodule/view?id=' . $wpmodule->getId())
															
															));
															/*
																array(
																	'link_to'=>'wpmodule/view?id=' . $wpmodule->getId(),
																	'flash'=>'error'. $group->getId(),
																	'fragment'=>$group->getId()
																	)
																));*/
																$moduleIsOk=false;

													};
												
												if($it->getEvaluationMax()>0 && (($item->getEvaluation()==null)&&$this->getState()==Workflow::IR_DRAFT))
													{
														$checkList->addCheck(new Check(
															Check::FAILED,
															'Missing evaluation',
															$groupname,
															array('link_to'=>'wpmodule/view?id=' . $wpmodule->getId())

															));
															/*
																array(
																	'link_to'=>'wpmodule/view?id=' . $wpmodule->getId(). '#' . $group->getId(),
																	'flash'=>'error'. $group->getId(),
																	'fragment'=>$group->getId()
																	)
																));*/
																$moduleIsOk=false;
												}
											}
										}
								}
						}
						
					if ($moduleIsOk)
						{
							$checkList->addCheck(new Check(
								Check::PASSED,
								'Module accepted',
								sprintf('Mod. %d) %s', $count, $wpmodule->getTitle())
								));
						}
						
				} // end foreach (modules)
		} //end if (modules are present)
		
		$wptoolItemTypes=WptoolItemTypePeer::getAllNeededForState($this->getState());
		
		foreach ($wptoolItemTypes as $type)
			{
				$flash='error_aux'.$type->getId();

				if ($this->countToolsOfType($type->getId())>=$type->getMinSelected())
					{
						$checkList->addCheck(new Check(
							Check::PASSED,
							'Tools selected',
							$type->getDescription()));
					}
				else
					{
						$checkList->addCheck(new Check(
							Check::FAILED,
							'Missing selection of tools',
							$type->getDescription(),
							array('link_to'=>'plansandreports/fill?id=' . $this->getId())
							));
							/*
									array(
										'link_to'=>'plansandreports/fill?id=' . $this->getId(),
										'flash'=>$flash, 
										'fragment'=>'wpaux')
									));
*/
					}
						
				
			}
				
		
		return $checkList;
		
	}


	public function countToolsOfType($typeId)
		{
			
		return WptoolAppointmentPeer::countToolsOfTypeForAppointment($typeId, $this->getId());
		}

	public function teacherSubmit(sfContext $sfContext=null)
	{

	$result=Array();

	$steps=Workflow::getWpfrSteps();
	$possibleAction=$steps[$this->getState()]['owner']['submitAction'];

	if ($possibleAction=='')
		{
			$result['result']='error';
			$result['message']='This action is not allowed for a document in this state.';
			return $result;
		}

	$checkList=$this->getChecks();
	
	if ($checkList->getTotalResults(Check::FAILED)==0)
		{
			$this->markSubItems('false');
			$result['result']='notice';
			$result['message']=$steps[$this->getState()]['owner']['submitDoneAction'];
			$this->addEvent($this->getOwner()->getId(), $steps[$this->getState()]['owner']['submitDoneAction'], $steps[$this->getState()]['owner']['submitNextState']);
			
			if ($this->getOwner()->getProfile()->sendWorkflowConfirmationMessage($sfContext, 'document_submission',
				array(
					'%document_id%'=>$this->getId(),
					'%document_state%'=>$sfContext->getI18N()->__($steps[$this->getState()]['stateDescription']),
					'%document_description%'=>$this->getDescription(),
				)
			))
			{
				$result['mail_sent_to']=$this->getOwner()->getProfile()->getEmail();
			}
			else
			{
				$result['mail_sent_to']=false;
			}
		}
	else
		{
			$result['result']='error';
			$result['message']='Some errors prevented the submission of the document';
			$result['checkList']=$checkList;
		}

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


	$at=WptoolAppointmentPeer::retrieveByAppointmentIdAndToolId($this->getId(), $tool_id);

	if ($at)
	{
		if ($this->getState()!=$at->getWptoolItem()->getWptoolItemType()->getState())
			{
				$result['result']='error_aux';
				$result['message']='This action is not allowed for a workplan/report in this state';
				return $result;
			}

		try {
			$at->delete();
		}
		catch (Exception $e)
		{
			$result['result']='error_aux';
			$result['message']='You cannot remove the same item twice.';
			return $result;
		}
	}

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

	$tool=WptoolItemPeer::retrieveByPK($tool_id);

	if ($this->getState()!=$tool->getWptoolItemType()->getState())
		{
			$result['result']='error_aux';
			$result['message']='This action is not allowed for a workplan/report in this state';
			return $result;
		}

	try
	{
		$tool= new WptoolAppointment();
		$tool
		->setAppointmentId($this->getId())
		->setWptoolItemId($tool_id)
		->save();
	}
	
	catch (Exception $e)
	{
		$result['result']='error_aux';
		$result['message']='You cannot add the same item twice.';
		return $result;
	}

	$result['result']='notice_aux';
	$result['message']='The tool was added';

	return $result;
	
	}

public function addEvent($userId, $comment='', $state=0)
{
		$wpevent = new Wpevent();
		$wpevent->setUserId($userId);
		$wpevent->setAppointmentId($this->getId());
		if (sfContext::hasInstance())
			{
				$comment=sfContext::getInstance()->getI18N()->__($comment);
			}

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
	$c->addAscendingOrderByColumn(WptoolItemPeer::ID);
	$t = WptoolItemPeer::doSelectJoinWptoolItemType($c);
	
	$chosenTools=$this->getWptoolAppointments();

	foreach($chosenTools as $chosenTool)
		{
				$chosen[]=$chosenTool->getWptoolItemId();
		}
	

	foreach($t as $item)
		{
			
		if ($item->getWptoolItemType()->getState()>$this->getState())
			{
				continue;
			}
			
		$group[$item->getWptoolItemTypeId()]['description']=$item->getWptoolItemType()->getDescription();
		$group[$item->getWptoolItemTypeId()]['min_selected']=$item->getWptoolItemType()->getMinSelected();
		$group[$item->getWptoolItemTypeId()]['state']=$item->getWptoolItemType()->getState();
		$group[$item->getWptoolItemTypeId()]['id']=$item->getWptoolItemType()->getId();
		
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
		
	return  ($this->getUserId()==$userId);
	}


	public function getCompleteContentAsArray()
	{
	$data['workplan_report']['id']=$this->getId();
	$data['workplan_report']['year']=$this->getYear()->getDescription();
	$data['workplan_report']['hours']=$this->getHours();
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
					$data['workplan_report']['modules'][$wpmodule->getTitle()]['hours_estimated']=$wpmodule->getHoursEstimated();
					$data['workplan_report']['modules'][$wpmodule->getTitle()]['details']=Array();
					$wpItemGroups=$wpmodule->getWpItemGroups();
					if (@sizeof($wpItemGroups)>0)
						{
							foreach($wpItemGroups as $wpItemGroup)
								{
										$built=Array();
										foreach($wpItemGroup->getWpmoduleItems() as $wpmoduleItem)
											{
												$built[]=Array(
													'content'=>$wpmoduleItem->getContent(),
													'evaluation'=>$wpmoduleItem->getEvaluation(),
													'rank'=>$wpmoduleItem->getRank()
													);
											}
									$data['workplan_report']['modules'][$wpmodule->getTitle()]['details'][]=Array($wpItemGroup->getWpitemType()->getTitle()=>$built);
									unset($built);
								}
						}
						
				}
		}


	return $data;

		
	}
	
	
	public function getOdf($doctype, sfContext $sfContext=null, $template='', $complete=true)
	{
		
		if ($template=='')
		{
			$template='workplan.odt';
		}
		
		$teachertitle=$this->getSfGuardUser()->getProfile()->getIsMale()?'Mr. ':'Ms. ';

		if ($sfContext)
		{
			$teachertitle=$sfContext->getI18n()->__($teachertitle);
		}
	
		try
		{
			$odf=new OdfDoc($template, $this->__toString(). '.' . $doctype, $doctype);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		
		$odfdoc->setVars('year',  $this->getYear()->__toString());
		$odfdoc->setVars('teacher',  $teachertitle . $this->getSfGuardUser()->getProfile()->getFullName());
		$odfdoc->setVars('subject', $this->getSubject()->getDescription());
		$odfdoc->setVars('year',  $this->getYear()->__toString());
		$odfdoc->setVars('schoolclass',  $this->getSchoolclassId());
		
		
		$wpinfos=$this->getWpinfos();
		
		$infos=$odfdoc->setSegment('infos');
		foreach($wpinfos as $wpinfo)
		{
			if (
				$wpinfo->getWpinfoType()->getState()<=$this->getState()
				&&
				$wpinfo->getContent()
				&&
				(!$wpinfo->getWpinfoType()->getIsReserved() || $complete)
				)
			{
				$infos->infoTitle($wpinfo->getWpinfoType()->getTitle());
				$infos->infoDescription($wpinfo->getWpinfoType()->getDescription());
				$infos->infoContent($wpinfo->getContent());
				$infos->merge();
			}
		}
		
		$odfdoc->mergeSegment($infos);
		
		
		$wpmodules=$this->getWpmodules();
		
		$modules=$odfdoc->setSegment('modules');
		
		$moduleNumber=0;
		
		foreach($wpmodules as $wpmodule)
		{
			$modules->moduleTitle($wpmodule->getTitle());
			$modules->moduleNumber(++$moduleNumber);
			$modules->modulePeriod($wpmodule->getPeriod());
			
			foreach($wpmodule->getWpitemGroups() as $wpitemgroup)
			{
				$wpitems=$wpitemgroup->getWpmoduleItems();
				if (($wpitemgroup->getWpitemType()->getState()<=$this->getState())&&(sizeof($wpitems)>0))
				{
					$modules->group->groupTitle($wpitemgroup->getWpitemType()->getTitle());
					
					foreach($wpitems as $wpitem)
					{
						$modules->group->item->itemContent($wpitem->getContent());
						$modules->group->item->merge();
					}
					$modules->group->merge();
				}
			}
			
			$pagebreak=($moduleNumber<sizeof($wpmodules))?'<pagebreak>':'';
			$modules->pagebreak($pagebreak);

			$modules->merge();
		}
		
		$odfdoc->mergeSegment($modules);


		$tools=$this->getTools(true);

		$toolgroups=$odfdoc->setSegment('toolgroups');
	
		if(sizeof($tools)>0)
			foreach($tools as $toolGroup)
				if (@sizeof($toolGroup['elements'])>0)
					{
					$toolgroups->toolgroupTitle($toolGroup['description']);
					foreach($toolGroup['elements'] as $element)
						{
							$toolgroups->tool->toolContent($element['description']);
							$toolgroups->tool->merge();
						}
					$toolgroups->merge();
					}
		$odfdoc->mergeSegment($toolgroups);
		
		return $odf;
	}
	
	public function getRecuperationLettersOdf($ids, $doctype, sfContext $sfContext=null, $template='')
	{
				
		if (!$term=TermPeer::retrieveByPK(sfConfig::get('app_config_current_term')))
		{
			throw new Exception('term not defined');
		}
		
				
		if ($template=='')
		{
			$template='recuperation.odt';
		}
		
		$teachertitle=$this->getSfGuardUser()->getProfile()->getIsMale()?'Mr. ':'Ms. ';
		$doctitle='Recuperation suggestions';

		if ($sfContext)
		{
			$teachertitle=$sfContext->getI18n()->__($teachertitle);
			$doctitle=$sfContext->getI18n()->__($doctitle);

		}
	
		try
		{
			$odf=new OdfDoc($template, $doctitle . '.' . $doctype, $doctype);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		
		$wpmodules=$this->getWpmodules();

		$students=sfGuardUserProfilePeer::retrieveByPKs($ids);
		
		$suggestions=SuggestionPeer::retrieveAllByRank();
		$hints=RecuperationHintPeer::retrieveAllByRankForTeacher($this->getUserId());
		
		$letters=$odfdoc->setSegment('letters');
		
		$letterNumber=0;
		
		$selectedStudents=array();
		
		foreach($students as $student)
		{
			
			foreach ($wpmodules as $wpmodule)
			{
				foreach($wpmodule->getWpitemGroups() as $wpitemgroup)
					{
						foreach($wpitemgroup->getWpmoduleItems() as $wpitem)
							{
								if ($wpitem->getStudentSituation($student->getId(), $term->getId()))
								{
									$selectedStudents[$student->getFullName()]['modules'][$wpmodule->getTitle()][$wpitemgroup->getWpitemType()->getTitle()][]=$wpitem->getContent();
								}
								
							}
						
					}
			}
			foreach ($suggestions as $suggestion)
			{
				if($suggestion->hasStudentSuggestionForAppointment($student->getId(), $this->getId(), $term->getId()))
				{
					$selectedStudents[$student->getFullName()]['suggestions'][]=$suggestion->getContent();
					
				}
			}
			
			foreach ($hints as $hint)
			{
				if($hint->hasStudentHintForAppointment($student->getId(), $this->getId(), $term->getId()))
				{
					$selectedStudents[$student->getFullName()]['hints'][]=$hint->getContent();
					
				}
			}
			
			
		}
			
		$studentsNumber=sizeof(array_keys($selectedStudents));
		$letterNumber=0;
		
		foreach($selectedStudents as $selectedStudent_key=>$selectedStudent_value)
		{
			$letterNumber++;
			$letters->student($selectedStudent_key);
			$letters->teacher($teachertitle. $this->getSfGuardUser()->getProfile()->getFullName());
			$letters->subject($this->getSubject()->getDescription());
			$letters->schoolclass($this->getSchoolclass()->getShortcut());
			$letters->term($term->getDescription());
			if (@is_array($selectedStudent_value['modules']))
			{
				$selectedModules=$selectedStudent_value['modules'];
				
				foreach($selectedModules as $selectedModule_key=>$selectedModule)
				{
					$letters->modules->moduleTitle($selectedModule_key);
					foreach($selectedModule as $selectedGroup_key=>$selectedGroup)
					{
						$letters->modules->group->groupTitle($selectedGroup_key);
						foreach($selectedGroup as $selectedItem)
						{
							$letters->modules->group->item->itemContent($selectedItem);
							$letters->modules->group->item->merge();
						}
						$letters->modules->group->merge();
					}
					$letters->modules->merge();
				}
			}
			
			if (@is_array($selectedStudent_value['suggestions']))
			{
				$selectedSuggestions=$selectedStudent_value['suggestions'];
			
				foreach($selectedSuggestions as $selectedSuggestion)
				{
					$letters->suggestions->suggestionContent($selectedSuggestion);
					$letters->suggestions->merge();
				
				}
			}
			else
			{
				$letters->suggestions->suggestionContent('');
				$letters->suggestions->merge();
			}
			

			if (@is_array($selectedStudent_value['hints']))
			{
				$selectedHints=$selectedStudent_value['hints'];
			
				foreach($selectedHints as $selectedHint)
				{
					$letters->hints->hintContent($selectedHint);
					$letters->hints->merge();
				
				}
			}
			else
			{
				$letters->hints->hintContent('');
				$letters->hints->merge();
			}
			
			$pagebreak=($letterNumber<$studentsNumber)?'<pagebreak>':'';
			$letters->pagebreak($pagebreak);

			$letters->merge();
			
		}
		
		
		$odfdoc->mergeSegment($letters);
		
	return $odf;
	}

public function getWpevents($criteria = null, PropelPDO $con = null)

	{
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(WpeventPeer::CREATED_AT);
		$criteria->addJoin(WpeventPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
		return parent::getWpevents($criteria);
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
		
		$this->setState(Workflow::WP_DRAFT);
		$this->save();

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

	protected function copyWpinfosFrom($iworkplan)
	{

		$wpinfos = $iworkplan->getWpinfos();
		foreach($wpinfos as $wpinfo)
			{
				$newwpinfo = new Wpinfo();
				$newwpinfo->setAppointmentId($this->getId());
				$newwpinfo->setWpinfoTypeId($wpinfo->getWpinfoTypeId());
				$newwpinfo->setContent($wpinfo->getContent());
				$newwpinfo->save();
				
			}
	}

	protected function copyWptoolsFrom($iworkplan)
	{

		$wptools = $iworkplan->getWptoolAppointments();
		foreach($wptools as $wptool)
			{
				$newwptoolappointment = new WptoolAppointment();
				$newwptoolappointment->setAppointmentId($this->getId());
				$newwptoolappointment->setWptoolItemId($wptool->getWptoolItemId());
				$newwptoolappointment->save();
			}
	}

	protected function copyWpmodulesFrom($iworkplan)
	{

		$wpmodules = $iworkplan->getWpmodules();
		foreach($wpmodules as $wpmodule)
			{
				$this->importWpmodule($wpmodule);
			}
	}


   public function importWpmodule($wpmodule)

	{
		
				$newwpmodule = new Wpmodule();
				$newwpmodule->setUserId($this->getUserId());
				$newwpmodule->setAppointmentId($this->getId());
				$newwpmodule->setTitle($wpmodule->getTitle());
				$newwpmodule->setPeriod($wpmodule->getPeriod());
				$newwpmodule->setIsPublic(false);
				$newwpmodule->save();
				$groups = $wpmodule->getWpitemGroups();
				foreach($groups as $group)
					{
						$newgroup = new WpitemGroup();
						$newgroup->setWpmoduleId($newwpmodule->getId());
						$newgroup->setWpitemTypeId($group->getWpitemTypeId());
						$newgroup->save();
						
						$items = $group->getWpmoduleItems();
						foreach($items as $item)
							{
								$newitem = new WpmoduleItem();
								$newitem->setWpitemGroupId($newgroup->getId());
								$newitem->setContent($item->getContent());
								$newitem->setEvaluation(null);
								$newitem->setRank($item->getRank());
								$newitem->setIsEditable(true);
								$newitem->save();
							}
					}			
		
	}



	public function importFromDb($context, $iworkplan)
	{
		
		$this->removeEverything();
		$this->copyWpinfosFrom($iworkplan);
		$this->copyWpmodulesFrom($iworkplan);
		$this->copyWptoolsFrom($iworkplan);


/*		
		This isn't really useful, since contents to be copied had been presumably checked
		Anyway, they'll be checked when the workplan is submitted

		$this->getChecks($context);
		$this->getChecks($context);
		// FIXME: We call it twice because the first time we just get the groups for each module...

*/		
		
		$result['result']='notice';
		$result['message']='The workplan has been correctly imported.';
		
		return $result;
		
	}

	public function delete(PropelPDO $con = null)
	{
		$this->removeEverything();
		parent::delete($con);
	}


	public function toggleStudentSuggestion($student_id, $term_id, Suggestion $suggestion)
	{
		
		//FIXME: Add check about the teacher doing the action...
		

		
		
		$c = new Criteria();
		$c->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->getId());
		$c->add(StudentSuggestionPeer::TERM_ID, $term_id);
		$c->add(StudentSuggestionPeer::USER_ID, $student_id);
		$c->add(StudentSuggestionPeer::SUGGESTION_ID, $suggestion->getId());

		$studentSuggestion = StudentSuggestionPeer::doSelectOne($c);
		
		$error=false;
		
		if ($studentSuggestion)
		{
			try
			{
				$studentSuggestion->delete();
			}
			catch (Exception $e)
			{
				$error=true;
			}
		}
		else
		{
			
			try
			{
				$studentSuggestion = new StudentSuggestion();
				$studentSuggestion
				->setTermId($term_id)
				->setUserId($student_id)
				->setAppointmentId($this->getId())
				->setSuggestion($suggestion)
				->save();
			}
			catch (Exception $e)
			{
				$error=true;
			}
			
		}

		
	}
	public function toggleStudentRecuperationHint($student_id, $term_id, RecuperationHint $hint)
	{
		
		//FIXME: Add check about the teacher doing the action...
		$c = new Criteria();
		$c->add(StudentHintPeer::APPOINTMENT_ID, $this->getId());
		$c->add(StudenthintPeer::TERM_ID, $term_id);
		$c->add(StudentHintPeer::USER_ID, $student_id);
		$c->add(StudentHintPeer::RECUPERATION_HINT_ID, $hint->getId());

		$studentHint = StudentHintPeer::doSelectOne($c);
		
		$error=false;
		
		if ($studentHint)
		{
			try
			{
				$studentHint->delete();
			}
			catch (Exception $e)
			{
				$error=true;
			}
		}
		else
		{
			
			try
			{
				$studentHint = new StudentHint();
				$studentHint
				->setTermId($term_id)
				->setUserId($student_id)
				->setAppointmentId($this->getId())
				->setRecuperationHint($hint)
				->save();
			}
			catch (Exception $e)
			{
				$error=true;
			}
			
		}

		
	}

}
