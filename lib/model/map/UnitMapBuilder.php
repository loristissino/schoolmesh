<?php



class UnitMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UnitMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(UnitPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UnitPeer::TABLE_NAME);
		$tMap->setPhpName('Unit');
		$tMap->setClassname('Unit');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('SHORTCUT', 'Shortcut', 'VARCHAR', false, 20);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 100);

		$tMap->addColumn('PERIOD', 'Period', 'VARCHAR', false, 100);

		$tMap->addColumn('IS_PUBLIC', 'IsPublic', 'BOOLEAN', false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'BOOLEAN', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 