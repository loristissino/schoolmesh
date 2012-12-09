<?php

/**
 * Base class that represents a row from the 'proj_detail_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProjDetailType extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProjDetailTypePeer
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
	 * The value for the code field.
	 * @var        string
	 */
	protected $code;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the label field.
	 * @var        string
	 */
	protected $label;

	/**
	 * The value for the is_required field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_required;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the state_min field.
	 * @var        int
	 */
	protected $state_min;

	/**
	 * The value for the state_max field.
	 * @var        int
	 */
	protected $state_max;

	/**
	 * The value for the printed_in_submission_documents field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $printed_in_submission_documents;

	/**
	 * The value for the printed_in_report_documents field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $printed_in_report_documents;

	/**
	 * The value for the example field.
	 * @var        string
	 */
	protected $example;

	/**
	 * The value for the missing_value_message field.
	 * @var        string
	 */
	protected $missing_value_message;

	/**
	 * The value for the filled_value_message field.
	 * @var        string
	 */
	protected $filled_value_message;

	/**
	 * The value for the cols field.
	 * Note: this column has a database default value of: 80
	 * @var        int
	 */
	protected $cols;

	/**
	 * The value for the rows field.
	 * Note: this column has a database default value of: 5
	 * @var        int
	 */
	protected $rows;

	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank;

	/**
	 * @var        ProjCategory
	 */
	protected $aProjCategory;

	/**
	 * @var        array ProjDetail[] Collection to store aggregation of ProjDetail objects.
	 */
	protected $collProjDetails;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjDetails.
	 */
	private $lastProjDetailCriteria = null;

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
	
	const PEER = 'ProjDetailTypePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_required = true;
		$this->is_active = true;
		$this->printed_in_submission_documents = true;
		$this->printed_in_report_documents = true;
		$this->cols = 80;
		$this->rows = 5;
	}

	/**
	 * Initializes internal state of BaseProjDetailType object.
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
	 * Get the [proj_category_id] column value.
	 * 
	 * @return     int
	 */
	public function getProjCategoryId()
	{
		return $this->proj_category_id;
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
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [label] column value.
	 * 
	 * @return     string
	 */
	public function getLabel()
	{
		return $this->label;
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
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{
		return $this->is_active;
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
	 * Get the [printed_in_submission_documents] column value.
	 * 
	 * @return     boolean
	 */
	public function getPrintedInSubmissionDocuments()
	{
		return $this->printed_in_submission_documents;
	}

	/**
	 * Get the [printed_in_report_documents] column value.
	 * 
	 * @return     boolean
	 */
	public function getPrintedInReportDocuments()
	{
		return $this->printed_in_report_documents;
	}

	/**
	 * Get the [example] column value.
	 * 
	 * @return     string
	 */
	public function getExample()
	{
		return $this->example;
	}

	/**
	 * Get the [missing_value_message] column value.
	 * 
	 * @return     string
	 */
	public function getMissingValueMessage()
	{
		return $this->missing_value_message;
	}

	/**
	 * Get the [filled_value_message] column value.
	 * 
	 * @return     string
	 */
	public function getFilledValueMessage()
	{
		return $this->filled_value_message;
	}

	/**
	 * Get the [cols] column value.
	 * 
	 * @return     int
	 */
	public function getCols()
	{
		return $this->cols;
	}

	/**
	 * Get the [rows] column value.
	 * 
	 * @return     int
	 */
	public function getRows()
	{
		return $this->rows;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [proj_category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setProjCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->proj_category_id !== $v) {
			$this->proj_category_id = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::PROJ_CATEGORY_ID;
		}

		if ($this->aProjCategory !== null && $this->aProjCategory->getId() !== $v) {
			$this->aProjCategory = null;
		}

		return $this;
	} // setProjCategoryId()

	/**
	 * Set the value of [code] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::CODE;
		}

		return $this;
	} // setCode()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [label] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setLabel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::LABEL;
		}

		return $this;
	} // setLabel()

	/**
	 * Set the value of [is_required] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setIsRequired($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_required !== $v || $this->isNew()) {
			$this->is_required = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::IS_REQUIRED;
		}

		return $this;
	} // setIsRequired()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [state_min] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setStateMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state_min !== $v) {
			$this->state_min = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::STATE_MIN;
		}

		return $this;
	} // setStateMin()

	/**
	 * Set the value of [state_max] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setStateMax($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state_max !== $v) {
			$this->state_max = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::STATE_MAX;
		}

		return $this;
	} // setStateMax()

	/**
	 * Set the value of [printed_in_submission_documents] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setPrintedInSubmissionDocuments($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->printed_in_submission_documents !== $v || $this->isNew()) {
			$this->printed_in_submission_documents = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::PRINTED_IN_SUBMISSION_DOCUMENTS;
		}

		return $this;
	} // setPrintedInSubmissionDocuments()

	/**
	 * Set the value of [printed_in_report_documents] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setPrintedInReportDocuments($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->printed_in_report_documents !== $v || $this->isNew()) {
			$this->printed_in_report_documents = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::PRINTED_IN_REPORT_DOCUMENTS;
		}

		return $this;
	} // setPrintedInReportDocuments()

	/**
	 * Set the value of [example] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setExample($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->example !== $v) {
			$this->example = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::EXAMPLE;
		}

		return $this;
	} // setExample()

	/**
	 * Set the value of [missing_value_message] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setMissingValueMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->missing_value_message !== $v) {
			$this->missing_value_message = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::MISSING_VALUE_MESSAGE;
		}

		return $this;
	} // setMissingValueMessage()

	/**
	 * Set the value of [filled_value_message] column.
	 * 
	 * @param      string $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setFilledValueMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->filled_value_message !== $v) {
			$this->filled_value_message = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::FILLED_VALUE_MESSAGE;
		}

		return $this;
	} // setFilledValueMessage()

	/**
	 * Set the value of [cols] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setCols($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cols !== $v || $this->isNew()) {
			$this->cols = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::COLS;
		}

		return $this;
	} // setCols()

	/**
	 * Set the value of [rows] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setRows($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rows !== $v || $this->isNew()) {
			$this->rows = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::ROWS;
		}

		return $this;
	} // setRows()

	/**
	 * Set the value of [rank] column.
	 * 
	 * @param      int $v new value
	 * @return     ProjDetailType The current object (for fluent API support)
	 */
	public function setRank($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = ProjDetailTypePeer::RANK;
		}

		return $this;
	} // setRank()

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
			if ($this->is_required !== true) {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->printed_in_submission_documents !== true) {
				return false;
			}

			if ($this->printed_in_report_documents !== true) {
				return false;
			}

			if ($this->cols !== 80) {
				return false;
			}

			if ($this->rows !== 5) {
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
			$this->proj_category_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->code = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->label = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_required = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->is_active = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->state_min = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->state_max = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->printed_in_submission_documents = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
			$this->printed_in_report_documents = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
			$this->example = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->missing_value_message = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->filled_value_message = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->cols = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->rows = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->rank = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = ProjDetailTypePeer::NUM_COLUMNS - ProjDetailTypePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ProjDetailType object", $e);
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
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ProjDetailTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aProjCategory = null;
			$this->collProjDetails = null;
			$this->lastProjDetailCriteria = null;

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
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				ProjDetailTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ProjDetailTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ProjDetailTypePeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ProjDetailTypePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProjDetailTypePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProjDetailTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProjDetails !== null) {
				foreach ($this->collProjDetails as $referrerFK) {
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


			if (($retval = ProjDetailTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjDetails !== null) {
					foreach ($this->collProjDetails as $referrerFK) {
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
		$pos = ProjDetailTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCode();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getLabel();
				break;
			case 5:
				return $this->getIsRequired();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getStateMin();
				break;
			case 8:
				return $this->getStateMax();
				break;
			case 9:
				return $this->getPrintedInSubmissionDocuments();
				break;
			case 10:
				return $this->getPrintedInReportDocuments();
				break;
			case 11:
				return $this->getExample();
				break;
			case 12:
				return $this->getMissingValueMessage();
				break;
			case 13:
				return $this->getFilledValueMessage();
				break;
			case 14:
				return $this->getCols();
				break;
			case 15:
				return $this->getRows();
				break;
			case 16:
				return $this->getRank();
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
		$keys = ProjDetailTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProjCategoryId(),
			$keys[2] => $this->getCode(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getLabel(),
			$keys[5] => $this->getIsRequired(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getStateMin(),
			$keys[8] => $this->getStateMax(),
			$keys[9] => $this->getPrintedInSubmissionDocuments(),
			$keys[10] => $this->getPrintedInReportDocuments(),
			$keys[11] => $this->getExample(),
			$keys[12] => $this->getMissingValueMessage(),
			$keys[13] => $this->getFilledValueMessage(),
			$keys[14] => $this->getCols(),
			$keys[15] => $this->getRows(),
			$keys[16] => $this->getRank(),
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
		$pos = ProjDetailTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCode($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setLabel($value);
				break;
			case 5:
				$this->setIsRequired($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setStateMin($value);
				break;
			case 8:
				$this->setStateMax($value);
				break;
			case 9:
				$this->setPrintedInSubmissionDocuments($value);
				break;
			case 10:
				$this->setPrintedInReportDocuments($value);
				break;
			case 11:
				$this->setExample($value);
				break;
			case 12:
				$this->setMissingValueMessage($value);
				break;
			case 13:
				$this->setFilledValueMessage($value);
				break;
			case 14:
				$this->setCols($value);
				break;
			case 15:
				$this->setRows($value);
				break;
			case 16:
				$this->setRank($value);
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
		$keys = ProjDetailTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProjCategoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLabel($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsRequired($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStateMin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStateMax($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPrintedInSubmissionDocuments($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPrintedInReportDocuments($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setExample($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setMissingValueMessage($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setFilledValueMessage($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCols($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setRows($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setRank($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjDetailTypePeer::ID)) $criteria->add(ProjDetailTypePeer::ID, $this->id);
		if ($this->isColumnModified(ProjDetailTypePeer::PROJ_CATEGORY_ID)) $criteria->add(ProjDetailTypePeer::PROJ_CATEGORY_ID, $this->proj_category_id);
		if ($this->isColumnModified(ProjDetailTypePeer::CODE)) $criteria->add(ProjDetailTypePeer::CODE, $this->code);
		if ($this->isColumnModified(ProjDetailTypePeer::DESCRIPTION)) $criteria->add(ProjDetailTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProjDetailTypePeer::LABEL)) $criteria->add(ProjDetailTypePeer::LABEL, $this->label);
		if ($this->isColumnModified(ProjDetailTypePeer::IS_REQUIRED)) $criteria->add(ProjDetailTypePeer::IS_REQUIRED, $this->is_required);
		if ($this->isColumnModified(ProjDetailTypePeer::IS_ACTIVE)) $criteria->add(ProjDetailTypePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(ProjDetailTypePeer::STATE_MIN)) $criteria->add(ProjDetailTypePeer::STATE_MIN, $this->state_min);
		if ($this->isColumnModified(ProjDetailTypePeer::STATE_MAX)) $criteria->add(ProjDetailTypePeer::STATE_MAX, $this->state_max);
		if ($this->isColumnModified(ProjDetailTypePeer::PRINTED_IN_SUBMISSION_DOCUMENTS)) $criteria->add(ProjDetailTypePeer::PRINTED_IN_SUBMISSION_DOCUMENTS, $this->printed_in_submission_documents);
		if ($this->isColumnModified(ProjDetailTypePeer::PRINTED_IN_REPORT_DOCUMENTS)) $criteria->add(ProjDetailTypePeer::PRINTED_IN_REPORT_DOCUMENTS, $this->printed_in_report_documents);
		if ($this->isColumnModified(ProjDetailTypePeer::EXAMPLE)) $criteria->add(ProjDetailTypePeer::EXAMPLE, $this->example);
		if ($this->isColumnModified(ProjDetailTypePeer::MISSING_VALUE_MESSAGE)) $criteria->add(ProjDetailTypePeer::MISSING_VALUE_MESSAGE, $this->missing_value_message);
		if ($this->isColumnModified(ProjDetailTypePeer::FILLED_VALUE_MESSAGE)) $criteria->add(ProjDetailTypePeer::FILLED_VALUE_MESSAGE, $this->filled_value_message);
		if ($this->isColumnModified(ProjDetailTypePeer::COLS)) $criteria->add(ProjDetailTypePeer::COLS, $this->cols);
		if ($this->isColumnModified(ProjDetailTypePeer::ROWS)) $criteria->add(ProjDetailTypePeer::ROWS, $this->rows);
		if ($this->isColumnModified(ProjDetailTypePeer::RANK)) $criteria->add(ProjDetailTypePeer::RANK, $this->rank);

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
		$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);

		$criteria->add(ProjDetailTypePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ProjDetailType (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setProjCategoryId($this->proj_category_id);

		$copyObj->setCode($this->code);

		$copyObj->setDescription($this->description);

		$copyObj->setLabel($this->label);

		$copyObj->setIsRequired($this->is_required);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setStateMin($this->state_min);

		$copyObj->setStateMax($this->state_max);

		$copyObj->setPrintedInSubmissionDocuments($this->printed_in_submission_documents);

		$copyObj->setPrintedInReportDocuments($this->printed_in_report_documents);

		$copyObj->setExample($this->example);

		$copyObj->setMissingValueMessage($this->missing_value_message);

		$copyObj->setFilledValueMessage($this->filled_value_message);

		$copyObj->setCols($this->cols);

		$copyObj->setRows($this->rows);

		$copyObj->setRank($this->rank);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getProjDetails() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjDetail($relObj->copy($deepCopy));
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
	 * @return     ProjDetailType Clone of current object.
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
	 * @return     ProjDetailTypePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProjDetailTypePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a ProjCategory object.
	 *
	 * @param      ProjCategory $v
	 * @return     ProjDetailType The current object (for fluent API support)
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
			$v->addProjDetailType($this);
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
			   $this->aProjCategory->addProjDetailTypes($this);
			 */
		}
		return $this->aProjCategory;
	}

	/**
	 * Clears out the collProjDetails collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjDetails()
	 */
	public function clearProjDetails()
	{
		$this->collProjDetails = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjDetails collection (array).
	 *
	 * By default this just sets the collProjDetails collection to an empty array (like clearcollProjDetails());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjDetails()
	{
		$this->collProjDetails = array();
	}

	/**
	 * Gets an array of ProjDetail objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ProjDetailType has previously been saved, it will retrieve
	 * related ProjDetails from storage. If this ProjDetailType is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjDetail[]
	 * @throws     PropelException
	 */
	public function getProjDetails($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjDetails === null) {
			if ($this->isNew()) {
			   $this->collProjDetails = array();
			} else {

				$criteria->add(ProjDetailPeer::PROJ_DETAIL_TYPE_ID, $this->id);

				ProjDetailPeer::addSelectColumns($criteria);
				$this->collProjDetails = ProjDetailPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjDetailPeer::PROJ_DETAIL_TYPE_ID, $this->id);

				ProjDetailPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjDetailCriteria) || !$this->lastProjDetailCriteria->equals($criteria)) {
					$this->collProjDetails = ProjDetailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjDetailCriteria = $criteria;
		return $this->collProjDetails;
	}

	/**
	 * Returns the number of related ProjDetail objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ProjDetail objects.
	 * @throws     PropelException
	 */
	public function countProjDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjDetails === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjDetailPeer::PROJ_DETAIL_TYPE_ID, $this->id);

				$count = ProjDetailPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjDetailPeer::PROJ_DETAIL_TYPE_ID, $this->id);

				if (!isset($this->lastProjDetailCriteria) || !$this->lastProjDetailCriteria->equals($criteria)) {
					$count = ProjDetailPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjDetails);
				}
			} else {
				$count = count($this->collProjDetails);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ProjDetail object to this object
	 * through the ProjDetail foreign key attribute.
	 *
	 * @param      ProjDetail $l ProjDetail
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjDetail(ProjDetail $l)
	{
		if ($this->collProjDetails === null) {
			$this->initProjDetails();
		}
		if (!in_array($l, $this->collProjDetails, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjDetails, $l);
			$l->setProjDetailType($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProjDetailType is new, it will return
	 * an empty collection; or if this ProjDetailType has previously
	 * been saved, it will retrieve related ProjDetails from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProjDetailType.
	 */
	public function getProjDetailsJoinSchoolproject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProjDetailTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjDetails === null) {
			if ($this->isNew()) {
				$this->collProjDetails = array();
			} else {

				$criteria->add(ProjDetailPeer::PROJ_DETAIL_TYPE_ID, $this->id);

				$this->collProjDetails = ProjDetailPeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjDetailPeer::PROJ_DETAIL_TYPE_ID, $this->id);

			if (!isset($this->lastProjDetailCriteria) || !$this->lastProjDetailCriteria->equals($criteria)) {
				$this->collProjDetails = ProjDetailPeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjDetailCriteria = $criteria;

		return $this->collProjDetails;
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
			if ($this->collProjDetails) {
				foreach ((array) $this->collProjDetails as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collProjDetails = null;
			$this->aProjCategory = null;
	}

} // BaseProjDetailType
