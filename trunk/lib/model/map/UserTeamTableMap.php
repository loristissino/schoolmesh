<?php


/**
 * This class defines the structure of the 'user_team' table.
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
class UserTeamTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserTeamTableMap';

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
		$this->setName('user_team');
		$this->setPhpName('UserTeam');
		$this->setClassname('UserTeam');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('TEAM_ID', 'TeamId', 'INTEGER', 'team', 'ID', true, null, null);
		$this->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'role', 'ID', true, null, null);
		$this->addColumn('EXPIRY', 'Expiry', 'DATE', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Team', 'Team', RelationMap::MANY_TO_ONE, array('team_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('Role', 'Role', RelationMap::MANY_TO_ONE, array('role_id' => 'id', ), 'RESTRICT', 'CASCADE');
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

} // UserTeamTableMap
