<?php



class WorkstationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WorkstationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WorkstationPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WorkstationPeer::TABLE_NAME);
		$tMap->setPhpName('Workstation');
		$tMap->setClassname('Workstation');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 40);

		$tMap->addColumn('IP_CIDR', 'IpCidr', 'VARCHAR', true, 20);

		$tMap->addColumn('MAC_ADDRESS', 'MacAddress', 'VARCHAR', false, 17);

		$tMap->addColumn('IS_ENABLED', 'IsEnabled', 'BOOLEAN', false, null);

		$tMap->addForeignKey('SUBNET_ID', 'SubnetId', 'INTEGER', 'subnet', 'ID', false, null);

	} 
} 