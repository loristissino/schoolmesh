<?php



class SongMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SongMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SongPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SongPeer::TABLE_NAME);
		$tMap->setPhpName('Song');
		$tMap->setClassname('Song');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 40);

		$tMap->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 40);

	} 
} 