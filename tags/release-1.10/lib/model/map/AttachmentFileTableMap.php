<?php


/**
 * This class defines the structure of the 'attachment_file' table.
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
class AttachmentFileTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AttachmentFileTableMap';

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
		$this->setName('attachment_file');
		$this->setPhpName('AttachmentFile');
		$this->setClassname('AttachmentFile');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addColumn('BASE_TABLE', 'BaseTable', 'INTEGER', false, null, null);
		$this->addColumn('BASE_ID', 'BaseId', 'INTEGER', false, null, null);
		$this->addColumn('INTERNET_MEDIA_TYPE', 'InternetMediaType', 'VARCHAR', false, 255, null);
		$this->addColumn('ORIGINAL_FILE_NAME', 'OriginalFileName', 'VARCHAR', false, 255, null);
		$this->addColumn('UNIQID', 'Uniqid', 'VARCHAR', true, 50, null);
		$this->addColumn('FILE_SIZE', 'FileSize', 'BIGINT', false, null, null);
		$this->addColumn('IS_PUBLIC', 'IsPublic', 'BOOLEAN', false, null, false);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('MD5SUM', 'Md5sum', 'VARCHAR', false, 32, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'CASCADE');
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
			'symfony_timestampable' => array('create_column' => 'created_at', ),
		);
	} // getBehaviors()

} // AttachmentFileTableMap
