<?php



class EnrollmentMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EnrollmentMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(EnrollmentPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(EnrollmentPeer::TABLE_NAME);
		$tMap->setPhpName('Enrollment');
		$tMap->setClassname('Enrollment');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SCHOOLCLASS_ID', 'SchoolclassId', 'VARCHAR' , 'schoolclass', 'ID', true, 5);

		$tMap->addForeignPrimaryKey('YEAR_ID', 'YearId', 'INTEGER' , 'year', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('IMPORT_CODE', 'ImportCode', 'VARCHAR', false, 20);

	} 
} 