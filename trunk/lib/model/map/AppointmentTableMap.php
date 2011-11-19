<?php


/**
 * This class defines the structure of the 'appointment' table.
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
class AppointmentTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AppointmentTableMap';

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
		$this->setName('appointment');
		$this->setPhpName('Appointment');
		$this->setClassname('Appointment');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('SUBJECT_ID', 'SubjectId', 'INTEGER', 'subject', 'ID', true, null, null);
		$this->addForeignKey('SCHOOLCLASS_ID', 'SchoolclassId', 'VARCHAR', 'schoolclass', 'ID', true, 5, null);
		$this->addForeignKey('TEAM_ID', 'TeamId', 'INTEGER', 'team', 'ID', false, null, null);
		$this->addForeignKey('YEAR_ID', 'YearId', 'INTEGER', 'year', 'ID', true, null, null);
		$this->addColumn('STATE', 'State', 'INTEGER', false, null, null);
		$this->addColumn('HOURS', 'Hours', 'INTEGER', false, null, 0);
		$this->addColumn('IS_PUBLIC', 'IsPublic', 'BOOLEAN', false, null, null);
		$this->addForeignKey('SYLLABUS_ID', 'SyllabusId', 'INTEGER', 'syllabus', 'ID', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('IMPORT_CODE', 'ImportCode', 'VARCHAR', false, 20, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Subject', 'Subject', RelationMap::MANY_TO_ONE, array('subject_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Schoolclass', 'Schoolclass', RelationMap::MANY_TO_ONE, array('schoolclass_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Team', 'Team', RelationMap::MANY_TO_ONE, array('team_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Year', 'Year', RelationMap::MANY_TO_ONE, array('year_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Syllabus', 'Syllabus', RelationMap::MANY_TO_ONE, array('syllabus_id' => 'id', ), null, null);
    $this->addRelation('Wpevent', 'Wpevent', RelationMap::ONE_TO_MANY, array('id' => 'appointment_id', ), null, null);
    $this->addRelation('Wpinfo', 'Wpinfo', RelationMap::ONE_TO_MANY, array('id' => 'appointment_id', ), null, null);
    $this->addRelation('WptoolAppointment', 'WptoolAppointment', RelationMap::ONE_TO_MANY, array('id' => 'appointment_id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Wpmodule', 'Wpmodule', RelationMap::ONE_TO_MANY, array('id' => 'appointment_id', ), null, null);
    $this->addRelation('StudentSuggestion', 'StudentSuggestion', RelationMap::ONE_TO_MANY, array('id' => 'appointment_id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('StudentHint', 'StudentHint', RelationMap::ONE_TO_MANY, array('id' => 'appointment_id', ), 'CASCADE', 'CASCADE');
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // AppointmentTableMap
