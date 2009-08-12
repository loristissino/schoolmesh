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

	protected function markSubItems($newstate, $con=null)
	{
		$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
	 
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
	
	
	public function getChecks($context=null)
	{
		$result=Array();
		$result['checks']=Array();
		
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

				if ($wpinfotype->getIsRequired() and $context)
						{
							if ($wpinfo->getContent()=='')
								{
								array_push($result['checks'],
									new Check(
										false,
										$context->getI18N()->__('Content cannot be empty'),
										$wpinfotype->getTitle(),
										array(
											'link_to'=>'wpinfo/edit?id=' . $wpinfo->getId(),
											'flash'=>$flash)
											)
										);
								}
							elseif (!$wpinfo->checkContentAgainstTemplate($wpinfo->getContent(), $wpinfotype->getTemplate()))
								{
								array_push($result['checks'],
									new Check(
										false,
										$context->getI18N()->__('Content doesn\'t match template'),
										$wpinfotype->getTitle(),
										array(
											'link_to'=>'wpinfo/edit?id=' . $wpinfo->getId(),
											'flash'=>$flash)
											)
										);
								}
							else
								{
								array_push($result['checks'],
									new Check(
										true,
										$context->getI18N()->__('Filled'),
										$wpinfotype->getTitle()));
								}
							}
			}
	
		$modules=$this->getWpmodules();
		
		if (sizeof($modules)==0 and $context)
			{
				array_push($result['checks'],
					new Check(
						false,
						$context->getI18N()->__('There must be at least one module'),
						'',
						array(
							'link_to'=>'plansandreports/fill?id=' . $this->getId()
							)
						));
					
			}
			
		else
		{
			
			$neededItemTypes=WpitemTypePeer::getAllByRank();
			
			$titles=Array('---', '');
			foreach($modules as $wpmodule)
				{
					$moduleIsOk=true;
					if(in_array($wpmodule->getTitle(), $titles) and $context)
						{
							array_push($result['checks'],
								new Check(
									false,
									$context->getI18N()->__('Invalid or duplicate title for module'),
									$wpmodule->getTitle(),
									array(
										'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
									)
									));
							$moduleIsOk=false;
						}
					else
						{
							array_push($titles, $wpmodule->getTitle());
							// There can't be two modules with the same title.
							// If we make the check here instead of on the database level we let the user have an
							// inconsistent situation until they submit the workplan...
						}
					if(($wpmodule->getPeriod()=='---'||$wpmodule->getPeriod()=='') and $context)
						{
							array_push($result['checks'],
								new Check(
									false,
									$context->getI18N()->__('Invalid period specification for module'),
									$wpmodule->getTitle(),
									array(
										'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
										)
									));
								$moduleIsOk=false;

						}
						
					foreach ($neededItemTypes as $it)
						{
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
									if ($context)
										{
											array_push($result['checks'],
												new Check(
													false,
													sprintf($context->getI18N()->__('Missing group %s'), $it->getTitle()),
													$wpmodule->getTitle(),
													array(
														'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
														)
													));
													$moduleIsOk=false;
										}
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
											
											
											if ($context)
												{
													array_push($result['checks'],
														new Check(
															false,
															sprintf($context->getI18N()->__('There must be at least an item in group «%s»'), $it->getTitle()),
															$wpmodule->getTitle(),
															array(
																'link_to'=>'wpmodule/view?id=' . $wpmodule->getId()
																)
															));
															$moduleIsOk=false;
												}
										}
									else
										{
											foreach($items as $item)
												{
												if(($item->getContent()=='---'||$item->getContent()=='') and $context)
													{
														array_push($result['checks'],
															new Check(
																false,
																sprintf($context->getI18N()->__('Invalid content for item «%s» in group «%s»'), $item->getContent(), $it->getTitle()),
																$wpmodule->getTitle(),
																array(
																	'link_to'=>'wpmodule/view?id=' . $wpmodule->getId(),
																	'flash'=>'error'. $group->getId(),
																	'fragment'=>$group->getId()
																	)
																));
																$moduleIsOk=false;

													};
												
												if($it->getEvaluationMax()>0 && (($item->getEvaluation()==null)&&$this->getState()==Workflow::IR_DRAFT) and $context)
													{
														array_push($result['checks'],
															new Check(
																false,
																sprintf($context->getI18N()->__('Missing evaluation for item «%s» in group «%s»'), $item->getContent(), $it->getTitle()),
																$wpmodule->getTitle(),
																array(
																	'link_to'=>'wpmodule/view?id=' . $wpmodule->getId(). '#' . $group->getId(),
																	'flash'=>'error'. $group->getId(),
																	'fragment'=>$group->getId()
																	)
																));
																$moduleIsOk=false;
												}
											}
										}
								}
						}
						
					if ($moduleIsOk and $context)
						{
							array_push($result['checks'],
								new Check(
									true,
									$context->getI18N()->__('Module accepted'),
									$wpmodule->getTitle()));
						}
						
				} // end foreach (modules)
		} //end if (modules are present)
		
		$wptoolItemTypes=WptoolItemTypePeer::getAllNeededForState($this->getState());
		
		foreach ($wptoolItemTypes as $type)
			{
				$flash='error_aux'.$type->getId();

				if ($context)
					{
				
						if ($this->countToolsOfType($type->getId())>=$type->getMinSelected())
							{
									array_push($result['checks'],
										new Check(
											true,
											$context->getI18N()->__('Tools selected'),
											$type->getDescription()));
							}
						else
							{
									array_push($result['checks'],
										new Check(
											false,
											$context->getI18N()->__('Missing selection of tools'),
											$type->getDescription(),
											array(
												'link_to'=>'plansandreports/fill?id=' . $this->getId(),
												'flash'=>$flash, 
												'fragment'=>'wpaux')
											));
							}
						}
				
			}
				
		$result['failed']=0;
		foreach($result['checks'] as $c)
			{
				if(!$c->getIsPassed())
					$result['failed']++;
			}
		
		return $result;
		
	}


	public function countToolsOfType($typeId)
		{
			
		return WptoolAppointmentPeer::countToolsOfTypeForAppointment($typeId, $this->getId());
		}

	public function teacherSubmit($context)
	{

	$user_id=$context->getUser()->getProfile()->getSfGuardUser()->getId();
	
	// FIXME
	/* From the context I can get the user, so I don't really need the user_id as a parameter...
   But what happens in tests and in tasks? I have to find out, because there are no contexts there... */

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
			$result['message']='This action is not allowed for a document in this state.';
			return $result;
		}

	$checks=$this->getChecks($context); //sfContext::getInstance());

	$result['checks']=$checks['checks'];
	
	if ($checks['failed']==0)
		{
			$this->markSubItems('false');
			$result['result']='notice';
			$result['message']=$steps[$this->getState()]['owner']['submitDoneAction'];
			$this->addEvent($user_id, $steps[$this->getState()]['owner']['submitDoneAction'], $steps[$this->getState()]['owner']['submitNextState']);
		}
	else
		{
			$result['result']='error';
			$result['message']='Some errors prevented the submission of the document';
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

	if ($this->getState()!=$at->getWptoolItem()->getWptoolItemType()->getState())
		{
			$result['result']='error_aux';
			$result['message']='This action is not allowed for a workplan/report in this state';
			return $result;
		}

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

	$tool=WptoolItemPeer::retrieveByPK($tool_id);

	if ($this->getState()!=$tool->getWptoolItemType()->getState())
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


public function getContentAsMarkdown()
	{
		
	// this should be a kind of template, but I don't know how to use the output of the template from the inside of the action...
	
	$data=$this->getCompleteContentAsArray();
	
	$text='#' . sfContext::getInstance()->getI18N()->__('Workplan'). "\n";
	
	$text.='##' . sfContext::getInstance()->getI18N()->__("General information"). "\n";

	$text.='* ' . sfContext::getInstance()->getI18N()->__("Teacher: "). 
		$data['workplan_report']['teacher']['firstname'] .
		$data['workplan_report']['teacher']['lastname'] .
		"\n";
	$text.='* ' . sfContext::getInstance()->getI18N()->__("Subject: "). 
		$data['workplan_report']['subject']['description'] .
		"\n";
	$text.='* ' . sfContext::getInstance()->getI18N()->__("Class: "). 
		$data['workplan_report']['class']['id'] . 
		"\n\n";

	$text.='##' .sfContext::getInstance()->getI18N()->__('Details, comments, general information') . "\n\n";

	foreach($data['workplan_report']['info'] as $infokey=>$infovalue)
		{
		$text.='### ' . $infokey . "\n\n";
		$text.= $infovalue . "\n\n";
		}

	$text .= '##' .sfContext::getInstance()->getI18N()->__('Modules') . "\n\n";

	foreach($data['workplan_report']['modules'] as $infokey=>$infovalue)
		{
		$text.="\n### " . $infokey . "\n";
		$text.=sfContext::getInstance()->getI18N()->__('Period: ') . $infovalue['period'] . "\n";
		foreach($infovalue['details'] as $key=>$value)
			{
				foreach($value as $k=>$v)
					{
					$text.="\n####$k\n";
					foreach ($v as $ik=>$iv)
						{
						$text .='1. '. $iv['content'] . '_(' . $iv['evaluation'] . ')_' ."\n";
//						$text.="\n$ik -- $iv\n";
						}
					}
			}
		}


	return $text;
	
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


}