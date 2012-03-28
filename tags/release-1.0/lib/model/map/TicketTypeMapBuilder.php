<?php



class TicketTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TicketTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TicketTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TicketTypePeer::TABLE_NAME);
		$tMap->setPhpName('TicketType');
		$tMap->setClassname('TicketType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 50);

	} 
} 