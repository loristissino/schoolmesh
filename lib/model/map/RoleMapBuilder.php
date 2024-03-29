<?php



class RoleMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RoleMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RolePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RolePeer::TABLE_NAME);
		$tMap->setPhpName('Role');
		$tMap->setClassname('Role');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('MALE_DESCRIPTION', 'MaleDescription', 'VARCHAR', false, 100);

		$tMap->addColumn('FEMALE_DESCRIPTION', 'FemaleDescription', 'VARCHAR', false, 100);

		$tMap->addColumn('QUALITY_CODE', 'QualityCode', 'VARCHAR', false, 10);

		$tMap->addColumn('POSIX_NAME', 'PosixName', 'VARCHAR', false, 20);

		$tMap->addColumn('MAY_BE_MAIN_ROLE', 'MayBeMainRole', 'BOOLEAN', false, null);

		$tMap->addColumn('DEFAULT_GUARDGROUP', 'DefaultGuardgroup', 'VARCHAR', false, 20);

	} 
} 