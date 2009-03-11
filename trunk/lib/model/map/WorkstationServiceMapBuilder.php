<?php



class WorkstationServiceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WorkstationServiceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WorkstationServicePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WorkstationServicePeer::TABLE_NAME);
		$tMap->setPhpName('WorkstationService');
		$tMap->setClassname('WorkstationService');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('WORKSTATION_ID', 'WorkstationId', 'INTEGER' , 'workstation', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'INTEGER' , 'service', 'ID', true, null);

	} 
} 