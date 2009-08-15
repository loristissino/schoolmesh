<?php



class AccountTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AccountTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(AccountTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AccountTypePeer::TABLE_NAME);
		$tMap->setPhpName('AccountType');
		$tMap->setClassname('AccountType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('IS_EXTERNAL', 'IsExternal', 'BOOLEAN', true, null);

	} 
} 