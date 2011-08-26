<?php


/**
 * This class defines the structure of the 'proj_resource' table.
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
class ProjResourceTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProjResourceTableMap';

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
		$this->setName('proj_resource');
		$this->setPhpName('ProjResource');
		$this->setClassname('ProjResource');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SCHOOLPROJECT_ID', 'SchoolprojectId', 'INTEGER', 'schoolproject', 'ID', false, null, null);
		$this->addForeignKey('PROJ_RESOURCE_TYPE_ID', 'ProjResourceTypeId', 'INTEGER', 'proj_resource_type', 'ID', false, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		$this->addColumn('QUANTITY_ESTIMATED', 'QuantityEstimated', 'DECIMAL', false, 10, null);
		$this->addColumn('QUANTITY_APPROVED', 'QuantityApproved', 'DECIMAL', false, 10, null);
		$this->addColumn('QUANTITY_FINAL', 'QuantityFinal', 'DECIMAL', false, 10, null);
		$this->addColumn('STANDARD_COST', 'StandardCost', 'DECIMAL', false, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Schoolproject', 'Schoolproject', RelationMap::MANY_TO_ONE, array('schoolproject_id' => 'id', ), null, null);
    $this->addRelation('ProjResourceType', 'ProjResourceType', RelationMap::MANY_TO_ONE, array('proj_resource_type_id' => 'id', ), null, null);
    $this->addRelation('ProjActivity', 'ProjActivity', RelationMap::ONE_TO_MANY, array('id' => 'proj_resource_id', ), null, null);
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

} // ProjResourceTableMap
