<?php



class WpitemTypeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WpitemTypeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(WpitemTypePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WpitemTypePeer::TABLE_NAME);
		$tMap->setPhpName('WpitemType');
		$tMap->setClassname('WpitemType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 50);

		$tMap->addColumn('SINGULAR', 'Singular', 'VARCHAR', false, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 200);

		$tMap->addColumn('STYLE', 'Style', 'VARCHAR', false, 50);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', true, null);

		$tMap->addColumn('STATE', 'State', 'INTEGER', false, null);

		$tMap->addColumn('IS_REQUIRED', 'IsRequired', 'BOOLEAN', false, null);

		$tMap->addColumn('EVALUATION_MIN', 'EvaluationMin', 'INTEGER', false, null);

		$tMap->addColumn('EVALUATION_MAX', 'EvaluationMax', 'INTEGER', false, null);

		$tMap->addColumn('EVALUATION_MIN_DESCRIPTION', 'EvaluationMinDescription', 'VARCHAR', false, 50);

		$tMap->addColumn('EVALUATION_MAX_DESCRIPTION', 'EvaluationMaxDescription', 'VARCHAR', false, 50);

	} 
} 