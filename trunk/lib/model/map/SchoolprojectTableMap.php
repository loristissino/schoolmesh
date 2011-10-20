<?php


/**
 * This class defines the structure of the 'schoolproject' table.
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
class SchoolprojectTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SchoolprojectTableMap';

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
		$this->setName('schoolproject');
		$this->setPhpName('Schoolproject');
		$this->setClassname('Schoolproject');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('PROJ_CATEGORY_ID', 'ProjCategoryId', 'INTEGER', 'proj_category', 'ID', false, null, null);
		$this->addForeignKey('PROJ_FINANCING_ID', 'ProjFinancingId', 'INTEGER', 'proj_financing', 'ID', false, null, null);
		$this->addForeignKey('YEAR_ID', 'YearId', 'INTEGER', 'year', 'ID', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('ADDRESSEES', 'Addressees', 'LONGVARCHAR', false, null, null);
		$this->addColumn('PURPOSES', 'Purposes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('GOALS', 'Goals', 'LONGVARCHAR', false, null, null);
		$this->addColumn('FINAL_REPORT', 'FinalReport', 'LONGVARCHAR', false, null, null);
		$this->addColumn('PROPOSALS', 'Proposals', 'LONGVARCHAR', false, null, null);
		$this->addColumn('HOURS_APPROVED', 'HoursApproved', 'INTEGER', false, null, null);
		$this->addColumn('STATE', 'State', 'INTEGER', false, null, null);
		$this->addColumn('SUBMISSION_DATE', 'SubmissionDate', 'DATE', false, null, null);
		$this->addColumn('REFERENCE_NUMBER', 'ReferenceNumber', 'VARCHAR', false, 20, null);
		$this->addColumn('APPROVAL_DATE', 'ApprovalDate', 'DATE', false, null, null);
		$this->addColumn('APPROVAL_NOTES', 'ApprovalNotes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('FINANCING_DATE', 'FinancingDate', 'DATE', false, null, null);
		$this->addColumn('FINANCING_NOTES', 'FinancingNotes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('EVALUATION_MIN', 'EvaluationMin', 'INTEGER', false, null, null);
		$this->addColumn('EVALUATION_MAX', 'EvaluationMax', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ProjCategory', 'ProjCategory', RelationMap::MANY_TO_ONE, array('proj_category_id' => 'id', ), null, null);
    $this->addRelation('ProjFinancing', 'ProjFinancing', RelationMap::MANY_TO_ONE, array('proj_financing_id' => 'id', ), null, null);
    $this->addRelation('Year', 'Year', RelationMap::MANY_TO_ONE, array('year_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('ProjDeadline', 'ProjDeadline', RelationMap::ONE_TO_MANY, array('id' => 'schoolproject_id', ), null, null);
    $this->addRelation('ProjResource', 'ProjResource', RelationMap::ONE_TO_MANY, array('id' => 'schoolproject_id', ), null, null);
    $this->addRelation('ProjUpshot', 'ProjUpshot', RelationMap::ONE_TO_MANY, array('id' => 'schoolproject_id', ), null, null);
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

} // SchoolprojectTableMap
