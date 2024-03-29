<?php

/**
 * Base static class for performing query and update operations on the 'docrevision' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseDocrevisionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'docrevision';

	/** the related Propel class for this table */
	const OM_CLASS = 'Docrevision';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Docrevision';

	/** the related TableMap class for this table */
	const TM_CLASS = 'DocrevisionTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'docrevision.ID';

	/** the column name for the DOCUMENT_ID field */
	const DOCUMENT_ID = 'docrevision.DOCUMENT_ID';

	/** the column name for the TITLE field */
	const TITLE = 'docrevision.TITLE';

	/** the column name for the REVISION_NUMBER field */
	const REVISION_NUMBER = 'docrevision.REVISION_NUMBER';

	/** the column name for the REVISIONED_AT field */
	const REVISIONED_AT = 'docrevision.REVISIONED_AT';

	/** the column name for the UPLOADER_ID field */
	const UPLOADER_ID = 'docrevision.UPLOADER_ID';

	/** the column name for the REVISIONER_ID field */
	const REVISIONER_ID = 'docrevision.REVISIONER_ID';

	/** the column name for the APPROVED_AT field */
	const APPROVED_AT = 'docrevision.APPROVED_AT';

	/** the column name for the APPROVER_ID field */
	const APPROVER_ID = 'docrevision.APPROVER_ID';

	/** the column name for the REVISION_GROUNDS field */
	const REVISION_GROUNDS = 'docrevision.REVISION_GROUNDS';

	/** the column name for the CONTENT field */
	const CONTENT = 'docrevision.CONTENT';

	/** the column name for the CONTENT_TYPE field */
	const CONTENT_TYPE = 'docrevision.CONTENT_TYPE';

	/** the column name for the SOURCE_ATTACHMENT_ID field */
	const SOURCE_ATTACHMENT_ID = 'docrevision.SOURCE_ATTACHMENT_ID';

	/** the column name for the PUBLISHED_ATTACHMENT_ID field */
	const PUBLISHED_ATTACHMENT_ID = 'docrevision.PUBLISHED_ATTACHMENT_ID';

	/**
	 * An identiy map to hold any loaded instances of Docrevision objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Docrevision[]
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
		BasePeer::TYPE_PHPNAME => array ('Id', 'DocumentId', 'Title', 'RevisionNumber', 'RevisionedAt', 'UploaderId', 'RevisionerId', 'ApprovedAt', 'ApproverId', 'RevisionGrounds', 'Content', 'ContentType', 'SourceAttachmentId', 'PublishedAttachmentId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'documentId', 'title', 'revisionNumber', 'revisionedAt', 'uploaderId', 'revisionerId', 'approvedAt', 'approverId', 'revisionGrounds', 'content', 'contentType', 'sourceAttachmentId', 'publishedAttachmentId', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::DOCUMENT_ID, self::TITLE, self::REVISION_NUMBER, self::REVISIONED_AT, self::UPLOADER_ID, self::REVISIONER_ID, self::APPROVED_AT, self::APPROVER_ID, self::REVISION_GROUNDS, self::CONTENT, self::CONTENT_TYPE, self::SOURCE_ATTACHMENT_ID, self::PUBLISHED_ATTACHMENT_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'document_id', 'title', 'revision_number', 'revisioned_at', 'uploader_id', 'revisioner_id', 'approved_at', 'approver_id', 'revision_grounds', 'content', 'content_type', 'source_attachment_id', 'published_attachment_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DocumentId' => 1, 'Title' => 2, 'RevisionNumber' => 3, 'RevisionedAt' => 4, 'UploaderId' => 5, 'RevisionerId' => 6, 'ApprovedAt' => 7, 'ApproverId' => 8, 'RevisionGrounds' => 9, 'Content' => 10, 'ContentType' => 11, 'SourceAttachmentId' => 12, 'PublishedAttachmentId' => 13, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'documentId' => 1, 'title' => 2, 'revisionNumber' => 3, 'revisionedAt' => 4, 'uploaderId' => 5, 'revisionerId' => 6, 'approvedAt' => 7, 'approverId' => 8, 'revisionGrounds' => 9, 'content' => 10, 'contentType' => 11, 'sourceAttachmentId' => 12, 'publishedAttachmentId' => 13, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::DOCUMENT_ID => 1, self::TITLE => 2, self::REVISION_NUMBER => 3, self::REVISIONED_AT => 4, self::UPLOADER_ID => 5, self::REVISIONER_ID => 6, self::APPROVED_AT => 7, self::APPROVER_ID => 8, self::REVISION_GROUNDS => 9, self::CONTENT => 10, self::CONTENT_TYPE => 11, self::SOURCE_ATTACHMENT_ID => 12, self::PUBLISHED_ATTACHMENT_ID => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'document_id' => 1, 'title' => 2, 'revision_number' => 3, 'revisioned_at' => 4, 'uploader_id' => 5, 'revisioner_id' => 6, 'approved_at' => 7, 'approver_id' => 8, 'revision_grounds' => 9, 'content' => 10, 'content_type' => 11, 'source_attachment_id' => 12, 'published_attachment_id' => 13, ),
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
	 * @param      string $column The column name for current table. (i.e. DocrevisionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(DocrevisionPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(DocrevisionPeer::ID);
		$criteria->addSelectColumn(DocrevisionPeer::DOCUMENT_ID);
		$criteria->addSelectColumn(DocrevisionPeer::TITLE);
		$criteria->addSelectColumn(DocrevisionPeer::REVISION_NUMBER);
		$criteria->addSelectColumn(DocrevisionPeer::REVISIONED_AT);
		$criteria->addSelectColumn(DocrevisionPeer::UPLOADER_ID);
		$criteria->addSelectColumn(DocrevisionPeer::REVISIONER_ID);
		$criteria->addSelectColumn(DocrevisionPeer::APPROVED_AT);
		$criteria->addSelectColumn(DocrevisionPeer::APPROVER_ID);
		$criteria->addSelectColumn(DocrevisionPeer::REVISION_GROUNDS);
		$criteria->addSelectColumn(DocrevisionPeer::CONTENT);
		$criteria->addSelectColumn(DocrevisionPeer::CONTENT_TYPE);
		$criteria->addSelectColumn(DocrevisionPeer::SOURCE_ATTACHMENT_ID);
		$criteria->addSelectColumn(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID);
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
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Docrevision
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DocrevisionPeer::doSelect($critcopy, $con);
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
		return DocrevisionPeer::populateObjects(DocrevisionPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			DocrevisionPeer::addSelectColumns($criteria);
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
	 * @param      Docrevision $value A Docrevision object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Docrevision $obj, $key = null)
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
	 * @param      mixed $value A Docrevision object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Docrevision) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Docrevision object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Docrevision Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to docrevision
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
		$cls = DocrevisionPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = DocrevisionPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				DocrevisionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Document table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinDocument(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUserRelatedByUploaderId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfGuardUserRelatedByUploaderId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUserRelatedByRevisionerId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfGuardUserRelatedByRevisionerId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUserRelatedByApproverId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfGuardUserRelatedByApproverId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related AttachmentFileRelatedBySourceAttachmentId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAttachmentFileRelatedBySourceAttachmentId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related AttachmentFileRelatedByPublishedAttachmentId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAttachmentFileRelatedByPublishedAttachmentId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Selects a collection of Docrevision objects pre-filled with their Document objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinDocument(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);
		DocumentPeer::addSelectColumns($criteria);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = DocumentPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Docrevision) to $obj2 (Document)
				$obj2->addDocrevision($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfGuardUserRelatedByUploaderId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Docrevision) to $obj2 (sfGuardUser)
				$obj2->addDocrevisionRelatedByUploaderId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfGuardUserRelatedByRevisionerId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Docrevision) to $obj2 (sfGuardUser)
				$obj2->addDocrevisionRelatedByRevisionerId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfGuardUserRelatedByApproverId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($criteria);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
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
				
				// Add the $obj1 (Docrevision) to $obj2 (sfGuardUser)
				$obj2->addDocrevisionRelatedByApproverId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with their AttachmentFile objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAttachmentFileRelatedBySourceAttachmentId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);
		AttachmentFilePeer::addSelectColumns($criteria);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AttachmentFilePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = AttachmentFilePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AttachmentFilePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Docrevision) to $obj2 (AttachmentFile)
				$obj2->addDocrevisionRelatedBySourceAttachmentId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with their AttachmentFile objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAttachmentFileRelatedByPublishedAttachmentId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);
		AttachmentFilePeer::addSelectColumns($criteria);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AttachmentFilePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = AttachmentFilePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AttachmentFilePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded
				
				// Add the $obj1 (Docrevision) to $obj2 (AttachmentFile)
				$obj2->addDocrevisionRelatedByPublishedAttachmentId($obj1);

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
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Selects a collection of Docrevision objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
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

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		DocumentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol8 = $startcol7 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Document rows

			$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = DocumentPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Docrevision) to the collection in $obj2 (Document)
				$obj2->addDocrevision($obj1);
			} // if joined row not null

			// Add objects for joined sfGuardUser rows

			$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = sfGuardUserPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (Docrevision) to the collection in $obj3 (sfGuardUser)
				$obj3->addDocrevisionRelatedByUploaderId($obj1);
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

				// Add the $obj1 (Docrevision) to the collection in $obj4 (sfGuardUser)
				$obj4->addDocrevisionRelatedByRevisionerId($obj1);
			} // if joined row not null

			// Add objects for joined sfGuardUser rows

			$key5 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = sfGuardUserPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$cls = sfGuardUserPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					sfGuardUserPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (Docrevision) to the collection in $obj5 (sfGuardUser)
				$obj5->addDocrevisionRelatedByApproverId($obj1);
			} // if joined row not null

			// Add objects for joined AttachmentFile rows

			$key6 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol6);
			if ($key6 !== null) {
				$obj6 = AttachmentFilePeer::getInstanceFromPool($key6);
				if (!$obj6) {

					$cls = AttachmentFilePeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					AttachmentFilePeer::addInstanceToPool($obj6, $key6);
				} // if obj6 loaded

				// Add the $obj1 (Docrevision) to the collection in $obj6 (AttachmentFile)
				$obj6->addDocrevisionRelatedBySourceAttachmentId($obj1);
			} // if joined row not null

			// Add objects for joined AttachmentFile rows

			$key7 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol7);
			if ($key7 !== null) {
				$obj7 = AttachmentFilePeer::getInstanceFromPool($key7);
				if (!$obj7) {

					$cls = AttachmentFilePeer::getOMClass(false);

					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					AttachmentFilePeer::addInstanceToPool($obj7, $key7);
				} // if obj7 loaded

				// Add the $obj1 (Docrevision) to the collection in $obj7 (AttachmentFile)
				$obj7->addDocrevisionRelatedByPublishedAttachmentId($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Document table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptDocument(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUserRelatedByUploaderId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfGuardUserRelatedByUploaderId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUserRelatedByRevisionerId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfGuardUserRelatedByRevisionerId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related sfGuardUserRelatedByApproverId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfGuardUserRelatedByApproverId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related AttachmentFileRelatedBySourceAttachmentId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAttachmentFileRelatedBySourceAttachmentId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related AttachmentFileRelatedByPublishedAttachmentId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAttachmentFileRelatedByPublishedAttachmentId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(DocrevisionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			DocrevisionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

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
	 * Selects a collection of Docrevision objects pre-filled with all related objects except Document.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptDocument(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Docrevision) to the collection in $obj2 (sfGuardUser)
				$obj2->addDocrevisionRelatedByUploaderId($obj1);

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

				// Add the $obj1 (Docrevision) to the collection in $obj3 (sfGuardUser)
				$obj3->addDocrevisionRelatedByRevisionerId($obj1);

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

				// Add the $obj1 (Docrevision) to the collection in $obj4 (sfGuardUser)
				$obj4->addDocrevisionRelatedByApproverId($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key5 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AttachmentFilePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AttachmentFilePeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj5 (AttachmentFile)
				$obj5->addDocrevisionRelatedBySourceAttachmentId($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key6 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = AttachmentFilePeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					AttachmentFilePeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj6 (AttachmentFile)
				$obj6->addDocrevisionRelatedByPublishedAttachmentId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with all related objects except sfGuardUserRelatedByUploaderId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfGuardUserRelatedByUploaderId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		DocumentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Document rows

				$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = DocumentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj2 (Document)
				$obj2->addDocrevision($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key3 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = AttachmentFilePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AttachmentFilePeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj3 (AttachmentFile)
				$obj3->addDocrevisionRelatedBySourceAttachmentId($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key4 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AttachmentFilePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AttachmentFilePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj4 (AttachmentFile)
				$obj4->addDocrevisionRelatedByPublishedAttachmentId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with all related objects except sfGuardUserRelatedByRevisionerId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfGuardUserRelatedByRevisionerId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		DocumentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Document rows

				$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = DocumentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj2 (Document)
				$obj2->addDocrevision($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key3 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = AttachmentFilePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AttachmentFilePeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj3 (AttachmentFile)
				$obj3->addDocrevisionRelatedBySourceAttachmentId($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key4 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AttachmentFilePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AttachmentFilePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj4 (AttachmentFile)
				$obj4->addDocrevisionRelatedByPublishedAttachmentId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with all related objects except sfGuardUserRelatedByApproverId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfGuardUserRelatedByApproverId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		DocumentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		AttachmentFilePeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::SOURCE_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, AttachmentFilePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Document rows

				$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = DocumentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj2 (Document)
				$obj2->addDocrevision($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key3 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = AttachmentFilePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AttachmentFilePeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj3 (AttachmentFile)
				$obj3->addDocrevisionRelatedBySourceAttachmentId($obj1);

			} // if joined row is not null

				// Add objects for joined AttachmentFile rows

				$key4 = AttachmentFilePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AttachmentFilePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = AttachmentFilePeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AttachmentFilePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj4 (AttachmentFile)
				$obj4->addDocrevisionRelatedByPublishedAttachmentId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with all related objects except AttachmentFileRelatedBySourceAttachmentId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAttachmentFileRelatedBySourceAttachmentId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		DocumentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Document rows

				$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = DocumentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj2 (Document)
				$obj2->addDocrevision($obj1);

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

				// Add the $obj1 (Docrevision) to the collection in $obj3 (sfGuardUser)
				$obj3->addDocrevisionRelatedByUploaderId($obj1);

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

				// Add the $obj1 (Docrevision) to the collection in $obj4 (sfGuardUser)
				$obj4->addDocrevisionRelatedByRevisionerId($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key5 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = sfGuardUserPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					sfGuardUserPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj5 (sfGuardUser)
				$obj5->addDocrevisionRelatedByApproverId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Docrevision objects pre-filled with all related objects except AttachmentFileRelatedByPublishedAttachmentId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Docrevision objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAttachmentFileRelatedByPublishedAttachmentId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		DocrevisionPeer::addSelectColumns($criteria);
		$startcol2 = (DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS);

		DocumentPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(DocrevisionPeer::DOCUMENT_ID, DocumentPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::UPLOADER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::REVISIONER_ID, sfGuardUserPeer::ID, $join_behavior);

		$criteria->addJoin(DocrevisionPeer::APPROVER_ID, sfGuardUserPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = DocrevisionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = DocrevisionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = DocrevisionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				DocrevisionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Document rows

				$key2 = DocumentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = DocumentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = DocumentPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DocumentPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj2 (Document)
				$obj2->addDocrevision($obj1);

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

				// Add the $obj1 (Docrevision) to the collection in $obj3 (sfGuardUser)
				$obj3->addDocrevisionRelatedByUploaderId($obj1);

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

				// Add the $obj1 (Docrevision) to the collection in $obj4 (sfGuardUser)
				$obj4->addDocrevisionRelatedByRevisionerId($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key5 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = sfGuardUserPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = sfGuardUserPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					sfGuardUserPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Docrevision) to the collection in $obj5 (sfGuardUser)
				$obj5->addDocrevisionRelatedByApproverId($obj1);

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
	  $dbMap = Propel::getDatabaseMap(BaseDocrevisionPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseDocrevisionPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new DocrevisionTableMap());
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
		return $withPrefix ? DocrevisionPeer::CLASS_DEFAULT : DocrevisionPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Docrevision or Criteria object.
	 *
	 * @param      mixed $values Criteria or Docrevision object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Docrevision object
		}

		if ($criteria->containsKey(DocrevisionPeer::ID) && $criteria->keyContainsValue(DocrevisionPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.DocrevisionPeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a Docrevision or Criteria object.
	 *
	 * @param      mixed $values Criteria or Docrevision object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(DocrevisionPeer::ID);
			$selectCriteria->add(DocrevisionPeer::ID, $criteria->remove(DocrevisionPeer::ID), $comparison);

		} else { // $values is Docrevision object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the docrevision table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(DocrevisionPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			DocrevisionPeer::clearInstancePool();
			DocrevisionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Docrevision or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Docrevision object or primary key or array of primary keys
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
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			DocrevisionPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Docrevision) { // it's a model object
			// invalidate the cache for this single object
			DocrevisionPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DocrevisionPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				DocrevisionPeer::removeInstanceFromPool($singleval);
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
			DocrevisionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Docrevision object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Docrevision $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Docrevision $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DocrevisionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DocrevisionPeer::TABLE_NAME);

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

		return BasePeer::doValidate(DocrevisionPeer::DATABASE_NAME, DocrevisionPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Docrevision
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = DocrevisionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);
		$criteria->add(DocrevisionPeer::ID, $pk);

		$v = DocrevisionPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);
			$criteria->add(DocrevisionPeer::ID, $pks, Criteria::IN);
			$objs = DocrevisionPeer::doSelect($criteria, $con);
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

} // BaseDocrevisionPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseDocrevisionPeer::buildTableMap();

