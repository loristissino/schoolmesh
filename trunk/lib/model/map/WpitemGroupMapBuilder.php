<?php



class WpitemGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpitemGroupMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(WpitemGroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpitemGroupPeer::TABLE_NAME);
		$tMap->setPhpName('WpitemGroup');
		$tMap->setClassname('WpitemGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('WPITEM_TYPE_ID', 'WpitemTypeId', 'INTEGER', 'wpitem_type', 'ID', false, null);

		$tMap->addForeignKey('WPMODULE_ID', 'WpmoduleId', 'INTEGER', 'wpmodule', 'ID', false, null);

	} 
} 