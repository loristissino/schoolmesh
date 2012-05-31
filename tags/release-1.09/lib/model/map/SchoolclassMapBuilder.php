<?php



class SchoolclassMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SchoolclassMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SchoolclassPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SchoolclassPeer::TABLE_NAME);
		$tMap->setPhpName('Schoolclass');
		$tMap->setClassname('Schoolclass');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 5);

		$tMap->addColumn('GRADE', 'Grade', 'INTEGER', true, null);

		$tMap->addColumn('SECTION', 'Section', 'VARCHAR', true, 3);

		$tMap->addForeignKey('TRACK_ID', 'TrackId', 'INTEGER', 'track', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255);

	} 
} 