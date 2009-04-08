<?php



class WptoolAppointmentMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WptoolAppointmentMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WptoolAppointmentPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WptoolAppointmentPeer::TABLE_NAME);
		$tMap->setPhpName('WptoolAppointment');
		$tMap->setClassname('WptoolAppointment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('APPOINTMENT_ID', 'AppointmentId', 'INTEGER', 'appointment', 'ID', false, null);

		$tMap->addForeignKey('WPTOOL_ITEM_ID', 'WptoolItemId', 'INTEGER', 'wptool_item', 'ID', false, null);

	} 
} 