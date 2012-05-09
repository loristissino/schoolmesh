<?php


/**
 * This class defines the structure of the 'wpmodule_item' table.
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
class WpmoduleItemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WpmoduleItemTableMap';

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
		$this->setName('wpmodule_item');
		$this->setPhpName('WpmoduleItem');
		$this->setClassname('WpmoduleItem');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('WPITEM_GROUP_ID', 'WpitemGroupId', 'INTEGER', 'wpitem_group', 'ID', true, null, null);
		$this->addColumn('RANK', 'Rank', 'INTEGER', true, null, null);
		$this->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null, null);
		$this->addColumn('EVALUATION', 'Evaluation', 'INTEGER', false, null, null);
		$this->addColumn('IS_EDITABLE', 'IsEditable', 'BOOLEAN', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('WpitemGroup', 'WpitemGroup', RelationMap::MANY_TO_ONE, array('wpitem_group_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('StudentSituation', 'StudentSituation', RelationMap::ONE_TO_MANY, array('id' => 'wpmodule_item_id', ), 'CASCADE', 'CASCADE');
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

} // WpmoduleItemTableMap
