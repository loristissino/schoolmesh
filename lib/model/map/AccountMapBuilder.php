<?php



class AccountMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AccountMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(AccountPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AccountPeer::TABLE_NAME);
		$tMap->setPhpName('Account');
		$tMap->setClassname('Account');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignKey('ACCOUNT_TYPE_ID', 'AccountTypeId', 'INTEGER', 'account_type', 'ID', true, null);

		$tMap->addColumn('INFO', 'Info', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SETTINGS', 'Settings', 'LONGVARCHAR', false, null);

		$tMap->addColumn('EXISTS', 'Exists', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_LOCKED', 'IsLocked', 'BOOLEAN', false, null);

		$tMap->addColumn('TEMPORARY_PASSWORD', 'TemporaryPassword', 'VARCHAR', false, 10);

		$tMap->addColumn('INFO_UPDATED_AT', 'InfoUpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('LAST_KNOWN_LOGIN_AT', 'LastKnownLoginAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('QUOTA_PERCENTAGE', 'QuotaPercentage', 'INTEGER', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 