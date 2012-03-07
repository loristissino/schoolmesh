<?php


/**
 * This class defines the structure of the 'wpinfo_type' table.
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
class WpinfoTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WpinfoTypeTableMap';

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
		$this->setName('wpinfo_type');
		$this->setPhpName('WpinfoType');
		$this->setClassname('WpinfoType');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 50, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		$this->addColumn('RANK', 'Rank', 'INTEGER', true, null, null);
		$this->addColumn('STATE', 'State', 'INTEGER', false, null, null);
		$this->addColumn('TEMPLATE', 'Template', 'LONGVARCHAR', false, null, null);
		$this->addColumn('EXAMPLE', 'Example', 'LONGVARCHAR', false, null, null);
		$this->addColumn('IS_REQUIRED', 'IsRequired', 'BOOLEAN', false, null, true);
		$this->addColumn('IS_CONFIDENTIAL', 'IsConfidential', 'BOOLEAN', false, null, false);
		$this->addColumn('GRADE_MIN', 'GradeMin', 'INTEGER', false, null, 1);
		$this->addColumn('GRADE_MAX', 'GradeMax', 'INTEGER', false, null, 5);
		$this->addForeignKey('APPOINTMENT_TYPE_ID', 'AppointmentTypeId', 'INTEGER', 'appointment_type', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AppointmentType', 'AppointmentType', RelationMap::MANY_TO_ONE, array('appointment_type_id' => 'id', ), null, null);
    $this->addRelation('Wpinfo', 'Wpinfo', RelationMap::ONE_TO_MANY, array('id' => 'wpinfo_type_id', ), null, null);
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

} // WpinfoTypeTableMap
