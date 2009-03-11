<?php



class WorkgroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WorkgroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WorkgroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WorkgroupPeer::TABLE_NAME);
		$tMap->setPhpName('Workgroup');
		$tMap->setClassname('Workgroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 100);

		$tMap->addColumn('POSIX_NAME', 'PosixName', 'VARCHAR', false, 20);

		$tMap->addColumn('PRIORITY', 'Priority', 'INTEGER', false, null);

		$tMap->addColumn('QUALITY_CODE', 'QualityCode', 'VARCHAR', false, 10);

	} 
} 