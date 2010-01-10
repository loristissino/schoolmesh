<?php

/**
 * Base class that represents a row from the 'student_hint' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseStudentHint extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StudentHintPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the term_id field.
	 * @var        string
	 */
	protected $term_id;

	/**
	 * The value for the appointment_id field.
	 * @var        int
	 */
	protected $appointment_id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the recuperation_hint_id field.
	 * @var        int
	 */
	protected $recuperation_hint_id;

	/**
	 * @var        Term
	 */
	protected $aTerm;

	/**
	 * @var        Appointment
	 */
	protected $aAppointment;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        RecuperationHint
	 */
	protected $aRecuperationHint;

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
	
	const PEER = 'StudentHintPeer';

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
	 * Get the [term_id] column value.
	 * 
	 * @return     string
	 */
	public function getTermId()
	{
		return $this->term_id;
	}

	/**
	 * Get the [appointment_id] column value.
	 * 
	 * @return     int
	 */
	public function getAppointmentId()
	{
		return $this->appointment_id;
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
	 * Get the [recuperation_hint_id] column value.
	 * 
	 * @return     int
	 */
	public function getRecuperationHintId()
	{
		return $this->recuperation_hint_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentHint The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StudentHintPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [term_id] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentHint The current object (for fluent API support)
	 */
	public function setTermId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->term_id !== $v) {
			$this->term_id = $v;
			$this->modifiedColumns[] = StudentHintPeer::TERM_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

		return $this;
	} // setTermId()

	/**
	 * Set the value of [appointment_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentHint The current object (for fluent API support)
	 */
	public function setAppointmentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->appointment_id !== $v) {
			$this->appointment_id = $v;
			$this->modifiedColumns[] = StudentHintPeer::APPOINTMENT_ID;
		}

		if ($this->aAppointment !== null && $this->aAppointment->getId() !== $v) {
			$this->aAppointment = null;
		}

		return $this;
	} // setAppointmentId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentHint The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = StudentHintPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [recuperation_hint_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentHint The current object (for fluent API support)
	 */
	public function setRecuperationHintId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->recuperation_hint_id !== $v) {
			$this->recuperation_hint_id = $v;
			$this->modifiedColumns[] = StudentHintPeer::RECUPERATION_HINT_ID;
		}

		if ($this->aRecuperationHint !== null && $this->aRecuperationHint->getId() !== $v) {
			$this->aRecuperationHint = null;
		}

		return $this;
	} // setRecuperationHintId()

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
			$this->term_id = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->appointment_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->user_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->recuperation_hint_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = StudentHintPeer::NUM_COLUMNS - StudentHintPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating StudentHint object", $e);
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

		if ($this->aTerm !== null && $this->term_id !== $this->aTerm->getId()) {
			$this->aTerm = null;
		}
		if ($this->aAppointment !== null && $this->appointment_id !== $this->aAppointment->getId()) {
			$this->aAppointment = null;
		}
		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aRecuperationHint !== null && $this->recuperation_hint_id !== $this->aRecuperationHint->getId()) {
			$this->aRecuperationHint = null;
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
			$con = Propel::getConnection(StudentHintPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = StudentHintPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTerm = null;
			$this->aAppointment = null;
			$this->asfGuardUser = null;
			$this->aRecuperationHint = null;
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
			$con = Propel::getConnection(StudentHintPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				StudentHintPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(StudentHintPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				StudentHintPeer::addInstanceToPool($this);
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

			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified() || $this->aTerm->isNew()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}

			if ($this->aAppointment !== null) {
				if ($this->aAppointment->isModified() || $this->aAppointment->isNew()) {
					$affectedRows += $this->aAppointment->save($con);
				}
				$this->setAppointment($this->aAppointment);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aRecuperationHint !== null) {
				if ($this->aRecuperationHint->isModified() || $this->aRecuperationHint->isNew()) {
					$affectedRows += $this->aRecuperationHint->save($con);
				}
				$this->setRecuperationHint($this->aRecuperationHint);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = StudentHintPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StudentHintPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += StudentHintPeer::doUpdate($this, $con);
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

			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}

			if ($this->aAppointment !== null) {
				if (!$this->aAppointment->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAppointment->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aRecuperationHint !== null) {
				if (!$this->aRecuperationHint->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRecuperationHint->getValidationFailures());
				}
			}


			if (($retval = StudentHintPeer::doValidate($this, $columns)) !== true) {
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
		$pos = StudentHintPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTermId();
				break;
			case 2:
				return $this->getAppointmentId();
				break;
			case 3:
				return $this->getUserId();
				break;
			case 4:
				return $this->getRecuperationHintId();
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
		$keys = StudentHintPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTermId(),
			$keys[2] => $this->getAppointmentId(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getRecuperationHintId(),
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
		$pos = StudentHintPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTermId($value);
				break;
			case 2:
				$this->setAppointmentId($value);
				break;
			case 3:
				$this->setUserId($value);
				break;
			case 4:
				$this->setRecuperationHintId($value);
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
		$keys = StudentHintPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTermId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAppointmentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRecuperationHintId($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StudentHintPeer::DATABASE_NAME);

		if ($this->isColumnModified(StudentHintPeer::ID)) $criteria->add(StudentHintPeer::ID, $this->id);
		if ($this->isColumnModified(StudentHintPeer::TERM_ID)) $criteria->add(StudentHintPeer::TERM_ID, $this->term_id);
		if ($this->isColumnModified(StudentHintPeer::APPOINTMENT_ID)) $criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->appointment_id);
		if ($this->isColumnModified(StudentHintPeer::USER_ID)) $criteria->add(StudentHintPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(StudentHintPeer::RECUPERATION_HINT_ID)) $criteria->add(StudentHintPeer::RECUPERATION_HINT_ID, $this->recuperation_hint_id);

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
		$criteria = new Criteria(StudentHintPeer::DATABASE_NAME);

		$criteria->add(StudentHintPeer::ID, $this->id);
		$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->appointment_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getAppointmentId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setAppointmentId($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of StudentHint (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTermId($this->term_id);

		$copyObj->setAppointmentId($this->appointment_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setRecuperationHintId($this->recuperation_hint_id);


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
	 * @return     StudentHint Clone of current object.
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
	 * @return     StudentHintPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StudentHintPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Term object.
	 *
	 * @param      Term $v
	 * @return     StudentHint The current object (for fluent API support)
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
			$v->addStudentHint($this);
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
			   $this->aTerm->addStudentHints($this);
			 */
		}
		return $this->aTerm;
	}

	/**
	 * Declares an association between this object and a Appointment object.
	 *
	 * @param      Appointment $v
	 * @return     StudentHint The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAppointment(Appointment $v = null)
	{
		if ($v === null) {
			$this->setAppointmentId(NULL);
		} else {
			$this->setAppointmentId($v->getId());
		}

		$this->aAppointment = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Appointment object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentHint($this);
		}

		return $this;
	}


	/**
	 * Get the associated Appointment object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Appointment The associated Appointment object.
	 * @throws     PropelException
	 */
	public function getAppointment(PropelPDO $con = null)
	{
		if ($this->aAppointment === null && ($this->appointment_id !== null)) {
			$this->aAppointment = AppointmentPeer::retrieveByPk($this->appointment_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAppointment->addStudentHints($this);
			 */
		}
		return $this->aAppointment;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     StudentHint The current object (for fluent API support)
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
			$v->addStudentHint($this);
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
			   $this->asfGuardUser->addStudentHints($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Declares an association between this object and a RecuperationHint object.
	 *
	 * @param      RecuperationHint $v
	 * @return     StudentHint The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRecuperationHint(RecuperationHint $v = null)
	{
		if ($v === null) {
			$this->setRecuperationHintId(NULL);
		} else {
			$this->setRecuperationHintId($v->getId());
		}

		$this->aRecuperationHint = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the RecuperationHint object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentHint($this);
		}

		return $this;
	}


	/**
	 * Get the associated RecuperationHint object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     RecuperationHint The associated RecuperationHint object.
	 * @throws     PropelException
	 */
	public function getRecuperationHint(PropelPDO $con = null)
	{
		if ($this->aRecuperationHint === null && ($this->recuperation_hint_id !== null)) {
			$this->aRecuperationHint = RecuperationHintPeer::retrieveByPk($this->recuperation_hint_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aRecuperationHint->addStudentHints($this);
			 */
		}
		return $this->aRecuperationHint;
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

			$this->aTerm = null;
			$this->aAppointment = null;
			$this->asfGuardUser = null;
			$this->aRecuperationHint = null;
	}

} // BaseStudentHint
