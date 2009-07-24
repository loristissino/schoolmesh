<?php



class WpinfoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpinfoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpinfoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpinfoPeer::TABLE_NAME);
		$tMap->setPhpName('Wpinfo');
		$tMap->setClassname('Wpinfo');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('APPOINTMENT_ID', 'AppointmentId', 'INTEGER', 'appointment', 'ID', false, null);

		$tMap->addForeignKey('WPINFO_TYPE_ID', 'WpinfoTypeId', 'INTEGER', 'wpinfo_type', 'ID', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null);

	} 
} 