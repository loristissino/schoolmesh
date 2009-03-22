<?php



class WpeventMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpeventMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpeventPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpeventPeer::TABLE_NAME);
		$tMap->setPhpName('Wpevent');
		$tMap->setClassname('Wpevent');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addForeignKey('APPOINTMENT_ID', 'AppointmentId', 'INTEGER', 'appointment', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'VARCHAR', false, 255);

		$tMap->addColumn('STATE', 'State', 'INTEGER', false, null);

	} 
} 