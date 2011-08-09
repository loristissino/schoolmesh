<?php

/**
 * Base class that represents a row from the 'syllabus_item' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSyllabusItem extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SyllabusItemPeer
	 */
	protected static $peer;

	/**
	 * The value for the syllabus_id field.
	 * @var        int
	 */
	protected $syllabus_id;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the level field.
	 * @var        int
	 */
	protected $level;

	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;

	/**
	 * The value for the content field.
	 * @var        string
	 */
	protected $content;

	/**
	 * The value for the is_selectable field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_selectable;

	/**
	 * @var        Syllabus
	 */
	protected $aSyllabus;

	/**
	 * @var        SyllabusItem
	 */
	protected $aSyllabusItemRelatedByParentId;

	/**
	 * @var        array SyllabusItem[] Collection to store aggregation of SyllabusItem objects.
	 */
	protected $collSyllabusItemsRelatedByParentId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collSyllabusItemsRelatedByParentId.
	 */
	private $lastSyllabusItemRelatedByParentIdCriteria = null;

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
	
	const PEER = 'SyllabusItemPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_selectable = false;
	}

	/**
	 * Initializes internal state of BaseSyllabusItem object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [syllabus_id] column value.
	 * 
	 * @return     int
	 */
	public function getSyllabusId()
	{
		return $this->syllabus_id;
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
	 * Get the [level] column value.
	 * 
	 * @return     int
	 */
	public function getLevel()
	{
		return $this->level;
	}

	/**
	 * Get the [parent_id] column value.
	 * 
	 * @return     int
	 */
	public function getParentId()
	{
		return $this->parent_id;
	}

	/**
	 * Get the [content] column value.
	 * 
	 * @return     string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Get the [is_selectable] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSelectable()
	{
		return $this->is_selectable;
	}

	/**
	 * Set the value of [syllabus_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SyllabusItem The current object (for fluent API support)
	 */
	public function setSyllabusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->syllabus_id !== $v) {
			$this->syllabus_id = $v;
			$this->modifiedColumns[] = SyllabusItemPeer::SYLLABUS_ID;
		}

		if ($this->aSyllabus !== null && $this->aSyllabus->getId() !== $v) {
			$this->aSyllabus = null;
		}

		return $this;
	} // setSyllabusId()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SyllabusItem The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SyllabusItemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [level] column.
	 * 
	 * @param      int $v new value
	 * @return     SyllabusItem The current object (for fluent API support)
	 */
	public function setLevel($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->level !== $v) {
			$this->level = $v;
			$this->modifiedColumns[] = SyllabusItemPeer::LEVEL;
		}

		return $this;
	} // setLevel()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SyllabusItem The current object (for fluent API support)
	 */
	public function setParentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = SyllabusItemPeer::PARENT_ID;
		}

		if ($this->aSyllabusItemRelatedByParentId !== null && $this->aSyllabusItemRelatedByParentId->getId() !== $v) {
			$this->aSyllabusItemRelatedByParentId = null;
		}

		return $this;
	} // setParentId()

	/**
	 * Set the value of [content] column.
	 * 
	 * @param      string $v new value
	 * @return     SyllabusItem The current object (for fluent API support)
	 */
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = SyllabusItemPeer::CONTENT;
		}

		return $this;
	} // setContent()

	/**
	 * Set the value of [is_selectable] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SyllabusItem The current object (for fluent API support)
	 */
	public function setIsSelectable($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_selectable !== $v || $this->isNew()) {
			$this->is_selectable = $v;
			$this->modifiedColumns[] = SyllabusItemPeer::IS_SELECTABLE;
		}

		return $this;
	} // setIsSelectable()

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
			if ($this->is_selectable !== false) {
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

			$this->syllabus_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->level = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->parent_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->content = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_selectable = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = SyllabusItemPeer::NUM_COLUMNS - SyllabusItemPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SyllabusItem object", $e);
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

		if ($this->aSyllabus !== null && $this->syllabus_id !== $this->aSyllabus->getId()) {
			$this->aSyllabus = null;
		}
		if ($this->aSyllabusItemRelatedByParentId !== null && $this->parent_id !== $this->aSyllabusItemRelatedByParentId->getId()) {
			$this->aSyllabusItemRelatedByParentId = null;
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
			$con = Propel::getConnection(SyllabusItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SyllabusItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSyllabus = null;
			$this->aSyllabusItemRelatedByParentId = null;
			$this->collSyllabusItemsRelatedByParentId = null;
			$this->lastSyllabusItemRelatedByParentIdCriteria = null;

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
			$con = Propel::getConnection(SyllabusItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SyllabusItemPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SyllabusItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SyllabusItemPeer::addInstanceToPool($this);
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

			if ($this->aSyllabus !== null) {
				if ($this->aSyllabus->isModified() || $this->aSyllabus->isNew()) {
					$affectedRows += $this->aSyllabus->save($con);
				}
				$this->setSyllabus($this->aSyllabus);
			}

			if ($this->aSyllabusItemRelatedByParentId !== null) {
				if ($this->aSyllabusItemRelatedByParentId->isModified() || $this->aSyllabusItemRelatedByParentId->isNew()) {
					$affectedRows += $this->aSyllabusItemRelatedByParentId->save($con);
				}
				$this->setSyllabusItemRelatedByParentId($this->aSyllabusItemRelatedByParentId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SyllabusItemPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SyllabusItemPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SyllabusItemPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSyllabusItemsRelatedByParentId !== null) {
				foreach ($this->collSyllabusItemsRelatedByParentId as $referrerFK) {
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

			if ($this->aSyllabus !== null) {
				if (!$this->aSyllabus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSyllabus->getValidationFailures());
				}
			}

			if ($this->aSyllabusItemRelatedByParentId !== null) {
				if (!$this->aSyllabusItemRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSyllabusItemRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = SyllabusItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSyllabusItemsRelatedByParentId !== null) {
					foreach ($this->collSyllabusItemsRelatedByParentId as $referrerFK) {
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
		$pos = SyllabusItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSyllabusId();
				break;
			case 1:
				return $this->getId();
				break;
			case 2:
				return $this->getLevel();
				break;
			case 3:
				return $this->getParentId();
				break;
			case 4:
				return $this->getContent();
				break;
			case 5:
				return $this->getIsSelectable();
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
		$keys = SyllabusItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSyllabusId(),
			$keys[1] => $this->getId(),
			$keys[2] => $this->getLevel(),
			$keys[3] => $this->getParentId(),
			$keys[4] => $this->getContent(),
			$keys[5] => $this->getIsSelectable(),
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
		$pos = SyllabusItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSyllabusId($value);
				break;
			case 1:
				$this->setId($value);
				break;
			case 2:
				$this->setLevel($value);
				break;
			case 3:
				$this->setParentId($value);
				break;
			case 4:
				$this->setContent($value);
				break;
			case 5:
				$this->setIsSelectable($value);
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
		$keys = SyllabusItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSyllabusId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLevel($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setParentId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsSelectable($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SyllabusItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(SyllabusItemPeer::SYLLABUS_ID)) $criteria->add(SyllabusItemPeer::SYLLABUS_ID, $this->syllabus_id);
		if ($this->isColumnModified(SyllabusItemPeer::ID)) $criteria->add(SyllabusItemPeer::ID, $this->id);
		if ($this->isColumnModified(SyllabusItemPeer::LEVEL)) $criteria->add(SyllabusItemPeer::LEVEL, $this->level);
		if ($this->isColumnModified(SyllabusItemPeer::PARENT_ID)) $criteria->add(SyllabusItemPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(SyllabusItemPeer::CONTENT)) $criteria->add(SyllabusItemPeer::CONTENT, $this->content);
		if ($this->isColumnModified(SyllabusItemPeer::IS_SELECTABLE)) $criteria->add(SyllabusItemPeer::IS_SELECTABLE, $this->is_selectable);

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
		$criteria = new Criteria(SyllabusItemPeer::DATABASE_NAME);

		$criteria->add(SyllabusItemPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SyllabusItem (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSyllabusId($this->syllabus_id);

		$copyObj->setLevel($this->level);

		$copyObj->setParentId($this->parent_id);

		$copyObj->setContent($this->content);

		$copyObj->setIsSelectable($this->is_selectable);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getSyllabusItemsRelatedByParentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSyllabusItemRelatedByParentId($relObj->copy($deepCopy));
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
	 * @return     SyllabusItem Clone of current object.
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
	 * @return     SyllabusItemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SyllabusItemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Syllabus object.
	 *
	 * @param      Syllabus $v
	 * @return     SyllabusItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSyllabus(Syllabus $v = null)
	{
		if ($v === null) {
			$this->setSyllabusId(NULL);
		} else {
			$this->setSyllabusId($v->getId());
		}

		$this->aSyllabus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Syllabus object, it will not be re-added.
		if ($v !== null) {
			$v->addSyllabusItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated Syllabus object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Syllabus The associated Syllabus object.
	 * @throws     PropelException
	 */
	public function getSyllabus(PropelPDO $con = null)
	{
		if ($this->aSyllabus === null && ($this->syllabus_id !== null)) {
			$this->aSyllabus = SyllabusPeer::retrieveByPk($this->syllabus_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSyllabus->addSyllabusItems($this);
			 */
		}
		return $this->aSyllabus;
	}

	/**
	 * Declares an association between this object and a SyllabusItem object.
	 *
	 * @param      SyllabusItem $v
	 * @return     SyllabusItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSyllabusItemRelatedByParentId(SyllabusItem $v = null)
	{
		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}

		$this->aSyllabusItemRelatedByParentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SyllabusItem object, it will not be re-added.
		if ($v !== null) {
			$v->addSyllabusItemRelatedByParentId($this);
		}

		return $this;
	}


	/**
	 * Get the associated SyllabusItem object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SyllabusItem The associated SyllabusItem object.
	 * @throws     PropelException
	 */
	public function getSyllabusItemRelatedByParentId(PropelPDO $con = null)
	{
		if ($this->aSyllabusItemRelatedByParentId === null && ($this->parent_id !== null)) {
			$this->aSyllabusItemRelatedByParentId = SyllabusItemPeer::retrieveByPk($this->parent_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSyllabusItemRelatedByParentId->addSyllabusItemsRelatedByParentId($this);
			 */
		}
		return $this->aSyllabusItemRelatedByParentId;
	}

	/**
	 * Clears out the collSyllabusItemsRelatedByParentId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSyllabusItemsRelatedByParentId()
	 */
	public function clearSyllabusItemsRelatedByParentId()
	{
		$this->collSyllabusItemsRelatedByParentId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSyllabusItemsRelatedByParentId collection (array).
	 *
	 * By default this just sets the collSyllabusItemsRelatedByParentId collection to an empty array (like clearcollSyllabusItemsRelatedByParentId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSyllabusItemsRelatedByParentId()
	{
		$this->collSyllabusItemsRelatedByParentId = array();
	}

	/**
	 * Gets an array of SyllabusItem objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this SyllabusItem has previously been saved, it will retrieve
	 * related SyllabusItemsRelatedByParentId from storage. If this SyllabusItem is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array SyllabusItem[]
	 * @throws     PropelException
	 */
	public function getSyllabusItemsRelatedByParentId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSyllabusItemsRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collSyllabusItemsRelatedByParentId = array();
			} else {

				$criteria->add(SyllabusItemPeer::PARENT_ID, $this->id);

				SyllabusItemPeer::addSelectColumns($criteria);
				$this->collSyllabusItemsRelatedByParentId = SyllabusItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SyllabusItemPeer::PARENT_ID, $this->id);

				SyllabusItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastSyllabusItemRelatedByParentIdCriteria) || !$this->lastSyllabusItemRelatedByParentIdCriteria->equals($criteria)) {
					$this->collSyllabusItemsRelatedByParentId = SyllabusItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSyllabusItemRelatedByParentIdCriteria = $criteria;
		return $this->collSyllabusItemsRelatedByParentId;
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
	public function countSyllabusItemsRelatedByParentId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusItemPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSyllabusItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SyllabusItemPeer::PARENT_ID, $this->id);

				$count = SyllabusItemPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SyllabusItemPeer::PARENT_ID, $this->id);

				if (!isset($this->lastSyllabusItemRelatedByParentIdCriteria) || !$this->lastSyllabusItemRelatedByParentIdCriteria->equals($criteria)) {
					$count = SyllabusItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collSyllabusItemsRelatedByParentId);
				}
			} else {
				$count = count($this->collSyllabusItemsRelatedByParentId);
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
	public function addSyllabusItemRelatedByParentId(SyllabusItem $l)
	{
		if ($this->collSyllabusItemsRelatedByParentId === null) {
			$this->initSyllabusItemsRelatedByParentId();
		}
		if (!in_array($l, $this->collSyllabusItemsRelatedByParentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSyllabusItemsRelatedByParentId, $l);
			$l->setSyllabusItemRelatedByParentId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SyllabusItem is new, it will return
	 * an empty collection; or if this SyllabusItem has previously
	 * been saved, it will retrieve related SyllabusItemsRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SyllabusItem.
	 */
	public function getSyllabusItemsRelatedByParentIdJoinSyllabus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SyllabusItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSyllabusItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collSyllabusItemsRelatedByParentId = array();
			} else {

				$criteria->add(SyllabusItemPeer::PARENT_ID, $this->id);

				$this->collSyllabusItemsRelatedByParentId = SyllabusItemPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SyllabusItemPeer::PARENT_ID, $this->id);

			if (!isset($this->lastSyllabusItemRelatedByParentIdCriteria) || !$this->lastSyllabusItemRelatedByParentIdCriteria->equals($criteria)) {
				$this->collSyllabusItemsRelatedByParentId = SyllabusItemPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		}
		$this->lastSyllabusItemRelatedByParentIdCriteria = $criteria;

		return $this->collSyllabusItemsRelatedByParentId;
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
			if ($this->collSyllabusItemsRelatedByParentId) {
				foreach ((array) $this->collSyllabusItemsRelatedByParentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collSyllabusItemsRelatedByParentId = null;
			$this->aSyllabus = null;
			$this->aSyllabusItemRelatedByParentId = null;
	}

} // BaseSyllabusItem
