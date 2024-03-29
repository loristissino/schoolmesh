<?php

/**
 * Base class that represents a row from the 'term' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseTerm extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TermPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        string
	 */
	protected $id;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the end_day field.
	 * @var        int
	 */
	protected $end_day;

	/**
	 * The value for the has_formal_evaluation field.
	 * @var        boolean
	 */
	protected $has_formal_evaluation;

	/**
	 * @var        array StudentSituation[] Collection to store aggregation of StudentSituation objects.
	 */
	protected $collStudentSituations;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentSituations.
	 */
	private $lastStudentSituationCriteria = null;

	/**
	 * @var        array StudentSuggestion[] Collection to store aggregation of StudentSuggestion objects.
	 */
	protected $collStudentSuggestions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentSuggestions.
	 */
	private $lastStudentSuggestionCriteria = null;

	/**
	 * @var        array StudentHint[] Collection to store aggregation of StudentHint objects.
	 */
	protected $collStudentHints;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentHints.
	 */
	private $lastStudentHintCriteria = null;

	/**
	 * @var        array StudentSyllabusItem[] Collection to store aggregation of StudentSyllabusItem objects.
	 */
	protected $collStudentSyllabusItems;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentSyllabusItems.
	 */
	private $lastStudentSyllabusItemCriteria = null;

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
	
	const PEER = 'TermPeer';

	/**
	 * Get the [id] column value.
	 * 
	 * @return     string
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
	 * Get the [end_day] column value.
	 * 
	 * @return     int
	 */
	public function getEndDay()
	{
		return $this->end_day;
	}

	/**
	 * Get the [has_formal_evaluation] column value.
	 * 
	 * @return     boolean
	 */
	public function getHasFormalEvaluation()
	{
		return $this->has_formal_evaluation;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      string $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TermPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = TermPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [end_day] column.
	 * 
	 * @param      int $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setEndDay($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->end_day !== $v) {
			$this->end_day = $v;
			$this->modifiedColumns[] = TermPeer::END_DAY;
		}

		return $this;
	} // setEndDay()

	/**
	 * Set the value of [has_formal_evaluation] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setHasFormalEvaluation($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->has_formal_evaluation !== $v) {
			$this->has_formal_evaluation = $v;
			$this->modifiedColumns[] = TermPeer::HAS_FORMAL_EVALUATION;
		}

		return $this;
	} // setHasFormalEvaluation()

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

			$this->id = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->end_day = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->has_formal_evaluation = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Term object", $e);
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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TermPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collStudentSituations = null;
			$this->lastStudentSituationCriteria = null;

			$this->collStudentSuggestions = null;
			$this->lastStudentSuggestionCriteria = null;

			$this->collStudentHints = null;
			$this->lastStudentHintCriteria = null;

			$this->collStudentSyllabusItems = null;
			$this->lastStudentSyllabusItemCriteria = null;

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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				TermPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				TermPeer::addInstanceToPool($this);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TermPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TermPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collStudentSituations !== null) {
				foreach ($this->collStudentSituations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStudentSuggestions !== null) {
				foreach ($this->collStudentSuggestions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStudentHints !== null) {
				foreach ($this->collStudentHints as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStudentSyllabusItems !== null) {
				foreach ($this->collStudentSyllabusItems as $referrerFK) {
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


			if (($retval = TermPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collStudentSituations !== null) {
					foreach ($this->collStudentSituations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStudentSuggestions !== null) {
					foreach ($this->collStudentSuggestions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStudentHints !== null) {
					foreach ($this->collStudentHints as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStudentSyllabusItems !== null) {
					foreach ($this->collStudentSyllabusItems as $referrerFK) {
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
		$pos = TermPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEndDay();
				break;
			case 3:
				return $this->getHasFormalEvaluation();
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
		$keys = TermPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getEndDay(),
			$keys[3] => $this->getHasFormalEvaluation(),
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
		$pos = TermPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEndDay($value);
				break;
			case 3:
				$this->setHasFormalEvaluation($value);
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
		$keys = TermPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEndDay($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHasFormalEvaluation($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TermPeer::DATABASE_NAME);

		if ($this->isColumnModified(TermPeer::ID)) $criteria->add(TermPeer::ID, $this->id);
		if ($this->isColumnModified(TermPeer::DESCRIPTION)) $criteria->add(TermPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(TermPeer::END_DAY)) $criteria->add(TermPeer::END_DAY, $this->end_day);
		if ($this->isColumnModified(TermPeer::HAS_FORMAL_EVALUATION)) $criteria->add(TermPeer::HAS_FORMAL_EVALUATION, $this->has_formal_evaluation);

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
		$criteria = new Criteria(TermPeer::DATABASE_NAME);

		$criteria->add(TermPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      string $key Primary key.
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
	 * @param      object $copyObj An object of Term (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setId($this->id);

		$copyObj->setDescription($this->description);

		$copyObj->setEndDay($this->end_day);

		$copyObj->setHasFormalEvaluation($this->has_formal_evaluation);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getStudentSituations() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentSituation($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStudentSuggestions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentSuggestion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStudentHints() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentHint($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStudentSyllabusItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentSyllabusItem($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     Term Clone of current object.
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
	 * @return     TermPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TermPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collStudentSituations collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentSituations()
	 */
	public function clearStudentSituations()
	{
		$this->collStudentSituations = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentSituations collection (array).
	 *
	 * By default this just sets the collStudentSituations collection to an empty array (like clearcollStudentSituations());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentSituations()
	{
		$this->collStudentSituations = array();
	}

	/**
	 * Gets an array of StudentSituation objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Term has previously been saved, it will retrieve
	 * related StudentSituations from storage. If this Term is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentSituation[]
	 * @throws     PropelException
	 */
	public function getStudentSituations($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
			   $this->collStudentSituations = array();
			} else {

				$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

				StudentSituationPeer::addSelectColumns($criteria);
				$this->collStudentSituations = StudentSituationPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

				StudentSituationPeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentSituationCriteria) || !$this->lastStudentSituationCriteria->equals($criteria)) {
					$this->collStudentSituations = StudentSituationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentSituationCriteria = $criteria;
		return $this->collStudentSituations;
	}

	/**
	 * Returns the number of related StudentSituation objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentSituation objects.
	 * @throws     PropelException
	 */
	public function countStudentSituations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

				$count = StudentSituationPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

				if (!isset($this->lastStudentSituationCriteria) || !$this->lastStudentSituationCriteria->equals($criteria)) {
					$count = StudentSituationPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collStudentSituations);
				}
			} else {
				$count = count($this->collStudentSituations);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentSituation object to this object
	 * through the StudentSituation foreign key attribute.
	 *
	 * @param      StudentSituation $l StudentSituation
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentSituation(StudentSituation $l)
	{
		if ($this->collStudentSituations === null) {
			$this->initStudentSituations();
		}
		if (!in_array($l, $this->collStudentSituations, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentSituations, $l);
			$l->setTerm($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSituations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSituationsJoinWpmoduleItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
				$this->collStudentSituations = array();
			} else {

				$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

				$this->collStudentSituations = StudentSituationPeer::doSelectJoinWpmoduleItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSituationCriteria) || !$this->lastStudentSituationCriteria->equals($criteria)) {
				$this->collStudentSituations = StudentSituationPeer::doSelectJoinWpmoduleItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSituationCriteria = $criteria;

		return $this->collStudentSituations;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSituations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSituationsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
				$this->collStudentSituations = array();
			} else {

				$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

				$this->collStudentSituations = StudentSituationPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSituationPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSituationCriteria) || !$this->lastStudentSituationCriteria->equals($criteria)) {
				$this->collStudentSituations = StudentSituationPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSituationCriteria = $criteria;

		return $this->collStudentSituations;
	}

	/**
	 * Clears out the collStudentSuggestions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentSuggestions()
	 */
	public function clearStudentSuggestions()
	{
		$this->collStudentSuggestions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentSuggestions collection (array).
	 *
	 * By default this just sets the collStudentSuggestions collection to an empty array (like clearcollStudentSuggestions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentSuggestions()
	{
		$this->collStudentSuggestions = array();
	}

	/**
	 * Gets an array of StudentSuggestion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Term has previously been saved, it will retrieve
	 * related StudentSuggestions from storage. If this Term is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentSuggestion[]
	 * @throws     PropelException
	 */
	public function getStudentSuggestions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
			   $this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				StudentSuggestionPeer::addSelectColumns($criteria);
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				StudentSuggestionPeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentSuggestionCriteria) || !$this->lastStudentSuggestionCriteria->equals($criteria)) {
					$this->collStudentSuggestions = StudentSuggestionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentSuggestionCriteria = $criteria;
		return $this->collStudentSuggestions;
	}

	/**
	 * Returns the number of related StudentSuggestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentSuggestion objects.
	 * @throws     PropelException
	 */
	public function countStudentSuggestions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				$count = StudentSuggestionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				if (!isset($this->lastStudentSuggestionCriteria) || !$this->lastStudentSuggestionCriteria->equals($criteria)) {
					$count = StudentSuggestionPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collStudentSuggestions);
				}
			} else {
				$count = count($this->collStudentSuggestions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentSuggestion object to this object
	 * through the StudentSuggestion foreign key attribute.
	 *
	 * @param      StudentSuggestion $l StudentSuggestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentSuggestion(StudentSuggestion $l)
	{
		if ($this->collStudentSuggestions === null) {
			$this->initStudentSuggestions();
		}
		if (!in_array($l, $this->collStudentSuggestions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentSuggestions, $l);
			$l->setTerm($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSuggestionsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSuggestionCriteria) || !$this->lastStudentSuggestionCriteria->equals($criteria)) {
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSuggestionCriteria = $criteria;

		return $this->collStudentSuggestions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSuggestionsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSuggestionCriteria) || !$this->lastStudentSuggestionCriteria->equals($criteria)) {
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSuggestionCriteria = $criteria;

		return $this->collStudentSuggestions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSuggestionsJoinSuggestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinSuggestion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSuggestionCriteria) || !$this->lastStudentSuggestionCriteria->equals($criteria)) {
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinSuggestion($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSuggestionCriteria = $criteria;

		return $this->collStudentSuggestions;
	}

	/**
	 * Clears out the collStudentHints collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentHints()
	 */
	public function clearStudentHints()
	{
		$this->collStudentHints = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentHints collection (array).
	 *
	 * By default this just sets the collStudentHints collection to an empty array (like clearcollStudentHints());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentHints()
	{
		$this->collStudentHints = array();
	}

	/**
	 * Gets an array of StudentHint objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Term has previously been saved, it will retrieve
	 * related StudentHints from storage. If this Term is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentHint[]
	 * @throws     PropelException
	 */
	public function getStudentHints($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
			   $this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				StudentHintPeer::addSelectColumns($criteria);
				$this->collStudentHints = StudentHintPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				StudentHintPeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentHintCriteria) || !$this->lastStudentHintCriteria->equals($criteria)) {
					$this->collStudentHints = StudentHintPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentHintCriteria = $criteria;
		return $this->collStudentHints;
	}

	/**
	 * Returns the number of related StudentHint objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentHint objects.
	 * @throws     PropelException
	 */
	public function countStudentHints(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				$count = StudentHintPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				if (!isset($this->lastStudentHintCriteria) || !$this->lastStudentHintCriteria->equals($criteria)) {
					$count = StudentHintPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collStudentHints);
				}
			} else {
				$count = count($this->collStudentHints);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentHint object to this object
	 * through the StudentHint foreign key attribute.
	 *
	 * @param      StudentHint $l StudentHint
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentHint(StudentHint $l)
	{
		if ($this->collStudentHints === null) {
			$this->initStudentHints();
		}
		if (!in_array($l, $this->collStudentHints, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentHints, $l);
			$l->setTerm($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentHintsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentHintCriteria) || !$this->lastStudentHintCriteria->equals($criteria)) {
				$this->collStudentHints = StudentHintPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentHintCriteria = $criteria;

		return $this->collStudentHints;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentHintsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentHintCriteria) || !$this->lastStudentHintCriteria->equals($criteria)) {
				$this->collStudentHints = StudentHintPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentHintCriteria = $criteria;

		return $this->collStudentHints;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentHintsJoinRecuperationHint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::TERM_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinRecuperationHint($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentHintCriteria) || !$this->lastStudentHintCriteria->equals($criteria)) {
				$this->collStudentHints = StudentHintPeer::doSelectJoinRecuperationHint($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentHintCriteria = $criteria;

		return $this->collStudentHints;
	}

	/**
	 * Clears out the collStudentSyllabusItems collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentSyllabusItems()
	 */
	public function clearStudentSyllabusItems()
	{
		$this->collStudentSyllabusItems = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentSyllabusItems collection (array).
	 *
	 * By default this just sets the collStudentSyllabusItems collection to an empty array (like clearcollStudentSyllabusItems());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentSyllabusItems()
	{
		$this->collStudentSyllabusItems = array();
	}

	/**
	 * Gets an array of StudentSyllabusItem objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Term has previously been saved, it will retrieve
	 * related StudentSyllabusItems from storage. If this Term is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentSyllabusItem[]
	 * @throws     PropelException
	 */
	public function getStudentSyllabusItems($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
			   $this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				StudentSyllabusItemPeer::addSelectColumns($criteria);
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				StudentSyllabusItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
					$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentSyllabusItemCriteria = $criteria;
		return $this->collStudentSyllabusItems;
	}

	/**
	 * Returns the number of related StudentSyllabusItem objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentSyllabusItem objects.
	 * @throws     PropelException
	 */
	public function countStudentSyllabusItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				$count = StudentSyllabusItemPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
					$count = StudentSyllabusItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collStudentSyllabusItems);
				}
			} else {
				$count = count($this->collStudentSyllabusItems);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentSyllabusItem object to this object
	 * through the StudentSyllabusItem foreign key attribute.
	 *
	 * @param      StudentSyllabusItem $l StudentSyllabusItem
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentSyllabusItem(StudentSyllabusItem $l)
	{
		if ($this->collStudentSyllabusItems === null) {
			$this->initStudentSyllabusItems();
		}
		if (!in_array($l, $this->collStudentSyllabusItems, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentSyllabusItems, $l);
			$l->setTerm($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSyllabusItemsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSyllabusItemCriteria = $criteria;

		return $this->collStudentSyllabusItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSyllabusItemsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSyllabusItemCriteria = $criteria;

		return $this->collStudentSyllabusItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Term is new, it will return
	 * an empty collection; or if this Term has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Term.
	 */
	public function getStudentSyllabusItemsJoinSyllabusItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TermPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::TERM_ID, $this->id);

			if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSyllabusItemCriteria = $criteria;

		return $this->collStudentSyllabusItems;
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
			if ($this->collStudentSituations) {
				foreach ((array) $this->collStudentSituations as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStudentSuggestions) {
				foreach ((array) $this->collStudentSuggestions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStudentHints) {
				foreach ((array) $this->collStudentHints as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStudentSyllabusItems) {
				foreach ((array) $this->collStudentSyllabusItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collStudentSituations = null;
		$this->collStudentSuggestions = null;
		$this->collStudentHints = null;
		$this->collStudentSyllabusItems = null;
	}

} // BaseTerm
