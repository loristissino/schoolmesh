<?php

/**
 * Base static class for performing query and update operations on the 'wpitem_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWpitemTypePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'wpitem_type';

	/** the related Propel class for this table */
	const OM_CLASS = 'WpitemType';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.WpitemType';

	/** the related TableMap class for this table */
	const TM_CLASS = 'WpitemTypeTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'wpitem_type.ID';

	/** the column name for the TITLE field */
	const TITLE = 'wpitem_type.TITLE';

	/** the column name for the SINGULAR field */
	const SINGULAR = 'wpitem_type.SINGULAR';

	/** the column name for the DESCRIPTION field */
	const DESCRIPTION = 'wpitem_type.DESCRIPTION';

	/** the column name for the STYLE field */
	const STYLE = 'wpitem_type.STYLE';

	/** the column name for the RANK field */
	const RANK = 'wpitem_type.RANK';

	/** the column name for the STATE_MIN field */
	const STATE_MIN = 'wpitem_type.STATE_MIN';

	/** the column name for the STATE_MAX field */
	const STATE_MAX = 'wpitem_type.STATE_MAX';

	/** the column name for the IS_REQUIRED field */
	const IS_REQUIRED = 'wpitem_type.IS_REQUIRED';

	/** the column name for the APPOINTMENT_TYPE_ID field */
	const APPOINTMENT_TYPE_ID = 'wpitem_type.APPOINTMENT_TYPE_ID';

	/** the column name for the CODE field */
	const CODE = 'wpitem_type.CODE';

	/** the column name for the EVALUATION_MIN field */
	const EVALUATION_MIN = 'wpitem_type.EVALUATION_MIN';

	/** the column name for the EVALUATION_MAX field */
	const EVALUATION_MAX = 'wpitem_type.EVALUATION_MAX';

	/** the column name for the EVALUATION_MIN_DESCRIPTION field */
	const EVALUATION_MIN_DESCRIPTION = 'wpitem_type.EVALUATION_MIN_DESCRIPTION';

	/** the column name for the EVALUATION_MAX_DESCRIPTION field */
	const EVALUATION_MAX_DESCRIPTION = 'wpitem_type.EVALUATION_MAX_DESCRIPTION';

	/** the column name for the GRADE_MIN field */
	const GRADE_MIN = 'wpitem_type.GRADE_MIN';

	/** the column name for the GRADE_MAX field */
	const GRADE_MAX = 'wpitem_type.GRADE_MAX';

	/**
	 * An identiy map to hold any loaded instances of WpitemType objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array WpitemType[]
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
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Singular', 'Description', 'Style', 'Rank', 'StateMin', 'StateMax', 'IsRequired', 'AppointmentTypeId', 'Code', 'EvaluationMin', 'EvaluationMax', 'EvaluationMinDescription', 'EvaluationMaxDescription', 'GradeMin', 'GradeMax', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'singular', 'description', 'style', 'rank', 'stateMin', 'stateMax', 'isRequired', 'appointmentTypeId', 'code', 'evaluationMin', 'evaluationMax', 'evaluationMinDescription', 'evaluationMaxDescription', 'gradeMin', 'gradeMax', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::TITLE, self::SINGULAR, self::DESCRIPTION, self::STYLE, self::RANK, self::STATE_MIN, self::STATE_MAX, self::IS_REQUIRED, self::APPOINTMENT_TYPE_ID, self::CODE, self::EVALUATION_MIN, self::EVALUATION_MAX, self::EVALUATION_MIN_DESCRIPTION, self::EVALUATION_MAX_DESCRIPTION, self::GRADE_MIN, self::GRADE_MAX, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'singular', 'description', 'style', 'rank', 'state_min', 'state_max', 'is_required', 'appointment_type_id', 'code', 'evaluation_min', 'evaluation_max', 'evaluation_min_description', 'evaluation_max_description', 'grade_min', 'grade_max', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Singular' => 2, 'Description' => 3, 'Style' => 4, 'Rank' => 5, 'StateMin' => 6, 'StateMax' => 7, 'IsRequired' => 8, 'AppointmentTypeId' => 9, 'Code' => 10, 'EvaluationMin' => 11, 'EvaluationMax' => 12, 'EvaluationMinDescription' => 13, 'EvaluationMaxDescription' => 14, 'GradeMin' => 15, 'GradeMax' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'singular' => 2, 'description' => 3, 'style' => 4, 'rank' => 5, 'stateMin' => 6, 'stateMax' => 7, 'isRequired' => 8, 'appointmentTypeId' => 9, 'code' => 10, 'evaluationMin' => 11, 'evaluationMax' => 12, 'evaluationMinDescription' => 13, 'evaluationMaxDescription' => 14, 'gradeMin' => 15, 'gradeMax' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::TITLE => 1, self::SINGULAR => 2, self::DESCRIPTION => 3, self::STYLE => 4, self::RANK => 5, self::STATE_MIN => 6, self::STATE_MAX => 7, self::IS_REQUIRED => 8, self::APPOINTMENT_TYPE_ID => 9, self::CODE => 10, self::EVALUATION_MIN => 11, self::EVALUATION_MAX => 12, self::EVALUATION_MIN_DESCRIPTION => 13, self::EVALUATION_MAX_DESCRIPTION => 14, self::GRADE_MIN => 15, self::GRADE_MAX => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'singular' => 2, 'description' => 3, 'style' => 4, 'rank' => 5, 'state_min' => 6, 'state_max' => 7, 'is_required' => 8, 'appointment_type_id' => 9, 'code' => 10, 'evaluation_min' => 11, 'evaluation_max' => 12, 'evaluation_min_description' => 13, 'evaluation_max_description' => 14, 'grade_min' => 15, 'grade_max' => 16, ),
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
	 * @param      string $column The column name for current table. (i.e. WpitemTypePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(WpitemTypePeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(WpitemTypePeer::ID);
		$criteria->addSelectColumn(WpitemTypePeer::TITLE);
		$criteria->addSelectColumn(WpitemTypePeer::SINGULAR);
		$criteria->addSelectColumn(WpitemTypePeer::DESCRIPTION);
		$criteria->addSelectColumn(WpitemTypePeer::STYLE);
		$criteria->addSelectColumn(WpitemTypePeer::RANK);
		$criteria->addSelectColumn(WpitemTypePeer::STATE_MIN);
		$criteria->addSelectColumn(WpitemTypePeer::STATE_MAX);
		$criteria->addSelectColumn(WpitemTypePeer::IS_REQUIRED);
		$criteria->addSelectColumn(WpitemTypePeer::APPOINTMENT_TYPE_ID);
		$criteria->addSelectColumn(WpitemTypePeer::CODE);
		$criteria->addSelectColumn(WpitemTypePeer::EVALUATION_MIN);
		$criteria->addSelectColumn(WpitemTypePeer::EVALUATION_MAX);
		$criteria->addSelectColumn(WpitemTypePeer::EVALUATION_MIN_DESCRIPTION);
		$criteria->addSelectColumn(WpitemTypePeer::EVALUATION_MAX_DESCRIPTION);
		$criteria->addSelectColumn(WpitemTypePeer::GRADE_MIN);
		$criteria->addSelectColumn(WpitemTypePeer::GRADE_MAX);
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
		$criteria->setPrimaryTableName(WpitemTypePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpitemTypePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     WpitemType
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = WpitemTypePeer::doSelect($critcopy, $con);
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
		return WpitemTypePeer::populateObjects(WpitemTypePeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			WpitemTypePeer::addSelectColumns($criteria);
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
	 * @param      WpitemType $value A WpitemType object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(WpitemType $obj, $key = null)
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
	 * @param      mixed $value A WpitemType object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof WpitemType) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or WpitemType object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     WpitemType Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to wpitem_type
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
		$cls = WpitemTypePeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = WpitemTypePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = WpitemTypePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				WpitemTypePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related AppointmentType table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAppointmentType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(WpitemTypePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpitemTypePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(WpitemTypePeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Selects a collection of WpitemType objects pre-filled with their AppointmentType objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of WpitemType objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAppointmentType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		WpitemTypePeer::addSelectColumns($criteria);
		$startcol = (WpitemTypePeer::NUM_COLUMNS - WpitemTypePeer::NUM_LAZY_LOAD_COLUMNS);
		AppointmentTypePeer::addSelectColumns($criteria);

		$criteria->addJoin(WpitemTypePeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpitemTypePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpitemTypePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = WpitemTypePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpitemTypePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AppointmentTypePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = AppointmentTypePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AppointmentTypePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (WpitemType) to $obj2 (AppointmentType)
				$obj2->addWpitemType($obj1);

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
		$criteria->setPrimaryTableName(WpitemTypePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpitemTypePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(WpitemTypePeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Selects a collection of WpitemType objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of WpitemType objects.
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

		WpitemTypePeer::addSelectColumns($criteria);
		$startcol2 = (WpitemTypePeer::NUM_COLUMNS - WpitemTypePeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(WpitemTypePeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpitemTypePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpitemTypePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = WpitemTypePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpitemTypePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined AppointmentType rows

			$key2 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = AppointmentTypePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = AppointmentTypePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppointmentTypePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (WpitemType) to the collection in $obj2 (AppointmentType)
				$obj2->addWpitemType($obj1);
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
	  $dbMap = Propel::getDatabaseMap(BaseWpitemTypePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseWpitemTypePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new WpitemTypeTableMap());
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
		return $withPrefix ? WpitemTypePeer::CLASS_DEFAULT : WpitemTypePeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a WpitemType or Criteria object.
	 *
	 * @param      mixed $values Criteria or WpitemType object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from WpitemType object
		}

		if ($criteria->containsKey(WpitemTypePeer::ID) && $criteria->keyContainsValue(WpitemTypePeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpitemTypePeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a WpitemType or Criteria object.
	 *
	 * @param      mixed $values Criteria or WpitemType object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(WpitemTypePeer::ID);
			$selectCriteria->add(WpitemTypePeer::ID, $criteria->remove(WpitemTypePeer::ID), $comparison);

		} else { // $values is WpitemType object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the wpitem_type table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(WpitemTypePeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			WpitemTypePeer::clearInstancePool();
			WpitemTypePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a WpitemType or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or WpitemType object or primary key or array of primary keys
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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			WpitemTypePeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof WpitemType) { // it's a model object
			// invalidate the cache for this single object
			WpitemTypePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WpitemTypePeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				WpitemTypePeer::removeInstanceFromPool($singleval);
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
			WpitemTypePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given WpitemType object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      WpitemType $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(WpitemType $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WpitemTypePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WpitemTypePeer::TABLE_NAME);

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

		return BasePeer::doValidate(WpitemTypePeer::DATABASE_NAME, WpitemTypePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     WpitemType
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = WpitemTypePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		$criteria->add(WpitemTypePeer::ID, $pk);

		$v = WpitemTypePeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
			$criteria->add(WpitemTypePeer::ID, $pks, Criteria::IN);
			$objs = WpitemTypePeer::doSelect($criteria, $con);
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
	  return array(array('appointment_type_id', 'code'));
	}

} // BaseWpitemTypePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseWpitemTypePeer::buildTableMap();

