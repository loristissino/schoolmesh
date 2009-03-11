<?php



class ItemTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ItemTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ItemTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ItemTypePeer::TABLE_NAME);
		$tMap->setPhpName('ItemType');
		$tMap->setClassname('ItemType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 200);

	} 
} 