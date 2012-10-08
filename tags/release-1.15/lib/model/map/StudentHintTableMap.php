<?php


/**
 * This class defines the structure of the 'student_hint' table.
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
class StudentHintTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.StudentHintTableMap';

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
		$this->setName('student_hint');
		$this->setPhpName('StudentHint');
		$this->setClassname('StudentHint');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('TERM_ID', 'TermId', 'VARCHAR', 'term', 'ID', true, 10, null);
		$this->addForeignPrimaryKey('APPOINTMENT_ID', 'AppointmentId', 'INTEGER' , 'appointment', 'ID', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('RECUPERATION_HINT_ID', 'RecuperationHintId', 'INTEGER', 'recuperation_hint', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Term', 'Term', RelationMap::MANY_TO_ONE, array('term_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Appointment', 'Appointment', RelationMap::MANY_TO_ONE, array('appointment_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('RecuperationHint', 'RecuperationHint', RelationMap::MANY_TO_ONE, array('recuperation_hint_id' => 'id', ), null, null);
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

} // StudentHintTableMap
