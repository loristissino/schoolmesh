<?php

/**
 * Base static class for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasesfGuardUserProfilePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'sf_guard_user_profile';

	/** the related Propel class for this table */
	const OM_CLASS = 'sfGuardUserProfile';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sfGuardUserProfile';

	/** the related TableMap class for this table */
	const TM_CLASS = 'sfGuardUserProfileTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 20;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the USER_ID field */
	const USER_ID = 'sf_guard_user_profile.USER_ID';

	/** the column name for the TITLE field */
	const TITLE = 'sf_guard_user_profile.TITLE';

	/** the column name for the FIRST_NAME field */
	const FIRST_NAME = 'sf_guard_user_profile.FIRST_NAME';

	/** the column name for the MIDDLE_NAME field */
	const MIDDLE_NAME = 'sf_guard_user_profile.MIDDLE_NAME';

	/** the column name for the LAST_NAME field */
	const LAST_NAME = 'sf_guard_user_profile.LAST_NAME';

	/** the column name for the PRONUNCIATION field */
	const PRONUNCIATION = 'sf_guard_user_profile.PRONUNCIATION';

	/** the column name for the INFO field */
	const INFO = 'sf_guard_user_profile.INFO';

	/** the column name for the ROLE_ID field */
	const ROLE_ID = 'sf_guard_user_profile.ROLE_ID';

	/** the column name for the GENDER field */
	const GENDER = 'sf_guard_user_profile.GENDER';

	/** the column name for the EMAIL field */
	const EMAIL = 'sf_guard_user_profile.EMAIL';

	/** the column name for the EMAIL_STATE field */
	const EMAIL_STATE = 'sf_guard_user_profile.EMAIL_STATE';

	/** the column name for the EMAIL_VERIFICATION_CODE field */
	const EMAIL_VERIFICATION_CODE = 'sf_guard_user_profile.EMAIL_VERIFICATION_CODE';

	/** the column name for the BIRTHDATE field */
	const BIRTHDATE = 'sf_guard_user_profile.BIRTHDATE';

	/** the column name for the BIRTHPLACE field */
	const BIRTHPLACE = 'sf_guard_user_profile.BIRTHPLACE';

	/** the column name for the IMPORT_CODE field */
	const IMPORT_CODE = 'sf_guard_user_profile.IMPORT_CODE';

	/** the column name for the SYSTEM_ALERTS field */
	const SYSTEM_ALERTS = 'sf_guard_user_profile.SYSTEM_ALERTS';

	/** the column name for the IS_SCHEDULED_FOR_DELETION field */
	const IS_SCHEDULED_FOR_DELETION = 'sf_guard_user_profile.IS_SCHEDULED_FOR_DELETION';

	/** the column name for the PREFERS_RICHTEXT field */
	const PREFERS_RICHTEXT = 'sf_guard_user_profile.PREFERS_RICHTEXT';

	/** the column name for the LAST_ACTION_AT field */
	const LAST_ACTION_AT = 'sf_guard_user_profile.LAST_ACTION_AT';

	/** the column name for the LAST_LOGIN_AT field */
	const LAST_LOGIN_AT = 'sf_guard_user_profile.LAST_LOGIN_AT';

	/**
	 * An identiy map to hold any loaded instances of sfGuardUserProfile objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array sfGuardUserProfile[]
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
		BasePeer::TYPE_PHPNAME => array ('UserId', 'Title', 'FirstName', 'MiddleName', 'LastName', 'Pronunciation', 'Info', 'RoleId', 'Gender', 'Email', 'EmailState', 'EmailVerificationCode', 'Birthdate', 'Birthplace', 'ImportCode', 'SystemAlerts', 'IsScheduledForDeletion', 'PrefersRichtext', 'LastActionAt', 'LastLoginAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId', 'title', 'firstName', 'middleName', 'lastName', 'pronunciation', 'info', 'roleId', 'gender', 'email', 'emailState', 'emailVerificationCode', 'birthdate', 'birthplace', 'importCode', 'systemAlerts', 'isScheduledForDeletion', 'prefersRichtext', 'lastActionAt', 'lastLoginAt', ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID, self::TITLE, self::FIRST_NAME, self::MIDDLE_NAME, self::LAST_NAME, self::PRONUNCIATION, self::INFO, self::ROLE_ID, self::GENDER, self::EMAIL, self::EMAIL_STATE, self::EMAIL_VERIFICATION_CODE, self::BIRTHDATE, self::BIRTHPLACE, self::IMPORT_CODE, self::SYSTEM_ALERTS, self::IS_SCHEDULED_FOR_DELETION, self::PREFERS_RICHTEXT, self::LAST_ACTION_AT, self::LAST_LOGIN_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'title', 'first_name', 'middle_name', 'last_name', 'pronunciation', 'info', 'role_id', 'gender', 'email', 'email_state', 'email_verification_code', 'birthdate', 'birthplace', 'import_code', 'system_alerts', 'is_scheduled_for_deletion', 'prefers_richtext', 'last_action_at', 'last_login_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'Title' => 1, 'FirstName' => 2, 'MiddleName' => 3, 'LastName' => 4, 'Pronunciation' => 5, 'Info' => 6, 'RoleId' => 7, 'Gender' => 8, 'Email' => 9, 'EmailState' => 10, 'EmailVerificationCode' => 11, 'Birthdate' => 12, 'Birthplace' => 13, 'ImportCode' => 14, 'SystemAlerts' => 15, 'IsScheduledForDeletion' => 16, 'PrefersRichtext' => 17, 'LastActionAt' => 18, 'LastLoginAt' => 19, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId' => 0, 'title' => 1, 'firstName' => 2, 'middleName' => 3, 'lastName' => 4, 'pronunciation' => 5, 'info' => 6, 'roleId' => 7, 'gender' => 8, 'email' => 9, 'emailState' => 10, 'emailVerificationCode' => 11, 'birthdate' => 12, 'birthplace' => 13, 'importCode' => 14, 'systemAlerts' => 15, 'isScheduledForDeletion' => 16, 'prefersRichtext' => 17, 'lastActionAt' => 18, 'lastLoginAt' => 19, ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID => 0, self::TITLE => 1, self::FIRST_NAME => 2, self::MIDDLE_NAME => 3, self::LAST_NAME => 4, self::PRONUNCIATION => 5, self::INFO => 6, self::ROLE_ID => 7, self::GENDER => 8, self::EMAIL => 9, self::EMAIL_STATE => 10, self::EMAIL_VERIFICATION_CODE => 11, self::BIRTHDATE => 12, self::BIRTHPLACE => 13, self::IMPORT_CODE => 14, self::SYSTEM_ALERTS => 15, self::IS_SCHEDULED_FOR_DELETION => 16, self::PREFERS_RICHTEXT => 17, self::LAST_ACTION_AT => 18, self::LAST_LOGIN_AT => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'title' => 1, 'first_name' => 2, 'middle_name' => 3, 'last_name' => 4, 'pronunciation' => 5, 'info' => 6, 'role_id' => 7, 'gender' => 8, 'email' => 9, 'email_state' => 10, 'email_verification_code' => 11, 'birthdate' => 12, 'birthplace' => 13, 'import_code' => 14, 'system_alerts' => 15, 'is_scheduled_for_deletion' => 16, 'prefers_richtext' => 17, 'last_action_at' => 18, 'last_login_at' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
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
	 * @param      string $column The column name for current table. (i.e. sfGuardUserProfilePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(sfGuardUserProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(sfGuardUserProfilePeer::USER_ID);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::TITLE);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::FIRST_NAME);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::MIDDLE_NAME);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::LAST_NAME);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::PRONUNCIATION);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::INFO);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::ROLE_ID);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::GENDER);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL_STATE);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::BIRTHDATE);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::BIRTHPLACE);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::IMPORT_CODE);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::SYSTEM_ALERTS);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::IS_SCHEDULED_FOR_DELETION);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::PREFERS_RICHTEXT);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::LAST_ACTION_AT);
		$criteria->addSelectColumn(sfGuardUserProfilePeer::LAST_LOGIN_AT);
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
		$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     sfGuardUserProfile
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = sfGuardUserProfilePeer::doSelect($critcopy, $con);
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
		return sfGuardUserProfilePeer::populateObjects(sfGuardUserProfilePeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			sfGuardUserProfilePeer::addSelectColumns($criteria);
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
	 * @param      sfGuardUserProfile $value A sfGuardUserProfile object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(sfGuardUserProfile $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getUserId();
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
	 * @param      mixed $value A sfGuardUserProfile object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof sfGuardUserProfile) {
				$key = (string) $value->getUserId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or sfGuardUserProfile object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     sfGuardUserProfile Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to sf_guard_user_profile
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
		$cls = sfGuardUserProfilePeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = sfGuardUserProfilePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				sfGuardUserProfilePeer::addInstanceToPool($obj, $key);
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
		$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Role table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinRole(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, $join_behavior);

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
	 * Selects a collection of sfGuardUserProfile objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfGuardUserProfile objects.
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

		sfGuardUserProfilePeer::addSelectColumns($criteria);
		$startcol = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = sfGuardUserProfilePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (sfGuardUserProfile) to $obj2 (sfGuardUser)
				// one to one relationship
				$obj1->setsfGuardUser($obj2);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of sfGuardUserProfile objects pre-filled with their Role objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfGuardUserProfile objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinRole(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($criteria);
		$startcol = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);
		RolePeer::addSelectColumns($criteria);

		$criteria->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = sfGuardUserProfilePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = RolePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = RolePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = RolePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					RolePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (sfGuardUserProfile) to $obj2 (Role)
				$obj2->addsfGuardUserProfile($obj1);

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
		$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, $join_behavior);

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
	 * Selects a collection of sfGuardUserProfile objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfGuardUserProfile objects.
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

		sfGuardUserProfilePeer::addSelectColumns($criteria);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		RolePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = sfGuardUserProfilePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (sfGuardUserProfile) to the collection in $obj2 (sfGuardUser)
				$obj1->setsfGuardUser($obj2);
			} // if joined row not null

			// Add objects for joined Role rows

			$key3 = RolePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = RolePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = RolePeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					RolePeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (sfGuardUserProfile) to the collection in $obj3 (Role)
				$obj3->addsfGuardUserProfile($obj1);
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
		$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Role table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptRole(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Selects a collection of sfGuardUserProfile objects pre-filled with all related objects except sfGuardUser.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfGuardUserProfile objects.
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

		sfGuardUserProfilePeer::addSelectColumns($criteria);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		RolePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = sfGuardUserProfilePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Role rows

				$key2 = RolePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = RolePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = RolePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					RolePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (sfGuardUserProfile) to the collection in $obj2 (Role)
				$obj2->addsfGuardUserProfile($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of sfGuardUserProfile objects pre-filled with all related objects except Role.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfGuardUserProfile objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptRole(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($criteria);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = sfGuardUserProfilePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (sfGuardUserProfile) to the collection in $obj2 (sfGuardUser)
				$obj1->setsfGuardUser($obj2);

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
	  $dbMap = Propel::getDatabaseMap(BasesfGuardUserProfilePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BasesfGuardUserProfilePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new sfGuardUserProfileTableMap());
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
		return $withPrefix ? sfGuardUserProfilePeer::CLASS_DEFAULT : sfGuardUserProfilePeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a sfGuardUserProfile or Criteria object.
	 *
	 * @param      mixed $values Criteria or sfGuardUserProfile object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from sfGuardUserProfile object
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
	 * Method perform an UPDATE on the database, given a sfGuardUserProfile or Criteria object.
	 *
	 * @param      mixed $values Criteria or sfGuardUserProfile object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(sfGuardUserProfilePeer::USER_ID);
			$selectCriteria->add(sfGuardUserProfilePeer::USER_ID, $criteria->remove(sfGuardUserProfilePeer::USER_ID), $comparison);

		} else { // $values is sfGuardUserProfile object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the sf_guard_user_profile table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(sfGuardUserProfilePeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			sfGuardUserProfilePeer::clearInstancePool();
			sfGuardUserProfilePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a sfGuardUserProfile or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or sfGuardUserProfile object or primary key or array of primary keys
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			sfGuardUserProfilePeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof sfGuardUserProfile) { // it's a model object
			// invalidate the cache for this single object
			sfGuardUserProfilePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfGuardUserProfilePeer::USER_ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				sfGuardUserProfilePeer::removeInstanceFromPool($singleval);
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
			sfGuardUserProfilePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given sfGuardUserProfile object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      sfGuardUserProfile $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(sfGuardUserProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfGuardUserProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfGuardUserProfilePeer::TABLE_NAME);

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

		return BasePeer::doValidate(sfGuardUserProfilePeer::DATABASE_NAME, sfGuardUserProfilePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     sfGuardUserProfile
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = sfGuardUserProfilePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		$criteria->add(sfGuardUserProfilePeer::USER_ID, $pk);

		$v = sfGuardUserProfilePeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$criteria->add(sfGuardUserProfilePeer::USER_ID, $pks, Criteria::IN);
			$objs = sfGuardUserProfilePeer::doSelect($criteria, $con);
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
	  return array();
	}

} // BasesfGuardUserProfilePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BasesfGuardUserProfilePeer::buildTableMap();

