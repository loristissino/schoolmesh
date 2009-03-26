<?php



class WpmoduleItemMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpmoduleItemMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpmoduleItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpmoduleItemPeer::TABLE_NAME);
		$tMap->setPhpName('WpmoduleItem');
		$tMap->setClassname('WpmoduleItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('WPITEM_GROUP_ID', 'WpitemGroupId', 'INTEGER', 'wpitem_group', 'ID', true, null);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', true, null);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', false, null);

		$tMap->addColumn('EVALUATION', 'Evaluation', 'INTEGER', false, null);

	} 
} 