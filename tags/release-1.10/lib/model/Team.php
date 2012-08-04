<?php

/**
 * Team class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Team extends BaseTeam
{
    
    public function __toString()
    {
            return $this->getDescription();
    }
	
	
	public function checkTeam(&$checkList)
	
	{
	
		$checkGroup=$this->getDescription();
		
		if (!$this->getPosixName())
		{
			$checkList->addCheck(new Check(Check::PASSED, 'team does not have a posix name (nothing to check)' . $this->getId(), $checkGroup));
			return;
		}
		
		if ($this->getNeedsFolder())
		{
			$info=Generic::executeCommand(sprintf('posixteam_getinfo %s', $this->getPosixName()));
			if ($info['found']==0)
			{
				$checkList->addCheck(new Check(Check::FAILED, 'team\'s posix group does not exist', $checkGroup, 
				array('command'=>sprintf('schoolmesh_posixteam_create %s', $this->getPosixName()))));
			}
			else
			{
				$checkList->addCheck(new Check(Check::PASSED, 'team\'s posix group exists', $checkGroup));
			}
			if (@$info['folder_found']!=1)
			{
				$checkList->addCheck(new Check(Check::WARNING, 'team\'s posix folder does not exist', $checkGroup,
				array('command'=>sprintf('schoolmesh_posixteam_foldercreate %s', $this->getPosixName()))));
			}
			else
			{
				$checkList->addCheck(new Check(Check::PASSED, 'team\'s posix folder exists', $checkGroup));
				$this->checkLinksForUsers($checkList, $checkGroup);
			}
		}
		else
		{
			$checkList->addCheck(new Check(Check::PASSED, 'team is set to not need a folder', $checkGroup));
		}
	}
	
	
	function checkLinksForUsers(&$checkList, $checkGroup)
	{
		$userteams=$this->getUserTeamsJoinsfGuardUser();
		foreach($userteams as $userteam)
		{
			$user=sfGuardUserPeer::retrieveByPK($userteam->getUserId());
			$username=$user->getUsername();
			
			$command=sprintf('posixteam_getuserinfo %s %s "%s"', $this->getPosixName(), $username, $this->getDescription());
			
			$info=Generic::executeCommand($command);

			if (sizeof($info)==0)
			{
				$checkList->addCheck(new Check(Check::WARNING, sprintf('problems with user %s (does the account exist?)', $user->getUsername()), $checkGroup));
				continue;
			}


			if (($info['link_found']!=1)||($info['belongs']!=1))
			{
				$checkList->addCheck(new Check(Check::WARNING, sprintf('user %s does not belong to the group or does not have a link in their folder for «%s»', $user->getUsername(), $this->getPosixName()), $checkGroup,
				array('command'=>sprintf('schoolmesh_posixteam_linkuser %s %s "%s"', $this->getPosixName(), $username, $this->getDescription()))
				));
			}
			else
			{
				$checkList->addCheck(new Check(Check::PASSED, sprintf('user %s has a link in their folder for %s', $user->getUsername(), $this->getPosixName()), $checkGroup));
			}
		}
	}
  
  public function getComponentsIds()
  {
    $ids=array();
    $c=new Criteria();
    $c->add(UserTeamPeer::TEAM_ID, $this->getId());
    $rows=UserTeamPeer::doSelect($c);
    foreach($rows as $row)
    {
      $ids[]=$row->getUserId();
    }
    return $ids;
  }
  
  public function getComponents()
  {
    $c=new Criteria();
    $c->add(UserTeamPeer::TEAM_ID, $this->getId());
    $c->addJoin(UserTeamPeer::USER_ID, sfGuardUserPeer::ID);
    $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
    $rows=UserTeamPeer::doSelectJoinAll($c);
    return $rows;
  }
	
  public function addWfevent($userId, $comment='', $i18n_subs, $state=0, $sf_context=null, $con=null)
  {
    Generic::addWfevent($this, $userId, $comment, $i18n_subs, $state, $sf_context, $con);
    return $this;
  }
  
  public function getWorkflowLogs()
	{
		$t = WfeventPeer::retrieveByClassAndId('Team', $this->getId(), true);
		if ($t)
			return $t;
		else
			return NULL;
	}

  
}
