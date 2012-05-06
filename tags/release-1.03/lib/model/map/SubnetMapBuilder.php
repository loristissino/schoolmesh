<?php



class SubnetMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SubnetMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SubnetPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SubnetPeer::TABLE_NAME);
		$tMap->setPhpName('Subnet');
		$tMap->setClassname('Subnet');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 40);

		$tMap->addColumn('IP_CIDR', 'IpCidr', 'VARCHAR', false, 20);

	} 
} 