<?php


/**
 * This class defines the structure of the 'document' table.
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
class DocumentTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.DocumentTableMap';

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
		$this->setName('document');
		$this->setPhpName('Document');
		$this->setClassname('Document');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('DOCTYPE_ID', 'DoctypeId', 'INTEGER', 'doctype', 'ID', false, null, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', true, 40, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 255, null);
		$this->addColumn('IS_FORM', 'IsForm', 'BOOLEAN', false, null, false);
		$this->addForeignKey('DOCREVISION_ID', 'DocrevisionId', 'INTEGER', 'docrevision', 'ID', false, null, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, true);
		$this->addColumn('IS_DEPRECATED', 'IsDeprecated', 'BOOLEAN', false, null, false);
		$this->addColumn('NOTES', 'Notes', 'VARCHAR', false, 255, null);
		$this->addForeignKey('SYLLABUS_ITEM_ID', 'SyllabusItemId', 'INTEGER', 'syllabus_item', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Doctype', 'Doctype', RelationMap::MANY_TO_ONE, array('doctype_id' => 'id', ), null, null);
    $this->addRelation('Docrevision', 'Docrevision', RelationMap::MANY_TO_ONE, array('docrevision_id' => 'id', ), null, null);
    $this->addRelation('SyllabusItem', 'SyllabusItem', RelationMap::MANY_TO_ONE, array('syllabus_item_id' => 'id', ), null, null);
    $this->addRelation('Docrevision', 'Docrevision', RelationMap::ONE_TO_MANY, array('id' => 'document_id', ), 'RESTRICT', 'CASCADE');
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

} // DocumentTableMap
