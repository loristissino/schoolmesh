<?php


/**
 * This class defines the structure of the 'wpmodule_syllabus_item' table.
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
class WpmoduleSyllabusItemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WpmoduleSyllabusItemTableMap';

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
		$this->setName('wpmodule_syllabus_item');
		$this->setPhpName('WpmoduleSyllabusItem');
		$this->setClassname('WpmoduleSyllabusItem');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('WPMODULE_ID', 'WpmoduleId', 'INTEGER', 'wpmodule', 'ID', false, null, null);
		$this->addForeignKey('SYLLABUS_ITEM_ID', 'SyllabusItemId', 'INTEGER', 'syllabus_item', 'ID', false, null, null);
		$this->addColumn('CONTRIBUTION', 'Contribution', 'INTEGER', false, null, null);
		$this->addColumn('EVALUATION', 'Evaluation', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Wpmodule', 'Wpmodule', RelationMap::MANY_TO_ONE, array('wpmodule_id' => 'id', ), null, null);
    $this->addRelation('SyllabusItem', 'SyllabusItem', RelationMap::MANY_TO_ONE, array('syllabus_item_id' => 'id', ), null, null);
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

} // WpmoduleSyllabusItemTableMap
