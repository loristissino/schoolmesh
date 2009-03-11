<?php



class SubnetServiceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SubnetServiceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SubnetServicePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SubnetServicePeer::TABLE_NAME);
		$tMap->setPhpName('SubnetService');
		$tMap->setClassname('SubnetService');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('SUBNET_ID', 'SubnetId', 'INTEGER' , 'subnet', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'INTEGER' , 'service', 'ID', true, null);

	} 
} 