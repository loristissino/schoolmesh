<?php


/**
 * This class defines the structure of the 'workstation' table.
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
class WorkstationTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WorkstationTableMap';

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
		$this->setName('workstation');
		$this->setPhpName('Workstation');
		$this->setClassname('Workstation');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 40, null);
		$this->addColumn('IP_CIDR', 'IpCidr', 'VARCHAR', true, 20, null);
		$this->addColumn('MAC_ADDRESS', 'MacAddress', 'VARCHAR', false, 17, null);
		$this->addColumn('IS_ENABLED', 'IsEnabled', 'BOOLEAN', false, null, false);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null, false);
		$this->addColumn('LOCATION_X', 'LocationX', 'FLOAT', false, null, null);
		$this->addColumn('LOCATION_Y', 'LocationY', 'FLOAT', false, null, null);
		$this->addForeignKey('SUBNET_ID', 'SubnetId', 'INTEGER', 'subnet', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Subnet', 'Subnet', RelationMap::MANY_TO_ONE, array('subnet_id' => 'id', ), null, null);
    $this->addRelation('Lanlog', 'Lanlog', RelationMap::ONE_TO_MANY, array('id' => 'workstation_id', ), 'RESTRICT', 'CASCADE');
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

} // WorkstationTableMap
