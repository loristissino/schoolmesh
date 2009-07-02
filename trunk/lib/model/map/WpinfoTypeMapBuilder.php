<?php



class WpinfoTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpinfoTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpinfoTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpinfoTypePeer::TABLE_NAME);
		$tMap->setPhpName('WpinfoType');
		$tMap->setClassname('WpinfoType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 200);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', true, null);

		$tMap->addColumn('STATE', 'State', 'INTEGER', false, null);

		$tMap->addColumn('TEMPLATE', 'Template', 'LONGVARCHAR', false, null);

		$tMap->addColumn('EXAMPLE', 'Example', 'LONGVARCHAR', false, null);

		$tMap->addColumn('IS_REQUIRED', 'IsRequired', 'BOOLEAN', false, null);

	} 
} 