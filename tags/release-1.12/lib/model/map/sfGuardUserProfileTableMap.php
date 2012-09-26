<?php


/**
 * This class defines the structure of the 'sf_guard_user_profile' table.
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
class sfGuardUserProfileTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileTableMap';

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
		$this->setName('sf_guard_user_profile');
		$this->setPhpName('sfGuardUserProfile');
		$this->setClassname('sfGuardUserProfile');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'sf_guard_user', 'ID', true, null, null);
		$this->addColumn('LETTERTITLE', 'Lettertitle', 'VARCHAR', false, 10, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 50, null);
		$this->addColumn('MIDDLE_NAME', 'MiddleName', 'VARCHAR', false, 50, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 50, null);
		$this->addColumn('PRONUNCIATION', 'Pronunciation', 'VARCHAR', false, 100, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 100, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 100, null);
		$this->addColumn('INFO', 'Info', 'LONGVARCHAR', false, null, null);
		$this->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'role', 'ID', false, null, null);
		$this->addColumn('GENDER', 'Gender', 'VARCHAR', false, 1, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 50, null);
		$this->addColumn('EMAIL_STATE', 'EmailState', 'INTEGER', false, null, 0);
		$this->addColumn('EMAIL_VERIFICATION_CODE', 'EmailVerificationCode', 'VARCHAR', false, 40, null);
		$this->addColumn('MOBILE', 'Mobile', 'VARCHAR', false, 15, null);
		$this->addColumn('WEBSITE', 'Website', 'VARCHAR', false, 255, null);
		$this->addColumn('OFFICE', 'Office', 'VARCHAR', false, 255, null);
		$this->addColumn('PTN_NOTES', 'PtnNotes', 'VARCHAR', false, 255, null);
		$this->addColumn('BIRTHDATE', 'Birthdate', 'DATE', false, null, null);
		$this->addColumn('BIRTHPLACE', 'Birthplace', 'VARCHAR', false, 50, null);
		$this->addColumn('IMPORT_CODE', 'ImportCode', 'VARCHAR', false, 20, null);
		$this->addColumn('SYSTEM_ALERTS', 'SystemAlerts', 'VARCHAR', false, 255, null);
		$this->addColumn('IS_SCHEDULED_FOR_DELETION', 'IsScheduledForDeletion', 'BOOLEAN', false, null, false);
		$this->addColumn('PREFERS_RICHTEXT', 'PrefersRichtext', 'BOOLEAN', false, null, true);
		$this->addColumn('PREFERRED_FORMAT', 'PreferredFormat', 'VARCHAR', false, 5, null);
		$this->addColumn('PREFERRED_CULTURE', 'PreferredCulture', 'VARCHAR', false, 7, null);
		$this->addColumn('LAST_ACTION_AT', 'LastActionAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('LAST_LOGIN_AT', 'LastLoginAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('PLAINTEXT_PASSWORD', 'PlaintextPassword', 'VARCHAR', false, 32, null);
		$this->addColumn('ENCRYPTED_PASSWORD', 'EncryptedPassword', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Role', 'Role', RelationMap::MANY_TO_ONE, array('role_id' => 'id', ), null, null);
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

} // sfGuardUserProfileTableMap
