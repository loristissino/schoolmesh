<?php

class Team extends BaseTeam
{
    
    public function __toString()
    {
            return $this->getDescription();
    }
	
	
	public function checkTeam(&$checkList)
	
	{
	
		$checkGroup=$this->getDescription();
		$checkList->addCheck(new Check(Check::PASSED, 'checking team ' . $this->getId(), $checkGroup);
		
		if $this->needsFolder()
		{
			
			
		}
	
		$userteams=$this->getUserTeamsJoinsfGuardUser();
		foreach($userteams as $userteam)
		{
			$profile=sfGuardUserProfilePeer::retrieveByPK($userteam->getUserId());
			$checkList->addCheck(new Check(Check::PASSED, sprintf('%s (%s)', $profile->getFullname(), $userteam->getRole()), $checkGroup);
		}
	
		
	}
}
