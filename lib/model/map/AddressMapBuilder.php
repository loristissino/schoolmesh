<?php



class AddressMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AddressMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(AddressPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AddressPeer::TABLE_NAME);
		$tMap->setPhpName('Address');
		$tMap->setClassname('Address');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('SHORTCUT', 'Shortcut', 'VARCHAR', false, 3);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 255);

	} 
} 