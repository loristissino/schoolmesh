<?php


/**
 * This class defines the structure of the 'appointment_type' table.
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
class AppointmentTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AppointmentTypeTableMap';

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
		$this->setName('appointment_type');
		$this->setPhpName('AppointmentType');
		$this->setClassname('AppointmentType');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		$this->addColumn('SHORTCUT', 'Shortcut', 'VARCHAR', false, 10, null);
		$this->addColumn('RANK', 'Rank', 'INTEGER', false, null, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('HAS_INFO', 'HasInfo', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_MODULES', 'HasModules', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_TOOLS', 'HasTools', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_ATTACHMENTS', 'HasAttachments', 'BOOLEAN', false, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Appointment', 'Appointment', RelationMap::ONE_TO_MANY, array('id' => 'appointment_type_id', ), null, null);
    $this->addRelation('WpinfoType', 'WpinfoType', RelationMap::ONE_TO_MANY, array('id' => 'appointment_type_id', ), null, null);
    $this->addRelation('WptoolItemType', 'WptoolItemType', RelationMap::ONE_TO_MANY, array('id' => 'appointment_type_id', ), null, null);
    $this->addRelation('WpitemType', 'WpitemType', RelationMap::ONE_TO_MANY, array('id' => 'appointment_type_id', ), null, null);
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

} // AppointmentTypeTableMap
