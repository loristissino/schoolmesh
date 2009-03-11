<?php



class ModuleItemMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ModuleItemMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ModuleItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ModuleItemPeer::TABLE_NAME);
		$tMap->setPhpName('ModuleItem');
		$tMap->setClassname('ModuleItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('ITEM_TYPE_ID', 'ItemTypeId', 'INTEGER', 'item_type', 'ID', false, null);

		$tMap->addForeignKey('MODULE_ID', 'ModuleId', 'INTEGER', 'module', 'ID', false, null);

		$tMap->addColumn('POSITION', 'Position', 'INTEGER', false, null);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null);

	} 
} 