<?php

/**
 * Base class that represents a row from the 'attachment_file' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseAttachmentFile extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AttachmentFilePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the base_table field.
	 * @var        int
	 */
	protected $base_table;

	/**
	 * The value for the base_id field.
	 * @var        int
	 */
	protected $base_id;

	/**
	 * The value for the internet_media_type field.
	 * @var        string
	 */
	protected $internet_media_type;

	/**
	 * The value for the original_file_name field.
	 * @var        string
	 */
	protected $original_file_name;

	/**
	 * The value for the uniqid field.
	 * @var        string
	 */
	protected $uniqid;

	/**
	 * The value for the file_size field.
	 * @var        string
	 */
	protected $file_size;

	/**
	 * The value for the is_public field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_public;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the md5sum field.
	 * @var        string
	 */
	protected $md5sum;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        array Docrevision[] Collection to store aggregation of Docrevision objects.
	 */
	protected $collDocrevisionsRelatedBySourceAttachmentId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collDocrevisionsRelatedBySourceAttachmentId.
	 */
	private $lastDocrevisionRelatedBySourceAttachmentIdCriteria = null;

	/**
	 * @var        array Docrevision[] Collection to store aggregation of Docrevision objects.
	 */
	protected $collDocrevisionsRelatedByPublishedAttachmentId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collDocrevisionsRelatedByPublishedAttachmentId.
	 */
	private $lastDocrevisionRelatedByPublishedAttachmentIdCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'AttachmentFilePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_public = false;
	}

	/**
	 * Initializes internal state of BaseAttachmentFile object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [base_table] column value.
	 * 
	 * @return     int
	 */
	public function getBaseTable()
	{
		return $this->base_table;
	}

	/**
	 * Get the [base_id] column value.
	 * 
	 * @return     int
	 */
	public function getBaseId()
	{
		return $this->base_id;
	}

	/**
	 * Get the [internet_media_type] column value.
	 * 
	 * @return     string
	 */
	public function getInternetMediaType()
	{
		return $this->internet_media_type;
	}

	/**
	 * Get the [original_file_name] column value.
	 * 
	 * @return     string
	 */
	public function getOriginalFileName()
	{
		return $this->original_file_name;
	}

	/**
	 * Get the [uniqid] column value.
	 * 
	 * @return     string
	 */
	public function getUniqid()
	{
		return $this->uniqid;
	}

	/**
	 * Get the [file_size] column value.
	 * 
	 * @return     string
	 */
	public function getFileSize()
	{
		return $this->file_size;
	}

	/**
	 * Get the [is_public] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPublic()
	{
		return $this->is_public;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [md5sum] column value.
	 * 
	 * @return     string
	 */
	public function getMd5sum()
	{
		return $this->md5sum;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [base_table] column.
	 * 
	 * @param      int $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setBaseTable($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->base_table !== $v) {
			$this->base_table = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::BASE_TABLE;
		}

		return $this;
	} // setBaseTable()

	/**
	 * Set the value of [base_id] column.
	 * 
	 * @param      int $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setBaseId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->base_id !== $v) {
			$this->base_id = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::BASE_ID;
		}

		return $this;
	} // setBaseId()

	/**
	 * Set the value of [internet_media_type] column.
	 * 
	 * @param      string $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setInternetMediaType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->internet_media_type !== $v) {
			$this->internet_media_type = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::INTERNET_MEDIA_TYPE;
		}

		return $this;
	} // setInternetMediaType()

	/**
	 * Set the value of [original_file_name] column.
	 * 
	 * @param      string $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setOriginalFileName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->original_file_name !== $v) {
			$this->original_file_name = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::ORIGINAL_FILE_NAME;
		}

		return $this;
	} // setOriginalFileName()

	/**
	 * Set the value of [uniqid] column.
	 * 
	 * @param      string $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setUniqid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->uniqid !== $v) {
			$this->uniqid = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::UNIQID;
		}

		return $this;
	} // setUniqid()

	/**
	 * Set the value of [file_size] column.
	 * 
	 * @param      string $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setFileSize($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->file_size !== $v) {
			$this->file_size = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::FILE_SIZE;
		}

		return $this;
	} // setFileSize()

	/**
	 * Set the value of [is_public] column.
	 * 
	 * @param      boolean $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setIsPublic($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_public !== $v || $this->isNew()) {
			$this->is_public = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::IS_PUBLIC;
		}

		return $this;
	} // setIsPublic()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AttachmentFilePeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Set the value of [md5sum] column.
	 * 
	 * @param      string $v new value
	 * @return     AttachmentFile The current object (for fluent API support)
	 */
	public function setMd5sum($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->md5sum !== $v) {
			$this->md5sum = $v;
			$this->modifiedColumns[] = AttachmentFilePeer::MD5SUM;
		}

		return $this;
	} // setMd5sum()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->is_public !== false) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->base_table = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->base_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->internet_media_type = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->original_file_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->uniqid = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->file_size = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->is_public = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->md5sum = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = AttachmentFilePeer::NUM_COLUMNS - AttachmentFilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating AttachmentFile object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AttachmentFilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AttachmentFilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfGuardUser = null;
			$this->collDocrevisionsRelatedBySourceAttachmentId = null;
			$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria = null;

			$this->collDocrevisionsRelatedByPublishedAttachmentId = null;
			$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AttachmentFilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				AttachmentFilePeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AttachmentFilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_timestampable behavior
			
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(AttachmentFilePeer::CREATED_AT))
				{
				  $this->setCreatedAt(time());
				}

			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				AttachmentFilePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AttachmentFilePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AttachmentFilePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AttachmentFilePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDocrevisionsRelatedBySourceAttachmentId !== null) {
				foreach ($this->collDocrevisionsRelatedBySourceAttachmentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDocrevisionsRelatedByPublishedAttachmentId !== null) {
				foreach ($this->collDocrevisionsRelatedByPublishedAttachmentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = AttachmentFilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDocrevisionsRelatedBySourceAttachmentId !== null) {
					foreach ($this->collDocrevisionsRelatedBySourceAttachmentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDocrevisionsRelatedByPublishedAttachmentId !== null) {
					foreach ($this->collDocrevisionsRelatedByPublishedAttachmentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AttachmentFilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getBaseTable();
				break;
			case 3:
				return $this->getBaseId();
				break;
			case 4:
				return $this->getInternetMediaType();
				break;
			case 5:
				return $this->getOriginalFileName();
				break;
			case 6:
				return $this->getUniqid();
				break;
			case 7:
				return $this->getFileSize();
				break;
			case 8:
				return $this->getIsPublic();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getMd5sum();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AttachmentFilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getBaseTable(),
			$keys[3] => $this->getBaseId(),
			$keys[4] => $this->getInternetMediaType(),
			$keys[5] => $this->getOriginalFileName(),
			$keys[6] => $this->getUniqid(),
			$keys[7] => $this->getFileSize(),
			$keys[8] => $this->getIsPublic(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getMd5sum(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AttachmentFilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setBaseTable($value);
				break;
			case 3:
				$this->setBaseId($value);
				break;
			case 4:
				$this->setInternetMediaType($value);
				break;
			case 5:
				$this->setOriginalFileName($value);
				break;
			case 6:
				$this->setUniqid($value);
				break;
			case 7:
				$this->setFileSize($value);
				break;
			case 8:
				$this->setIsPublic($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setMd5sum($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AttachmentFilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBaseTable($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBaseId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setInternetMediaType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOriginalFileName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUniqid($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setFileSize($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsPublic($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMd5sum($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);

		if ($this->isColumnModified(AttachmentFilePeer::ID)) $criteria->add(AttachmentFilePeer::ID, $this->id);
		if ($this->isColumnModified(AttachmentFilePeer::USER_ID)) $criteria->add(AttachmentFilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(AttachmentFilePeer::BASE_TABLE)) $criteria->add(AttachmentFilePeer::BASE_TABLE, $this->base_table);
		if ($this->isColumnModified(AttachmentFilePeer::BASE_ID)) $criteria->add(AttachmentFilePeer::BASE_ID, $this->base_id);
		if ($this->isColumnModified(AttachmentFilePeer::INTERNET_MEDIA_TYPE)) $criteria->add(AttachmentFilePeer::INTERNET_MEDIA_TYPE, $this->internet_media_type);
		if ($this->isColumnModified(AttachmentFilePeer::ORIGINAL_FILE_NAME)) $criteria->add(AttachmentFilePeer::ORIGINAL_FILE_NAME, $this->original_file_name);
		if ($this->isColumnModified(AttachmentFilePeer::UNIQID)) $criteria->add(AttachmentFilePeer::UNIQID, $this->uniqid);
		if ($this->isColumnModified(AttachmentFilePeer::FILE_SIZE)) $criteria->add(AttachmentFilePeer::FILE_SIZE, $this->file_size);
		if ($this->isColumnModified(AttachmentFilePeer::IS_PUBLIC)) $criteria->add(AttachmentFilePeer::IS_PUBLIC, $this->is_public);
		if ($this->isColumnModified(AttachmentFilePeer::CREATED_AT)) $criteria->add(AttachmentFilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AttachmentFilePeer::MD5SUM)) $criteria->add(AttachmentFilePeer::MD5SUM, $this->md5sum);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);

		$criteria->add(AttachmentFilePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of AttachmentFile (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setBaseTable($this->base_table);

		$copyObj->setBaseId($this->base_id);

		$copyObj->setInternetMediaType($this->internet_media_type);

		$copyObj->setOriginalFileName($this->original_file_name);

		$copyObj->setUniqid($this->uniqid);

		$copyObj->setFileSize($this->file_size);

		$copyObj->setIsPublic($this->is_public);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setMd5sum($this->md5sum);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getDocrevisionsRelatedBySourceAttachmentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDocrevisionRelatedBySourceAttachmentId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getDocrevisionsRelatedByPublishedAttachmentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDocrevisionRelatedByPublishedAttachmentId($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     AttachmentFile Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     AttachmentFilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AttachmentFilePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     AttachmentFile The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addAttachmentFile($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfGuardUser object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfGuardUser The associated sfGuardUser object.
	 * @throws     PropelException
	 */
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$this->asfGuardUser = sfGuardUserPeer::retrieveByPk($this->user_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfGuardUser->addAttachmentFiles($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Clears out the collDocrevisionsRelatedBySourceAttachmentId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDocrevisionsRelatedBySourceAttachmentId()
	 */
	public function clearDocrevisionsRelatedBySourceAttachmentId()
	{
		$this->collDocrevisionsRelatedBySourceAttachmentId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDocrevisionsRelatedBySourceAttachmentId collection (array).
	 *
	 * By default this just sets the collDocrevisionsRelatedBySourceAttachmentId collection to an empty array (like clearcollDocrevisionsRelatedBySourceAttachmentId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initDocrevisionsRelatedBySourceAttachmentId()
	{
		$this->collDocrevisionsRelatedBySourceAttachmentId = array();
	}

	/**
	 * Gets an array of Docrevision objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AttachmentFile has previously been saved, it will retrieve
	 * related DocrevisionsRelatedBySourceAttachmentId from storage. If this AttachmentFile is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Docrevision[]
	 * @throws     PropelException
	 */
	public function getDocrevisionsRelatedBySourceAttachmentId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			if ($this->isNew()) {
			   $this->collDocrevisionsRelatedBySourceAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				DocrevisionPeer::addSelectColumns($criteria);
				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				DocrevisionPeer::addSelectColumns($criteria);
				if (!isset($this->lastDocrevisionRelatedBySourceAttachmentIdCriteria) || !$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria->equals($criteria)) {
					$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria = $criteria;
		return $this->collDocrevisionsRelatedBySourceAttachmentId;
	}

	/**
	 * Returns the number of related Docrevision objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Docrevision objects.
	 * @throws     PropelException
	 */
	public function countDocrevisionsRelatedBySourceAttachmentId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				$count = DocrevisionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				if (!isset($this->lastDocrevisionRelatedBySourceAttachmentIdCriteria) || !$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria->equals($criteria)) {
					$count = DocrevisionPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collDocrevisionsRelatedBySourceAttachmentId);
				}
			} else {
				$count = count($this->collDocrevisionsRelatedBySourceAttachmentId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Docrevision object to this object
	 * through the Docrevision foreign key attribute.
	 *
	 * @param      Docrevision $l Docrevision
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDocrevisionRelatedBySourceAttachmentId(Docrevision $l)
	{
		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			$this->initDocrevisionsRelatedBySourceAttachmentId();
		}
		if (!in_array($l, $this->collDocrevisionsRelatedBySourceAttachmentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collDocrevisionsRelatedBySourceAttachmentId, $l);
			$l->setAttachmentFileRelatedBySourceAttachmentId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedBySourceAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedBySourceAttachmentIdJoinDocument($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinDocument($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedBySourceAttachmentIdCriteria) || !$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinDocument($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedBySourceAttachmentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedBySourceAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedBySourceAttachmentIdJoinsfGuardUserRelatedByUploaderId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByUploaderId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedBySourceAttachmentIdCriteria) || !$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByUploaderId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedBySourceAttachmentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedBySourceAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedBySourceAttachmentIdJoinsfGuardUserRelatedByRevisionerId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByRevisionerId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedBySourceAttachmentIdCriteria) || !$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByRevisionerId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedBySourceAttachmentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedBySourceAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedBySourceAttachmentIdJoinsfGuardUserRelatedByApproverId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedBySourceAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByApproverId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedBySourceAttachmentIdCriteria) || !$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedBySourceAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByApproverId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedBySourceAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedBySourceAttachmentId;
	}

	/**
	 * Clears out the collDocrevisionsRelatedByPublishedAttachmentId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDocrevisionsRelatedByPublishedAttachmentId()
	 */
	public function clearDocrevisionsRelatedByPublishedAttachmentId()
	{
		$this->collDocrevisionsRelatedByPublishedAttachmentId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDocrevisionsRelatedByPublishedAttachmentId collection (array).
	 *
	 * By default this just sets the collDocrevisionsRelatedByPublishedAttachmentId collection to an empty array (like clearcollDocrevisionsRelatedByPublishedAttachmentId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initDocrevisionsRelatedByPublishedAttachmentId()
	{
		$this->collDocrevisionsRelatedByPublishedAttachmentId = array();
	}

	/**
	 * Gets an array of Docrevision objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AttachmentFile has previously been saved, it will retrieve
	 * related DocrevisionsRelatedByPublishedAttachmentId from storage. If this AttachmentFile is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Docrevision[]
	 * @throws     PropelException
	 */
	public function getDocrevisionsRelatedByPublishedAttachmentId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			if ($this->isNew()) {
			   $this->collDocrevisionsRelatedByPublishedAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				DocrevisionPeer::addSelectColumns($criteria);
				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				DocrevisionPeer::addSelectColumns($criteria);
				if (!isset($this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria) || !$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria->equals($criteria)) {
					$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria = $criteria;
		return $this->collDocrevisionsRelatedByPublishedAttachmentId;
	}

	/**
	 * Returns the number of related Docrevision objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Docrevision objects.
	 * @throws     PropelException
	 */
	public function countDocrevisionsRelatedByPublishedAttachmentId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				$count = DocrevisionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				if (!isset($this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria) || !$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria->equals($criteria)) {
					$count = DocrevisionPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collDocrevisionsRelatedByPublishedAttachmentId);
				}
			} else {
				$count = count($this->collDocrevisionsRelatedByPublishedAttachmentId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Docrevision object to this object
	 * through the Docrevision foreign key attribute.
	 *
	 * @param      Docrevision $l Docrevision
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDocrevisionRelatedByPublishedAttachmentId(Docrevision $l)
	{
		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			$this->initDocrevisionsRelatedByPublishedAttachmentId();
		}
		if (!in_array($l, $this->collDocrevisionsRelatedByPublishedAttachmentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collDocrevisionsRelatedByPublishedAttachmentId, $l);
			$l->setAttachmentFileRelatedByPublishedAttachmentId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedByPublishedAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedByPublishedAttachmentIdJoinDocument($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinDocument($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria) || !$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinDocument($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedByPublishedAttachmentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedByPublishedAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedByPublishedAttachmentIdJoinsfGuardUserRelatedByUploaderId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByUploaderId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria) || !$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByUploaderId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedByPublishedAttachmentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedByPublishedAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedByPublishedAttachmentIdJoinsfGuardUserRelatedByRevisionerId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByRevisionerId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria) || !$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByRevisionerId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedByPublishedAttachmentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AttachmentFile is new, it will return
	 * an empty collection; or if this AttachmentFile has previously
	 * been saved, it will retrieve related DocrevisionsRelatedByPublishedAttachmentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AttachmentFile.
	 */
	public function getDocrevisionsRelatedByPublishedAttachmentIdJoinsfGuardUserRelatedByApproverId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AttachmentFilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisionsRelatedByPublishedAttachmentId === null) {
			if ($this->isNew()) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = array();
			} else {

				$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByApproverId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria) || !$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria->equals($criteria)) {
				$this->collDocrevisionsRelatedByPublishedAttachmentId = DocrevisionPeer::doSelectJoinsfGuardUserRelatedByApproverId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionRelatedByPublishedAttachmentIdCriteria = $criteria;

		return $this->collDocrevisionsRelatedByPublishedAttachmentId;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collDocrevisionsRelatedBySourceAttachmentId) {
				foreach ((array) $this->collDocrevisionsRelatedBySourceAttachmentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collDocrevisionsRelatedByPublishedAttachmentId) {
				foreach ((array) $this->collDocrevisionsRelatedByPublishedAttachmentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collDocrevisionsRelatedBySourceAttachmentId = null;
		$this->collDocrevisionsRelatedByPublishedAttachmentId = null;
			$this->asfGuardUser = null;
	}

} // BaseAttachmentFile
