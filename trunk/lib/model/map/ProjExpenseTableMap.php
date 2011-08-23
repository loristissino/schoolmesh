<?php


/**
 * This class defines the structure of the 'proj_expense' table.
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
class ProjExpenseTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProjExpenseTableMap';

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
		$this->setName('proj_expense');
		$this->setPhpName('ProjExpense');
		$this->setClassname('ProjExpense');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SCHOOLPROJECT_ID', 'SchoolprojectId', 'INTEGER', 'schoolproject', 'ID', false, null, null);
		$this->addForeignKey('PROJ_EXPENSE_TYPE_ID', 'ProjExpenseTypeId', 'INTEGER', 'proj_expense_type', 'ID', false, null, null);
		$this->addColumn('HOURS_ESTIMATED', 'HoursEstimated', 'INTEGER', false, null, null);
		$this->addColumn('HOURS_APPROVED', 'HoursApproved', 'INTEGER', false, null, null);
		$this->addColumn('AMOUNT_ESTIMATED', 'AmountEstimated', 'DECIMAL', false, null, null);
		$this->addColumn('AMOUNT_APPROVED', 'AmountApproved', 'DECIMAL', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Schoolproject', 'Schoolproject', RelationMap::MANY_TO_ONE, array('schoolproject_id' => 'id', ), null, null);
    $this->addRelation('ProjExpenseType', 'ProjExpenseType', RelationMap::MANY_TO_ONE, array('proj_expense_type_id' => 'id', ), null, null);
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

} // ProjExpenseTableMap
