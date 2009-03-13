<?php



class WpitemTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpitemTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpitemTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpitemTypePeer::TABLE_NAME);
		$tMap->setPhpName('WpitemType');
		$tMap->setClassname('WpitemType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 200);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', true, null);

	} 
} 