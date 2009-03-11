<?php



class UnitItemMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UnitItemMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(UnitItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UnitItemPeer::TABLE_NAME);
		$tMap->setPhpName('UnitItem');
		$tMap->setClassname('UnitItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('ITEM_TYPE_ID', 'ItemTypeId', 'INTEGER', 'item_type', 'ID', false, null);

		$tMap->addForeignKey('UNIT_ID', 'UnitId', 'INTEGER', 'unit', 'ID', false, null);

		$tMap->addColumn('POSITION', 'Position', 'INTEGER', false, null);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null);

	} 
} 