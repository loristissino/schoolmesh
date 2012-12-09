<?php

/**
 * Base static class for performing query and update operations on the 'proj_detail_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProjDetailTypePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'proj_detail_type';

	/** the related Propel class for this table */
	const OM_CLASS = 'ProjDetailType';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ProjDetailType';

	/** the related TableMap class for this table */
	const TM_CLASS = 'ProjDetailTypeTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'proj_detail_type.ID';

	/** the column name for the PROJ_CATEGORY_ID field */
	const PROJ_CATEGORY_ID = 'proj_detail_type.PROJ_CATEGORY_ID';

	/** the column name for the CODE field */
	const CODE = 'proj_detail_type.CODE';

	/** the column name for the DESCRIPTION field */
	const DESCRIPTION = 'proj_detail_type.DESCRIPTION';

	/** the column name for the LABEL field */
	const LABEL = 'proj_detail_type.LABEL';

	/** the column name for the IS_REQUIRED field */
	const IS_REQUIRED = 'proj_detail_type.IS_REQUIRED';

	/** the column name for the IS_ACTIVE field */
	const IS_ACTIVE = 'proj_detail_type.IS_ACTIVE';

	/** the column name for the STATE_MIN field */
	const STATE_MIN = 'proj_detail_type.STATE_MIN';

	/** the column name for the STATE_MAX field */
	const STATE_MAX = 'proj_detail_type.STATE_MAX';

	/** the column name for the PRINTED_IN_SUBMISSION_DOCUMENTS field */
	const PRINTED_IN_SUBMISSION_DOCUMENTS = 'proj_detail_type.PRINTED_IN_SUBMISSION_DOCUMENTS';

	/** the column name for the PRINTED_IN_REPORT_DOCUMENTS field */
	const PRINTED_IN_REPORT_DOCUMENTS = 'proj_detail_type.PRINTED_IN_REPORT_DOCUMENTS';

	/** the column name for the EXAMPLE field */
	const EXAMPLE = 'proj_detail_type.EXAMPLE';

	/** the column name for the MISSING_VALUE_MESSAGE field */
	const MISSING_VALUE_MESSAGE = 'proj_detail_type.MISSING_VALUE_MESSAGE';

	/** the column name for the FILLED_VALUE_MESSAGE field */
	const FILLED_VALUE_MESSAGE = 'proj_detail_type.FILLED_VALUE_MESSAGE';

	/** the column name for the COLS field */
	const COLS = 'proj_detail_type.COLS';

	/** the column name for the ROWS field */
	const ROWS = 'proj_detail_type.ROWS';

	/** the column name for the RANK field */
	const RANK = 'proj_detail_type.RANK';

	/**
	 * An identiy map to hold any loaded instances of ProjDetailType objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array ProjDetailType[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProjCategoryId', 'Code', 'Description', 'Label', 'IsRequired', 'IsActive', 'StateMin', 'StateMax', 'PrintedInSubmissionDocuments', 'PrintedInReportDocuments', 'Example', 'MissingValueMessage', 'FilledValueMessage', 'Cols', 'Rows', 'Rank', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'projCategoryId', 'code', 'description', 'label', 'isRequired', 'isActive', 'stateMin', 'stateMax', 'printedInSubmissionDocuments', 'printedInReportDocuments', 'example', 'missingValueMessage', 'filledValueMessage', 'cols', 'rows', 'rank', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::PROJ_CATEGORY_ID, self::CODE, self::DESCRIPTION, self::LABEL, self::IS_REQUIRED, self::IS_ACTIVE, self::STATE_MIN, self::STATE_MAX, self::PRINTED_IN_SUBMISSION_DOCUMENTS, self::PRINTED_IN_REPORT_DOCUMENTS, self::EXAMPLE, self::MISSING_VALUE_MESSAGE, self::FILLED_VALUE_MESSAGE, self::COLS, self::ROWS, self::RANK, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'proj_category_id', 'code', 'description', 'label', 'is_required', 'is_active', 'state_min', 'state_max', 'printed_in_submission_documents', 'printed_in_report_documents', 'example', 'missing_value_message', 'filled_value_message', 'cols', 'rows', 'rank', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProjCategoryId' => 1, 'Code' => 2, 'Description' => 3, 'Label' => 4, 'IsRequired' => 5, 'IsActive' => 6, 'StateMin' => 7, 'StateMax' => 8, 'PrintedInSubmissionDocuments' => 9, 'PrintedInReportDocuments' => 10, 'Example' => 11, 'MissingValueMessage' => 12, 'FilledValueMessage' => 13, 'Cols' => 14, 'Rows' => 15, 'Rank' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'projCategoryId' => 1, 'code' => 2, 'description' => 3, 'label' => 4, 'isRequired' => 5, 'isActive' => 6, 'stateMin' => 7, 'stateMax' => 8, 'printedInSubmissionDocuments' => 9, 'printedInReportDocuments' => 10, 'example' => 11, 'missingValueMessage' => 12, 'filledValueMessage' => 13, 'cols' => 14, 'rows' => 15, 'rank' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PROJ_CATEGORY_ID => 1, self::CODE => 2, self::DESCRIPTION => 3, self::LABEL => 4, self::IS_REQUIRED => 5, self::IS_ACTIVE => 6, self::STATE_MIN => 7, self::STATE_MAX => 8, self::PRINTED_IN_SUBMISSION_DOCUMENTS => 9, self::PRINTED_IN_REPORT_DOCUMENTS => 10, self::EXAMPLE => 11, self::MISSING_VALUE_MESSAGE => 12, self::FILLED_VALUE_MESSAGE => 13, self::COLS => 14, self::ROWS => 15, self::RANK => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'proj_category_id' => 1, 'code' => 2, 'description' => 3, 'label' => 4, 'is_required' => 5, 'is_active' => 6, 'state_min' => 7, 'state_max' => 8, 'printed_in_submission_documents' => 9, 'printed_in_report_documents' => 10, 'example' => 11, 'missing_value_message' => 12, 'filled_value_message' => 13, 'cols' => 14, 'rows' => 15, 'rank' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. ProjDetailTypePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ProjDetailTypePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(ProjDetailTypePeer::ID);
		$criteria->addSelectColumn(ProjDetailTypePeer::PROJ_CATEGORY_ID);
		$criteria->addSelectColumn(ProjDetailTypePeer::CODE);
		$criteria->addSelectColumn(ProjDetailTypePeer::DESCRIPTION);
		$criteria->addSelectColumn(ProjDetailTypePeer::LABEL);
		$criteria->addSelectColumn(ProjDetailTypePeer::IS_REQUIRED);
		$criteria->addSelectColumn(ProjDetailTypePeer::IS_ACTIVE);
		$criteria->addSelectColumn(ProjDetailTypePeer::STATE_MIN);
		$criteria->addSelectColumn(ProjDetailTypePeer::STATE_MAX);
		$criteria->addSelectColumn(ProjDetailTypePeer::PRINTED_IN_SUBMISSION_DOCUMENTS);
		$criteria->addSelectColumn(ProjDetailTypePeer::PRINTED_IN_REPORT_DOCUMENTS);
		$criteria->addSelectColumn(ProjDetailTypePeer::EXAMPLE);
		$criteria->addSelectColumn(ProjDetailTypePeer::MISSING_VALUE_MESSAGE);
		$criteria->addSelectColumn(ProjDetailTypePeer::FILLED_VALUE_MESSAGE);
		$criteria->addSelectColumn(ProjDetailTypePeer::COLS);
		$criteria->addSelectColumn(ProjDetailTypePeer::ROWS);
		$criteria->addSelectColumn(ProjDetailTypePeer::RANK);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ProjDetailTypePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ProjDetailTypePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     ProjDetailType
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ProjDetailTypePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ProjDetailTypePeer::populateObjects(ProjDetailTypePeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ProjDetailTypePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      ProjDetailType $value A ProjDetailType object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(ProjDetailType $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A ProjDetailType object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ProjDetailType) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ProjDetailType object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     ProjDetailType Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to proj_detail_type
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ProjDetailTypePeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ProjDetailTypePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ProjDetailTypePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ProjDetailTypePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related ProjCategory table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinProjCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ProjDetailTypePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ProjDetailTypePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ProjDetailTypePeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of ProjDetailType objects pre-filled with their ProjCategory objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ProjDetailType objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProjCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ProjDetailTypePeer::addSelectColumns($criteria);
		$startcol = (ProjDetailTypePeer::NUM_COLUMNS - ProjDetailTypePeer::NUM_LAZY_LOAD_COLUMNS);
		ProjCategoryPeer::addSelectColumns($criteria);

		$criteria->addJoin(ProjDetailTypePeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ProjDetailTypePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ProjDetailTypePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = ProjDetailTypePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ProjDetailTypePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ProjCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ProjCategoryPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ProjCategoryPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ProjCategoryPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (ProjDetailType) to $obj2 (ProjCategory)
				$obj2->addProjDetailType($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ProjDetailTypePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ProjDetailTypePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ProjDetailTypePeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of ProjDetailType objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ProjDetailType objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ProjDetailTypePeer::addSelectColumns($criteria);
		$startcol2 = (ProjDetailTypePeer::NUM_COLUMNS - ProjDetailTypePeer::NUM_LAZY_LOAD_COLUMNS);

		ProjCategoryPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (ProjCategoryPeer::NUM_COLUMNS - ProjCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(ProjDetailTypePeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ProjDetailTypePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ProjDetailTypePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = ProjDetailTypePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ProjDetailTypePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined ProjCategory rows

			$key2 = ProjCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ProjCategoryPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ProjCategoryPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ProjCategoryPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (ProjDetailType) to the collection in $obj2 (ProjCategory)
				$obj2->addProjDetailType($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseProjDetailTypePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseProjDetailTypePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new ProjDetailTypeTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? ProjDetailTypePeer::CLASS_DEFAULT : ProjDetailTypePeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a ProjDetailType or Criteria object.
	 *
	 * @param      mixed $values Criteria or ProjDetailType object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ProjDetailType object
		}

		if ($criteria->containsKey(ProjDetailTypePeer::ID) && $criteria->keyContainsValue(ProjDetailTypePeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProjDetailTypePeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ProjDetailType or Criteria object.
	 *
	 * @param      mixed $values Criteria or ProjDetailType object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ProjDetailTypePeer::ID);
			$selectCriteria->add(ProjDetailTypePeer::ID, $criteria->remove(ProjDetailTypePeer::ID), $comparison);

		} else { // $values is ProjDetailType object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the proj_detail_type table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ProjDetailTypePeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			ProjDetailTypePeer::clearInstancePool();
			ProjDetailTypePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ProjDetailType or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ProjDetailType object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			ProjDetailTypePeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof ProjDetailType) { // it's a model object
			// invalidate the cache for this single object
			ProjDetailTypePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProjDetailTypePeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				ProjDetailTypePeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			ProjDetailTypePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given ProjDetailType object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ProjDetailType $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(ProjDetailType $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProjDetailTypePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProjDetailTypePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(ProjDetailTypePeer::DATABASE_NAME, ProjDetailTypePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     ProjDetailType
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ProjDetailTypePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);
		$criteria->add(ProjDetailTypePeer::ID, $pk);

		$v = ProjDetailTypePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);
			$criteria->add(ProjDetailTypePeer::ID, $pks, Criteria::IN);
			$objs = ProjDetailTypePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array(array('code'));
	}

} // BaseProjDetailTypePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseProjDetailTypePeer::buildTableMap();

