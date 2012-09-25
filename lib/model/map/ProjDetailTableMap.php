<?php


/**
 * This class defines the structure of the 'proj_detail' table.
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
class ProjDetailTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProjDetailTableMap';

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
		$this->setName('proj_detail');
		$this->setPhpName('ProjDetail');
		$this->setClassname('ProjDetail');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SCHOOLPROJECT_ID', 'SchoolprojectId', 'INTEGER', 'schoolproject', 'ID', false, null, null);
		$this->addForeignKey('PROJ_DETAIL_TYPE_ID', 'ProjDetailTypeId', 'INTEGER', 'proj_detail_type', 'ID', false, null, null);
		$this->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Schoolproject', 'Schoolproject', RelationMap::MANY_TO_ONE, array('schoolproject_id' => 'id', ), null, null);
    $this->addRelation('ProjDetailType', 'ProjDetailType', RelationMap::MANY_TO_ONE, array('proj_detail_type_id' => 'id', ), null, null);
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

} // ProjDetailTableMap
