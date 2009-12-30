<?php

/**
 * Base class that represents a row from the 'student_situation' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseStudentSituation extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StudentSituationPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the year_id field.
	 * @var        int
	 */
	protected $year_id;

	/**
	 * The value for the term_id field.
	 * @var        string
	 */
	protected $term_id;

	/**
	 * The value for the wpmodule_item_id field.
	 * @var        int
	 */
	protected $wpmodule_item_id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the evaluation field.
	 * @var        int
	 */
	protected $evaluation;

	/**
	 * @var        Year
	 */
	protected $aYear;

	/**
	 * @var        Term
	 */
	protected $aTerm;

	/**
	 * @var        WpmoduleItem
	 */
	protected $aWpmoduleItem;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

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
	
	const PEER = 'StudentSituationPeer';

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
	 * Get the [year_id] column value.
	 * 
	 * @return     int
	 */
	public function getYearId()
	{
		return $this->year_id;
	}

	/**
	 * Get the [term_id] column value.
	 * 
	 * @return     string
	 */
	public function getTermId()
	{
		return $this->term_id;
	}

	/**
	 * Get the [wpmodule_item_id] column value.
	 * 
	 * @return     int
	 */
	public function getWpmoduleItemId()
	{
		return $this->wpmodule_item_id;
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
	 * @return     StudentSituation The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StudentSituationPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [year_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentSituation The current object (for fluent API support)
	 */
	public function setYearId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->year_id !== $v) {
			$this->year_id = $v;
			$this->modifiedColumns[] = StudentSituationPeer::YEAR_ID;
		}

		if ($this->aYear !== null && $this->aYear->getId() !== $v) {
			$this->aYear = null;
		}

		return $this;
	} // setYearId()

	/**
	 * Set the value of [term_id] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentSituation The current object (for fluent API support)
	 */
	public function setTermId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->term_id !== $v) {
			$this->term_id = $v;
			$this->modifiedColumns[] = StudentSituationPeer::TERM_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

		return $this;
	} // setTermId()

	/**
	 * Set the value of [wpmodule_item_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentSituation The current object (for fluent API support)
	 */
	public function setWpmoduleItemId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wpmodule_item_id !== $v) {
			$this->wpmodule_item_id = $v;
			$this->modifiedColumns[] = StudentSituationPeer::WPMODULE_ITEM_ID;
		}

		if ($this->aWpmoduleItem !== null && $this->aWpmoduleItem->getId() !== $v) {
			$this->aWpmoduleItem = null;
		}

		return $this;
	} // setWpmoduleItemId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentSituation The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = StudentSituationPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [evaluation] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentSituation The current object (for fluent API support)
	 */
	public function setEvaluation($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation !== $v) {
			$this->evaluation = $v;
			$this->modifiedColumns[] = StudentSituationPeer::EVALUATION;
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
			$this->year_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->term_id = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->wpmodule_item_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->user_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->evaluation = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = StudentSituationPeer::NUM_COLUMNS - StudentSituationPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating StudentSituation object", $e);
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

		if ($this->aYear !== null && $this->year_id !== $this->aYear->getId()) {
			$this->aYear = null;
		}
		if ($this->aTerm !== null && $this->term_id !== $this->aTerm->getId()) {
			$this->aTerm = null;
		}
		if ($this->aWpmoduleItem !== null && $this->wpmodule_item_id !== $this->aWpmoduleItem->getId()) {
			$this->aWpmoduleItem = null;
		}
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
			$con = Propel::getConnection(StudentSituationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = StudentSituationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aYear = null;
			$this->aTerm = null;
			$this->aWpmoduleItem = null;
			$this->asfGuardUser = null;
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
			$con = Propel::getConnection(StudentSituationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				StudentSituationPeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
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
			$con = Propel::getConnection(StudentSituationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				$con->commit();
				StudentSituationPeer::addInstanceToPool($this);
				return $affectedRows;
			}
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

			if ($this->aYear !== null) {
				if ($this->aYear->isModified() || $this->aYear->isNew()) {
					$affectedRows += $this->aYear->save($con);
				}
				$this->setYear($this->aYear);
			}

			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified() || $this->aTerm->isNew()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}

			if ($this->aWpmoduleItem !== null) {
				if ($this->aWpmoduleItem->isModified() || $this->aWpmoduleItem->isNew()) {
					$affectedRows += $this->aWpmoduleItem->save($con);
				}
				$this->setWpmoduleItem($this->aWpmoduleItem);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = StudentSituationPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StudentSituationPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += StudentSituationPeer::doUpdate($this, $con);
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

			if ($this->aYear !== null) {
				if (!$this->aYear->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aYear->getValidationFailures());
				}
			}

			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}

			if ($this->aWpmoduleItem !== null) {
				if (!$this->aWpmoduleItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWpmoduleItem->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = StudentSituationPeer::doValidate($this, $columns)) !== true) {
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
		$pos = StudentSituationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getYearId();
				break;
			case 2:
				return $this->getTermId();
				break;
			case 3:
				return $this->getWpmoduleItemId();
				break;
			case 4:
				return $this->getUserId();
				break;
			case 5:
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
		$keys = StudentSituationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getYearId(),
			$keys[2] => $this->getTermId(),
			$keys[3] => $this->getWpmoduleItemId(),
			$keys[4] => $this->getUserId(),
			$keys[5] => $this->getEvaluation(),
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
		$pos = StudentSituationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setYearId($value);
				break;
			case 2:
				$this->setTermId($value);
				break;
			case 3:
				$this->setWpmoduleItemId($value);
				break;
			case 4:
				$this->setUserId($value);
				break;
			case 5:
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
		$keys = StudentSituationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setYearId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTermId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setWpmoduleItemId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEvaluation($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StudentSituationPeer::DATABASE_NAME);

		if ($this->isColumnModified(StudentSituationPeer::ID)) $criteria->add(StudentSituationPeer::ID, $this->id);
		if ($this->isColumnModified(StudentSituationPeer::YEAR_ID)) $criteria->add(StudentSituationPeer::YEAR_ID, $this->year_id);
		if ($this->isColumnModified(StudentSituationPeer::TERM_ID)) $criteria->add(StudentSituationPeer::TERM_ID, $this->term_id);
		if ($this->isColumnModified(StudentSituationPeer::WPMODULE_ITEM_ID)) $criteria->add(StudentSituationPeer::WPMODULE_ITEM_ID, $this->wpmodule_item_id);
		if ($this->isColumnModified(StudentSituationPeer::USER_ID)) $criteria->add(StudentSituationPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(StudentSituationPeer::EVALUATION)) $criteria->add(StudentSituationPeer::EVALUATION, $this->evaluation);

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
		$criteria = new Criteria(StudentSituationPeer::DATABASE_NAME);

		$criteria->add(StudentSituationPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of StudentSituation (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setYearId($this->year_id);

		$copyObj->setTermId($this->term_id);

		$copyObj->setWpmoduleItemId($this->wpmodule_item_id);

		$copyObj->setUserId($this->user_id);

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
	 * @return     StudentSituation Clone of current object.
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
	 * @return     StudentSituationPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StudentSituationPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Year object.
	 *
	 * @param      Year $v
	 * @return     StudentSituation The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setYear(Year $v = null)
	{
		if ($v === null) {
			$this->setYearId(NULL);
		} else {
			$this->setYearId($v->getId());
		}

		$this->aYear = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Year object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentSituation($this);
		}

		return $this;
	}


	/**
	 * Get the associated Year object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Year The associated Year object.
	 * @throws     PropelException
	 */
	public function getYear(PropelPDO $con = null)
	{
		if ($this->aYear === null && ($this->year_id !== null)) {
			$this->aYear = YearPeer::retrieveByPk($this->year_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aYear->addStudentSituations($this);
			 */
		}
		return $this->aYear;
	}

	/**
	 * Declares an association between this object and a Term object.
	 *
	 * @param      Term $v
	 * @return     StudentSituation The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTerm(Term $v = null)
	{
		if ($v === null) {
			$this->setTermId(NULL);
		} else {
			$this->setTermId($v->getId());
		}

		$this->aTerm = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Term object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentSituation($this);
		}

		return $this;
	}


	/**
	 * Get the associated Term object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Term The associated Term object.
	 * @throws     PropelException
	 */
	public function getTerm(PropelPDO $con = null)
	{
		if ($this->aTerm === null && (($this->term_id !== "" && $this->term_id !== null))) {
			$this->aTerm = TermPeer::retrieveByPk($this->term_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTerm->addStudentSituations($this);
			 */
		}
		return $this->aTerm;
	}

	/**
	 * Declares an association between this object and a WpmoduleItem object.
	 *
	 * @param      WpmoduleItem $v
	 * @return     StudentSituation The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setWpmoduleItem(WpmoduleItem $v = null)
	{
		if ($v === null) {
			$this->setWpmoduleItemId(NULL);
		} else {
			$this->setWpmoduleItemId($v->getId());
		}

		$this->aWpmoduleItem = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the WpmoduleItem object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentSituation($this);
		}

		return $this;
	}


	/**
	 * Get the associated WpmoduleItem object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     WpmoduleItem The associated WpmoduleItem object.
	 * @throws     PropelException
	 */
	public function getWpmoduleItem(PropelPDO $con = null)
	{
		if ($this->aWpmoduleItem === null && ($this->wpmodule_item_id !== null)) {
			$this->aWpmoduleItem = WpmoduleItemPeer::retrieveByPk($this->wpmodule_item_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aWpmoduleItem->addStudentSituations($this);
			 */
		}
		return $this->aWpmoduleItem;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     StudentSituation The current object (for fluent API support)
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
			$v->addStudentSituation($this);
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
			   $this->asfGuardUser->addStudentSituations($this);
			 */
		}
		return $this->asfGuardUser;
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

			$this->aYear = null;
			$this->aTerm = null;
			$this->aWpmoduleItem = null;
			$this->asfGuardUser = null;
	}

} // BaseStudentSituation
