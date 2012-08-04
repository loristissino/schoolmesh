<?php

/**
 * Base class that represents a row from the 'wpitem_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWpitemType extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WpitemTypePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the singular field.
	 * @var        string
	 */
	protected $singular;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the style field.
	 * @var        string
	 */
	protected $style;

	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank;

	/**
	 * The value for the state_min field.
	 * Note: this column has a database default value of: 10
	 * @var        int
	 */
	protected $state_min;

	/**
	 * The value for the state_max field.
	 * Note: this column has a database default value of: 10
	 * @var        int
	 */
	protected $state_max;

	/**
	 * The value for the is_required field.
	 * @var        boolean
	 */
	protected $is_required;

	/**
	 * The value for the appointment_type_id field.
	 * @var        int
	 */
	protected $appointment_type_id;

	/**
	 * The value for the code field.
	 * @var        string
	 */
	protected $code;

	/**
	 * The value for the evaluation_min field.
	 * @var        int
	 */
	protected $evaluation_min;

	/**
	 * The value for the evaluation_max field.
	 * @var        int
	 */
	protected $evaluation_max;

	/**
	 * The value for the evaluation_min_description field.
	 * @var        string
	 */
	protected $evaluation_min_description;

	/**
	 * The value for the evaluation_max_description field.
	 * @var        string
	 */
	protected $evaluation_max_description;

	/**
	 * The value for the grade_min field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $grade_min;

	/**
	 * The value for the grade_max field.
	 * Note: this column has a database default value of: 5
	 * @var        int
	 */
	protected $grade_max;

	/**
	 * @var        AppointmentType
	 */
	protected $aAppointmentType;

	/**
	 * @var        array WpitemGroup[] Collection to store aggregation of WpitemGroup objects.
	 */
	protected $collWpitemGroups;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWpitemGroups.
	 */
	private $lastWpitemGroupCriteria = null;

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
	
	const PEER = 'WpitemTypePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->state_min = 10;
		$this->state_max = 10;
		$this->grade_min = 1;
		$this->grade_max = 5;
	}

	/**
	 * Initializes internal state of BaseWpitemType object.
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
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [singular] column value.
	 * 
	 * @return     string
	 */
	public function getSingular()
	{
		return $this->singular;
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
	 * Get the [style] column value.
	 * 
	 * @return     string
	 */
	public function getStyle()
	{
		return $this->style;
	}

	/**
	 * Get the [rank] column value.
	 * 
	 * @return     int
	 */
	public function getRank()
	{
		return $this->rank;
	}

	/**
	 * Get the [state_min] column value.
	 * 
	 * @return     int
	 */
	public function getStateMin()
	{
		return $this->state_min;
	}

	/**
	 * Get the [state_max] column value.
	 * 
	 * @return     int
	 */
	public function getStateMax()
	{
		return $this->state_max;
	}

	/**
	 * Get the [is_required] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsRequired()
	{
		return $this->is_required;
	}

	/**
	 * Get the [appointment_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getAppointmentTypeId()
	{
		return $this->appointment_type_id;
	}

	/**
	 * Get the [code] column value.
	 * 
	 * @return     string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Get the [evaluation_min] column value.
	 * 
	 * @return     int
	 */
	public function getEvaluationMin()
	{
		return $this->evaluation_min;
	}

	/**
	 * Get the [evaluation_max] column value.
	 * 
	 * @return     int
	 */
	public function getEvaluationMax()
	{
		return $this->evaluation_max;
	}

	/**
	 * Get the [evaluation_min_description] column value.
	 * 
	 * @return     string
	 */
	public function getEvaluationMinDescription()
	{
		return $this->evaluation_min_description;
	}

	/**
	 * Get the [evaluation_max_description] column value.
	 * 
	 * @return     string
	 */
	public function getEvaluationMaxDescription()
	{
		return $this->evaluation_max_description;
	}

	/**
	 * Get the [grade_min] column value.
	 * 
	 * @return     int
	 */
	public function getGradeMin()
	{
		return $this->grade_min;
	}

	/**
	 * Get the [grade_max] column value.
	 * 
	 * @return     int
	 */
	public function getGradeMax()
	{
		return $this->grade_max;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpitemTypePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = WpitemTypePeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [singular] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setSingular($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->singular !== $v) {
			$this->singular = $v;
			$this->modifiedColumns[] = WpitemTypePeer::SINGULAR;
		}

		return $this;
	} // setSingular()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = WpitemTypePeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [style] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setStyle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->style !== $v) {
			$this->style = $v;
			$this->modifiedColumns[] = WpitemTypePeer::STYLE;
		}

		return $this;
	} // setStyle()

	/**
	 * Set the value of [rank] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setRank($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = WpitemTypePeer::RANK;
		}

		return $this;
	} // setRank()

	/**
	 * Set the value of [state_min] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setStateMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state_min !== $v || $this->isNew()) {
			$this->state_min = $v;
			$this->modifiedColumns[] = WpitemTypePeer::STATE_MIN;
		}

		return $this;
	} // setStateMin()

	/**
	 * Set the value of [state_max] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setStateMax($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state_max !== $v || $this->isNew()) {
			$this->state_max = $v;
			$this->modifiedColumns[] = WpitemTypePeer::STATE_MAX;
		}

		return $this;
	} // setStateMax()

	/**
	 * Set the value of [is_required] column.
	 * 
	 * @param      boolean $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setIsRequired($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_required !== $v) {
			$this->is_required = $v;
			$this->modifiedColumns[] = WpitemTypePeer::IS_REQUIRED;
		}

		return $this;
	} // setIsRequired()

	/**
	 * Set the value of [appointment_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setAppointmentTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->appointment_type_id !== $v) {
			$this->appointment_type_id = $v;
			$this->modifiedColumns[] = WpitemTypePeer::APPOINTMENT_TYPE_ID;
		}

		if ($this->aAppointmentType !== null && $this->aAppointmentType->getId() !== $v) {
			$this->aAppointmentType = null;
		}

		return $this;
	} // setAppointmentTypeId()

	/**
	 * Set the value of [code] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = WpitemTypePeer::CODE;
		}

		return $this;
	} // setCode()

	/**
	 * Set the value of [evaluation_min] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setEvaluationMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation_min !== $v) {
			$this->evaluation_min = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MIN;
		}

		return $this;
	} // setEvaluationMin()

	/**
	 * Set the value of [evaluation_max] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setEvaluationMax($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation_max !== $v) {
			$this->evaluation_max = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MAX;
		}

		return $this;
	} // setEvaluationMax()

	/**
	 * Set the value of [evaluation_min_description] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setEvaluationMinDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->evaluation_min_description !== $v) {
			$this->evaluation_min_description = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MIN_DESCRIPTION;
		}

		return $this;
	} // setEvaluationMinDescription()

	/**
	 * Set the value of [evaluation_max_description] column.
	 * 
	 * @param      string $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setEvaluationMaxDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->evaluation_max_description !== $v) {
			$this->evaluation_max_description = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MAX_DESCRIPTION;
		}

		return $this;
	} // setEvaluationMaxDescription()

	/**
	 * Set the value of [grade_min] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setGradeMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->grade_min !== $v || $this->isNew()) {
			$this->grade_min = $v;
			$this->modifiedColumns[] = WpitemTypePeer::GRADE_MIN;
		}

		return $this;
	} // setGradeMin()

	/**
	 * Set the value of [grade_max] column.
	 * 
	 * @param      int $v new value
	 * @return     WpitemType The current object (for fluent API support)
	 */
	public function setGradeMax($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->grade_max !== $v || $this->isNew()) {
			$this->grade_max = $v;
			$this->modifiedColumns[] = WpitemTypePeer::GRADE_MAX;
		}

		return $this;
	} // setGradeMax()

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
			if ($this->state_min !== 10) {
				return false;
			}

			if ($this->state_max !== 10) {
				return false;
			}

			if ($this->grade_min !== 1) {
				return false;
			}

			if ($this->grade_max !== 5) {
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
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->singular = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->style = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->rank = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->state_min = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->state_max = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->is_required = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->appointment_type_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->code = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->evaluation_min = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->evaluation_max = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->evaluation_min_description = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->evaluation_max_description = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->grade_min = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->grade_max = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = WpitemTypePeer::NUM_COLUMNS - WpitemTypePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating WpitemType object", $e);
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

		if ($this->aAppointmentType !== null && $this->appointment_type_id !== $this->aAppointmentType->getId()) {
			$this->aAppointmentType = null;
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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = WpitemTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aAppointmentType = null;
			$this->collWpitemGroups = null;
			$this->lastWpitemGroupCriteria = null;

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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				WpitemTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				WpitemTypePeer::addInstanceToPool($this);
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

			if ($this->aAppointmentType !== null) {
				if ($this->aAppointmentType->isModified() || $this->aAppointmentType->isNew()) {
					$affectedRows += $this->aAppointmentType->save($con);
				}
				$this->setAppointmentType($this->aAppointmentType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WpitemTypePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpitemTypePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WpitemTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collWpitemGroups !== null) {
				foreach ($this->collWpitemGroups as $referrerFK) {
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

			if ($this->aAppointmentType !== null) {
				if (!$this->aAppointmentType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAppointmentType->getValidationFailures());
				}
			}


			if (($retval = WpitemTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpitemGroups !== null) {
					foreach ($this->collWpitemGroups as $referrerFK) {
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
		$pos = WpitemTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 2:
				return $this->getSingular();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getStyle();
				break;
			case 5:
				return $this->getRank();
				break;
			case 6:
				return $this->getStateMin();
				break;
			case 7:
				return $this->getStateMax();
				break;
			case 8:
				return $this->getIsRequired();
				break;
			case 9:
				return $this->getAppointmentTypeId();
				break;
			case 10:
				return $this->getCode();
				break;
			case 11:
				return $this->getEvaluationMin();
				break;
			case 12:
				return $this->getEvaluationMax();
				break;
			case 13:
				return $this->getEvaluationMinDescription();
				break;
			case 14:
				return $this->getEvaluationMaxDescription();
				break;
			case 15:
				return $this->getGradeMin();
				break;
			case 16:
				return $this->getGradeMax();
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
		$keys = WpitemTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getSingular(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getStyle(),
			$keys[5] => $this->getRank(),
			$keys[6] => $this->getStateMin(),
			$keys[7] => $this->getStateMax(),
			$keys[8] => $this->getIsRequired(),
			$keys[9] => $this->getAppointmentTypeId(),
			$keys[10] => $this->getCode(),
			$keys[11] => $this->getEvaluationMin(),
			$keys[12] => $this->getEvaluationMax(),
			$keys[13] => $this->getEvaluationMinDescription(),
			$keys[14] => $this->getEvaluationMaxDescription(),
			$keys[15] => $this->getGradeMin(),
			$keys[16] => $this->getGradeMax(),
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
		$pos = WpitemTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 2:
				$this->setSingular($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setStyle($value);
				break;
			case 5:
				$this->setRank($value);
				break;
			case 6:
				$this->setStateMin($value);
				break;
			case 7:
				$this->setStateMax($value);
				break;
			case 8:
				$this->setIsRequired($value);
				break;
			case 9:
				$this->setAppointmentTypeId($value);
				break;
			case 10:
				$this->setCode($value);
				break;
			case 11:
				$this->setEvaluationMin($value);
				break;
			case 12:
				$this->setEvaluationMax($value);
				break;
			case 13:
				$this->setEvaluationMinDescription($value);
				break;
			case 14:
				$this->setEvaluationMaxDescription($value);
				break;
			case 15:
				$this->setGradeMin($value);
				break;
			case 16:
				$this->setGradeMax($value);
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
		$keys = WpitemTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSingular($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStyle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRank($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStateMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStateMax($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsRequired($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAppointmentTypeId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCode($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEvaluationMin($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setEvaluationMax($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEvaluationMinDescription($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setEvaluationMaxDescription($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setGradeMin($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setGradeMax($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(WpitemTypePeer::ID)) $criteria->add(WpitemTypePeer::ID, $this->id);
		if ($this->isColumnModified(WpitemTypePeer::TITLE)) $criteria->add(WpitemTypePeer::TITLE, $this->title);
		if ($this->isColumnModified(WpitemTypePeer::SINGULAR)) $criteria->add(WpitemTypePeer::SINGULAR, $this->singular);
		if ($this->isColumnModified(WpitemTypePeer::DESCRIPTION)) $criteria->add(WpitemTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WpitemTypePeer::STYLE)) $criteria->add(WpitemTypePeer::STYLE, $this->style);
		if ($this->isColumnModified(WpitemTypePeer::RANK)) $criteria->add(WpitemTypePeer::RANK, $this->rank);
		if ($this->isColumnModified(WpitemTypePeer::STATE_MIN)) $criteria->add(WpitemTypePeer::STATE_MIN, $this->state_min);
		if ($this->isColumnModified(WpitemTypePeer::STATE_MAX)) $criteria->add(WpitemTypePeer::STATE_MAX, $this->state_max);
		if ($this->isColumnModified(WpitemTypePeer::IS_REQUIRED)) $criteria->add(WpitemTypePeer::IS_REQUIRED, $this->is_required);
		if ($this->isColumnModified(WpitemTypePeer::APPOINTMENT_TYPE_ID)) $criteria->add(WpitemTypePeer::APPOINTMENT_TYPE_ID, $this->appointment_type_id);
		if ($this->isColumnModified(WpitemTypePeer::CODE)) $criteria->add(WpitemTypePeer::CODE, $this->code);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MIN)) $criteria->add(WpitemTypePeer::EVALUATION_MIN, $this->evaluation_min);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MAX)) $criteria->add(WpitemTypePeer::EVALUATION_MAX, $this->evaluation_max);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MIN_DESCRIPTION)) $criteria->add(WpitemTypePeer::EVALUATION_MIN_DESCRIPTION, $this->evaluation_min_description);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MAX_DESCRIPTION)) $criteria->add(WpitemTypePeer::EVALUATION_MAX_DESCRIPTION, $this->evaluation_max_description);
		if ($this->isColumnModified(WpitemTypePeer::GRADE_MIN)) $criteria->add(WpitemTypePeer::GRADE_MIN, $this->grade_min);
		if ($this->isColumnModified(WpitemTypePeer::GRADE_MAX)) $criteria->add(WpitemTypePeer::GRADE_MAX, $this->grade_max);

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
		$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);

		$criteria->add(WpitemTypePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of WpitemType (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setSingular($this->singular);

		$copyObj->setDescription($this->description);

		$copyObj->setStyle($this->style);

		$copyObj->setRank($this->rank);

		$copyObj->setStateMin($this->state_min);

		$copyObj->setStateMax($this->state_max);

		$copyObj->setIsRequired($this->is_required);

		$copyObj->setAppointmentTypeId($this->appointment_type_id);

		$copyObj->setCode($this->code);

		$copyObj->setEvaluationMin($this->evaluation_min);

		$copyObj->setEvaluationMax($this->evaluation_max);

		$copyObj->setEvaluationMinDescription($this->evaluation_min_description);

		$copyObj->setEvaluationMaxDescription($this->evaluation_max_description);

		$copyObj->setGradeMin($this->grade_min);

		$copyObj->setGradeMax($this->grade_max);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getWpitemGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWpitemGroup($relObj->copy($deepCopy));
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
	 * @return     WpitemType Clone of current object.
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
	 * @return     WpitemTypePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WpitemTypePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a AppointmentType object.
	 *
	 * @param      AppointmentType $v
	 * @return     WpitemType The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAppointmentType(AppointmentType $v = null)
	{
		if ($v === null) {
			$this->setAppointmentTypeId(NULL);
		} else {
			$this->setAppointmentTypeId($v->getId());
		}

		$this->aAppointmentType = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the AppointmentType object, it will not be re-added.
		if ($v !== null) {
			$v->addWpitemType($this);
		}

		return $this;
	}


	/**
	 * Get the associated AppointmentType object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     AppointmentType The associated AppointmentType object.
	 * @throws     PropelException
	 */
	public function getAppointmentType(PropelPDO $con = null)
	{
		if ($this->aAppointmentType === null && ($this->appointment_type_id !== null)) {
			$this->aAppointmentType = AppointmentTypePeer::retrieveByPk($this->appointment_type_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAppointmentType->addWpitemTypes($this);
			 */
		}
		return $this->aAppointmentType;
	}

	/**
	 * Clears out the collWpitemGroups collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWpitemGroups()
	 */
	public function clearWpitemGroups()
	{
		$this->collWpitemGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWpitemGroups collection (array).
	 *
	 * By default this just sets the collWpitemGroups collection to an empty array (like clearcollWpitemGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWpitemGroups()
	{
		$this->collWpitemGroups = array();
	}

	/**
	 * Gets an array of WpitemGroup objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this WpitemType has previously been saved, it will retrieve
	 * related WpitemGroups from storage. If this WpitemType is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WpitemGroup[]
	 * @throws     PropelException
	 */
	public function getWpitemGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpitemGroups === null) {
			if ($this->isNew()) {
			   $this->collWpitemGroups = array();
			} else {

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				WpitemGroupPeer::addSelectColumns($criteria);
				$this->collWpitemGroups = WpitemGroupPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				WpitemGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpitemGroupCriteria) || !$this->lastWpitemGroupCriteria->equals($criteria)) {
					$this->collWpitemGroups = WpitemGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpitemGroupCriteria = $criteria;
		return $this->collWpitemGroups;
	}

	/**
	 * Returns the number of related WpitemGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WpitemGroup objects.
	 * @throws     PropelException
	 */
	public function countWpitemGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpitemGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				$count = WpitemGroupPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				if (!isset($this->lastWpitemGroupCriteria) || !$this->lastWpitemGroupCriteria->equals($criteria)) {
					$count = WpitemGroupPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWpitemGroups);
				}
			} else {
				$count = count($this->collWpitemGroups);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WpitemGroup object to this object
	 * through the WpitemGroup foreign key attribute.
	 *
	 * @param      WpitemGroup $l WpitemGroup
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWpitemGroup(WpitemGroup $l)
	{
		if ($this->collWpitemGroups === null) {
			$this->initWpitemGroups();
		}
		if (!in_array($l, $this->collWpitemGroups, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWpitemGroups, $l);
			$l->setWpitemType($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this WpitemType is new, it will return
	 * an empty collection; or if this WpitemType has previously
	 * been saved, it will retrieve related WpitemGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in WpitemType.
	 */
	public function getWpitemGroupsJoinWpmodule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpitemGroups === null) {
			if ($this->isNew()) {
				$this->collWpitemGroups = array();
			} else {

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				$this->collWpitemGroups = WpitemGroupPeer::doSelectJoinWpmodule($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

			if (!isset($this->lastWpitemGroupCriteria) || !$this->lastWpitemGroupCriteria->equals($criteria)) {
				$this->collWpitemGroups = WpitemGroupPeer::doSelectJoinWpmodule($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpitemGroupCriteria = $criteria;

		return $this->collWpitemGroups;
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
			if ($this->collWpitemGroups) {
				foreach ((array) $this->collWpitemGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collWpitemGroups = null;
			$this->aAppointmentType = null;
	}

} // BaseWpitemType
