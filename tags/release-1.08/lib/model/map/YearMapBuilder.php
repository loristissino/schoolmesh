<?php



class YearMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.YearMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(YearPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(YearPeer::TABLE_NAME);
		$tMap->setPhpName('Year');
		$tMap->setClassname('Year');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 7);

	} 
} 