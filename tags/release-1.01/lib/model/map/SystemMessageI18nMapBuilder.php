<?php



class SystemMessageI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SystemMessageI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SystemMessageI18nPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SystemMessageI18nPeer::TABLE_NAME);
		$tMap->setPhpName('SystemMessageI18n');
		$tMap->setClassname('SystemMessageI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CONTENT', 'Content', 'VARCHAR', false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'system_message', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'VARCHAR', true, 7);

	} 
} 