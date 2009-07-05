<?php



class WptoolItemTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WptoolItemTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WptoolItemTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WptoolItemTypePeer::TABLE_NAME);
		$tMap->setPhpName('WptoolItemType');
		$tMap->setClassname('WptoolItemType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 50);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', false, null);

		$tMap->addColumn('STATE', 'State', 'INTEGER', false, null);

	} 
} 