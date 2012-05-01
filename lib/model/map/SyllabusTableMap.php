<?php


/**
 * This class defines the structure of the 'syllabus' table.
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
class SyllabusTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SyllabusTableMap';

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
		$this->setName('syllabus');
		$this->setPhpName('Syllabus');
		$this->setClassname('Syllabus');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 50, null);
		$this->addColumn('VERSION', 'Version', 'VARCHAR', false, 20, null);
		$this->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 50, null);
		$this->addColumn('HREF', 'Href', 'VARCHAR', false, 255, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('EVALUATION_MIN', 'EvaluationMin', 'INTEGER', false, null, null);
		$this->addColumn('EVALUATION_MAX', 'EvaluationMax', 'INTEGER', false, null, null);
		$this->addColumn('EVALUATION_MIN_DESCRIPTION', 'EvaluationMinDescription', 'VARCHAR', false, 50, null);
		$this->addColumn('EVALUATION_MAX_DESCRIPTION', 'EvaluationMaxDescription', 'VARCHAR', false, 50, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('SyllabusItem', 'SyllabusItem', RelationMap::ONE_TO_MANY, array('id' => 'syllabus_id', ), null, null);
    $this->addRelation('Appointment', 'Appointment', RelationMap::ONE_TO_MANY, array('id' => 'syllabus_id', ), null, null);
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

} // SyllabusTableMap
