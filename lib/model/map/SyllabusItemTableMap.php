<?php


/**
 * This class defines the structure of the 'syllabus_item' table.
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
class SyllabusItemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SyllabusItemTableMap';

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
		$this->setName('syllabus_item');
		$this->setPhpName('SyllabusItem');
		$this->setClassname('SyllabusItem');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignKey('SYLLABUS_ID', 'SyllabusId', 'INTEGER', 'syllabus', 'ID', false, null, null);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('REF', 'Ref', 'VARCHAR', false, 20, null);
		$this->addColumn('LEVEL', 'Level', 'INTEGER', false, null, null);
		$this->addForeignKey('PARENT_ID', 'ParentId', 'INTEGER', 'syllabus_item', 'ID', false, null, null);
		$this->addColumn('CONTENT', 'Content', 'VARCHAR', false, 255, null);
		$this->addColumn('IS_SELECTABLE', 'IsSelectable', 'BOOLEAN', false, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Syllabus', 'Syllabus', RelationMap::MANY_TO_ONE, array('syllabus_id' => 'id', ), null, null);
    $this->addRelation('SyllabusItemRelatedByParentId', 'SyllabusItem', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('SyllabusItemRelatedByParentId', 'SyllabusItem', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('WpmoduleSyllabusItem', 'WpmoduleSyllabusItem', RelationMap::ONE_TO_MANY, array('id' => 'syllabus_item_id', ), null, null);
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

} // SyllabusItemTableMap
