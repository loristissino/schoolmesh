<?php

/**
 * Base class that represents a row from the 'schoolproject' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchoolproject extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SchoolprojectPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the proj_category_id field.
	 * @var        int
	 */
	protected $proj_category_id;

	/**
	 * The value for the year_id field.
	 * @var        int
	 */
	protected $year_id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the notes field.
	 * @var        string
	 */
	protected $notes;

	/**
	 * The value for the hours_approved field.
	 * @var        int
	 */
	protected $hours_approved;

	/**
	 * The value for the state field.
	 * @var        int
	 */
	protected $state;

	/**
	 * @var        ProjCategory
	 */
	protected $aProjCategory;

	/**
	 * @var        Year
	 */
	protected $aYear;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        array ProjDeadline[] Collection to store aggregation of ProjDeadline objects.
	 */
	protected $collProjDeadlines;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjDeadlines.
	 */
	private $lastProjDeadlineCriteria = null;

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
	
	const PEER = 'SchoolprojectPeer';

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
	 * Get the [proj_category_id] column value.
	 * 
	 * @return     int
	 */
	public function getProjCategoryId()
	{
		return $this->proj_category_id;
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
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
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
	 * Get the [notes] column value.
	 * 
	 * @return     string
	 */
	public function getNotes()
	{
		return $this->notes;
	}

	/**
	 * Get the [hours_approved] column value.
	 * 
	 * @return     int
	 */
	public function getHoursApproved()
	{
		return $this->hours_approved;
	}

	/**
	 * Get the [state] column value.
	 * 
	 * @return     int
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [proj_category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setProjCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->proj_category_id !== $v) {
			$this->proj_category_id = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::PROJ_CATEGORY_ID;
		}

		if ($this->aProjCategory !== null && $this->aProjCategory->getId() !== $v) {
			$this->aProjCategory = null;
		}

		return $this;
	} // setProjCategoryId()

	/**
	 * Set the value of [year_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setYearId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->year_id !== $v) {
			$this->year_id = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::YEAR_ID;
		}

		if ($this->aYear !== null && $this->aYear->getId() !== $v) {
			$this->aYear = null;
		}

		return $this;
	} // setYearId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [notes] column.
	 * 
	 * @param      string $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setNotes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->notes !== $v) {
			$this->notes = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::NOTES;
		}

		return $this;
	} // setNotes()

	/**
	 * Set the value of [hours_approved] column.
	 * 
	 * @param      int $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setHoursApproved($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hours_approved !== $v) {
			$this->hours_approved = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::HOURS_APPROVED;
		}

		return $this;
	} // setHoursApproved()

	/**
	 * Set the value of [state] column.
	 * 
	 * @param      int $v new value
	 * @return     Schoolproject The current object (for fluent API support)
	 */
	public function setState($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = SchoolprojectPeer::STATE;
		}

		return $this;
	} // setState()

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
			$this->proj_category_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->year_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->user_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->title = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->description = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->notes = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->hours_approved = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->state = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = SchoolprojectPeer::NUM_COLUMNS - SchoolprojectPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Schoolproject object", $e);
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

		if ($this->aProjCategory !== null && $this->proj_category_id !== $this->aProjCategory->getId()) {
			$this->aProjCategory = null;
		}
		if ($this->aYear !== null && $this->year_id !== $this->aYear->getId()) {
			$this->aYear = null;
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
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SchoolprojectPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aProjCategory = null;
			$this->aYear = null;
			$this->asfGuardUser = null;
			$this->collProjDeadlines = null;
			$this->lastProjDeadlineCriteria = null;

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
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SchoolprojectPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SchoolprojectPeer::addInstanceToPool($this);
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

			if ($this->aProjCategory !== null) {
				if ($this->aProjCategory->isModified() || $this->aProjCategory->isNew()) {
					$affectedRows += $this->aProjCategory->save($con);
				}
				$this->setProjCategory($this->aProjCategory);
			}

			if ($this->aYear !== null) {
				if ($this->aYear->isModified() || $this->aYear->isNew()) {
					$affectedRows += $this->aYear->save($con);
				}
				$this->setYear($this->aYear);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SchoolprojectPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SchoolprojectPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SchoolprojectPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProjDeadlines !== null) {
				foreach ($this->collProjDeadlines as $referrerFK) {
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

			if ($this->aProjCategory !== null) {
				if (!$this->aProjCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProjCategory->getValidationFailures());
				}
			}

			if ($this->aYear !== null) {
				if (!$this->aYear->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aYear->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = SchoolprojectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjDeadlines !== null) {
					foreach ($this->collProjDeadlines as $referrerFK) {
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
		$pos = SchoolprojectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getProjCategoryId();
				break;
			case 2:
				return $this->getYearId();
				break;
			case 3:
				return $this->getUserId();
				break;
			case 4:
				return $this->getTitle();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getNotes();
				break;
			case 7:
				return $this->getHoursApproved();
				break;
			case 8:
				return $this->getState();
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
		$keys = SchoolprojectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProjCategoryId(),
			$keys[2] => $this->getYearId(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getTitle(),
			$keys[5] => $this->getDescription(),
			$keys[6] => $this->getNotes(),
			$keys[7] => $this->getHoursApproved(),
			$keys[8] => $this->getState(),
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
		$pos = SchoolprojectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setProjCategoryId($value);
				break;
			case 2:
				$this->setYearId($value);
				break;
			case 3:
				$this->setUserId($value);
				break;
			case 4:
				$this->setTitle($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setNotes($value);
				break;
			case 7:
				$this->setHoursApproved($value);
				break;
			case 8:
				$this->setState($value);
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
		$keys = SchoolprojectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProjCategoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setYearId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNotes($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHoursApproved($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setState($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchoolprojectPeer::ID)) $criteria->add(SchoolprojectPeer::ID, $this->id);
		if ($this->isColumnModified(SchoolprojectPeer::PROJ_CATEGORY_ID)) $criteria->add(SchoolprojectPeer::PROJ_CATEGORY_ID, $this->proj_category_id);
		if ($this->isColumnModified(SchoolprojectPeer::YEAR_ID)) $criteria->add(SchoolprojectPeer::YEAR_ID, $this->year_id);
		if ($this->isColumnModified(SchoolprojectPeer::USER_ID)) $criteria->add(SchoolprojectPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(SchoolprojectPeer::TITLE)) $criteria->add(SchoolprojectPeer::TITLE, $this->title);
		if ($this->isColumnModified(SchoolprojectPeer::DESCRIPTION)) $criteria->add(SchoolprojectPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SchoolprojectPeer::NOTES)) $criteria->add(SchoolprojectPeer::NOTES, $this->notes);
		if ($this->isColumnModified(SchoolprojectPeer::HOURS_APPROVED)) $criteria->add(SchoolprojectPeer::HOURS_APPROVED, $this->hours_approved);
		if ($this->isColumnModified(SchoolprojectPeer::STATE)) $criteria->add(SchoolprojectPeer::STATE, $this->state);

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
		$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);

		$criteria->add(SchoolprojectPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Schoolproject (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setProjCategoryId($this->proj_category_id);

		$copyObj->setYearId($this->year_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setNotes($this->notes);

		$copyObj->setHoursApproved($this->hours_approved);

		$copyObj->setState($this->state);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getProjDeadlines() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjDeadline($relObj->copy($deepCopy));
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
	 * @return     Schoolproject Clone of current object.
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
	 * @return     SchoolprojectPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SchoolprojectPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a ProjCategory object.
	 *
	 * @param      ProjCategory $v
	 * @return     Schoolproject The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setProjCategory(ProjCategory $v = null)
	{
		if ($v === null) {
			$this->setProjCategoryId(NULL);
		} else {
			$this->setProjCategoryId($v->getId());
		}

		$this->aProjCategory = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ProjCategory object, it will not be re-added.
		if ($v !== null) {
			$v->addSchoolproject($this);
		}

		return $this;
	}


	/**
	 * Get the associated ProjCategory object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ProjCategory The associated ProjCategory object.
	 * @throws     PropelException
	 */
	public function getProjCategory(PropelPDO $con = null)
	{
		if ($this->aProjCategory === null && ($this->proj_category_id !== null)) {
			$this->aProjCategory = ProjCategoryPeer::retrieveByPk($this->proj_category_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aProjCategory->addSchoolprojects($this);
			 */
		}
		return $this->aProjCategory;
	}

	/**
	 * Declares an association between this object and a Year object.
	 *
	 * @param      Year $v
	 * @return     Schoolproject The current object (for fluent API support)
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
			$v->addSchoolproject($this);
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
			   $this->aYear->addSchoolprojects($this);
			 */
		}
		return $this->aYear;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Schoolproject The current object (for fluent API support)
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
			$v->addSchoolproject($this);
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
			   $this->asfGuardUser->addSchoolprojects($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Clears out the collProjDeadlines collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjDeadlines()
	 */
	public function clearProjDeadlines()
	{
		$this->collProjDeadlines = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjDeadlines collection (array).
	 *
	 * By default this just sets the collProjDeadlines collection to an empty array (like clearcollProjDeadlines());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjDeadlines()
	{
		$this->collProjDeadlines = array();
	}

	/**
	 * Gets an array of ProjDeadline objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Schoolproject has previously been saved, it will retrieve
	 * related ProjDeadlines from storage. If this Schoolproject is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjDeadline[]
	 * @throws     PropelException
	 */
	public function getProjDeadlines($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjDeadlines === null) {
			if ($this->isNew()) {
			   $this->collProjDeadlines = array();
			} else {

				$criteria->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->id);

				ProjDeadlinePeer::addSelectColumns($criteria);
				$this->collProjDeadlines = ProjDeadlinePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->id);

				ProjDeadlinePeer::addSelectColumns($criteria);
				if (!isset($this->lastProjDeadlineCriteria) || !$this->lastProjDeadlineCriteria->equals($criteria)) {
					$this->collProjDeadlines = ProjDeadlinePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjDeadlineCriteria = $criteria;
		return $this->collProjDeadlines;
	}

	/**
	 * Returns the number of related ProjDeadline objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ProjDeadline objects.
	 * @throws     PropelException
	 */
	public function countProjDeadlines(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjDeadlines === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->id);

				$count = ProjDeadlinePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->id);

				if (!isset($this->lastProjDeadlineCriteria) || !$this->lastProjDeadlineCriteria->equals($criteria)) {
					$count = ProjDeadlinePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjDeadlines);
				}
			} else {
				$count = count($this->collProjDeadlines);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ProjDeadline object to this object
	 * through the ProjDeadline foreign key attribute.
	 *
	 * @param      ProjDeadline $l ProjDeadline
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjDeadline(ProjDeadline $l)
	{
		if ($this->collProjDeadlines === null) {
			$this->initProjDeadlines();
		}
		if (!in_array($l, $this->collProjDeadlines, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjDeadlines, $l);
			$l->setSchoolproject($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Schoolproject is new, it will return
	 * an empty collection; or if this Schoolproject has previously
	 * been saved, it will retrieve related ProjDeadlines from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Schoolproject.
	 */
	public function getProjDeadlinesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolprojectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjDeadlines === null) {
			if ($this->isNew()) {
				$this->collProjDeadlines = array();
			} else {

				$criteria->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->id);

				$this->collProjDeadlines = ProjDeadlinePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->id);

			if (!isset($this->lastProjDeadlineCriteria) || !$this->lastProjDeadlineCriteria->equals($criteria)) {
				$this->collProjDeadlines = ProjDeadlinePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjDeadlineCriteria = $criteria;

		return $this->collProjDeadlines;
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
			if ($this->collProjDeadlines) {
				foreach ((array) $this->collProjDeadlines as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collProjDeadlines = null;
			$this->aProjCategory = null;
			$this->aYear = null;
			$this->asfGuardUser = null;
	}

} // BaseSchoolproject
