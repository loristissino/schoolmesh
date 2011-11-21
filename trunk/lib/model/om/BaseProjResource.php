<?php

/**
 * Base class that represents a row from the 'proj_resource' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProjResource extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProjResourcePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the schoolproject_id field.
	 * @var        int
	 */
	protected $schoolproject_id;

	/**
	 * The value for the proj_resource_type_id field.
	 * @var        int
	 */
	protected $proj_resource_type_id;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the charged_user_id field.
	 * @var        int
	 */
	protected $charged_user_id;

	/**
	 * The value for the quantity_estimated field.
	 * @var        string
	 */
	protected $quantity_estimated;

	/**
	 * The value for the quantity_approved field.
	 * @var        string
	 */
	protected $quantity_approved;

	/**
	 * The value for the amount_estimated field.
	 * @var        string
	 */
	protected $amount_estimated;

	/**
	 * The value for the amount_funded_externally field.
	 * @var        string
	 */
	protected $amount_funded_externally;

	/**
	 * The value for the financing_notes field.
	 * @var        string
	 */
	protected $financing_notes;

	/**
	 * The value for the quantity_final field.
	 * @var        string
	 */
	protected $quantity_final;

	/**
	 * The value for the standard_cost field.
	 * @var        string
	 */
	protected $standard_cost;

	/**
	 * The value for the scheduled_deadline field.
	 * @var        string
	 */
	protected $scheduled_deadline;

	/**
	 * @var        Schoolproject
	 */
	protected $aSchoolproject;

	/**
	 * @var        ProjResourceType
	 */
	protected $aProjResourceType;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        array ProjActivity[] Collection to store aggregation of ProjActivity objects.
	 */
	protected $collProjActivitys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjActivitys.
	 */
	private $lastProjActivityCriteria = null;

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
	
	const PEER = 'ProjResourcePeer';

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
	 * Get the [schoolproject_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchoolprojectId()
	{
		return $this->schoolproject_id;
	}

	/**
	 * Get the [proj_resource_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getProjResourceTypeId()
	{
		return $this->proj_resource_type_id;
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
	 * Get the [charged_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getChargedUserId()
	{
		return $this->charged_user_id;
	}

	/**
	 * Get the [quantity_estimated] column value.
	 * 
	 * @return     string
	 */
	public function getQuantityEstimated()
	{
		return $this->quantity_estimated;
	}

	/**
	 * Get the [quantity_approved] column value.
	 * 
	 * @return     string
	 */
	public function getQuantityApproved()
	{
		return $this->quantity_approved;
	}

	/**
	 * Get the [amount_estimated] column value.
	 * 
	 * @return     string
	 */
	public function getAmountEstimated()
	{
		return $this->amount_estimated;
	}

	/**
	 * Get the [amount_funded_externally] column value.
	 * 
	 * @return     string
	 */
	public function getAmountFundedExternally()
	{
		return $this->amount_funded_externally;
	}

	/**
	 * Get the [financing_notes] column value.
	 * 
	 * @return     string
	 */
	public function getFinancingNotes()
	{
		return $this->financing_notes;
	}

	/**
	 * Get the [quantity_final] column value.
	 * 
	 * @return     string
	 */
	public function getQuantityFinal()
	{
		return $this->quantity_final;
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
	 * Get the [optionally formatted] temporal [scheduled_deadline] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getScheduledDeadline($format = 'Y-m-d')
	{
		if ($this->scheduled_deadline === null) {
			return null;
		}


		if ($this->scheduled_deadline === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->scheduled_deadline);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->scheduled_deadline, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ProjResourcePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [schoolproject_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setSchoolprojectId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->schoolproject_id !== $v) {
			$this->schoolproject_id = $v;
			$this->modifiedColumns[] = ProjResourcePeer::SCHOOLPROJECT_ID;
		}

		if ($this->aSchoolproject !== null && $this->aSchoolproject->getId() !== $v) {
			$this->aSchoolproject = null;
		}

		return $this;
	} // setSchoolprojectId()

	/**
	 * Set the value of [proj_resource_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setProjResourceTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->proj_resource_type_id !== $v) {
			$this->proj_resource_type_id = $v;
			$this->modifiedColumns[] = ProjResourcePeer::PROJ_RESOURCE_TYPE_ID;
		}

		if ($this->aProjResourceType !== null && $this->aProjResourceType->getId() !== $v) {
			$this->aProjResourceType = null;
		}

		return $this;
	} // setProjResourceTypeId()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProjResourcePeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [charged_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setChargedUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->charged_user_id !== $v) {
			$this->charged_user_id = $v;
			$this->modifiedColumns[] = ProjResourcePeer::CHARGED_USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setChargedUserId()

	/**
	 * Set the value of [quantity_estimated] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setQuantityEstimated($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->quantity_estimated !== $v) {
			$this->quantity_estimated = $v;
			$this->modifiedColumns[] = ProjResourcePeer::QUANTITY_ESTIMATED;
		}

		return $this;
	} // setQuantityEstimated()

	/**
	 * Set the value of [quantity_approved] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setQuantityApproved($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->quantity_approved !== $v) {
			$this->quantity_approved = $v;
			$this->modifiedColumns[] = ProjResourcePeer::QUANTITY_APPROVED;
		}

		return $this;
	} // setQuantityApproved()

	/**
	 * Set the value of [amount_estimated] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setAmountEstimated($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->amount_estimated !== $v) {
			$this->amount_estimated = $v;
			$this->modifiedColumns[] = ProjResourcePeer::AMOUNT_ESTIMATED;
		}

		return $this;
	} // setAmountEstimated()

	/**
	 * Set the value of [amount_funded_externally] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setAmountFundedExternally($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->amount_funded_externally !== $v) {
			$this->amount_funded_externally = $v;
			$this->modifiedColumns[] = ProjResourcePeer::AMOUNT_FUNDED_EXTERNALLY;
		}

		return $this;
	} // setAmountFundedExternally()

	/**
	 * Set the value of [financing_notes] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setFinancingNotes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->financing_notes !== $v) {
			$this->financing_notes = $v;
			$this->modifiedColumns[] = ProjResourcePeer::FINANCING_NOTES;
		}

		return $this;
	} // setFinancingNotes()

	/**
	 * Set the value of [quantity_final] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setQuantityFinal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->quantity_final !== $v) {
			$this->quantity_final = $v;
			$this->modifiedColumns[] = ProjResourcePeer::QUANTITY_FINAL;
		}

		return $this;
	} // setQuantityFinal()

	/**
	 * Set the value of [standard_cost] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setStandardCost($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->standard_cost !== $v) {
			$this->standard_cost = $v;
			$this->modifiedColumns[] = ProjResourcePeer::STANDARD_COST;
		}

		return $this;
	} // setStandardCost()

	/**
	 * Sets the value of [scheduled_deadline] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ProjResource The current object (for fluent API support)
	 */
	public function setScheduledDeadline($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->scheduled_deadline !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->scheduled_deadline !== null && $tmpDt = new DateTime($this->scheduled_deadline)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->scheduled_deadline = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ProjResourcePeer::SCHEDULED_DEADLINE;
			}
		} // if either are not null

		return $this;
	} // setScheduledDeadline()

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
			$this->schoolproject_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->proj_resource_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->charged_user_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->quantity_estimated = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->quantity_approved = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->amount_estimated = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->amount_funded_externally = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->financing_notes = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->quantity_final = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->standard_cost = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->scheduled_deadline = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = ProjResourcePeer::NUM_COLUMNS - ProjResourcePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ProjResource object", $e);
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

		if ($this->aSchoolproject !== null && $this->schoolproject_id !== $this->aSchoolproject->getId()) {
			$this->aSchoolproject = null;
		}
		if ($this->aProjResourceType !== null && $this->proj_resource_type_id !== $this->aProjResourceType->getId()) {
			$this->aProjResourceType = null;
		}
		if ($this->asfGuardUser !== null && $this->charged_user_id !== $this->asfGuardUser->getId()) {
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
			$con = Propel::getConnection(ProjResourcePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ProjResourcePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSchoolproject = null;
			$this->aProjResourceType = null;
			$this->asfGuardUser = null;
			$this->collProjActivitys = null;
			$this->lastProjActivityCriteria = null;

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
			$con = Propel::getConnection(ProjResourcePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				ProjResourcePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ProjResourcePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ProjResourcePeer::addInstanceToPool($this);
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

			if ($this->aSchoolproject !== null) {
				if ($this->aSchoolproject->isModified() || $this->aSchoolproject->isNew()) {
					$affectedRows += $this->aSchoolproject->save($con);
				}
				$this->setSchoolproject($this->aSchoolproject);
			}

			if ($this->aProjResourceType !== null) {
				if ($this->aProjResourceType->isModified() || $this->aProjResourceType->isNew()) {
					$affectedRows += $this->aProjResourceType->save($con);
				}
				$this->setProjResourceType($this->aProjResourceType);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ProjResourcePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProjResourcePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProjResourcePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProjActivitys !== null) {
				foreach ($this->collProjActivitys as $referrerFK) {
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

			if ($this->aSchoolproject !== null) {
				if (!$this->aSchoolproject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchoolproject->getValidationFailures());
				}
			}

			if ($this->aProjResourceType !== null) {
				if (!$this->aProjResourceType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProjResourceType->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = ProjResourcePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjActivitys !== null) {
					foreach ($this->collProjActivitys as $referrerFK) {
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
		$pos = ProjResourcePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSchoolprojectId();
				break;
			case 2:
				return $this->getProjResourceTypeId();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getChargedUserId();
				break;
			case 5:
				return $this->getQuantityEstimated();
				break;
			case 6:
				return $this->getQuantityApproved();
				break;
			case 7:
				return $this->getAmountEstimated();
				break;
			case 8:
				return $this->getAmountFundedExternally();
				break;
			case 9:
				return $this->getFinancingNotes();
				break;
			case 10:
				return $this->getQuantityFinal();
				break;
			case 11:
				return $this->getStandardCost();
				break;
			case 12:
				return $this->getScheduledDeadline();
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
		$keys = ProjResourcePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSchoolprojectId(),
			$keys[2] => $this->getProjResourceTypeId(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getChargedUserId(),
			$keys[5] => $this->getQuantityEstimated(),
			$keys[6] => $this->getQuantityApproved(),
			$keys[7] => $this->getAmountEstimated(),
			$keys[8] => $this->getAmountFundedExternally(),
			$keys[9] => $this->getFinancingNotes(),
			$keys[10] => $this->getQuantityFinal(),
			$keys[11] => $this->getStandardCost(),
			$keys[12] => $this->getScheduledDeadline(),
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
		$pos = ProjResourcePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSchoolprojectId($value);
				break;
			case 2:
				$this->setProjResourceTypeId($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setChargedUserId($value);
				break;
			case 5:
				$this->setQuantityEstimated($value);
				break;
			case 6:
				$this->setQuantityApproved($value);
				break;
			case 7:
				$this->setAmountEstimated($value);
				break;
			case 8:
				$this->setAmountFundedExternally($value);
				break;
			case 9:
				$this->setFinancingNotes($value);
				break;
			case 10:
				$this->setQuantityFinal($value);
				break;
			case 11:
				$this->setStandardCost($value);
				break;
			case 12:
				$this->setScheduledDeadline($value);
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
		$keys = ProjResourcePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSchoolprojectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProjResourceTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setChargedUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setQuantityEstimated($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setQuantityApproved($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAmountEstimated($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAmountFundedExternally($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setFinancingNotes($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setQuantityFinal($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStandardCost($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setScheduledDeadline($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjResourcePeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjResourcePeer::ID)) $criteria->add(ProjResourcePeer::ID, $this->id);
		if ($this->isColumnModified(ProjResourcePeer::SCHOOLPROJECT_ID)) $criteria->add(ProjResourcePeer::SCHOOLPROJECT_ID, $this->schoolproject_id);
		if ($this->isColumnModified(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID)) $criteria->add(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, $this->proj_resource_type_id);
		if ($this->isColumnModified(ProjResourcePeer::DESCRIPTION)) $criteria->add(ProjResourcePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProjResourcePeer::CHARGED_USER_ID)) $criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->charged_user_id);
		if ($this->isColumnModified(ProjResourcePeer::QUANTITY_ESTIMATED)) $criteria->add(ProjResourcePeer::QUANTITY_ESTIMATED, $this->quantity_estimated);
		if ($this->isColumnModified(ProjResourcePeer::QUANTITY_APPROVED)) $criteria->add(ProjResourcePeer::QUANTITY_APPROVED, $this->quantity_approved);
		if ($this->isColumnModified(ProjResourcePeer::AMOUNT_ESTIMATED)) $criteria->add(ProjResourcePeer::AMOUNT_ESTIMATED, $this->amount_estimated);
		if ($this->isColumnModified(ProjResourcePeer::AMOUNT_FUNDED_EXTERNALLY)) $criteria->add(ProjResourcePeer::AMOUNT_FUNDED_EXTERNALLY, $this->amount_funded_externally);
		if ($this->isColumnModified(ProjResourcePeer::FINANCING_NOTES)) $criteria->add(ProjResourcePeer::FINANCING_NOTES, $this->financing_notes);
		if ($this->isColumnModified(ProjResourcePeer::QUANTITY_FINAL)) $criteria->add(ProjResourcePeer::QUANTITY_FINAL, $this->quantity_final);
		if ($this->isColumnModified(ProjResourcePeer::STANDARD_COST)) $criteria->add(ProjResourcePeer::STANDARD_COST, $this->standard_cost);
		if ($this->isColumnModified(ProjResourcePeer::SCHEDULED_DEADLINE)) $criteria->add(ProjResourcePeer::SCHEDULED_DEADLINE, $this->scheduled_deadline);

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
		$criteria = new Criteria(ProjResourcePeer::DATABASE_NAME);

		$criteria->add(ProjResourcePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ProjResource (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSchoolprojectId($this->schoolproject_id);

		$copyObj->setProjResourceTypeId($this->proj_resource_type_id);

		$copyObj->setDescription($this->description);

		$copyObj->setChargedUserId($this->charged_user_id);

		$copyObj->setQuantityEstimated($this->quantity_estimated);

		$copyObj->setQuantityApproved($this->quantity_approved);

		$copyObj->setAmountEstimated($this->amount_estimated);

		$copyObj->setAmountFundedExternally($this->amount_funded_externally);

		$copyObj->setFinancingNotes($this->financing_notes);

		$copyObj->setQuantityFinal($this->quantity_final);

		$copyObj->setStandardCost($this->standard_cost);

		$copyObj->setScheduledDeadline($this->scheduled_deadline);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getProjActivitys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjActivity($relObj->copy($deepCopy));
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
	 * @return     ProjResource Clone of current object.
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
	 * @return     ProjResourcePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProjResourcePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Schoolproject object.
	 *
	 * @param      Schoolproject $v
	 * @return     ProjResource The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSchoolproject(Schoolproject $v = null)
	{
		if ($v === null) {
			$this->setSchoolprojectId(NULL);
		} else {
			$this->setSchoolprojectId($v->getId());
		}

		$this->aSchoolproject = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Schoolproject object, it will not be re-added.
		if ($v !== null) {
			$v->addProjResource($this);
		}

		return $this;
	}


	/**
	 * Get the associated Schoolproject object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Schoolproject The associated Schoolproject object.
	 * @throws     PropelException
	 */
	public function getSchoolproject(PropelPDO $con = null)
	{
		if ($this->aSchoolproject === null && ($this->schoolproject_id !== null)) {
			$this->aSchoolproject = SchoolprojectPeer::retrieveByPk($this->schoolproject_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSchoolproject->addProjResources($this);
			 */
		}
		return $this->aSchoolproject;
	}

	/**
	 * Declares an association between this object and a ProjResourceType object.
	 *
	 * @param      ProjResourceType $v
	 * @return     ProjResource The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setProjResourceType(ProjResourceType $v = null)
	{
		if ($v === null) {
			$this->setProjResourceTypeId(NULL);
		} else {
			$this->setProjResourceTypeId($v->getId());
		}

		$this->aProjResourceType = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ProjResourceType object, it will not be re-added.
		if ($v !== null) {
			$v->addProjResource($this);
		}

		return $this;
	}


	/**
	 * Get the associated ProjResourceType object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ProjResourceType The associated ProjResourceType object.
	 * @throws     PropelException
	 */
	public function getProjResourceType(PropelPDO $con = null)
	{
		if ($this->aProjResourceType === null && ($this->proj_resource_type_id !== null)) {
			$this->aProjResourceType = ProjResourceTypePeer::retrieveByPk($this->proj_resource_type_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aProjResourceType->addProjResources($this);
			 */
		}
		return $this->aProjResourceType;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     ProjResource The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setChargedUserId(NULL);
		} else {
			$this->setChargedUserId($v->getId());
		}

		$this->asfGuardUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addProjResource($this);
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
		if ($this->asfGuardUser === null && ($this->charged_user_id !== null)) {
			$this->asfGuardUser = sfGuardUserPeer::retrieveByPk($this->charged_user_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfGuardUser->addProjResources($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Clears out the collProjActivitys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjActivitys()
	 */
	public function clearProjActivitys()
	{
		$this->collProjActivitys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjActivitys collection (array).
	 *
	 * By default this just sets the collProjActivitys collection to an empty array (like clearcollProjActivitys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjActivitys()
	{
		$this->collProjActivitys = array();
	}

	/**
	 * Gets an array of ProjActivity objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ProjResource has previously been saved, it will retrieve
	 * related ProjActivitys from storage. If this ProjResource is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjActivity[]
	 * @throws     PropelException
	 */
	public function getProjActivitys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourcePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitys === null) {
			if ($this->isNew()) {
			   $this->collProjActivitys = array();
			} else {

				$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

				ProjActivityPeer::addSelectColumns($criteria);
				$this->collProjActivitys = ProjActivityPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

				ProjActivityPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjActivityCriteria) || !$this->lastProjActivityCriteria->equals($criteria)) {
					$this->collProjActivitys = ProjActivityPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjActivityCriteria = $criteria;
		return $this->collProjActivitys;
	}

	/**
	 * Returns the number of related ProjActivity objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ProjActivity objects.
	 * @throws     PropelException
	 */
	public function countProjActivitys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourcePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjActivitys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

				$count = ProjActivityPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

				if (!isset($this->lastProjActivityCriteria) || !$this->lastProjActivityCriteria->equals($criteria)) {
					$count = ProjActivityPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjActivitys);
				}
			} else {
				$count = count($this->collProjActivitys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ProjActivity object to this object
	 * through the ProjActivity foreign key attribute.
	 *
	 * @param      ProjActivity $l ProjActivity
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjActivity(ProjActivity $l)
	{
		if ($this->collProjActivitys === null) {
			$this->initProjActivitys();
		}
		if (!in_array($l, $this->collProjActivitys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjActivitys, $l);
			$l->setProjResource($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProjResource is new, it will return
	 * an empty collection; or if this ProjResource has previously
	 * been saved, it will retrieve related ProjActivitys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProjResource.
	 */
	public function getProjActivitysJoinsfGuardUserRelatedByUserId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourcePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitys === null) {
			if ($this->isNew()) {
				$this->collProjActivitys = array();
			} else {

				$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

				$this->collProjActivitys = ProjActivityPeer::doSelectJoinsfGuardUserRelatedByUserId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

			if (!isset($this->lastProjActivityCriteria) || !$this->lastProjActivityCriteria->equals($criteria)) {
				$this->collProjActivitys = ProjActivityPeer::doSelectJoinsfGuardUserRelatedByUserId($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjActivityCriteria = $criteria;

		return $this->collProjActivitys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProjResource is new, it will return
	 * an empty collection; or if this ProjResource has previously
	 * been saved, it will retrieve related ProjActivitys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProjResource.
	 */
	public function getProjActivitysJoinsfGuardUserRelatedByAcknowledgerUserId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjResourcePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitys === null) {
			if ($this->isNew()) {
				$this->collProjActivitys = array();
			} else {

				$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

				$this->collProjActivitys = ProjActivityPeer::doSelectJoinsfGuardUserRelatedByAcknowledgerUserId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->id);

			if (!isset($this->lastProjActivityCriteria) || !$this->lastProjActivityCriteria->equals($criteria)) {
				$this->collProjActivitys = ProjActivityPeer::doSelectJoinsfGuardUserRelatedByAcknowledgerUserId($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjActivityCriteria = $criteria;

		return $this->collProjActivitys;
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
			if ($this->collProjActivitys) {
				foreach ((array) $this->collProjActivitys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collProjActivitys = null;
			$this->aSchoolproject = null;
			$this->aProjResourceType = null;
			$this->asfGuardUser = null;
	}

} // BaseProjResource
