<?php

/**
 * Base class that represents a row from the 'workstation' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWorkstation extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WorkstationPeer
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
	 * The value for the ip_cidr field.
	 * @var        string
	 */
	protected $ip_cidr;

	/**
	 * The value for the mac_address field.
	 * @var        string
	 */
	protected $mac_address;

	/**
	 * The value for the is_enabled field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_enabled;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the location_x field.
	 * @var        double
	 */
	protected $location_x;

	/**
	 * The value for the location_y field.
	 * @var        double
	 */
	protected $location_y;

	/**
	 * The value for the subnet_id field.
	 * @var        int
	 */
	protected $subnet_id;

	/**
	 * @var        Subnet
	 */
	protected $aSubnet;

	/**
	 * @var        array Lanlog[] Collection to store aggregation of Lanlog objects.
	 */
	protected $collLanlogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collLanlogs.
	 */
	private $lastLanlogCriteria = null;

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
	
	const PEER = 'WorkstationPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_enabled = false;
		$this->is_active = false;
	}

	/**
	 * Initializes internal state of BaseWorkstation object.
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
	 * Get the [ip_cidr] column value.
	 * 
	 * @return     string
	 */
	public function getIpCidr()
	{
		return $this->ip_cidr;
	}

	/**
	 * Get the [mac_address] column value.
	 * 
	 * @return     string
	 */
	public function getMacAddress()
	{
		return $this->mac_address;
	}

	/**
	 * Get the [is_enabled] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsEnabled()
	{
		return $this->is_enabled;
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
	 * Get the [location_x] column value.
	 * 
	 * @return     double
	 */
	public function getLocationX()
	{
		return $this->location_x;
	}

	/**
	 * Get the [location_y] column value.
	 * 
	 * @return     double
	 */
	public function getLocationY()
	{
		return $this->location_y;
	}

	/**
	 * Get the [subnet_id] column value.
	 * 
	 * @return     int
	 */
	public function getSubnetId()
	{
		return $this->subnet_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WorkstationPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = WorkstationPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [ip_cidr] column.
	 * 
	 * @param      string $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setIpCidr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ip_cidr !== $v) {
			$this->ip_cidr = $v;
			$this->modifiedColumns[] = WorkstationPeer::IP_CIDR;
		}

		return $this;
	} // setIpCidr()

	/**
	 * Set the value of [mac_address] column.
	 * 
	 * @param      string $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setMacAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mac_address !== $v) {
			$this->mac_address = $v;
			$this->modifiedColumns[] = WorkstationPeer::MAC_ADDRESS;
		}

		return $this;
	} // setMacAddress()

	/**
	 * Set the value of [is_enabled] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setIsEnabled($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_enabled !== $v || $this->isNew()) {
			$this->is_enabled = $v;
			$this->modifiedColumns[] = WorkstationPeer::IS_ENABLED;
		}

		return $this;
	} // setIsEnabled()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = WorkstationPeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [location_x] column.
	 * 
	 * @param      double $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setLocationX($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->location_x !== $v) {
			$this->location_x = $v;
			$this->modifiedColumns[] = WorkstationPeer::LOCATION_X;
		}

		return $this;
	} // setLocationX()

	/**
	 * Set the value of [location_y] column.
	 * 
	 * @param      double $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setLocationY($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->location_y !== $v) {
			$this->location_y = $v;
			$this->modifiedColumns[] = WorkstationPeer::LOCATION_Y;
		}

		return $this;
	} // setLocationY()

	/**
	 * Set the value of [subnet_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Workstation The current object (for fluent API support)
	 */
	public function setSubnetId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->subnet_id !== $v) {
			$this->subnet_id = $v;
			$this->modifiedColumns[] = WorkstationPeer::SUBNET_ID;
		}

		if ($this->aSubnet !== null && $this->aSubnet->getId() !== $v) {
			$this->aSubnet = null;
		}

		return $this;
	} // setSubnetId()

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
			if ($this->is_enabled !== false) {
				return false;
			}

			if ($this->is_active !== false) {
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
			$this->ip_cidr = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->mac_address = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->is_enabled = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->is_active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->location_x = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
			$this->location_y = ($row[$startcol + 7] !== null) ? (double) $row[$startcol + 7] : null;
			$this->subnet_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = WorkstationPeer::NUM_COLUMNS - WorkstationPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Workstation object", $e);
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

		if ($this->aSubnet !== null && $this->subnet_id !== $this->aSubnet->getId()) {
			$this->aSubnet = null;
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
			$con = Propel::getConnection(WorkstationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = WorkstationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSubnet = null;
			$this->collLanlogs = null;
			$this->lastLanlogCriteria = null;

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
			$con = Propel::getConnection(WorkstationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				WorkstationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WorkstationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				WorkstationPeer::addInstanceToPool($this);
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

			if ($this->aSubnet !== null) {
				if ($this->aSubnet->isModified() || $this->aSubnet->isNew()) {
					$affectedRows += $this->aSubnet->save($con);
				}
				$this->setSubnet($this->aSubnet);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WorkstationPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkstationPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WorkstationPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collLanlogs !== null) {
				foreach ($this->collLanlogs as $referrerFK) {
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

			if ($this->aSubnet !== null) {
				if (!$this->aSubnet->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSubnet->getValidationFailures());
				}
			}


			if (($retval = WorkstationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLanlogs !== null) {
					foreach ($this->collLanlogs as $referrerFK) {
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
		$pos = WorkstationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIpCidr();
				break;
			case 3:
				return $this->getMacAddress();
				break;
			case 4:
				return $this->getIsEnabled();
				break;
			case 5:
				return $this->getIsActive();
				break;
			case 6:
				return $this->getLocationX();
				break;
			case 7:
				return $this->getLocationY();
				break;
			case 8:
				return $this->getSubnetId();
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
		$keys = WorkstationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIpCidr(),
			$keys[3] => $this->getMacAddress(),
			$keys[4] => $this->getIsEnabled(),
			$keys[5] => $this->getIsActive(),
			$keys[6] => $this->getLocationX(),
			$keys[7] => $this->getLocationY(),
			$keys[8] => $this->getSubnetId(),
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
		$pos = WorkstationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIpCidr($value);
				break;
			case 3:
				$this->setMacAddress($value);
				break;
			case 4:
				$this->setIsEnabled($value);
				break;
			case 5:
				$this->setIsActive($value);
				break;
			case 6:
				$this->setLocationX($value);
				break;
			case 7:
				$this->setLocationY($value);
				break;
			case 8:
				$this->setSubnetId($value);
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
		$keys = WorkstationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIpCidr($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMacAddress($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsEnabled($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLocationX($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLocationY($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSubnetId($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkstationPeer::ID)) $criteria->add(WorkstationPeer::ID, $this->id);
		if ($this->isColumnModified(WorkstationPeer::NAME)) $criteria->add(WorkstationPeer::NAME, $this->name);
		if ($this->isColumnModified(WorkstationPeer::IP_CIDR)) $criteria->add(WorkstationPeer::IP_CIDR, $this->ip_cidr);
		if ($this->isColumnModified(WorkstationPeer::MAC_ADDRESS)) $criteria->add(WorkstationPeer::MAC_ADDRESS, $this->mac_address);
		if ($this->isColumnModified(WorkstationPeer::IS_ENABLED)) $criteria->add(WorkstationPeer::IS_ENABLED, $this->is_enabled);
		if ($this->isColumnModified(WorkstationPeer::IS_ACTIVE)) $criteria->add(WorkstationPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(WorkstationPeer::LOCATION_X)) $criteria->add(WorkstationPeer::LOCATION_X, $this->location_x);
		if ($this->isColumnModified(WorkstationPeer::LOCATION_Y)) $criteria->add(WorkstationPeer::LOCATION_Y, $this->location_y);
		if ($this->isColumnModified(WorkstationPeer::SUBNET_ID)) $criteria->add(WorkstationPeer::SUBNET_ID, $this->subnet_id);

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
		$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);

		$criteria->add(WorkstationPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Workstation (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setIpCidr($this->ip_cidr);

		$copyObj->setMacAddress($this->mac_address);

		$copyObj->setIsEnabled($this->is_enabled);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setLocationX($this->location_x);

		$copyObj->setLocationY($this->location_y);

		$copyObj->setSubnetId($this->subnet_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getLanlogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLanlog($relObj->copy($deepCopy));
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
	 * @return     Workstation Clone of current object.
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
	 * @return     WorkstationPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WorkstationPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Subnet object.
	 *
	 * @param      Subnet $v
	 * @return     Workstation The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSubnet(Subnet $v = null)
	{
		if ($v === null) {
			$this->setSubnetId(NULL);
		} else {
			$this->setSubnetId($v->getId());
		}

		$this->aSubnet = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Subnet object, it will not be re-added.
		if ($v !== null) {
			$v->addWorkstation($this);
		}

		return $this;
	}


	/**
	 * Get the associated Subnet object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Subnet The associated Subnet object.
	 * @throws     PropelException
	 */
	public function getSubnet(PropelPDO $con = null)
	{
		if ($this->aSubnet === null && ($this->subnet_id !== null)) {
			$this->aSubnet = SubnetPeer::retrieveByPk($this->subnet_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSubnet->addWorkstations($this);
			 */
		}
		return $this->aSubnet;
	}

	/**
	 * Clears out the collLanlogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLanlogs()
	 */
	public function clearLanlogs()
	{
		$this->collLanlogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLanlogs collection (array).
	 *
	 * By default this just sets the collLanlogs collection to an empty array (like clearcollLanlogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initLanlogs()
	{
		$this->collLanlogs = array();
	}

	/**
	 * Gets an array of Lanlog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Workstation has previously been saved, it will retrieve
	 * related Lanlogs from storage. If this Workstation is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Lanlog[]
	 * @throws     PropelException
	 */
	public function getLanlogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
			   $this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
					$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanlogCriteria = $criteria;
		return $this->collLanlogs;
	}

	/**
	 * Returns the number of related Lanlog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Lanlog objects.
	 * @throws     PropelException
	 */
	public function countLanlogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				$count = LanlogPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
					$count = LanlogPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collLanlogs);
				}
			} else {
				$count = count($this->collLanlogs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Lanlog object to this object
	 * through the Lanlog foreign key attribute.
	 *
	 * @param      Lanlog $l Lanlog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLanlog(Lanlog $l)
	{
		if ($this->collLanlogs === null) {
			$this->initLanlogs();
		}
		if (!in_array($l, $this->collLanlogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLanlogs, $l);
			$l->setWorkstation($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Workstation is new, it will return
	 * an empty collection; or if this Workstation has previously
	 * been saved, it will retrieve related Lanlogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Workstation.
	 */
	public function getLanlogsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				$this->collLanlogs = LanlogPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

			if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
				$this->collLanlogs = LanlogPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastLanlogCriteria = $criteria;

		return $this->collLanlogs;
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
			if ($this->collLanlogs) {
				foreach ((array) $this->collLanlogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collLanlogs = null;
			$this->aSubnet = null;
	}

} // BaseWorkstation
