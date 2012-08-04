<?php



class UserTeamMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserTeamMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(UserTeamPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserTeamPeer::TABLE_NAME);
		$tMap->setPhpName('UserTeam');
		$tMap->setClassname('UserTeam');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignKey('TEAM_ID', 'TeamId', 'INTEGER', 'team', 'ID', true, null);

		$tMap->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'role', 'ID', true, null);

	} 
} 