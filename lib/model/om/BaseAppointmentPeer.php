<?php

/**
 * Base static class for performing query and update operations on the 'appointment' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseAppointmentPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'appointment';

	/** the related Propel class for this table */
	const OM_CLASS = 'Appointment';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Appointment';

	/** the related TableMap class for this table */
	const TM_CLASS = 'AppointmentTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'appointment.ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'appointment.USER_ID';

	/** the column name for the SUBJECT_ID field */
	const SUBJECT_ID = 'appointment.SUBJECT_ID';

	/** the column name for the SCHOOLCLASS_ID field */
	const SCHOOLCLASS_ID = 'appointment.SCHOOLCLASS_ID';

	/** the column name for the TEAM_ID field */
	const TEAM_ID = 'appointment.TEAM_ID';

	/** the column name for the YEAR_ID field */
	const YEAR_ID = 'appointment.YEAR_ID';

	/** the column name for the STATE field */
	const STATE = 'appointment.STATE';

	/** the column name for the HOURS field */
	const HOURS = 'appointment.HOURS';

	/** the column name for the IS_PUBLIC field */
	const IS_PUBLIC = 'appointment.IS_PUBLIC';

	/** the column name for the SYLLABUS_ID field */
	const SYLLABUS_ID = 'appointment.SYLLABUS_ID';

	/** the column name for the APPOINTMENT_TYPE_ID field */
	const APPOINTMENT_TYPE_ID = 'appointment.APPOINTMENT_TYPE_ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'appointment.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'appointment.UPDATED_AT';

	/** the column name for the IMPORT_CODE field */
	const IMPORT_CODE = 'appointment.IMPORT_CODE';

	/**
	 * An identiy map to hold any loaded instances of Appointment objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Appointment[]
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
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'SubjectId', 'SchoolclassId', 'TeamId', 'YearId', 'State', 'Hours', 'IsPublic', 'SyllabusId', 'AppointmentTypeId', 'CreatedAt', 'UpdatedAt', 'ImportCode', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userId', 'subjectId', 'schoolclassId', 'teamId', 'yearId', 'state', 'hours', 'isPublic', 'syllabusId', 'appointmentTypeId', 'createdAt', 'updatedAt', 'importCode', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USER_ID, self::SUBJECT_ID, self::SCHOOLCLASS_ID, self::TEAM_ID, self::YEAR_ID, self::STATE, self::HOURS, self::IS_PUBLIC, self::SYLLABUS_ID, self::APPOINTMENT_TYPE_ID, self::CREATED_AT, self::UPDATED_AT, self::IMPORT_CODE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'subject_id', 'schoolclass_id', 'team_id', 'year_id', 'state', 'hours', 'is_public', 'syllabus_id', 'appointment_type_id', 'created_at', 'updated_at', 'import_code', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'SubjectId' => 2, 'SchoolclassId' => 3, 'TeamId' => 4, 'YearId' => 5, 'State' => 6, 'Hours' => 7, 'IsPublic' => 8, 'SyllabusId' => 9, 'AppointmentTypeId' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'ImportCode' => 13, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userId' => 1, 'subjectId' => 2, 'schoolclassId' => 3, 'teamId' => 4, 'yearId' => 5, 'state' => 6, 'hours' => 7, 'isPublic' => 8, 'syllabusId' => 9, 'appointmentTypeId' => 10, 'createdAt' => 11, 'updatedAt' => 12, 'importCode' => 13, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USER_ID => 1, self::SUBJECT_ID => 2, self::SCHOOLCLASS_ID => 3, self::TEAM_ID => 4, self::YEAR_ID => 5, self::STATE => 6, self::HOURS => 7, self::IS_PUBLIC => 8, self::SYLLABUS_ID => 9, self::APPOINTMENT_TYPE_ID => 10, self::CREATED_AT => 11, self::UPDATED_AT => 12, self::IMPORT_CODE => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'subject_id' => 2, 'schoolclass_id' => 3, 'team_id' => 4, 'year_id' => 5, 'state' => 6, 'hours' => 7, 'is_public' => 8, 'syllabus_id' => 9, 'appointment_type_id' => 10, 'created_at' => 11, 'updated_at' => 12, 'import_code' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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
	 * @param      string $column The column name for current table. (i.e. AppointmentPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(AppointmentPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(AppointmentPeer::ID);
		$criteria->addSelectColumn(AppointmentPeer::USER_ID);
		$criteria->addSelectColumn(AppointmentPeer::SUBJECT_ID);
		$criteria->addSelectColumn(AppointmentPeer::SCHOOLCLASS_ID);
		$criteria->addSelectColumn(AppointmentPeer::TEAM_ID);
		$criteria->addSelectColumn(AppointmentPeer::YEAR_ID);
		$criteria->addSelectColumn(AppointmentPeer::STATE);
		$criteria->addSelectColumn(AppointmentPeer::HOURS);
		$criteria->addSelectColumn(AppointmentPeer::IS_PUBLIC);
		$criteria->addSelectColumn(AppointmentPeer::SYLLABUS_ID);
		$criteria->addSelectColumn(AppointmentPeer::APPOINTMENT_TYPE_ID);
		$criteria->addSelectColumn(AppointmentPeer::CREATED_AT);
		$criteria->addSelectColumn(AppointmentPeer::UPDATED_AT);
		$criteria->addSelectColumn(AppointmentPeer::IMPORT_CODE);
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
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Appointment
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AppointmentPeer::doSelect($critcopy, $con);
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
		return AppointmentPeer::populateObjects(AppointmentPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AppointmentPeer::addSelectColumns($criteria);
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
	 * @param      Appointment $value A Appointment object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Appointment $obj, $key = null)
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
	 * @param      mixed $value A Appointment object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Appointment) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Appointment object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Appointment Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to appointment
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
		// invalidate objects in WptoolAppointmentPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		WptoolAppointmentPeer::clearInstancePool();

		// invalidate objects in StudentSuggestionPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		StudentSuggestionPeer::clearInstancePool();

		// invalidate objects in StudentHintPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		StudentHintPeer::clearInstancePool();

		// invalidate objects in StudentSyllabusItemPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		StudentSyllabusItemPeer::clearInstancePool();

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
		$cls = AppointmentPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AppointmentPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AppointmentPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
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
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Subject table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinSubject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Schoolclass table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinSchoolclass(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Team table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTeam(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Year table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinYear(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Syllabus table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinSyllabus(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Selects a collection of Appointment objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
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

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Appointment) to $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with their Subject objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSubject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		SubjectPeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SubjectPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = SubjectPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SubjectPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Appointment) to $obj2 (Subject)
				$obj2->addAppointment($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with their Schoolclass objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSchoolclass(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		SchoolclassPeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SchoolclassPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = SchoolclassPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SchoolclassPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Appointment) to $obj2 (Schoolclass)
				$obj2->addAppointment($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with their Team objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTeam(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		TeamPeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TeamPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TeamPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TeamPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Appointment) to $obj2 (Team)
				$obj2->addAppointment($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with their Year objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinYear(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		YearPeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = YearPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = YearPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					YearPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Appointment) to $obj2 (Year)
				$obj2->addAppointment($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with their Syllabus objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSyllabus(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		SyllabusPeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SyllabusPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = SyllabusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SyllabusPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Appointment) to $obj2 (Syllabus)
				$obj2->addAppointment($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with their AppointmentType objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
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

		AppointmentPeer::addSelectColumns($criteria);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		AppointmentTypePeer::addSelectColumns($criteria);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Appointment) to $obj2 (AppointmentType)
				$obj2->addAppointment($obj1);

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
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Selects a collection of Appointment objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
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

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol9 = $startcol8 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined sfGuardUser rows

			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);
			} // if joined row not null

			// Add objects for joined Subject rows

			$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = SubjectPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = SubjectPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Subject)
				$obj3->addAppointment($obj1);
			} // if joined row not null

			// Add objects for joined Schoolclass rows

			$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$cls = SchoolclassPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Schoolclass)
				$obj4->addAppointment($obj1);
			} // if joined row not null

			// Add objects for joined Team rows

			$key5 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = TeamPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$cls = TeamPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					TeamPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Team)
				$obj5->addAppointment($obj1);
			} // if joined row not null

			// Add objects for joined Year rows

			$key6 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol6);
			if ($key6 !== null) {
				$obj6 = YearPeer::getInstanceFromPool($key6);
				if (!$obj6) {

					$cls = YearPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					YearPeer::addInstanceToPool($obj6, $key6);
				} // if obj6 loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Year)
				$obj6->addAppointment($obj1);
			} // if joined row not null

			// Add objects for joined Syllabus rows

			$key7 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol7);
			if ($key7 !== null) {
				$obj7 = SyllabusPeer::getInstanceFromPool($key7);
				if (!$obj7) {

					$cls = SyllabusPeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					SyllabusPeer::addInstanceToPool($obj7, $key7);
				} // if obj7 loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (Syllabus)
				$obj7->addAppointment($obj1);
			} // if joined row not null

			// Add objects for joined AppointmentType rows

			$key8 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol8);
			if ($key8 !== null) {
				$obj8 = AppointmentTypePeer::getInstanceFromPool($key8);
				if (!$obj8) {

					$cls = AppointmentTypePeer::getOMClass(false);

					$obj8 = new $cls();
					$obj8->hydrate($row, $startcol8);
					AppointmentTypePeer::addInstanceToPool($obj8, $key8);
				} // if obj8 loaded

				// Add the $obj1 (Appointment) to the collection in $obj8 (AppointmentType)
				$obj8->addAppointment($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
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
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Subject table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSubject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Schoolclass table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchoolclass(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Team table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTeam(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Year table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptYear(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Syllabus table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSyllabus(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related AppointmentType table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAppointmentType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

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
	 * Selects a collection of Appointment objects pre-filled with all related objects except sfGuardUser.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
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

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Subject rows

				$key2 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = SubjectPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = SubjectPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SubjectPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (Subject)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Schoolclass rows

				$key3 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SchoolclassPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SchoolclassPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SchoolclassPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Schoolclass)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Team rows

				$key4 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TeamPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = TeamPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TeamPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Team)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key5 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = YearPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = YearPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					YearPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Year)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Syllabus rows

				$key6 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = SyllabusPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = SyllabusPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					SyllabusPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Syllabus)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined AppointmentType rows

				$key7 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = AppointmentTypePeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = AppointmentTypePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AppointmentTypePeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (AppointmentType)
				$obj7->addAppointment($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with all related objects except Subject.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSubject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfGuardUser rows

				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Schoolclass rows

				$key3 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SchoolclassPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SchoolclassPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SchoolclassPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Schoolclass)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Team rows

				$key4 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TeamPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = TeamPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TeamPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Team)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key5 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = YearPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = YearPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					YearPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Year)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Syllabus rows

				$key6 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = SyllabusPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = SyllabusPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					SyllabusPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Syllabus)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined AppointmentType rows

				$key7 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = AppointmentTypePeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = AppointmentTypePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AppointmentTypePeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (AppointmentType)
				$obj7->addAppointment($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with all related objects except Schoolclass.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchoolclass(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfGuardUser rows

				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Subject rows

				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SubjectPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Subject)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Team rows

				$key4 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TeamPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = TeamPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TeamPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Team)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key5 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = YearPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = YearPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					YearPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Year)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Syllabus rows

				$key6 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = SyllabusPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = SyllabusPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					SyllabusPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Syllabus)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined AppointmentType rows

				$key7 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = AppointmentTypePeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = AppointmentTypePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AppointmentTypePeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (AppointmentType)
				$obj7->addAppointment($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with all related objects except Team.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTeam(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfGuardUser rows

				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Subject rows

				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SubjectPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Subject)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Schoolclass rows

				$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SchoolclassPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Schoolclass)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key5 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = YearPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = YearPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					YearPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Year)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Syllabus rows

				$key6 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = SyllabusPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = SyllabusPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					SyllabusPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Syllabus)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined AppointmentType rows

				$key7 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = AppointmentTypePeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = AppointmentTypePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AppointmentTypePeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (AppointmentType)
				$obj7->addAppointment($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with all related objects except Year.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptYear(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfGuardUser rows

				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Subject rows

				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SubjectPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Subject)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Schoolclass rows

				$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SchoolclassPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Schoolclass)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Team rows

				$key5 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = TeamPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = TeamPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					TeamPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Team)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Syllabus rows

				$key6 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = SyllabusPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = SyllabusPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					SyllabusPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Syllabus)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined AppointmentType rows

				$key7 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = AppointmentTypePeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = AppointmentTypePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AppointmentTypePeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (AppointmentType)
				$obj7->addAppointment($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with all related objects except Syllabus.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSyllabus(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentTypePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::APPOINTMENT_TYPE_ID, AppointmentTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfGuardUser rows

				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Subject rows

				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SubjectPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Subject)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Schoolclass rows

				$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SchoolclassPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Schoolclass)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Team rows

				$key5 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = TeamPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = TeamPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					TeamPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Team)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key6 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = YearPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = YearPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					YearPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Year)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined AppointmentType rows

				$key7 = AppointmentTypePeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = AppointmentTypePeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = AppointmentTypePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AppointmentTypePeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (AppointmentType)
				$obj7->addAppointment($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Appointment objects pre-filled with all related objects except AppointmentType.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Appointment objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAppointmentType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($criteria);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		SyllabusPeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(AppointmentPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SUBJECT_ID, SubjectPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SCHOOLCLASS_ID, SchoolclassPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(AppointmentPeer::SYLLABUS_ID, SyllabusPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = AppointmentPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfGuardUser rows

				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj2 (sfGuardUser)
				$obj2->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Subject rows

				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = SubjectPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj3 (Subject)
				$obj3->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Schoolclass rows

				$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = SchoolclassPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj4 (Schoolclass)
				$obj4->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Team rows

				$key5 = TeamPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = TeamPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = TeamPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					TeamPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj5 (Team)
				$obj5->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key6 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = YearPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = YearPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					YearPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj6 (Year)
				$obj6->addAppointment($obj1);

			} // if joined row is not null

				// Add objects for joined Syllabus rows

				$key7 = SyllabusPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = SyllabusPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$cls = SyllabusPeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					SyllabusPeer::addInstanceToPool($obj7, $key7);
				} // if $obj7 already loaded

				// Add the $obj1 (Appointment) to the collection in $obj7 (Syllabus)
				$obj7->addAppointment($obj1);

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
	  $dbMap = Propel::getDatabaseMap(BaseAppointmentPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseAppointmentPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new AppointmentTableMap());
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
		return $withPrefix ? AppointmentPeer::CLASS_DEFAULT : AppointmentPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Appointment or Criteria object.
	 *
	 * @param      mixed $values Criteria or Appointment object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Appointment object
		}

		if ($criteria->containsKey(AppointmentPeer::ID) && $criteria->keyContainsValue(AppointmentPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.AppointmentPeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a Appointment or Criteria object.
	 *
	 * @param      mixed $values Criteria or Appointment object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(AppointmentPeer::ID);
			$selectCriteria->add(AppointmentPeer::ID, $criteria->remove(AppointmentPeer::ID), $comparison);

		} else { // $values is Appointment object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the appointment table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AppointmentPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			AppointmentPeer::clearInstancePool();
			AppointmentPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Appointment or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Appointment object or primary key or array of primary keys
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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			AppointmentPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Appointment) { // it's a model object
			// invalidate the cache for this single object
			AppointmentPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AppointmentPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				AppointmentPeer::removeInstanceFromPool($singleval);
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
			AppointmentPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Appointment object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Appointment $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Appointment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AppointmentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AppointmentPeer::TABLE_NAME);

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

		return BasePeer::doValidate(AppointmentPeer::DATABASE_NAME, AppointmentPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Appointment
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AppointmentPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		$criteria->add(AppointmentPeer::ID, $pk);

		$v = AppointmentPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
			$criteria->add(AppointmentPeer::ID, $pks, Criteria::IN);
			$objs = AppointmentPeer::doSelect($criteria, $con);
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
	  return array(array('user_id', 'subject_id', 'appointment_type_id', 'schoolclass_id', 'year_id'));
	}

} // BaseAppointmentPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseAppointmentPeer::buildTableMap();

