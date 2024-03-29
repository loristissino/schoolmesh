<?php

/**
 * Base class that represents a row from the 'team' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseTeam extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TeamPeer
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
	 * The value for the posix_name field.
	 * @var        string
	 */
	protected $posix_name;

	/**
	 * The value for the quality_code field.
	 * @var        string
	 */
	protected $quality_code;

	/**
	 * The value for the needs_folder field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $needs_folder;

	/**
	 * The value for the needs_mailing_list field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $needs_mailing_list;

	/**
	 * The value for the is_public field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_public;

	/**
	 * @var        array Appointment[] Collection to store aggregation of Appointment objects.
	 */
	protected $collAppointments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAppointments.
	 */
	private $lastAppointmentCriteria = null;

	/**
	 * @var        array UserTeam[] Collection to store aggregation of UserTeam objects.
	 */
	protected $collUserTeams;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserTeams.
	 */
	private $lastUserTeamCriteria = null;

	/**
	 * @var        array Schoolproject[] Collection to store aggregation of Schoolproject objects.
	 */
	protected $collSchoolprojects;

	/**
	 * @var        Criteria The criteria used to select the current contents of collSchoolprojects.
	 */
	private $lastSchoolprojectCriteria = null;

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
	
	const PEER = 'TeamPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->needs_folder = false;
		$this->needs_mailing_list = false;
		$this->is_public = false;
	}

	/**
	 * Initializes internal state of BaseTeam object.
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
	 * Get the [posix_name] column value.
	 * 
	 * @return     string
	 */
	public function getPosixName()
	{
		return $this->posix_name;
	}

	/**
	 * Get the [quality_code] column value.
	 * 
	 * @return     string
	 */
	public function getQualityCode()
	{
		return $this->quality_code;
	}

	/**
	 * Get the [needs_folder] column value.
	 * 
	 * @return     boolean
	 */
	public function getNeedsFolder()
	{
		return $this->needs_folder;
	}

	/**
	 * Get the [needs_mailing_list] column value.
	 * 
	 * @return     boolean
	 */
	public function getNeedsMailingList()
	{
		return $this->needs_mailing_list;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TeamPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = TeamPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [posix_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setPosixName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->posix_name !== $v) {
			$this->posix_name = $v;
			$this->modifiedColumns[] = TeamPeer::POSIX_NAME;
		}

		return $this;
	} // setPosixName()

	/**
	 * Set the value of [quality_code] column.
	 * 
	 * @param      string $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setQualityCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->quality_code !== $v) {
			$this->quality_code = $v;
			$this->modifiedColumns[] = TeamPeer::QUALITY_CODE;
		}

		return $this;
	} // setQualityCode()

	/**
	 * Set the value of [needs_folder] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setNeedsFolder($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->needs_folder !== $v || $this->isNew()) {
			$this->needs_folder = $v;
			$this->modifiedColumns[] = TeamPeer::NEEDS_FOLDER;
		}

		return $this;
	} // setNeedsFolder()

	/**
	 * Set the value of [needs_mailing_list] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setNeedsMailingList($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->needs_mailing_list !== $v || $this->isNew()) {
			$this->needs_mailing_list = $v;
			$this->modifiedColumns[] = TeamPeer::NEEDS_MAILING_LIST;
		}

		return $this;
	} // setNeedsMailingList()

	/**
	 * Set the value of [is_public] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Team The current object (for fluent API support)
	 */
	public function setIsPublic($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_public !== $v || $this->isNew()) {
			$this->is_public = $v;
			$this->modifiedColumns[] = TeamPeer::IS_PUBLIC;
		}

		return $this;
	} // setIsPublic()

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
			if ($this->needs_folder !== false) {
				return false;
			}

			if ($this->needs_mailing_list !== false) {
				return false;
			}

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
			$this->description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->posix_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->quality_code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->needs_folder = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->needs_mailing_list = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->is_public = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = TeamPeer::NUM_COLUMNS - TeamPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Team object", $e);
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
			$con = Propel::getConnection(TeamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TeamPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

			$this->collUserTeams = null;
			$this->lastUserTeamCriteria = null;

			$this->collSchoolprojects = null;
			$this->lastSchoolprojectCriteria = null;

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
			$con = Propel::getConnection(TeamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				TeamPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TeamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				TeamPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TeamPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TeamPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TeamPeer::doUpdate($this, $con);
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

			if ($this->collUserTeams !== null) {
				foreach ($this->collUserTeams as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchoolprojects !== null) {
				foreach ($this->collSchoolprojects as $referrerFK) {
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


			if (($retval = TeamPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserTeams !== null) {
					foreach ($this->collUserTeams as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchoolprojects !== null) {
					foreach ($this->collSchoolprojects as $referrerFK) {
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
		$pos = TeamPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPosixName();
				break;
			case 3:
				return $this->getQualityCode();
				break;
			case 4:
				return $this->getNeedsFolder();
				break;
			case 5:
				return $this->getNeedsMailingList();
				break;
			case 6:
				return $this->getIsPublic();
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
		$keys = TeamPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getPosixName(),
			$keys[3] => $this->getQualityCode(),
			$keys[4] => $this->getNeedsFolder(),
			$keys[5] => $this->getNeedsMailingList(),
			$keys[6] => $this->getIsPublic(),
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
		$pos = TeamPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPosixName($value);
				break;
			case 3:
				$this->setQualityCode($value);
				break;
			case 4:
				$this->setNeedsFolder($value);
				break;
			case 5:
				$this->setNeedsMailingList($value);
				break;
			case 6:
				$this->setIsPublic($value);
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
		$keys = TeamPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPosixName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQualityCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNeedsFolder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNeedsMailingList($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsPublic($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TeamPeer::DATABASE_NAME);

		if ($this->isColumnModified(TeamPeer::ID)) $criteria->add(TeamPeer::ID, $this->id);
		if ($this->isColumnModified(TeamPeer::DESCRIPTION)) $criteria->add(TeamPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(TeamPeer::POSIX_NAME)) $criteria->add(TeamPeer::POSIX_NAME, $this->posix_name);
		if ($this->isColumnModified(TeamPeer::QUALITY_CODE)) $criteria->add(TeamPeer::QUALITY_CODE, $this->quality_code);
		if ($this->isColumnModified(TeamPeer::NEEDS_FOLDER)) $criteria->add(TeamPeer::NEEDS_FOLDER, $this->needs_folder);
		if ($this->isColumnModified(TeamPeer::NEEDS_MAILING_LIST)) $criteria->add(TeamPeer::NEEDS_MAILING_LIST, $this->needs_mailing_list);
		if ($this->isColumnModified(TeamPeer::IS_PUBLIC)) $criteria->add(TeamPeer::IS_PUBLIC, $this->is_public);

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
		$criteria = new Criteria(TeamPeer::DATABASE_NAME);

		$criteria->add(TeamPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Team (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDescription($this->description);

		$copyObj->setPosixName($this->posix_name);

		$copyObj->setQualityCode($this->quality_code);

		$copyObj->setNeedsFolder($this->needs_folder);

		$copyObj->setNeedsMailingList($this->needs_mailing_list);

		$copyObj->setIsPublic($this->is_public);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAppointment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserTeams() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserTeam($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSchoolprojects() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSchoolproject($relObj->copy($deepCopy));
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
	 * @return     Team Clone of current object.
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
	 * @return     TeamPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TeamPeer();
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
	 * Otherwise if this Team has previously been saved, it will retrieve
	 * related Appointments from storage. If this Team is new, it will return
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
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

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
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
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

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

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
			$l->setTeam($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getAppointmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

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
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getAppointmentsJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

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
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

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
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

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
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getAppointmentsJoinSyllabus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getAppointmentsJoinAppointmentType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinAppointmentType($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::TEAM_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinAppointmentType($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}

	/**
	 * Clears out the collUserTeams collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserTeams()
	 */
	public function clearUserTeams()
	{
		$this->collUserTeams = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserTeams collection (array).
	 *
	 * By default this just sets the collUserTeams collection to an empty array (like clearcollUserTeams());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserTeams()
	{
		$this->collUserTeams = array();
	}

	/**
	 * Gets an array of UserTeam objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Team has previously been saved, it will retrieve
	 * related UserTeams from storage. If this Team is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array UserTeam[]
	 * @throws     PropelException
	 */
	public function getUserTeams($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
			   $this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
					$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserTeamCriteria = $criteria;
		return $this->collUserTeams;
	}

	/**
	 * Returns the number of related UserTeam objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UserTeam objects.
	 * @throws     PropelException
	 */
	public function countUserTeams(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				$count = UserTeamPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
					$count = UserTeamPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collUserTeams);
				}
			} else {
				$count = count($this->collUserTeams);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a UserTeam object to this object
	 * through the UserTeam foreign key attribute.
	 *
	 * @param      UserTeam $l UserTeam
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserTeam(UserTeam $l)
	{
		if ($this->collUserTeams === null) {
			$this->initUserTeams();
		}
		if (!in_array($l, $this->collUserTeams, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserTeams, $l);
			$l->setTeam($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related UserTeams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getUserTeamsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related UserTeams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getUserTeamsJoinRole($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}

	/**
	 * Clears out the collSchoolprojects collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSchoolprojects()
	 */
	public function clearSchoolprojects()
	{
		$this->collSchoolprojects = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSchoolprojects collection (array).
	 *
	 * By default this just sets the collSchoolprojects collection to an empty array (like clearcollSchoolprojects());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSchoolprojects()
	{
		$this->collSchoolprojects = array();
	}

	/**
	 * Gets an array of Schoolproject objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Team has previously been saved, it will retrieve
	 * related Schoolprojects from storage. If this Team is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Schoolproject[]
	 * @throws     PropelException
	 */
	public function getSchoolprojects($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
			   $this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				SchoolprojectPeer::addSelectColumns($criteria);
				$this->collSchoolprojects = SchoolprojectPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				SchoolprojectPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
					$this->collSchoolprojects = SchoolprojectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;
		return $this->collSchoolprojects;
	}

	/**
	 * Returns the number of related Schoolproject objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Schoolproject objects.
	 * @throws     PropelException
	 */
	public function countSchoolprojects(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				$count = SchoolprojectPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
					$count = SchoolprojectPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collSchoolprojects);
				}
			} else {
				$count = count($this->collSchoolprojects);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Schoolproject object to this object
	 * through the Schoolproject foreign key attribute.
	 *
	 * @param      Schoolproject $l Schoolproject
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchoolproject(Schoolproject $l)
	{
		if ($this->collSchoolprojects === null) {
			$this->initSchoolprojects();
		}
		if (!in_array($l, $this->collSchoolprojects, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSchoolprojects, $l);
			$l->setTeam($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Schoolprojects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getSchoolprojectsJoinProjCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinProjCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

			if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinProjCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;

		return $this->collSchoolprojects;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Schoolprojects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getSchoolprojectsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

			if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;

		return $this->collSchoolprojects;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Team is new, it will return
	 * an empty collection; or if this Team has previously
	 * been saved, it will retrieve related Schoolprojects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Team.
	 */
	public function getSchoolprojectsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchoolprojectPeer::TEAM_ID, $this->id);

			if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;

		return $this->collSchoolprojects;
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
			if ($this->collUserTeams) {
				foreach ((array) $this->collUserTeams as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSchoolprojects) {
				foreach ((array) $this->collSchoolprojects as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collAppointments = null;
		$this->collUserTeams = null;
		$this->collSchoolprojects = null;
	}

} // BaseTeam
