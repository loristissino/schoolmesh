<?php


/**
 * This class defines the structure of the 'term' table.
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
class TermTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TermTableMap';

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
		$this->setName('term');
		$this->setPhpName('Term');
		$this->setClassname('Term');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 10, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 100, null);
		$this->addColumn('END_DAY', 'EndDay', 'INTEGER', true, null, null);
		$this->addColumn('HAS_FORMAL_EVALUATION', 'HasFormalEvaluation', 'BOOLEAN', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('StudentSituation', 'StudentSituation', RelationMap::ONE_TO_MANY, array('id' => 'term_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('StudentSuggestion', 'StudentSuggestion', RelationMap::ONE_TO_MANY, array('id' => 'term_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('StudentHint', 'StudentHint', RelationMap::ONE_TO_MANY, array('id' => 'term_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('StudentSyllabusItem', 'StudentSyllabusItem', RelationMap::ONE_TO_MANY, array('id' => 'term_id', ), 'RESTRICT', 'CASCADE');
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

} // TermTableMap
