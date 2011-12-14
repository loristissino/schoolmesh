<?php


/**
 * This class defines the structure of the 'schoolclass' table.
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
class SchoolclassTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SchoolclassTableMap';

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
		$this->setName('schoolclass');
		$this->setPhpName('Schoolclass');
		$this->setClassname('Schoolclass');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 5, null);
		$this->addColumn('GRADE', 'Grade', 'INTEGER', true, null, null);
		$this->addColumn('SECTION', 'Section', 'VARCHAR', true, 3, null);
		$this->addForeignKey('TRACK_ID', 'TrackId', 'INTEGER', 'track', 'ID', false, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Track', 'Track', RelationMap::MANY_TO_ONE, array('track_id' => 'id', ), null, null);
    $this->addRelation('Appointment', 'Appointment', RelationMap::ONE_TO_MANY, array('id' => 'schoolclass_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Enrolment', 'Enrolment', RelationMap::ONE_TO_MANY, array('id' => 'schoolclass_id', ), 'RESTRICT', 'CASCADE');
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

} // SchoolclassTableMap
