<?php

/**
 * Base class that represents a row from the 'wpmodule_syllabus_item' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWpmoduleSyllabusItem extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WpmoduleSyllabusItemPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the wpmodule_id field.
	 * @var        int
	 */
	protected $wpmodule_id;

	/**
	 * The value for the syllabus_item_id field.
	 * @var        int
	 */
	protected $syllabus_item_id;

	/**
	 * The value for the contribution field.
	 * @var        int
	 */
	protected $contribution;

	/**
	 * The value for the evaluation field.
	 * @var        int
	 */
	protected $evaluation;

	/**
	 * @var        Wpmodule
	 */
	protected $aWpmodule;

	/**
	 * @var        SyllabusItem
	 */
	protected $aSyllabusItem;

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
	
	const PEER = 'WpmoduleSyllabusItemPeer';

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
	 * Get the [wpmodule_id] column value.
	 * 
	 * @return     int
	 */
	public function getWpmoduleId()
	{
		return $this->wpmodule_id;
	}

	/**
	 * Get the [syllabus_item_id] column value.
	 * 
	 * @return     int
	 */
	public function getSyllabusItemId()
	{
		return $this->syllabus_item_id;
	}

	/**
	 * Get the [contribution] column value.
	 * 
	 * @return     int
	 */
	public function getContribution()
	{
		return $this->contribution;
	}

	/**
	 * Get the [evaluation] column value.
	 * 
	 * @return     int
	 */
	public function getEvaluation()
	{
		return $this->evaluation;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpmoduleSyllabusItemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [wpmodule_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 */
	public function setWpmoduleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wpmodule_id !== $v) {
			$this->wpmodule_id = $v;
			$this->modifiedColumns[] = WpmoduleSyllabusItemPeer::WPMODULE_ID;
		}

		if ($this->aWpmodule !== null && $this->aWpmodule->getId() !== $v) {
			$this->aWpmodule = null;
		}

		return $this;
	} // setWpmoduleId()

	/**
	 * Set the value of [syllabus_item_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 */
	public function setSyllabusItemId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->syllabus_item_id !== $v) {
			$this->syllabus_item_id = $v;
			$this->modifiedColumns[] = WpmoduleSyllabusItemPeer::SYLLABUS_ITEM_ID;
		}

		if ($this->aSyllabusItem !== null && $this->aSyllabusItem->getId() !== $v) {
			$this->aSyllabusItem = null;
		}

		return $this;
	} // setSyllabusItemId()

	/**
	 * Set the value of [contribution] column.
	 * 
	 * @param      int $v new value
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 */
	public function setContribution($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->contribution !== $v) {
			$this->contribution = $v;
			$this->modifiedColumns[] = WpmoduleSyllabusItemPeer::CONTRIBUTION;
		}

		return $this;
	} // setContribution()

	/**
	 * Set the value of [evaluation] column.
	 * 
	 * @param      int $v new value
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 */
	public function setEvaluation($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation !== $v) {
			$this->evaluation = $v;
			$this->modifiedColumns[] = WpmoduleSyllabusItemPeer::EVALUATION;
		}

		return $this;
	} // setEvaluation()

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
			$this->wpmodule_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->syllabus_item_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->contribution = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->evaluation = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = WpmoduleSyllabusItemPeer::NUM_COLUMNS - WpmoduleSyllabusItemPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating WpmoduleSyllabusItem object", $e);
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

		if ($this->aWpmodule !== null && $this->wpmodule_id !== $this->aWpmodule->getId()) {
			$this->aWpmodule = null;
		}
		if ($this->aSyllabusItem !== null && $this->syllabus_item_id !== $this->aSyllabusItem->getId()) {
			$this->aSyllabusItem = null;
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
			$con = Propel::getConnection(WpmoduleSyllabusItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = WpmoduleSyllabusItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aWpmodule = null;
			$this->aSyllabusItem = null;
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
			$con = Propel::getConnection(WpmoduleSyllabusItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				WpmoduleSyllabusItemPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WpmoduleSyllabusItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				WpmoduleSyllabusItemPeer::addInstanceToPool($this);
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

			if ($this->aWpmodule !== null) {
				if ($this->aWpmodule->isModified() || $this->aWpmodule->isNew()) {
					$affectedRows += $this->aWpmodule->save($con);
				}
				$this->setWpmodule($this->aWpmodule);
			}

			if ($this->aSyllabusItem !== null) {
				if ($this->aSyllabusItem->isModified() || $this->aSyllabusItem->isNew()) {
					$affectedRows += $this->aSyllabusItem->save($con);
				}
				$this->setSyllabusItem($this->aSyllabusItem);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WpmoduleSyllabusItemPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpmoduleSyllabusItemPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WpmoduleSyllabusItemPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aWpmodule !== null) {
				if (!$this->aWpmodule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWpmodule->getValidationFailures());
				}
			}

			if ($this->aSyllabusItem !== null) {
				if (!$this->aSyllabusItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSyllabusItem->getValidationFailures());
				}
			}


			if (($retval = WpmoduleSyllabusItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = WpmoduleSyllabusItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWpmoduleId();
				break;
			case 2:
				return $this->getSyllabusItemId();
				break;
			case 3:
				return $this->getContribution();
				break;
			case 4:
				return $this->getEvaluation();
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
		$keys = WpmoduleSyllabusItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWpmoduleId(),
			$keys[2] => $this->getSyllabusItemId(),
			$keys[3] => $this->getContribution(),
			$keys[4] => $this->getEvaluation(),
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
		$pos = WpmoduleSyllabusItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setWpmoduleId($value);
				break;
			case 2:
				$this->setSyllabusItemId($value);
				break;
			case 3:
				$this->setContribution($value);
				break;
			case 4:
				$this->setEvaluation($value);
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
		$keys = WpmoduleSyllabusItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWpmoduleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSyllabusItemId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContribution($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEvaluation($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WpmoduleSyllabusItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(WpmoduleSyllabusItemPeer::ID)) $criteria->add(WpmoduleSyllabusItemPeer::ID, $this->id);
		if ($this->isColumnModified(WpmoduleSyllabusItemPeer::WPMODULE_ID)) $criteria->add(WpmoduleSyllabusItemPeer::WPMODULE_ID, $this->wpmodule_id);
		if ($this->isColumnModified(WpmoduleSyllabusItemPeer::SYLLABUS_ITEM_ID)) $criteria->add(WpmoduleSyllabusItemPeer::SYLLABUS_ITEM_ID, $this->syllabus_item_id);
		if ($this->isColumnModified(WpmoduleSyllabusItemPeer::CONTRIBUTION)) $criteria->add(WpmoduleSyllabusItemPeer::CONTRIBUTION, $this->contribution);
		if ($this->isColumnModified(WpmoduleSyllabusItemPeer::EVALUATION)) $criteria->add(WpmoduleSyllabusItemPeer::EVALUATION, $this->evaluation);

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
		$criteria = new Criteria(WpmoduleSyllabusItemPeer::DATABASE_NAME);

		$criteria->add(WpmoduleSyllabusItemPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of WpmoduleSyllabusItem (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setWpmoduleId($this->wpmodule_id);

		$copyObj->setSyllabusItemId($this->syllabus_item_id);

		$copyObj->setContribution($this->contribution);

		$copyObj->setEvaluation($this->evaluation);


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
	 * @return     WpmoduleSyllabusItem Clone of current object.
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
	 * @return     WpmoduleSyllabusItemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WpmoduleSyllabusItemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Wpmodule object.
	 *
	 * @param      Wpmodule $v
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setWpmodule(Wpmodule $v = null)
	{
		if ($v === null) {
			$this->setWpmoduleId(NULL);
		} else {
			$this->setWpmoduleId($v->getId());
		}

		$this->aWpmodule = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Wpmodule object, it will not be re-added.
		if ($v !== null) {
			$v->addWpmoduleSyllabusItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated Wpmodule object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Wpmodule The associated Wpmodule object.
	 * @throws     PropelException
	 */
	public function getWpmodule(PropelPDO $con = null)
	{
		if ($this->aWpmodule === null && ($this->wpmodule_id !== null)) {
			$this->aWpmodule = WpmodulePeer::retrieveByPk($this->wpmodule_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aWpmodule->addWpmoduleSyllabusItems($this);
			 */
		}
		return $this->aWpmodule;
	}

	/**
	 * Declares an association between this object and a SyllabusItem object.
	 *
	 * @param      SyllabusItem $v
	 * @return     WpmoduleSyllabusItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSyllabusItem(SyllabusItem $v = null)
	{
		if ($v === null) {
			$this->setSyllabusItemId(NULL);
		} else {
			$this->setSyllabusItemId($v->getId());
		}

		$this->aSyllabusItem = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SyllabusItem object, it will not be re-added.
		if ($v !== null) {
			$v->addWpmoduleSyllabusItem($this);
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
	public function getSyllabusItem(PropelPDO $con = null)
	{
		if ($this->aSyllabusItem === null && ($this->syllabus_item_id !== null)) {
			$this->aSyllabusItem = SyllabusItemPeer::retrieveByPk($this->syllabus_item_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSyllabusItem->addWpmoduleSyllabusItems($this);
			 */
		}
		return $this->aSyllabusItem;
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
		} // if ($deep)

			$this->aWpmodule = null;
			$this->aSyllabusItem = null;
	}

} // BaseWpmoduleSyllabusItem
