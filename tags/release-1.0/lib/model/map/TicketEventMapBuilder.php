<?php



class TicketEventMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TicketEventMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TicketEventPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TicketEventPeer::TABLE_NAME);
		$tMap->setPhpName('TicketEvent');
		$tMap->setClassname('TicketEvent');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('TICKET_ID', 'TicketId', 'INTEGER', 'ticket', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('CONTENT', 'Content', 'VARCHAR', true, 255);

		$tMap->addColumn('STATE', 'State', 'INTEGER', false, null);

		$tMap->addForeignKey('ASSIGNEE_ID', 'AssigneeId', 'INTEGER', 'sf_guard_user', 'ID', false, null);

	} 
} 