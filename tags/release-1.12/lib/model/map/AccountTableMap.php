<?php


/**
 * This class defines the structure of the 'account' table.
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
class AccountTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AccountTableMap';

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
		$this->setName('account');
		$this->setPhpName('Account');
		$this->setClassname('Account');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('ACCOUNT_TYPE_ID', 'AccountTypeId', 'INTEGER', 'account_type', 'ID', true, null, null);
		$this->addColumn('INFO', 'Info', 'LONGVARCHAR', false, null, null);
		$this->addColumn('SETTINGS', 'Settings', 'LONGVARCHAR', false, null, null);
		$this->addColumn('EXISTS', 'Exists', 'BOOLEAN', false, null, null);
		$this->addColumn('IS_LOCKED', 'IsLocked', 'BOOLEAN', false, null, null);
		$this->addColumn('TEMPORARY_PASSWORD', 'TemporaryPassword', 'VARCHAR', false, 10, null);
		$this->addColumn('INFO_UPDATED_AT', 'InfoUpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('LAST_KNOWN_LOGIN_AT', 'LastKnownLoginAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('QUOTA_PERCENTAGE', 'QuotaPercentage', 'INTEGER', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('AccountType', 'AccountType', RelationMap::MANY_TO_ONE, array('account_type_id' => 'id', ), 'RESTRICT', null);
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
			'symfony_timestampable' => array('update_column' => 'updated_at', 'create_column' => 'created_at', ),
		);
	} // getBehaviors()

} // AccountTableMap
