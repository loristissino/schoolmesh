<?php



class sfGuardUserProfileMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(sfGuardUserProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(sfGuardUserProfilePeer::TABLE_NAME);
		$tMap->setPhpName('sfGuardUserProfile');
		$tMap->setClassname('sfGuardUserProfile');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 50);

		$tMap->addColumn('MIDDLE_NAME', 'MiddleName', 'VARCHAR', false, 50);

		$tMap->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 50);

		$tMap->addColumn('PRONUNCIATION', 'Pronunciation', 'VARCHAR', false, 100);

		$tMap->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'role', 'ID', false, null);

		$tMap->addColumn('GENDER', 'Gender', 'VARCHAR', false, 1);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 50);

		$tMap->addColumn('EMAIL_STATE', 'EmailState', 'INTEGER', false, null);

		$tMap->addColumn('EMAIL_VERIFICATION_CODE', 'EmailVerificationCode', 'VARCHAR', false, 32);

		$tMap->addColumn('BIRTHDATE', 'Birthdate', 'DATE', false, null);

		$tMap->addColumn('BIRTHPLACE', 'Birthplace', 'VARCHAR', false, 50);

		$tMap->addColumn('IMPORT_CODE', 'ImportCode', 'VARCHAR', false, 20);

		$tMap->addColumn('POSIX_UID', 'PosixUid', 'INTEGER', false, null);

		$tMap->addColumn('DISK_SET_SOFT_BLOCKS_QUOTA', 'DiskSetSoftBlocksQuota', 'INTEGER', false, null);

		$tMap->addColumn('DISK_SET_HARD_BLOCKS_QUOTA', 'DiskSetHardBlocksQuota', 'INTEGER', false, null);

		$tMap->addColumn('DISK_SET_SOFT_FILES_QUOTA', 'DiskSetSoftFilesQuota', 'INTEGER', false, null);

		$tMap->addColumn('DISK_SET_HARD_FILES_QUOTA', 'DiskSetHardFilesQuota', 'INTEGER', false, null);

		$tMap->addColumn('DISK_USED_BLOCKS', 'DiskUsedBlocks', 'INTEGER', false, null);

		$tMap->addColumn('DISK_USED_FILES', 'DiskUsedFiles', 'INTEGER', false, null);

		$tMap->addColumn('DISK_UPDATED_AT', 'DiskUpdatedAt', 'TIMESTAMP', false, null);

	} 
} 