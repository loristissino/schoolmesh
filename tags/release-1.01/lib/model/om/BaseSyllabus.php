<?php

/**
 * Base class that represents a row from the 'syllabus' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSyllabus extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SyllabusPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the version field.
	 * @var        string
	 */
	protected $version;

	/**
	 * The value for the author field.
	 * @var        string
	 */
	protected $author;

	/**
	 * The value for the href field.
	 * @var        string
	 */
	protected $href;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * @var        array SyllabusItem[] Collection to store aggregation of SyllabusItem objects.
	 */
	protected $collSyllabusItems;

	/**
	 * @var        Criteria The criteria used to select the current contents of collSyllabusItems.
	 */
	private $lastSyllabusItemCriteria = null;

	/**
	 * @var        array Appointment[] Collection to store aggregation of Appointment objects.
	 */
	protected $collAppointments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAppointments.
	 */
	private $lastAppointmentCriteria = null;

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
	
	const PEER = 'SyllabusPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_active = true;
	}

	/**
	 * Initializes internal state of BaseSyllabus object.
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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [version] column value.
	 * 
	 * @return     string
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * Get the [author] column value.
	 * 
	 * @return     string
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Get the [href] column value.
	 * 
	 * @return     string
	 */
	public function getHref()
	{
		return $this->href;
	}

	/**
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{
		return $this->is_active;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Syllabus The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SyllabusPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Syllabus The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SyllabusPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [version] column.
	 * 
	 * @param      string $v new value
	 * @return     Syllabus The current object (for fluent API support)
	 */
	public function setVersion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = SyllabusPeer::VERSION;
		}

		return $this;
	} // setVersion()

	/**
	 * Set the value of [author] column.
	 * 
	 * @param      string $v new value
	 * @return     Syllabus The current object (for fluent API support)
	 */
	public function setAuthor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author !== $v) {
			$this->author = $v;
			$this->modifiedColumns[] = SyllabusPeer::AUTHOR;
		}

		return $this;
	} // setAuthor()

	/**
	 * Set the value of [href] column.
	 * 
	 * @param      string $v new value
	 * @return     Syllabus The current object (for fluent API support)
	 */
	public function setHref($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->href !== $v) {
			$this->href = $v;
			$this->modifiedColumns[] = SyllabusPeer::HREF;
		}

		return $this;
	} // setHref()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Syllabus The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = SyllabusPeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

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
			if ($this->is_active !== true) {
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
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->version = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->author = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->href = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = SyllabusPeer::NUM_COLUMNS - SyllabusPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Syllabus object", $e);
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
			$con = Propel::getConnection(SyllabusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SyllabusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collSyllabusItems = null;
			$this->lastSyllabusItemCriteria = null;

			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

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
			$con = Propel::getConnection(SyllabusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SyllabusPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SyllabusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
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
				SyllabusPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SyllabusPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SyllabusPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SyllabusPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSyllabusItems !== null) {
				foreach ($this->collSyllabusItems as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAppointments !== null) {
				foreach ($this->collAppointments as $referrerFK) {
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


			if (($retval = SyllabusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSyllabusItems !== null) {
					foreach ($this->collSyllabusItems as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
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
		$pos = SyllabusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getVersion();
				break;
			case 3:
				return $this->getAuthor();
				break;
			case 4:
				return $this->getHref();
				break;
			case 5:
				return $this->getIsActive();
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
		$keys = SyllabusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getVersion(),
			$keys[3] => $this->getAuthor(),
			$keys[4] => $this->getHref(),
			$keys[5] => $this->getIsActive(),
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
		$pos = SyllabusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setVersion($value);
				break;
			case 3:
				$this->setAuthor($value);
				break;
			case 4:
				$this->setHref($value);
				break;
			case 5:
				$this->setIsActive($value);
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
		$keys = SyllabusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVersion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAuthor($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHref($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);

		if ($this->isColumnModified(SyllabusPeer::ID)) $criteria->add(SyllabusPeer::ID, $this->id);
		if ($this->isColumnModified(SyllabusPeer::NAME)) $criteria->add(SyllabusPeer::NAME, $this->name);
		if ($this->isColumnModified(SyllabusPeer::VERSION)) $criteria->add(SyllabusPeer::VERSION, $this->version);
		if ($this->isColumnModified(SyllabusPeer::AUTHOR)) $criteria->add(SyllabusPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(SyllabusPeer::HREF)) $criteria->add(SyllabusPeer::HREF, $this->href);
		if ($this->isColumnModified(SyllabusPeer::IS_ACTIVE)) $criteria->add(SyllabusPeer::IS_ACTIVE, $this->is_active);

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
		$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);

		$criteria->add(SyllabusPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Syllabus (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setVersion($this->version);

		$copyObj->setAuthor($this->author);

		$copyObj->setHref($this->href);

		$copyObj->setIsActive($this->is_active);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getSyllabusItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSyllabusItem($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAppointment($relObj->copy($deepCopy));
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
	 * @return     Syllabus Clone of current object.
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
	 * @return     SyllabusPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SyllabusPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collSyllabusItems collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSyllabusItems()
	 */
	public function clearSyllabusItems()
	{
		$this->collSyllabusItems = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSyllabusItems collection (array).
	 *
	 * By default this just sets the collSyllabusItems collection to an empty array (like clearcollSyllabusItems());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSyllabusItems()
	{
		$this->collSyllabusItems = array();
	}

	/**
	 * Gets an array of SyllabusItem objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Syllabus has previously been saved, it will retrieve
	 * related SyllabusItems from storage. If this Syllabus is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array SyllabusItem[]
	 * @throws     PropelException
	 */
	public function getSyllabusItems($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSyllabusItems === null) {
			if ($this->isNew()) {
			   $this->collSyllabusItems = array();
			} else {

				$criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->id);

				SyllabusItemPeer::addSelectColumns($criteria);
				$this->collSyllabusItems = SyllabusItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->id);

				SyllabusItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastSyllabusItemCriteria) || !$this->lastSyllabusItemCriteria->equals($criteria)) {
					$this->collSyllabusItems = SyllabusItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSyllabusItemCriteria = $criteria;
		return $this->collSyllabusItems;
	}

	/**
	 * Returns the number of related SyllabusItem objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SyllabusItem objects.
	 * @throws     PropelException
	 */
	public function countSyllabusItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSyllabusItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->id);

				$count = SyllabusItemPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->id);

				if (!isset($this->lastSyllabusItemCriteria) || !$this->lastSyllabusItemCriteria->equals($criteria)) {
					$count = SyllabusItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collSyllabusItems);
				}
			} else {
				$count = count($this->collSyllabusItems);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a SyllabusItem object to this object
	 * through the SyllabusItem foreign key attribute.
	 *
	 * @param      SyllabusItem $l SyllabusItem
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSyllabusItem(SyllabusItem $l)
	{
		if ($this->collSyllabusItems === null) {
			$this->initSyllabusItems();
		}
		if (!in_array($l, $this->collSyllabusItems, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSyllabusItems, $l);
			$l->setSyllabus($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related SyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getSyllabusItemsJoinSyllabusItemRelatedByParentId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collSyllabusItems = array();
			} else {

				$criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->id);

				$this->collSyllabusItems = SyllabusItemPeer::doSelectJoinSyllabusItemRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastSyllabusItemCriteria) || !$this->lastSyllabusItemCriteria->equals($criteria)) {
				$this->collSyllabusItems = SyllabusItemPeer::doSelectJoinSyllabusItemRelatedByParentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastSyllabusItemCriteria = $criteria;

		return $this->collSyllabusItems;
	}

	/**
	 * Clears out the collAppointments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAppointments()
	 */
	public function clearAppointments()
	{
		$this->collAppointments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAppointments collection (array).
	 *
	 * By default this just sets the collAppointments collection to an empty array (like clearcollAppointments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAppointments()
	{
		$this->collAppointments = array();
	}

	/**
	 * Gets an array of Appointment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Syllabus has previously been saved, it will retrieve
	 * related Appointments from storage. If this Syllabus is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Appointment[]
	 * @throws     PropelException
	 */
	public function getAppointments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAppointmentCriteria = $criteria;
		return $this->collAppointments;
	}

	/**
	 * Returns the number of related Appointment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Appointment objects.
	 * @throws     PropelException
	 */
	public function countAppointments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$count = AppointmentPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAppointments);
				}
			} else {
				$count = count($this->collAppointments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Appointment object to this object
	 * through the Appointment foreign key attribute.
	 *
	 * @param      Appointment $l Appointment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAppointment(Appointment $l)
	{
		if ($this->collAppointments === null) {
			$this->initAppointments();
		}
		if (!in_array($l, $this->collAppointments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAppointments, $l);
			$l->setSyllabus($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getAppointmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getAppointmentsJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getAppointmentsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Syllabus is new, it will return
	 * an empty collection; or if this Syllabus has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Syllabus.
	 */
	public function getAppointmentsJoinAppointmentType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinAppointmentType($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::SYLLABUS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinAppointmentType($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
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
			if ($this->collSyllabusItems) {
				foreach ((array) $this->collSyllabusItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAppointments) {
				foreach ((array) $this->collAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collSyllabusItems = null;
		$this->collAppointments = null;
	}

} // BaseSyllabus
