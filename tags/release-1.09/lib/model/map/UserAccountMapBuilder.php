<?php



class UserAccountMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserAccountMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(UserAccountPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserAccountPeer::TABLE_NAME);
		$tMap->setPhpName('UserAccount');
		$tMap->setClassname('UserAccount');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignKey('ACCOUNT_ID', 'AccountId', 'INTEGER', 'account', 'ID', true, null);

		$tMap->addColumn('INFO', 'Info', 'LONGVARCHAR', false, null);

	} 
} 