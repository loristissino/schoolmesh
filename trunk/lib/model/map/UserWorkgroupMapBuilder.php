<?php



class UserWorkgroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserWorkgroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(UserWorkgroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserWorkgroupPeer::TABLE_NAME);
		$tMap->setPhpName('UserWorkgroup');
		$tMap->setClassname('UserWorkgroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addForeignKey('WORKGROUP_ID', 'WorkgroupId', 'INTEGER', 'workgroup', 'ID', false, null);

		$tMap->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'role', 'ID', false, null);

	} 
} 