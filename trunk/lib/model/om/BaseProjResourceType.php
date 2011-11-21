<?php

/**
 * Base class that represents a row from the 'proj_resource_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProjResourceType extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProjResourceTypePeer
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
	 * The value for the role_id field.
	 * @var        int
	 */
	protected $role_id;

	/**
	 * The value for the standard_cost field.
	 * @var        string
	 */
	protected $standard_cost;

	/**
	 * The value for the measurement_unit field.
	 * @var        string
	 */
	protected $measurement_unit;

	/**
	 * The value for the is_monetary field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_monetary;

	/**
	 * @var        Role
	 */
	protected $aRole;

	/**
	 * @var        array ProjResource[] Collection to store aggregation of ProjResource objects.
	 */
	protected $collProjResources;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjResources.
	 */
	private $lastProjResourceCriteria = null;

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
	
	const PEER = 'ProjResourceTypePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_monetary = true;
	}

	/**
	 * Initializes internal state of BaseProjResourceType object.
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
	 * Get the [role_id] column value.
	 * 
	 * @return     int
	 */
	public function getRoleId()
	{
		return $this->role_id;
	}

	/**
	 * Get the [standard_cost] column value.
	 * 
	 * @return     string
	 */
	public function getStandardCost()
	{
		return $this->standard_cost;
	}

	/**
	 * Get the [measurement_unit] column value.
	 * 
	 * @return     string
	 */
	public function getMeasurementUnit()
	{
		return $this->measurement_unit;
	}

	/**
	 * Get the [is_monetary] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsMonetary()
	{
		return $this->is_monetary;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjResourceType The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ProjResourceTypePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResourceType The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProjResourceTypePeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [role_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjResourceType The current object (for fluent API support)
	 */
	public function setRoleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->role_id !== $v) {
			$this->role_id = $v;
			$this->modifiedColumns[] = ProjResourceTypePeer::ROLE_ID;
		}

		if ($this->aRole !== null && $this->aRole->getId() !== $v) {
			$this->aRole = null;
		}

		return $this;
	} // setRoleId()

	/**
	 * Set the value of [standard_cost] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResourceType The current object (for fluent API support)
	 */
	public function setStandardCost($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->standard_cost !== $v) {
			$this->standard_cost = $v;
			$this->modifiedColumns[] = ProjResourceTypePeer::STANDARD_COST;
		}

		return $this;
	} // setStandardCost()

	/**
	 * Set the value of [measurement_unit] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResourceType The current object (for fluent API support)
	 */
	public function setMeasurementUnit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->measurement_unit !== $v) {
			$this->measurement_unit = $v;
			$this->modifiedColumns[] = ProjResourceTypePeer::MEASUREMENT_UNIT;
		}

		return $this;
	} // setMeasurementUnit()

	/**
	 * Set the value of [is_monetary] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ProjResourceType The current object (for fluent API support)
	 */
	public function setIsMonetary($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_monetary !== $v || $this->isNew()) {
			$this->is_monetary = $v;
			$this->modifiedColumns[] = ProjResourceTypePeer::IS_MONETARY;
		}

		return $this;
	} // setIsMonetary()

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
			if ($this->is_monetary !== true) {
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
			$this->role_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->standard_cost = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->measurement_unit = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_monetary = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = ProjResourceTypePeer::NUM_COLUMNS - ProjResourceTypePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ProjResourceType object", $e);
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

		if ($this->aRole !== null && $this->role_id !== $this->aRole->getId()) {
			$this->aRole = null;
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
			$con = Propel::getConnection(ProjResourceTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ProjResourceTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aRole = null;
			$this->collProjResources = null;
			$this->lastProjResourceCriteria = null;

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
			$con = Propel::getConnection(ProjResourceTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				ProjResourceTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ProjResourceTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ProjResourceTypePeer::addInstanceToPool($this);
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

			if ($this->aRole !== null) {
				if ($this->aRole->isModified() || $this->aRole->isNew()) {
					$affectedRows += $this->aRole->save($con);
				}
				$this->setRole($this->aRole);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ProjResourceTypePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProjResourceTypePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProjResourceTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProjResources !== null) {
				foreach ($this->collProjResources as $referrerFK) {
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

			if ($this->aRole !== null) {
				if (!$this->aRole->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRole->getValidationFailures());
				}
			}


			if (($retval = ProjResourceTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjResources !== null) {
					foreach ($this->collProjResources as $referrerFK) {
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
		$pos = ProjResourceTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRoleId();
				break;
			case 3:
				return $this->getStandardCost();
				break;
			case 4:
				return $this->getMeasurementUnit();
				break;
			case 5:
				return $this->getIsMonetary();
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
		$keys = ProjResourceTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getRoleId(),
			$keys[3] => $this->getStandardCost(),
			$keys[4] => $this->getMeasurementUnit(),
			$keys[5] => $this->getIsMonetary(),
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
		$pos = ProjResourceTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRoleId($value);
				break;
			case 3:
				$this->setStandardCost($value);
				break;
			case 4:
				$this->setMeasurementUnit($value);
				break;
			case 5:
				$this->setIsMonetary($value);
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
		$keys = ProjResourceTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoleId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStandardCost($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMeasurementUnit($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsMonetary($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjResourceTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjResourceTypePeer::ID)) $criteria->add(ProjResourceTypePeer::ID, $this->id);
		if ($this->isColumnModified(ProjResourceTypePeer::DESCRIPTION)) $criteria->add(ProjResourceTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProjResourceTypePeer::ROLE_ID)) $criteria->add(ProjResourceTypePeer::ROLE_ID, $this->role_id);
		if ($this->isColumnModified(ProjResourceTypePeer::STANDARD_COST)) $criteria->add(ProjResourceTypePeer::STANDARD_COST, $this->standard_cost);
		if ($this->isColumnModified(ProjResourceTypePeer::MEASUREMENT_UNIT)) $criteria->add(ProjResourceTypePeer::MEASUREMENT_UNIT, $this->measurement_unit);
		if ($this->isColumnModified(ProjResourceTypePeer::IS_MONETARY)) $criteria->add(ProjResourceTypePeer::IS_MONETARY, $this->is_monetary);

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
		$criteria = new Criteria(ProjResourceTypePeer::DATABASE_NAME);

		$criteria->add(ProjResourceTypePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ProjResourceType (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDescription($this->description);

		$copyObj->setRoleId($this->role_id);

		$copyObj->setStandardCost($this->standard_cost);

		$copyObj->setMeasurementUnit($this->measurement_unit);

		$copyObj->setIsMonetary($this->is_monetary);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getProjResources() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjResource($relObj->copy($deepCopy));
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
	 * @return     ProjResourceType Clone of current object.
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
	 * @return     ProjResourceTypePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProjResourceTypePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Role object.
	 *
	 * @param      Role $v
	 * @return     ProjResourceType The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRole(Role $v = null)
	{
		if ($v === null) {
			$this->setRoleId(NULL);
		} else {
			$this->setRoleId($v->getId());
		}

		$this->aRole = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Role object, it will not be re-added.
		if ($v !== null) {
			$v->addProjResourceType($this);
		}

		return $this;
	}


	/**
	 * Get the associated Role object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Role The associated Role object.
	 * @throws     PropelException
	 */
	public function getRole(PropelPDO $con = null)
	{
		if ($this->aRole === null && ($this->role_id !== null)) {
			$this->aRole = RolePeer::retrieveByPk($this->role_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aRole->addProjResourceTypes($this);
			 */
		}
		return $this->aRole;
	}

	/**
	 * Clears out the collProjResources collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjResources()
	 */
	public function clearProjResources()
	{
		$this->collProjResources = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjResources collection (array).
	 *
	 * By default this just sets the collProjResources collection to an empty array (like clearcollProjResources());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjResources()
	{
		$this->collProjResources = array();
	}

	/**
	 * Gets an array of ProjResource objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ProjResourceType has previously been saved, it will retrieve
	 * related ProjResources from storage. If this ProjResourceType is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjResource[]
	 * @throws     PropelException
	 */
	public function getProjResources($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourceTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
			   $this->collProjResources = array();
			} else {

				$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

				ProjResourcePeer::addSelectColumns($criteria);
				$this->collProjResources = ProjResourcePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

				ProjResourcePeer::addSelectColumns($criteria);
				if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
					$this->collProjResources = ProjResourcePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjResourceCriteria = $criteria;
		return $this->collProjResources;
	}

	/**
	 * Returns the number of related ProjResource objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ProjResource objects.
	 * @throws     PropelException
	 */
	public function countProjResources(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourceTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

				$count = ProjResourcePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

				if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
					$count = ProjResourcePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjResources);
				}
			} else {
				$count = count($this->collProjResources);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ProjResource object to this object
	 * through the ProjResource foreign key attribute.
	 *
	 * @param      ProjResource $l ProjResource
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjResource(ProjResource $l)
	{
		if ($this->collProjResources === null) {
			$this->initProjResources();
		}
		if (!in_array($l, $this->collProjResources, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjResources, $l);
			$l->setProjResourceType($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProjResourceType is new, it will return
	 * an empty collection; or if this ProjResourceType has previously
	 * been saved, it will retrieve related ProjResources from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProjResourceType.
	 */
	public function getProjResourcesJoinSchoolproject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourceTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
				$this->collProjResources = array();
			} else {

				$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

				$this->collProjResources = ProjResourcePeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

			if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
				$this->collProjResources = ProjResourcePeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjResourceCriteria = $criteria;

		return $this->collProjResources;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProjResourceType is new, it will return
	 * an empty collection; or if this ProjResourceType has previously
	 * been saved, it will retrieve related ProjResources from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProjResourceType.
	 */
	public function getProjResourcesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourceTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
				$this->collProjResources = array();
			} else {

				$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

				$this->collProjResources = ProjResourcePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->id);

			if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
				$this->collProjResources = ProjResourcePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjResourceCriteria = $criteria;

		return $this->collProjResources;
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
			if ($this->collProjResources) {
				foreach ((array) $this->collProjResources as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collProjResources = null;
			$this->aRole = null;
	}

} // BaseProjResourceType
