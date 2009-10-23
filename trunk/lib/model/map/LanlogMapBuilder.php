<?php



class LanlogMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LanlogMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(LanlogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(LanlogPeer::TABLE_NAME);
		$tMap->setPhpName('Lanlog');
		$tMap->setClassname('Lanlog');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignKey('WORKSTATION_ID', 'WorkstationId', 'INTEGER', 'workstation', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('IS_ONLINE', 'IsOnline', 'BOOLEAN', true, null);

		$tMap->addColumn('OS_USED', 'OsUsed', 'VARCHAR', false, 100);

	} 
} 