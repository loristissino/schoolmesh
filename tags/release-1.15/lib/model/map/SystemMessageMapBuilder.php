<?php



class SystemMessageMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SystemMessageMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SystemMessagePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SystemMessagePeer::TABLE_NAME);
		$tMap->setPhpName('SystemMessage');
		$tMap->setClassname('SystemMessage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('KEY', 'Key', 'VARCHAR', false, 30);

	} 
} 