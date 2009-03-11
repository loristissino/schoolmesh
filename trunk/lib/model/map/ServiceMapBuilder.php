<?php



class ServiceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ServiceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ServicePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ServicePeer::TABLE_NAME);
		$tMap->setPhpName('Service');
		$tMap->setClassname('Service');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 40);

		$tMap->addColumn('IS_ENABLED_BY_DEFAULT', 'IsEnabledByDefault', 'BOOLEAN', false, null);

		$tMap->addColumn('PORT', 'Port', 'INTEGER', true, null);

		$tMap->addColumn('IS_UDP', 'IsUdp', 'BOOLEAN', false, null);

	} 
} 