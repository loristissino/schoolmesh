<?php



class WptoolItemMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WptoolItemMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WptoolItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WptoolItemPeer::TABLE_NAME);
		$tMap->setPhpName('WptoolItem');
		$tMap->setClassname('WptoolItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 50);

		$tMap->addForeignKey('WPTOOL_ITEM_TYPE_ID', 'WptoolItemTypeId', 'INTEGER', 'wptool_item_type', 'ID', false, null);

	} 
} 