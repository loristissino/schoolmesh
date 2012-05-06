<?php



class TicketMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TicketMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TicketPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TicketPeer::TABLE_NAME);
		$tMap->setPhpName('Ticket');
		$tMap->setClassname('Ticket');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('REFERRER', 'Referrer', 'VARCHAR', false, 255);

		$tMap->addForeignKey('TICKET_TYPE_ID', 'TicketTypeId', 'INTEGER', 'ticket_type', 'ID', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('STATE', 'State', 'INTEGER', false, null);

	} 
} 