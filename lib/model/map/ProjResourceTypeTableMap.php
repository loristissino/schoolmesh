<?php


/**
 * This class defines the structure of the 'proj_resource_type' table.
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
class ProjResourceTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProjResourceTypeTableMap';

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
		$this->setName('proj_resource_type');
		$this->setPhpName('ProjResourceType');
		$this->setClassname('ProjResourceType');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		$this->addColumn('SHORTCUT', 'Shortcut', 'VARCHAR', true, 5, null);
		$this->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'role', 'ID', false, null, null);
		$this->addColumn('STANDARD_COST', 'StandardCost', 'DECIMAL', false, 10, null);
		$this->addColumn('MEASUREMENT_UNIT', 'MeasurementUnit', 'VARCHAR', false, 10, null);
		$this->addColumn('IS_MONETARY', 'IsMonetary', 'BOOLEAN', false, null, true);
		$this->addColumn('RANK', 'Rank', 'INTEGER', false, null, null);
		$this->addColumn('PRINTED_IN_SUBMISSION_LETTERS', 'PrintedInSubmissionLetters', 'BOOLEAN', false, null, true);
		$this->addColumn('PRINTED_IN_CHARGE_LETTERS', 'PrintedInChargeLetters', 'BOOLEAN', false, null, true);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Role', 'Role', RelationMap::MANY_TO_ONE, array('role_id' => 'id', ), null, null);
    $this->addRelation('ProjResource', 'ProjResource', RelationMap::ONE_TO_MANY, array('id' => 'proj_resource_type_id', ), null, null);
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

} // ProjResourceTypeTableMap
