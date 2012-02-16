<?php

/**
 * RolePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class RolePeer extends BaseRolePeer
{
	
	public static function retrieveMainRoles()
	{
		$c=new Criteria();
		$c->add(RolePeer::MAY_BE_MAIN_ROLE, true);
    return self::retrieveAll($c);
	}
  
	public static function retrieveKeyRoles()
	{
		$c=new Criteria();
		$c->add(RolePeer::IS_KEY, true);
    return self::retrieveAll($c);
	}

	public static function retrieveFunctionalRoles()
	{
		$c=new Criteria();
		$c->add(RolePeer::IS_KEY, false);
		$c->add(RolePeer::QUALITY_CODE, '', Criteria::NOT_EQUAL);
		$c->add(RolePeer::MAY_BE_MAIN_ROLE, false);
    return self::retrieveAll($c);
	}

  
	public static function retrieveAll($c=null)
	{
    if(!$c)
    {
      $c=new Criteria();
    }
    $c->addAscendingOrderByColumn(RolePeer::RANK);
    $c->addAscendingOrderByColumn(RolePeer::MALE_DESCRIPTION);
		return self::doSelect($c);
	}

	public static function retrieveByDescription($description)
	{
    $c=new Criteria();
    $c->add(self::DESCRIPTION, $description);
    $t = self::doSelectOne($c);
    return $t;
	}

	public static function retrieveByPosixName($value)
	{
    $c=new Criteria();
    $c->add(self::POSIX_NAME, $value);
    $t = self::doSelectOne($c);
    return $t;
	}
  
  public static function retrieveUsersPlayingRole(Role $Role)
  {
    $c=new Criteria();
    $c->addJoin(RolePeer::ID, UserTeamPeer::ROLE_ID);
    $c->addJoin(UserTeamPeer::USER_ID, sfGuardUserPeer::ID);
    $c->addJoin(UserTeamPeer::TEAM_ID, TeamPeer::ID);
    if($Role->getMayBeMainRole())
    {
      // this is the case of the principal, for instance
      $c->add(TeamPeer::QUALITY_CODE, $Role->getQualityCode());
    }

    $c->add(RolePeer::ID, $Role->getId());
    $c->setDistinct();
    
    return UserTeamPeer::doSelectJoinAll($c);
  }


  public static function getOrganizationalChartOdf($doctype, sfContext $sfContext=null, $template='')
  {
		if ($template=='')
		{
			$template='organizational_chart.odt';
		}

		$doctitle='Organizational Chart';
    $unassigned='Unassigned';

		if ($sfContext)
		{
			$doctitle=$sfContext->getI18n()->__($doctitle);
      $unassigned=$sfContext->getI18n()->__($unassigned);
		}

		try
		{
			$odf=new OdfDoc($template, $doctitle . '.' .$doctype, $doctype);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
    
    foreach(self::retrieveKeyRoles() as $Role)
    {
      $users=array();
      if($userteams=$Role->getUsersPlayingRole())
      {
        foreach($userteams as $userteam)
        {
          $users[$userteam->getSfGuardUser()->getProfile()->getFullName()]=$userteam->getSfGuardUser()->getProfile()->getId();
        }
      }
      $text=sizeof($users) ? implode(', ', array_flip($users)): $unassigned;
      $odfdoc->setVars($Role->getQualityCode(), $text);
    }
    return $odf;
  }


}
