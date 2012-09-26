<?php


/**
 * This class defines the structure of the 'proj_detail_type' table.
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
class ProjDetailTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProjDetailTypeTableMap';

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
		$this->setName('proj_detail_type');
		$this->setPhpName('ProjDetailType');
		$this->setClassname('ProjDetailType');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('PROJ_CATEGORY_ID', 'ProjCategoryId', 'INTEGER', 'proj_category', 'ID', false, null, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', true, 30, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 255, null);
		$this->addColumn('LABEL', 'Label', 'VARCHAR', true, 100, null);
		$this->addColumn('IS_REQUIRED', 'IsRequired', 'BOOLEAN', false, null, true);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('STATE_MIN', 'StateMin', 'INTEGER', false, null, null);
		$this->addColumn('STATE_MAX', 'StateMax', 'INTEGER', false, null, null);
		$this->addColumn('EXAMPLE', 'Example', 'LONGVARCHAR', false, null, null);
		$this->addColumn('MISSING_VALUE_MESSAGE', 'MissingValueMessage', 'VARCHAR', false, 255, null);
		$this->addColumn('FILLED_VALUE_MESSAGE', 'FilledValueMessage', 'VARCHAR', false, 255, null);
		$this->addColumn('COLS', 'Cols', 'INTEGER', false, null, 80);
		$this->addColumn('ROWS', 'Rows', 'INTEGER', false, null, 5);
		$this->addColumn('RANK', 'Rank', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ProjCategory', 'ProjCategory', RelationMap::MANY_TO_ONE, array('proj_category_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('ProjDetail', 'ProjDetail', RelationMap::ONE_TO_MANY, array('id' => 'proj_detail_type_id', ), null, null);
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

} // ProjDetailTypeTableMap
