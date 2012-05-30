<?php


/**
 * This class defines the structure of the 'wptool_appointment' table.
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
class WptoolAppointmentTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WptoolAppointmentTableMap';

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
		$this->setName('wptool_appointment');
		$this->setPhpName('WptoolAppointment');
		$this->setClassname('WptoolAppointment');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('APPOINTMENT_ID', 'AppointmentId', 'INTEGER' , 'appointment', 'ID', true, null, null);
		$this->addForeignPrimaryKey('WPTOOL_ITEM_ID', 'WptoolItemId', 'INTEGER' , 'wptool_item', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Appointment', 'Appointment', RelationMap::MANY_TO_ONE, array('appointment_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('WptoolItem', 'WptoolItem', RelationMap::MANY_TO_ONE, array('wptool_item_id' => 'id', ), 'RESTRICT', 'CASCADE');
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
		);
	} // getBehaviors()

} // WptoolAppointmentTableMap
