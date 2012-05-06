<?php


/**
 * This class defines the structure of the 'ticket_event' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TicketEventTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TicketEventTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('ticket_event');
		$this->setPhpName('TicketEvent');
		$this->setClassname('TicketEvent');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('TICKET_ID', 'TicketId', 'INTEGER', 'ticket', 'ID', false, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('CONTENT', 'Content', 'VARCHAR', true, 255, null);
		$this->addColumn('STATE', 'State', 'INTEGER', false, null, null);
		$this->addForeignKey('ASSIGNEE_ID', 'AssigneeId', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Ticket', 'Ticket', RelationMap::MANY_TO_ONE, array('ticket_id' => 'id', ), null, null);
    $this->addRelation('sfGuardUserRelatedByUserId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('sfGuardUserRelatedByAssigneeId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('assignee_id' => 'id', ), 'RESTRICT', 'CASCADE');
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_timestampable' => array('create_column' => 'created_at', ),
		);
	} // getBehaviors()

} // TicketEventTableMap
