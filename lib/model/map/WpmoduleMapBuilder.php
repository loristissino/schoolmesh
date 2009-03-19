<?php



class WpmoduleMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpmoduleMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpmodulePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpmodulePeer::TABLE_NAME);
		$tMap->setPhpName('Wpmodule');
		$tMap->setClassname('Wpmodule');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 100);

		$tMap->addColumn('PERIOD', 'Period', 'VARCHAR', false, 100);

		$tMap->addForeignKey('WORKPLAN_ID', 'WorkplanId', 'INTEGER', 'workplan', 'ID', false, null);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', false, null);

		$tMap->addColumn('IS_PUBLIC', 'IsPublic', 'BOOLEAN', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 