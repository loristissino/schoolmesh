<?php

/**
 * Base static class for performing query and update operations on the 'schoolproject' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchoolprojectPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'schoolproject';

	/** the related Propel class for this table */
	const OM_CLASS = 'Schoolproject';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Schoolproject';

	/** the related TableMap class for this table */
	const TM_CLASS = 'SchoolprojectTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 23;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'schoolproject.ID';

	/** the column name for the PROJ_CATEGORY_ID field */
	const PROJ_CATEGORY_ID = 'schoolproject.PROJ_CATEGORY_ID';

	/** the column name for the CODE field */
	const CODE = 'schoolproject.CODE';

	/** the column name for the YEAR_ID field */
	const YEAR_ID = 'schoolproject.YEAR_ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'schoolproject.USER_ID';

	/** the column name for the TEAM_ID field */
	const TEAM_ID = 'schoolproject.TEAM_ID';

	/** the column name for the TITLE field */
	const TITLE = 'schoolproject.TITLE';

	/** the column name for the HOURS_APPROVED field */
	const HOURS_APPROVED = 'schoolproject.HOURS_APPROVED';

	/** the column name for the STATE field */
	const STATE = 'schoolproject.STATE';

	/** the column name for the SUBMISSION_DATE field */
	const SUBMISSION_DATE = 'schoolproject.SUBMISSION_DATE';

	/** the column name for the REFERENCE_NUMBER field */
	const REFERENCE_NUMBER = 'schoolproject.REFERENCE_NUMBER';

	/** the column name for the APPROVAL_DATE field */
	const APPROVAL_DATE = 'schoolproject.APPROVAL_DATE';

	/** the column name for the APPROVAL_NOTES field */
	const APPROVAL_NOTES = 'schoolproject.APPROVAL_NOTES';

	/** the column name for the FINANCING_DATE field */
	const FINANCING_DATE = 'schoolproject.FINANCING_DATE';

	/** the column name for the FINANCING_NOTES field */
	const FINANCING_NOTES = 'schoolproject.FINANCING_NOTES';

	/** the column name for the CONFIRMATION_DATE field */
	const CONFIRMATION_DATE = 'schoolproject.CONFIRMATION_DATE';

	/** the column name for the CONFIRMATION_NOTES field */
	const CONFIRMATION_NOTES = 'schoolproject.CONFIRMATION_NOTES';

	/** the column name for the REJECTION_DATE field */
	const REJECTION_DATE = 'schoolproject.REJECTION_DATE';

	/** the column name for the REJECTION_NOTES field */
	const REJECTION_NOTES = 'schoolproject.REJECTION_NOTES';

	/** the column name for the EVALUATION_MIN field */
	const EVALUATION_MIN = 'schoolproject.EVALUATION_MIN';

	/** the column name for the EVALUATION_MAX field */
	const EVALUATION_MAX = 'schoolproject.EVALUATION_MAX';

	/** the column name for the NO_ACTIVITY_CONFIRM field */
	const NO_ACTIVITY_CONFIRM = 'schoolproject.NO_ACTIVITY_CONFIRM';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'schoolproject.CREATED_AT';

	/**
	 * An identiy map to hold any loaded instances of Schoolproject objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Schoolproject[]
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
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProjCategoryId', 'Code', 'YearId', 'UserId', 'TeamId', 'Title', 'HoursApproved', 'State', 'SubmissionDate', 'ReferenceNumber', 'ApprovalDate', 'ApprovalNotes', 'FinancingDate', 'FinancingNotes', 'ConfirmationDate', 'ConfirmationNotes', 'RejectionDate', 'RejectionNotes', 'EvaluationMin', 'EvaluationMax', 'NoActivityConfirm', 'CreatedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'projCategoryId', 'code', 'yearId', 'userId', 'teamId', 'title', 'hoursApproved', 'state', 'submissionDate', 'referenceNumber', 'approvalDate', 'approvalNotes', 'financingDate', 'financingNotes', 'confirmationDate', 'confirmationNotes', 'rejectionDate', 'rejectionNotes', 'evaluationMin', 'evaluationMax', 'noActivityConfirm', 'createdAt', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::PROJ_CATEGORY_ID, self::CODE, self::YEAR_ID, self::USER_ID, self::TEAM_ID, self::TITLE, self::HOURS_APPROVED, self::STATE, self::SUBMISSION_DATE, self::REFERENCE_NUMBER, self::APPROVAL_DATE, self::APPROVAL_NOTES, self::FINANCING_DATE, self::FINANCING_NOTES, self::CONFIRMATION_DATE, self::CONFIRMATION_NOTES, self::REJECTION_DATE, self::REJECTION_NOTES, self::EVALUATION_MIN, self::EVALUATION_MAX, self::NO_ACTIVITY_CONFIRM, self::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'proj_category_id', 'code', 'year_id', 'user_id', 'team_id', 'title', 'hours_approved', 'state', 'submission_date', 'reference_number', 'approval_date', 'approval_notes', 'financing_date', 'financing_notes', 'confirmation_date', 'confirmation_notes', 'rejection_date', 'rejection_notes', 'evaluation_min', 'evaluation_max', 'no_activity_confirm', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProjCategoryId' => 1, 'Code' => 2, 'YearId' => 3, 'UserId' => 4, 'TeamId' => 5, 'Title' => 6, 'HoursApproved' => 7, 'State' => 8, 'SubmissionDate' => 9, 'ReferenceNumber' => 10, 'ApprovalDate' => 11, 'ApprovalNotes' => 12, 'FinancingDate' => 13, 'FinancingNotes' => 14, 'ConfirmationDate' => 15, 'ConfirmationNotes' => 16, 'RejectionDate' => 17, 'RejectionNotes' => 18, 'EvaluationMin' => 19, 'EvaluationMax' => 20, 'NoActivityConfirm' => 21, 'CreatedAt' => 22, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'projCategoryId' => 1, 'code' => 2, 'yearId' => 3, 'userId' => 4, 'teamId' => 5, 'title' => 6, 'hoursApproved' => 7, 'state' => 8, 'submissionDate' => 9, 'referenceNumber' => 10, 'approvalDate' => 11, 'approvalNotes' => 12, 'financingDate' => 13, 'financingNotes' => 14, 'confirmationDate' => 15, 'confirmationNotes' => 16, 'rejectionDate' => 17, 'rejectionNotes' => 18, 'evaluationMin' => 19, 'evaluationMax' => 20, 'noActivityConfirm' => 21, 'createdAt' => 22, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PROJ_CATEGORY_ID => 1, self::CODE => 2, self::YEAR_ID => 3, self::USER_ID => 4, self::TEAM_ID => 5, self::TITLE => 6, self::HOURS_APPROVED => 7, self::STATE => 8, self::SUBMISSION_DATE => 9, self::REFERENCE_NUMBER => 10, self::APPROVAL_DATE => 11, self::APPROVAL_NOTES => 12, self::FINANCING_DATE => 13, self::FINANCING_NOTES => 14, self::CONFIRMATION_DATE => 15, self::CONFIRMATION_NOTES => 16, self::REJECTION_DATE => 17, self::REJECTION_NOTES => 18, self::EVALUATION_MIN => 19, self::EVALUATION_MAX => 20, self::NO_ACTIVITY_CONFIRM => 21, self::CREATED_AT => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'proj_category_id' => 1, 'code' => 2, 'year_id' => 3, 'user_id' => 4, 'team_id' => 5, 'title' => 6, 'hours_approved' => 7, 'state' => 8, 'submission_date' => 9, 'reference_number' => 10, 'approval_date' => 11, 'approval_notes' => 12, 'financing_date' => 13, 'financing_notes' => 14, 'confirmation_date' => 15, 'confirmation_notes' => 16, 'rejection_date' => 17, 'rejection_notes' => 18, 'evaluation_min' => 19, 'evaluation_max' => 20, 'no_activity_confirm' => 21, 'created_at' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
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
	 * @param      string $column The column name for current table. (i.e. SchoolprojectPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchoolprojectPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(SchoolprojectPeer::ID);
		$criteria->addSelectColumn(SchoolprojectPeer::PROJ_CATEGORY_ID);
		$criteria->addSelectColumn(SchoolprojectPeer::CODE);
		$criteria->addSelectColumn(SchoolprojectPeer::YEAR_ID);
		$criteria->addSelectColumn(SchoolprojectPeer::USER_ID);
		$criteria->addSelectColumn(SchoolprojectPeer::TEAM_ID);
		$criteria->addSelectColumn(SchoolprojectPeer::TITLE);
		$criteria->addSelectColumn(SchoolprojectPeer::HOURS_APPROVED);
		$criteria->addSelectColumn(SchoolprojectPeer::STATE);
		$criteria->addSelectColumn(SchoolprojectPeer::SUBMISSION_DATE);
		$criteria->addSelectColumn(SchoolprojectPeer::REFERENCE_NUMBER);
		$criteria->addSelectColumn(SchoolprojectPeer::APPROVAL_DATE);
		$criteria->addSelectColumn(SchoolprojectPeer::APPROVAL_NOTES);
		$criteria->addSelectColumn(SchoolprojectPeer::FINANCING_DATE);
		$criteria->addSelectColumn(SchoolprojectPeer::FINANCING_NOTES);
		$criteria->addSelectColumn(SchoolprojectPeer::CONFIRMATION_DATE);
		$criteria->addSelectColumn(SchoolprojectPeer::CONFIRMATION_NOTES);
		$criteria->addSelectColumn(SchoolprojectPeer::REJECTION_DATE);
		$criteria->addSelectColumn(SchoolprojectPeer::REJECTION_NOTES);
		$criteria->addSelectColumn(SchoolprojectPeer::EVALUATION_MIN);
		$criteria->addSelectColumn(SchoolprojectPeer::EVALUATION_MAX);
		$criteria->addSelectColumn(SchoolprojectPeer::NO_ACTIVITY_CONFIRM);
		$criteria->addSelectColumn(SchoolprojectPeer::CREATED_AT);
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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Schoolproject
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchoolprojectPeer::doSelect($critcopy, $con);
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
		return SchoolprojectPeer::populateObjects(SchoolprojectPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SchoolprojectPeer::addSelectColumns($criteria);
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
	 * @param      Schoolproject $value A Schoolproject object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Schoolproject $obj, $key = null)
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
	 * @param      mixed $value A Schoolproject object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Schoolproject) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Schoolproject object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Schoolproject Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to schoolproject
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
		$cls = SchoolprojectPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SchoolprojectPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SchoolprojectPeer::addInstanceToPool($obj, $key);
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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

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
	 * Selects a collection of Schoolproject objects pre-filled with their ProjCategory objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);
		ProjCategoryPeer::addSelectColumns($criteria);

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Schoolproject) to $obj2 (ProjCategory)
				$obj2->addSchoolproject($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Schoolproject objects pre-filled with their Year objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);
		YearPeer::addSelectColumns($criteria);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Schoolproject) to $obj2 (Year)
				$obj2->addSchoolproject($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Schoolproject objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Schoolproject) to $obj2 (sfGuardUser)
				$obj2->addSchoolproject($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Schoolproject objects pre-filled with their Team objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);
		TeamPeer::addSelectColumns($criteria);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Schoolproject) to $obj2 (Team)
				$obj2->addSchoolproject($obj1);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

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
	 * Selects a collection of Schoolproject objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol2 = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);

		ProjCategoryPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (ProjCategoryPeer::NUM_COLUMNS - ProjCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Schoolproject) to the collection in $obj2 (ProjCategory)
				$obj2->addSchoolproject($obj1);
			} // if joined row not null

			// Add objects for joined Year rows

			$key3 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = YearPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = YearPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					YearPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj3 (Year)
				$obj3->addSchoolproject($obj1);
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

				// Add the $obj1 (Schoolproject) to the collection in $obj4 (sfGuardUser)
				$obj4->addSchoolproject($obj1);
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

				// Add the $obj1 (Schoolproject) to the collection in $obj5 (Team)
				$obj5->addSchoolproject($obj1);
			} // if joined row not null

			$results[] = $obj1;
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
	public static function doCountJoinAllExceptProjCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);

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
		$criteria->setPrimaryTableName(SchoolprojectPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolprojectPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Selects a collection of Schoolproject objects pre-filled with all related objects except ProjCategory.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProjCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol2 = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Year rows

				$key2 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = YearPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = YearPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					YearPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj2 (Year)
				$obj2->addSchoolproject($obj1);

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

				// Add the $obj1 (Schoolproject) to the collection in $obj3 (sfGuardUser)
				$obj3->addSchoolproject($obj1);

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

				// Add the $obj1 (Schoolproject) to the collection in $obj4 (Team)
				$obj4->addSchoolproject($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Schoolproject objects pre-filled with all related objects except Year.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol2 = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);

		ProjCategoryPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (ProjCategoryPeer::NUM_COLUMNS - ProjCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj2 (ProjCategory)
				$obj2->addSchoolproject($obj1);

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

				// Add the $obj1 (Schoolproject) to the collection in $obj3 (sfGuardUser)
				$obj3->addSchoolproject($obj1);

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

				// Add the $obj1 (Schoolproject) to the collection in $obj4 (Team)
				$obj4->addSchoolproject($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Schoolproject objects pre-filled with all related objects except sfGuardUser.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol2 = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);

		ProjCategoryPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (ProjCategoryPeer::NUM_COLUMNS - ProjCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		TeamPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::TEAM_ID, TeamPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj2 (ProjCategory)
				$obj2->addSchoolproject($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key3 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = YearPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = YearPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					YearPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj3 (Year)
				$obj3->addSchoolproject($obj1);

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

				// Add the $obj1 (Schoolproject) to the collection in $obj4 (Team)
				$obj4->addSchoolproject($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Schoolproject objects pre-filled with all related objects except Team.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Schoolproject objects.
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

		SchoolprojectPeer::addSelectColumns($criteria);
		$startcol2 = (SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS);

		ProjCategoryPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (ProjCategoryPeer::NUM_COLUMNS - ProjCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(SchoolprojectPeer::PROJ_CATEGORY_ID, ProjCategoryPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::YEAR_ID, YearPeer::ID, $join_behavior);

		$criteria->addJoin(SchoolprojectPeer::USER_ID, sfGuardUserPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SchoolprojectPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SchoolprojectPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = SchoolprojectPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				SchoolprojectPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj2 (ProjCategory)
				$obj2->addSchoolproject($obj1);

			} // if joined row is not null

				// Add objects for joined Year rows

				$key3 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = YearPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = YearPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					YearPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Schoolproject) to the collection in $obj3 (Year)
				$obj3->addSchoolproject($obj1);

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

				// Add the $obj1 (Schoolproject) to the collection in $obj4 (sfGuardUser)
				$obj4->addSchoolproject($obj1);

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
	  $dbMap = Propel::getDatabaseMap(BaseSchoolprojectPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseSchoolprojectPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new SchoolprojectTableMap());
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
		return $withPrefix ? SchoolprojectPeer::CLASS_DEFAULT : SchoolprojectPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Schoolproject or Criteria object.
	 *
	 * @param      mixed $values Criteria or Schoolproject object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Schoolproject object
		}

		if ($criteria->containsKey(SchoolprojectPeer::ID) && $criteria->keyContainsValue(SchoolprojectPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.SchoolprojectPeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a Schoolproject or Criteria object.
	 *
	 * @param      mixed $values Criteria or Schoolproject object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(SchoolprojectPeer::ID);
			$selectCriteria->add(SchoolprojectPeer::ID, $criteria->remove(SchoolprojectPeer::ID), $comparison);

		} else { // $values is Schoolproject object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the schoolproject table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(SchoolprojectPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			SchoolprojectPeer::clearInstancePool();
			SchoolprojectPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Schoolproject or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Schoolproject object or primary key or array of primary keys
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
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			SchoolprojectPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Schoolproject) { // it's a model object
			// invalidate the cache for this single object
			SchoolprojectPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchoolprojectPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				SchoolprojectPeer::removeInstanceFromPool($singleval);
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
			SchoolprojectPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Schoolproject object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Schoolproject $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Schoolproject $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchoolprojectPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchoolprojectPeer::TABLE_NAME);

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

		return BasePeer::doValidate(SchoolprojectPeer::DATABASE_NAME, SchoolprojectPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Schoolproject
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = SchoolprojectPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);
		$criteria->add(SchoolprojectPeer::ID, $pk);

		$v = SchoolprojectPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);
			$criteria->add(SchoolprojectPeer::ID, $pks, Criteria::IN);
			$objs = SchoolprojectPeer::doSelect($criteria, $con);
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

} // BaseSchoolprojectPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseSchoolprojectPeer::buildTableMap();

