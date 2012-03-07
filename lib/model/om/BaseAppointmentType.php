<?php

/**
 * Base class that represents a row from the 'appointment_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseAppointmentType extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AppointmentTypePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the has_info field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $has_info;

	/**
	 * The value for the has_modules field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $has_modules;

	/**
	 * The value for the has_tools field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $has_tools;

	/**
	 * @var        array Appointment[] Collection to store aggregation of Appointment objects.
	 */
	protected $collAppointments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAppointments.
	 */
	private $lastAppointmentCriteria = null;

	/**
	 * @var        array WpinfoType[] Collection to store aggregation of WpinfoType objects.
	 */
	protected $collWpinfoTypes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWpinfoTypes.
	 */
	private $lastWpinfoTypeCriteria = null;

	/**
	 * @var        array WptoolItemType[] Collection to store aggregation of WptoolItemType objects.
	 */
	protected $collWptoolItemTypes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWptoolItemTypes.
	 */
	private $lastWptoolItemTypeCriteria = null;

	/**
	 * @var        array WpitemType[] Collection to store aggregation of WpitemType objects.
	 */
	protected $collWpitemTypes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWpitemTypes.
	 */
	private $lastWpitemTypeCriteria = null;

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
	
	const PEER = 'AppointmentTypePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_active = true;
		$this->has_info = false;
		$this->has_modules = false;
		$this->has_tools = false;
	}

	/**
	 * Initializes internal state of BaseAppointmentType object.
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
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [rank] column value.
	 * 
	 * @return     int
	 */
	public function getRank()
	{
		return $this->rank;
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
	 * Get the [has_info] column value.
	 * 
	 * @return     boolean
	 */
	public function getHasInfo()
	{
		return $this->has_info;
	}

	/**
	 * Get the [has_modules] column value.
	 * 
	 * @return     boolean
	 */
	public function getHasModules()
	{
		return $this->has_modules;
	}

	/**
	 * Get the [has_tools] column value.
	 * 
	 * @return     boolean
	 */
	public function getHasTools()
	{
		return $this->has_tools;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [rank] column.
	 * 
	 * @param      int $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setRank($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::RANK;
		}

		return $this;
	} // setRank()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [has_info] column.
	 * 
	 * @param      boolean $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setHasInfo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->has_info !== $v || $this->isNew()) {
			$this->has_info = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::HAS_INFO;
		}

		return $this;
	} // setHasInfo()

	/**
	 * Set the value of [has_modules] column.
	 * 
	 * @param      boolean $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setHasModules($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->has_modules !== $v || $this->isNew()) {
			$this->has_modules = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::HAS_MODULES;
		}

		return $this;
	} // setHasModules()

	/**
	 * Set the value of [has_tools] column.
	 * 
	 * @param      boolean $v new value
	 * @return     AppointmentType The current object (for fluent API support)
	 */
	public function setHasTools($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->has_tools !== $v || $this->isNew()) {
			$this->has_tools = $v;
			$this->modifiedColumns[] = AppointmentTypePeer::HAS_TOOLS;
		}

		return $this;
	} // setHasTools()

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

			if ($this->has_info !== false) {
				return false;
			}

			if ($this->has_modules !== false) {
				return false;
			}

			if ($this->has_tools !== false) {
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
			$this->description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->rank = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->is_active = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->has_info = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->has_modules = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->has_tools = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = AppointmentTypePeer::NUM_COLUMNS - AppointmentTypePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating AppointmentType object", $e);
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
			$con = Propel::getConnection(AppointmentTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AppointmentTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

			$this->collWpinfoTypes = null;
			$this->lastWpinfoTypeCriteria = null;

			$this->collWptoolItemTypes = null;
			$this->lastWptoolItemTypeCriteria = null;

			$this->collWpitemTypes = null;
			$this->lastWpitemTypeCriteria = null;

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
			$con = Propel::getConnection(AppointmentTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				AppointmentTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AppointmentTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				AppointmentTypePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = AppointmentTypePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AppointmentTypePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AppointmentTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAppointments !== null) {
				foreach ($this->collAppointments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWpinfoTypes !== null) {
				foreach ($this->collWpinfoTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWptoolItemTypes !== null) {
				foreach ($this->collWptoolItemTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWpitemTypes !== null) {
				foreach ($this->collWpitemTypes as $referrerFK) {
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


			if (($retval = AppointmentTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWpinfoTypes !== null) {
					foreach ($this->collWpinfoTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWptoolItemTypes !== null) {
					foreach ($this->collWptoolItemTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWpitemTypes !== null) {
					foreach ($this->collWpitemTypes as $referrerFK) {
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
		$pos = AppointmentTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescription();
				break;
			case 2:
				return $this->getRank();
				break;
			case 3:
				return $this->getIsActive();
				break;
			case 4:
				return $this->getHasInfo();
				break;
			case 5:
				return $this->getHasModules();
				break;
			case 6:
				return $this->getHasTools();
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
		$keys = AppointmentTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getRank(),
			$keys[3] => $this->getIsActive(),
			$keys[4] => $this->getHasInfo(),
			$keys[5] => $this->getHasModules(),
			$keys[6] => $this->getHasTools(),
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
		$pos = AppointmentTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDescription($value);
				break;
			case 2:
				$this->setRank($value);
				break;
			case 3:
				$this->setIsActive($value);
				break;
			case 4:
				$this->setHasInfo($value);
				break;
			case 5:
				$this->setHasModules($value);
				break;
			case 6:
				$this->setHasTools($value);
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
		$keys = AppointmentTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsActive($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHasInfo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHasModules($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHasTools($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(AppointmentTypePeer::ID)) $criteria->add(AppointmentTypePeer::ID, $this->id);
		if ($this->isColumnModified(AppointmentTypePeer::DESCRIPTION)) $criteria->add(AppointmentTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(AppointmentTypePeer::RANK)) $criteria->add(AppointmentTypePeer::RANK, $this->rank);
		if ($this->isColumnModified(AppointmentTypePeer::IS_ACTIVE)) $criteria->add(AppointmentTypePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(AppointmentTypePeer::HAS_INFO)) $criteria->add(AppointmentTypePeer::HAS_INFO, $this->has_info);
		if ($this->isColumnModified(AppointmentTypePeer::HAS_MODULES)) $criteria->add(AppointmentTypePeer::HAS_MODULES, $this->has_modules);
		if ($this->isColumnModified(AppointmentTypePeer::HAS_TOOLS)) $criteria->add(AppointmentTypePeer::HAS_TOOLS, $this->has_tools);

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
		$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);

		$criteria->add(AppointmentTypePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of AppointmentType (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDescription($this->description);

		$copyObj->setRank($this->rank);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setHasInfo($this->has_info);

		$copyObj->setHasModules($this->has_modules);

		$copyObj->setHasTools($this->has_tools);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAppointment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpinfoTypes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWpinfoType($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWptoolItemTypes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWptoolItemType($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpitemTypes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWpitemType($relObj->copy($deepCopy));
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
	 * @return     AppointmentType Clone of current object.
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
	 * @return     AppointmentTypePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AppointmentTypePeer();
		}
		return self::$peer;
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
	 * Otherwise if this AppointmentType has previously been saved, it will retrieve
	 * related Appointments from storage. If this AppointmentType is new, it will return
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
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
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

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
			$l->setAppointmentType($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this AppointmentType is new, it will return
	 * an empty collection; or if this AppointmentType has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AppointmentType.
	 */
	public function getAppointmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
	 * Otherwise if this AppointmentType is new, it will return
	 * an empty collection; or if this AppointmentType has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AppointmentType.
	 */
	public function getAppointmentsJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
	 * Otherwise if this AppointmentType is new, it will return
	 * an empty collection; or if this AppointmentType has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AppointmentType.
	 */
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
	 * Otherwise if this AppointmentType is new, it will return
	 * an empty collection; or if this AppointmentType has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AppointmentType.
	 */
	public function getAppointmentsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
	 * Otherwise if this AppointmentType is new, it will return
	 * an empty collection; or if this AppointmentType has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AppointmentType.
	 */
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

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
	 * Otherwise if this AppointmentType is new, it will return
	 * an empty collection; or if this AppointmentType has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in AppointmentType.
	 */
	public function getAppointmentsJoinSyllabus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}

	/**
	 * Clears out the collWpinfoTypes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWpinfoTypes()
	 */
	public function clearWpinfoTypes()
	{
		$this->collWpinfoTypes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWpinfoTypes collection (array).
	 *
	 * By default this just sets the collWpinfoTypes collection to an empty array (like clearcollWpinfoTypes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWpinfoTypes()
	{
		$this->collWpinfoTypes = array();
	}

	/**
	 * Gets an array of WpinfoType objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AppointmentType has previously been saved, it will retrieve
	 * related WpinfoTypes from storage. If this AppointmentType is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WpinfoType[]
	 * @throws     PropelException
	 */
	public function getWpinfoTypes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpinfoTypes === null) {
			if ($this->isNew()) {
			   $this->collWpinfoTypes = array();
			} else {

				$criteria->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				WpinfoTypePeer::addSelectColumns($criteria);
				$this->collWpinfoTypes = WpinfoTypePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				WpinfoTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastWpinfoTypeCriteria) || !$this->lastWpinfoTypeCriteria->equals($criteria)) {
					$this->collWpinfoTypes = WpinfoTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpinfoTypeCriteria = $criteria;
		return $this->collWpinfoTypes;
	}

	/**
	 * Returns the number of related WpinfoType objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WpinfoType objects.
	 * @throws     PropelException
	 */
	public function countWpinfoTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpinfoTypes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				$count = WpinfoTypePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WpinfoTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				if (!isset($this->lastWpinfoTypeCriteria) || !$this->lastWpinfoTypeCriteria->equals($criteria)) {
					$count = WpinfoTypePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWpinfoTypes);
				}
			} else {
				$count = count($this->collWpinfoTypes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WpinfoType object to this object
	 * through the WpinfoType foreign key attribute.
	 *
	 * @param      WpinfoType $l WpinfoType
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWpinfoType(WpinfoType $l)
	{
		if ($this->collWpinfoTypes === null) {
			$this->initWpinfoTypes();
		}
		if (!in_array($l, $this->collWpinfoTypes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWpinfoTypes, $l);
			$l->setAppointmentType($this);
		}
	}

	/**
	 * Clears out the collWptoolItemTypes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWptoolItemTypes()
	 */
	public function clearWptoolItemTypes()
	{
		$this->collWptoolItemTypes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWptoolItemTypes collection (array).
	 *
	 * By default this just sets the collWptoolItemTypes collection to an empty array (like clearcollWptoolItemTypes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWptoolItemTypes()
	{
		$this->collWptoolItemTypes = array();
	}

	/**
	 * Gets an array of WptoolItemType objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AppointmentType has previously been saved, it will retrieve
	 * related WptoolItemTypes from storage. If this AppointmentType is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WptoolItemType[]
	 * @throws     PropelException
	 */
	public function getWptoolItemTypes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWptoolItemTypes === null) {
			if ($this->isNew()) {
			   $this->collWptoolItemTypes = array();
			} else {

				$criteria->add(WptoolItemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				WptoolItemTypePeer::addSelectColumns($criteria);
				$this->collWptoolItemTypes = WptoolItemTypePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WptoolItemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				WptoolItemTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastWptoolItemTypeCriteria) || !$this->lastWptoolItemTypeCriteria->equals($criteria)) {
					$this->collWptoolItemTypes = WptoolItemTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWptoolItemTypeCriteria = $criteria;
		return $this->collWptoolItemTypes;
	}

	/**
	 * Returns the number of related WptoolItemType objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WptoolItemType objects.
	 * @throws     PropelException
	 */
	public function countWptoolItemTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWptoolItemTypes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WptoolItemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				$count = WptoolItemTypePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WptoolItemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				if (!isset($this->lastWptoolItemTypeCriteria) || !$this->lastWptoolItemTypeCriteria->equals($criteria)) {
					$count = WptoolItemTypePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWptoolItemTypes);
				}
			} else {
				$count = count($this->collWptoolItemTypes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WptoolItemType object to this object
	 * through the WptoolItemType foreign key attribute.
	 *
	 * @param      WptoolItemType $l WptoolItemType
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWptoolItemType(WptoolItemType $l)
	{
		if ($this->collWptoolItemTypes === null) {
			$this->initWptoolItemTypes();
		}
		if (!in_array($l, $this->collWptoolItemTypes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWptoolItemTypes, $l);
			$l->setAppointmentType($this);
		}
	}

	/**
	 * Clears out the collWpitemTypes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWpitemTypes()
	 */
	public function clearWpitemTypes()
	{
		$this->collWpitemTypes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWpitemTypes collection (array).
	 *
	 * By default this just sets the collWpitemTypes collection to an empty array (like clearcollWpitemTypes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWpitemTypes()
	{
		$this->collWpitemTypes = array();
	}

	/**
	 * Gets an array of WpitemType objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AppointmentType has previously been saved, it will retrieve
	 * related WpitemTypes from storage. If this AppointmentType is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WpitemType[]
	 * @throws     PropelException
	 */
	public function getWpitemTypes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpitemTypes === null) {
			if ($this->isNew()) {
			   $this->collWpitemTypes = array();
			} else {

				$criteria->add(WpitemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				WpitemTypePeer::addSelectColumns($criteria);
				$this->collWpitemTypes = WpitemTypePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WpitemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				WpitemTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastWpitemTypeCriteria) || !$this->lastWpitemTypeCriteria->equals($criteria)) {
					$this->collWpitemTypes = WpitemTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpitemTypeCriteria = $criteria;
		return $this->collWpitemTypes;
	}

	/**
	 * Returns the number of related WpitemType objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WpitemType objects.
	 * @throws     PropelException
	 */
	public function countWpitemTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpitemTypes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpitemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				$count = WpitemTypePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WpitemTypePeer::APPOINTMENT_TYPE_ID, $this->id);

				if (!isset($this->lastWpitemTypeCriteria) || !$this->lastWpitemTypeCriteria->equals($criteria)) {
					$count = WpitemTypePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWpitemTypes);
				}
			} else {
				$count = count($this->collWpitemTypes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WpitemType object to this object
	 * through the WpitemType foreign key attribute.
	 *
	 * @param      WpitemType $l WpitemType
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWpitemType(WpitemType $l)
	{
		if ($this->collWpitemTypes === null) {
			$this->initWpitemTypes();
		}
		if (!in_array($l, $this->collWpitemTypes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWpitemTypes, $l);
			$l->setAppointmentType($this);
		}
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
			if ($this->collAppointments) {
				foreach ((array) $this->collAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpinfoTypes) {
				foreach ((array) $this->collWpinfoTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWptoolItemTypes) {
				foreach ((array) $this->collWptoolItemTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpitemTypes) {
				foreach ((array) $this->collWpitemTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collAppointments = null;
		$this->collWpinfoTypes = null;
		$this->collWptoolItemTypes = null;
		$this->collWpitemTypes = null;
	}

} // BaseAppointmentType