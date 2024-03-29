<?php


/**
 * This class defines the structure of the 'role' table.
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
class RoleTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RoleTableMap';

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
		$this->setName('role');
		$this->setPhpName('Role');
		$this->setClassname('Role');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('MALE_DESCRIPTION', 'MaleDescription', 'VARCHAR', false, 100, null);
		$this->addColumn('FEMALE_DESCRIPTION', 'FemaleDescription', 'VARCHAR', false, 100, null);
		$this->addColumn('QUALITY_CODE', 'QualityCode', 'VARCHAR', false, 10, null);
		$this->addColumn('POSIX_NAME', 'PosixName', 'VARCHAR', false, 20, null);
		$this->addColumn('MAY_BE_MAIN_ROLE', 'MayBeMainRole', 'BOOLEAN', false, null, null);
		$this->addColumn('NEEDS_CHARGE_LETTER', 'NeedsChargeLetter', 'BOOLEAN', false, null, null);
		$this->addColumn('IS_KEY', 'IsKey', 'BOOLEAN', false, null, false);
		$this->addColumn('DEFAULT_GUARDGROUP', 'DefaultGuardgroup', 'VARCHAR', false, 20, null);
		$this->addColumn('MIN', 'Min', 'INTEGER', false, null, 0);
		$this->addColumn('MAX', 'Max', 'INTEGER', false, null, 0);
		$this->addColumn('FORFAIT_RETRIBUTION', 'ForfaitRetribution', 'DECIMAL', false, 10, null);
		$this->addColumn('CHARGE_NOTES', 'ChargeNotes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CONFIRMATION_NOTES', 'ConfirmationNotes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CHARGE_HAVINGREGARDTO', 'ChargeHavingregardto', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CONFIRMATION_HAVINGREGARDTO', 'ConfirmationHavingregardto', 'LONGVARCHAR', false, null, null);
		$this->addColumn('RANK', 'Rank', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUserProfile', 'sfGuardUserProfile', RelationMap::ONE_TO_MANY, array('id' => 'role_id', ), null, null);
    $this->addRelation('UserTeam', 'UserTeam', RelationMap::ONE_TO_MANY, array('id' => 'role_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('ProjResourceType', 'ProjResourceType', RelationMap::ONE_TO_MANY, array('id' => 'role_id', ), null, null);
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

} // RoleTableMap
