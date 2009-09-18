<?php



class EnrolmentMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EnrolmentMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(EnrolmentPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(EnrolmentPeer::TABLE_NAME);
		$tMap->setPhpName('Enrolment');
		$tMap->setClassname('Enrolment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignKey('SCHOOLCLASS_ID', 'SchoolclassId', 'VARCHAR', 'schoolclass', 'ID', true, 5);

		$tMap->addForeignKey('YEAR_ID', 'YearId', 'INTEGER', 'year', 'ID', true, null);

		$tMap->addColumn('INFO', 'Info', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('IMPORT_CODE', 'ImportCode', 'VARCHAR', false, 20);

	} 
} 