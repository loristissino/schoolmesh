<?php



class TeamMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TeamMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TeamPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TeamPeer::TABLE_NAME);
		$tMap->setPhpName('Team');
		$tMap->setClassname('Team');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 100);

		$tMap->addColumn('POSIX_NAME', 'PosixName', 'VARCHAR', false, 20);

		$tMap->addColumn('QUALITY_CODE', 'QualityCode', 'VARCHAR', false, 10);

	} 
} 