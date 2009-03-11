<?php



class SubjectMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SubjectMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SubjectPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SubjectPeer::TABLE_NAME);
		$tMap->setPhpName('Subject');
		$tMap->setClassname('Subject');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('SHORTCUT', 'Shortcut', 'VARCHAR', true, 3);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 255);

	} 
} 