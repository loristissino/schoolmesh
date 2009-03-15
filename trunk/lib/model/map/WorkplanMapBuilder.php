<?php



class WorkplanMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WorkplanMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WorkplanPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WorkplanPeer::TABLE_NAME);
		$tMap->setPhpName('Workplan');
		$tMap->setClassname('Workplan');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addForeignKey('YEAR_ID', 'YearId', 'INTEGER', 'year', 'ID', true, null);

		$tMap->addForeignKey('SCHOOLCLASS_ID', 'SchoolclassId', 'VARCHAR', 'schoolclass', 'ID', true, 5);

		$tMap->addForeignKey('SUBJECT_ID', 'SubjectId', 'INTEGER', 'subject', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('IS_LOCKED', 'IsLocked', 'BOOLEAN', false, null);

	} 
} 