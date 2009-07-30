<?php



class ReservedUsernameMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ReservedUsernameMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ReservedUsernamePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ReservedUsernamePeer::TABLE_NAME);
		$tMap->setPhpName('ReservedUsername');
		$tMap->setClassname('ReservedUsername');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('USERNAME', 'Username', 'VARCHAR', false, 20);

	} 
} 