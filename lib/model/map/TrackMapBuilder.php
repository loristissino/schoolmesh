<?php



class TrackMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TrackMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TrackPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackPeer::TABLE_NAME);
		$tMap->setPhpName('Track');
		$tMap->setClassname('Track');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('SHORTCUT', 'Shortcut', 'VARCHAR', false, 3);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 255);

	} 
} 