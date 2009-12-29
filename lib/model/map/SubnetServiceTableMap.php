<?php


/**
 * This class defines the structure of the 'subnet_service' table.
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
class SubnetServiceTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SubnetServiceTableMap';

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
		$this->setName('subnet_service');
		$this->setPhpName('SubnetService');
		$this->setClassname('SubnetService');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('SUBNET_ID', 'SubnetId', 'INTEGER' , 'subnet', 'ID', true, null, null);
		$this->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'INTEGER' , 'service', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Subnet', 'Subnet', RelationMap::MANY_TO_ONE, array('subnet_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Service', 'Service', RelationMap::MANY_TO_ONE, array('service_id' => 'id', ), 'CASCADE', 'CASCADE');
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

} // SubnetServiceTableMap
