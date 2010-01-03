<?php

/**
 * Base static class for performing query and update operations on the 'student_suggestion' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseStudentSuggestionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'student_suggestion';

	/** the related Propel class for this table */
	const OM_CLASS = 'StudentSuggestion';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.StudentSuggestion';

	/** the related TableMap class for this table */
	const TM_CLASS = 'StudentSuggestionTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 5;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'student_suggestion.ID';

	/** the column name for the TERM_ID field */
	const TERM_ID = 'student_suggestion.TERM_ID';

	/** the column name for the APPOINTMENT_ID field */
	const APPOINTMENT_ID = 'student_suggestion.APPOINTMENT_ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'student_suggestion.USER_ID';

	/** the column name for the SUGGESTION_ID field */
	const SUGGESTION_ID = 'student_suggestion.SUGGESTION_ID';

	/**
	 * An identiy map to hold any loaded instances of StudentSuggestion objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array StudentSuggestion[]
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
		BasePeer::TYPE_PHPNAME => array ('Id', 'TermId', 'AppointmentId', 'UserId', 'SuggestionId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'termId', 'appointmentId', 'userId', 'suggestionId', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::TERM_ID, self::APPOINTMENT_ID, self::USER_ID, self::SUGGESTION_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'term_id', 'appointment_id', 'user_id', 'suggestion_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TermId' => 1, 'AppointmentId' => 2, 'UserId' => 3, 'SuggestionId' => 4, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'termId' => 1, 'appointmentId' => 2, 'userId' => 3, 'suggestionId' => 4, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::TERM_ID => 1, self::APPOINTMENT_ID => 2, self::USER_ID => 3, self::SUGGESTION_ID => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'term_id' => 1, 'appointment_id' => 2, 'user_id' => 3, 'suggestion_id' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
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
	 * @param      string $column The column name for current table. (i.e. StudentSuggestionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(StudentSuggestionPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(StudentSuggestionPeer::ID);
		$criteria->addSelectColumn(StudentSuggestionPeer::TERM_ID);
		$criteria->addSelectColumn(StudentSuggestionPeer::APPOINTMENT_ID);
		$criteria->addSelectColumn(StudentSuggestionPeer::USER_ID);
		$criteria->addSelectColumn(StudentSuggestionPeer::SUGGESTION_ID);
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
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     StudentSuggestion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = StudentSuggestionPeer::doSelect($critcopy, $con);
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
		return StudentSuggestionPeer::populateObjects(StudentSuggestionPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			StudentSuggestionPeer::addSelectColumns($criteria);
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
	 * @param      StudentSuggestion $value A StudentSuggestion object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(StudentSuggestion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getId(), (string) $obj->getAppointmentId()));
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
	 * @param      mixed $value A StudentSuggestion object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof StudentSuggestion) {
				$key = serialize(array((string) $value->getId(), (string) $value->getAppointmentId()));
			} elseif (is_array($value) && count($value) === 2) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or StudentSuggestion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     StudentSuggestion Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to student_suggestion
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
		if ($row[$startcol] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol], (string) $row[$startcol + 2]));
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
		$cls = StudentSuggestionPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = StudentSuggestionPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				StudentSuggestionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Term table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTerm(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Appointment table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAppointment(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUser table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Suggestion table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinSuggestion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

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
	 * Selects a collection of StudentSuggestion objects pre-filled with their Term objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTerm(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);
		TermPeer::addSelectColumns($criteria);

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TermPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TermPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TermPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TermPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to $obj2 (Term)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of StudentSuggestion objects pre-filled with their Appointment objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAppointment(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);
		AppointmentPeer::addSelectColumns($criteria);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AppointmentPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = AppointmentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AppointmentPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to $obj2 (Appointment)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of StudentSuggestion objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfGuardUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to $obj2 (sfGuardUser)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of StudentSuggestion objects pre-filled with their Suggestion objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSuggestion(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);
		SuggestionPeer::addSelectColumns($criteria);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = SuggestionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SuggestionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = SuggestionPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SuggestionPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to $obj2 (Suggestion)
				$obj2->addStudentSuggestion($obj1);

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
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

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
	 * Selects a collection of StudentSuggestion objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
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

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol2 = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		TermPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SuggestionPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (SuggestionPeer::NUM_COLUMNS - SuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Term rows

			$key2 = TermPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TermPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TermPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TermPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj2 (Term)
				$obj2->addStudentSuggestion($obj1);
			} // if joined row not null

			// Add objects for joined Appointment rows

			$key3 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = AppointmentPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = AppointmentPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AppointmentPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj3 (Appointment)
				$obj3->addStudentSuggestion($obj1);
			} // if joined row not null

			// Add objects for joined sfGuardUser rows

			$key4 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = sfGuardUserPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$cls = sfGuardUserPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					sfGuardUserPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj4 (sfGuardUser)
				$obj4->addStudentSuggestion($obj1);
			} // if joined row not null

			// Add objects for joined Suggestion rows

			$key5 = SuggestionPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = SuggestionPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$cls = SuggestionPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					SuggestionPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj5 (Suggestion)
				$obj5->addStudentSuggestion($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Term table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTerm(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Appointment table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAppointment(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUser table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Suggestion table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSuggestion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StudentSuggestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StudentSuggestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Selects a collection of StudentSuggestion objects pre-filled with all related objects except Term.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTerm(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol2 = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SuggestionPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SuggestionPeer::NUM_COLUMNS - SuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Appointment rows

				$key2 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AppointmentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = AppointmentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppointmentPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj2 (Appointment)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj3 (sfGuardUser)
				$obj3->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined Suggestion rows

				$key4 = SuggestionPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SuggestionPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SuggestionPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SuggestionPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj4 (Suggestion)
				$obj4->addStudentSuggestion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of StudentSuggestion objects pre-filled with all related objects except Appointment.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAppointment(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol2 = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		TermPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SuggestionPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SuggestionPeer::NUM_COLUMNS - SuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Term rows

				$key2 = TermPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TermPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = TermPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TermPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj2 (Term)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj3 (sfGuardUser)
				$obj3->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined Suggestion rows

				$key4 = SuggestionPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SuggestionPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SuggestionPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SuggestionPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj4 (Suggestion)
				$obj4->addStudentSuggestion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of StudentSuggestion objects pre-filled with all related objects except sfGuardUser.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfGuardUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol2 = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		TermPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		SuggestionPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SuggestionPeer::NUM_COLUMNS - SuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::SUGGESTION_ID, SuggestionPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Term rows

				$key2 = TermPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TermPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = TermPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TermPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj2 (Term)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined Appointment rows

				$key3 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = AppointmentPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = AppointmentPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AppointmentPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj3 (Appointment)
				$obj3->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined Suggestion rows

				$key4 = SuggestionPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SuggestionPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SuggestionPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SuggestionPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj4 (Suggestion)
				$obj4->addStudentSuggestion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of StudentSuggestion objects pre-filled with all related objects except Suggestion.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of StudentSuggestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSuggestion(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		StudentSuggestionPeer::addSelectColumns($criteria);
		$startcol2 = (StudentSuggestionPeer::NUM_COLUMNS - StudentSuggestionPeer::NUM_LAZY_LOAD_COLUMNS);

		TermPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(StudentSuggestionPeer::TERM_ID, TermPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::APPOINTMENT_ID, AppointmentPeer::ID, $join_behavior);

		$criteria->addJoin(StudentSuggestionPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = StudentSuggestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = StudentSuggestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = StudentSuggestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				StudentSuggestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Term rows

				$key2 = TermPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TermPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = TermPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TermPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj2 (Term)
				$obj2->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined Appointment rows

				$key3 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = AppointmentPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = AppointmentPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AppointmentPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj3 (Appointment)
				$obj3->addStudentSuggestion($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key4 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = sfGuardUserPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					sfGuardUserPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (StudentSuggestion) to the collection in $obj4 (sfGuardUser)
				$obj4->addStudentSuggestion($obj1);

			} // if joined row is not null

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
	  $dbMap = Propel::getDatabaseMap(BaseStudentSuggestionPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseStudentSuggestionPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new StudentSuggestionTableMap());
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
		return $withPrefix ? StudentSuggestionPeer::CLASS_DEFAULT : StudentSuggestionPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a StudentSuggestion or Criteria object.
	 *
	 * @param      mixed $values Criteria or StudentSuggestion object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from StudentSuggestion object
		}

		if ($criteria->containsKey(StudentSuggestionPeer::ID) && $criteria->keyContainsValue(StudentSuggestionPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.StudentSuggestionPeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a StudentSuggestion or Criteria object.
	 *
	 * @param      mixed $values Criteria or StudentSuggestion object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(StudentSuggestionPeer::ID);
			$selectCriteria->add(StudentSuggestionPeer::ID, $criteria->remove(StudentSuggestionPeer::ID), $comparison);

			$comparison = $criteria->getComparison(StudentSuggestionPeer::APPOINTMENT_ID);
			$selectCriteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $criteria->remove(StudentSuggestionPeer::APPOINTMENT_ID), $comparison);

		} else { // $values is StudentSuggestion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the student_suggestion table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(StudentSuggestionPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			StudentSuggestionPeer::clearInstancePool();
			StudentSuggestionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a StudentSuggestion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or StudentSuggestion object or primary key or array of primary keys
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
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			StudentSuggestionPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof StudentSuggestion) {
			// invalidate the cache for this single object
			StudentSuggestionPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(StudentSuggestionPeer::ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(StudentSuggestionPeer::APPOINTMENT_ID, $value[1]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				StudentSuggestionPeer::removeInstanceFromPool($value);
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
			StudentSuggestionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given StudentSuggestion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      StudentSuggestion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(StudentSuggestion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(StudentSuggestionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(StudentSuggestionPeer::TABLE_NAME);

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

		return BasePeer::doValidate(StudentSuggestionPeer::DATABASE_NAME, StudentSuggestionPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $id
	 * @param      int $appointment_id
	 * @param      PropelPDO $con
	 * @return     StudentSuggestion
	 */
	public static function retrieveByPK($id, $appointment_id, PropelPDO $con = null) {
		$key = serialize(array((string) $id, (string) $appointment_id));
 		if (null !== ($obj = StudentSuggestionPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(StudentSuggestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(StudentSuggestionPeer::DATABASE_NAME);
		$criteria->add(StudentSuggestionPeer::ID, $id);
		$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $appointment_id);
		$v = StudentSuggestionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array(array('term_id', 'appointment_id', 'user_id', 'suggestion_id'));
	}

} // BaseStudentSuggestionPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseStudentSuggestionPeer::buildTableMap();

