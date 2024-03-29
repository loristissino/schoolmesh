<?php

/**
 * Base class that represents a row from the 'role' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseRole extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RolePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the male_description field.
	 * @var        string
	 */
	protected $male_description;

	/**
	 * The value for the female_description field.
	 * @var        string
	 */
	protected $female_description;

	/**
	 * The value for the quality_code field.
	 * @var        string
	 */
	protected $quality_code;

	/**
	 * The value for the posix_name field.
	 * @var        string
	 */
	protected $posix_name;

	/**
	 * The value for the may_be_main_role field.
	 * @var        boolean
	 */
	protected $may_be_main_role;

	/**
	 * The value for the needs_charge_letter field.
	 * @var        boolean
	 */
	protected $needs_charge_letter;

	/**
	 * The value for the is_key field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_key;

	/**
	 * The value for the default_guardgroup field.
	 * @var        string
	 */
	protected $default_guardgroup;

	/**
	 * The value for the min field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $min;

	/**
	 * The value for the max field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $max;

	/**
	 * The value for the forfait_retribution field.
	 * @var        string
	 */
	protected $forfait_retribution;

	/**
	 * The value for the charge_notes field.
	 * @var        string
	 */
	protected $charge_notes;

	/**
	 * The value for the confirmation_notes field.
	 * @var        string
	 */
	protected $confirmation_notes;

	/**
	 * The value for the charge_havingregardto field.
	 * @var        string
	 */
	protected $charge_havingregardto;

	/**
	 * The value for the confirmation_havingregardto field.
	 * @var        string
	 */
	protected $confirmation_havingregardto;

	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank;

	/**
	 * @var        array sfGuardUserProfile[] Collection to store aggregation of sfGuardUserProfile objects.
	 */
	protected $collsfGuardUserProfiles;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfGuardUserProfiles.
	 */
	private $lastsfGuardUserProfileCriteria = null;

	/**
	 * @var        array UserTeam[] Collection to store aggregation of UserTeam objects.
	 */
	protected $collUserTeams;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserTeams.
	 */
	private $lastUserTeamCriteria = null;

	/**
	 * @var        array ProjResourceType[] Collection to store aggregation of ProjResourceType objects.
	 */
	protected $collProjResourceTypes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjResourceTypes.
	 */
	private $lastProjResourceTypeCriteria = null;

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
	
	const PEER = 'RolePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_key = false;
		$this->min = 0;
		$this->max = 0;
	}

	/**
	 * Initializes internal state of BaseRole object.
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
	 * Get the [male_description] column value.
	 * 
	 * @return     string
	 */
	public function getMaleDescription()
	{
		return $this->male_description;
	}

	/**
	 * Get the [female_description] column value.
	 * 
	 * @return     string
	 */
	public function getFemaleDescription()
	{
		return $this->female_description;
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
	 * Get the [posix_name] column value.
	 * 
	 * @return     string
	 */
	public function getPosixName()
	{
		return $this->posix_name;
	}

	/**
	 * Get the [may_be_main_role] column value.
	 * 
	 * @return     boolean
	 */
	public function getMayBeMainRole()
	{
		return $this->may_be_main_role;
	}

	/**
	 * Get the [needs_charge_letter] column value.
	 * 
	 * @return     boolean
	 */
	public function getNeedsChargeLetter()
	{
		return $this->needs_charge_letter;
	}

	/**
	 * Get the [is_key] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsKey()
	{
		return $this->is_key;
	}

	/**
	 * Get the [default_guardgroup] column value.
	 * 
	 * @return     string
	 */
	public function getDefaultGuardgroup()
	{
		return $this->default_guardgroup;
	}

	/**
	 * Get the [min] column value.
	 * 
	 * @return     int
	 */
	public function getMin()
	{
		return $this->min;
	}

	/**
	 * Get the [max] column value.
	 * 
	 * @return     int
	 */
	public function getMax()
	{
		return $this->max;
	}

	/**
	 * Get the [forfait_retribution] column value.
	 * 
	 * @return     string
	 */
	public function getForfaitRetribution()
	{
		return $this->forfait_retribution;
	}

	/**
	 * Get the [charge_notes] column value.
	 * 
	 * @return     string
	 */
	public function getChargeNotes()
	{
		return $this->charge_notes;
	}

	/**
	 * Get the [confirmation_notes] column value.
	 * 
	 * @return     string
	 */
	public function getConfirmationNotes()
	{
		return $this->confirmation_notes;
	}

	/**
	 * Get the [charge_havingregardto] column value.
	 * 
	 * @return     string
	 */
	public function getChargeHavingregardto()
	{
		return $this->charge_havingregardto;
	}

	/**
	 * Get the [confirmation_havingregardto] column value.
	 * 
	 * @return     string
	 */
	public function getConfirmationHavingregardto()
	{
		return $this->confirmation_havingregardto;
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
	 * @return     Role The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RolePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [male_description] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setMaleDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->male_description !== $v) {
			$this->male_description = $v;
			$this->modifiedColumns[] = RolePeer::MALE_DESCRIPTION;
		}

		return $this;
	} // setMaleDescription()

	/**
	 * Set the value of [female_description] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setFemaleDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->female_description !== $v) {
			$this->female_description = $v;
			$this->modifiedColumns[] = RolePeer::FEMALE_DESCRIPTION;
		}

		return $this;
	} // setFemaleDescription()

	/**
	 * Set the value of [quality_code] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setQualityCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->quality_code !== $v) {
			$this->quality_code = $v;
			$this->modifiedColumns[] = RolePeer::QUALITY_CODE;
		}

		return $this;
	} // setQualityCode()

	/**
	 * Set the value of [posix_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setPosixName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->posix_name !== $v) {
			$this->posix_name = $v;
			$this->modifiedColumns[] = RolePeer::POSIX_NAME;
		}

		return $this;
	} // setPosixName()

	/**
	 * Set the value of [may_be_main_role] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setMayBeMainRole($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->may_be_main_role !== $v) {
			$this->may_be_main_role = $v;
			$this->modifiedColumns[] = RolePeer::MAY_BE_MAIN_ROLE;
		}

		return $this;
	} // setMayBeMainRole()

	/**
	 * Set the value of [needs_charge_letter] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setNeedsChargeLetter($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->needs_charge_letter !== $v) {
			$this->needs_charge_letter = $v;
			$this->modifiedColumns[] = RolePeer::NEEDS_CHARGE_LETTER;
		}

		return $this;
	} // setNeedsChargeLetter()

	/**
	 * Set the value of [is_key] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setIsKey($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_key !== $v || $this->isNew()) {
			$this->is_key = $v;
			$this->modifiedColumns[] = RolePeer::IS_KEY;
		}

		return $this;
	} // setIsKey()

	/**
	 * Set the value of [default_guardgroup] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setDefaultGuardgroup($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->default_guardgroup !== $v) {
			$this->default_guardgroup = $v;
			$this->modifiedColumns[] = RolePeer::DEFAULT_GUARDGROUP;
		}

		return $this;
	} // setDefaultGuardgroup()

	/**
	 * Set the value of [min] column.
	 * 
	 * @param      int $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->min !== $v || $this->isNew()) {
			$this->min = $v;
			$this->modifiedColumns[] = RolePeer::MIN;
		}

		return $this;
	} // setMin()

	/**
	 * Set the value of [max] column.
	 * 
	 * @param      int $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setMax($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->max !== $v || $this->isNew()) {
			$this->max = $v;
			$this->modifiedColumns[] = RolePeer::MAX;
		}

		return $this;
	} // setMax()

	/**
	 * Set the value of [forfait_retribution] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setForfaitRetribution($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->forfait_retribution !== $v) {
			$this->forfait_retribution = $v;
			$this->modifiedColumns[] = RolePeer::FORFAIT_RETRIBUTION;
		}

		return $this;
	} // setForfaitRetribution()

	/**
	 * Set the value of [charge_notes] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setChargeNotes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->charge_notes !== $v) {
			$this->charge_notes = $v;
			$this->modifiedColumns[] = RolePeer::CHARGE_NOTES;
		}

		return $this;
	} // setChargeNotes()

	/**
	 * Set the value of [confirmation_notes] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setConfirmationNotes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->confirmation_notes !== $v) {
			$this->confirmation_notes = $v;
			$this->modifiedColumns[] = RolePeer::CONFIRMATION_NOTES;
		}

		return $this;
	} // setConfirmationNotes()

	/**
	 * Set the value of [charge_havingregardto] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setChargeHavingregardto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->charge_havingregardto !== $v) {
			$this->charge_havingregardto = $v;
			$this->modifiedColumns[] = RolePeer::CHARGE_HAVINGREGARDTO;
		}

		return $this;
	} // setChargeHavingregardto()

	/**
	 * Set the value of [confirmation_havingregardto] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setConfirmationHavingregardto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->confirmation_havingregardto !== $v) {
			$this->confirmation_havingregardto = $v;
			$this->modifiedColumns[] = RolePeer::CONFIRMATION_HAVINGREGARDTO;
		}

		return $this;
	} // setConfirmationHavingregardto()

	/**
	 * Set the value of [rank] column.
	 * 
	 * @param      int $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setRank($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = RolePeer::RANK;
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
			if ($this->is_key !== false) {
				return false;
			}

			if ($this->min !== 0) {
				return false;
			}

			if ($this->max !== 0) {
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
			$this->male_description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->female_description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->quality_code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->posix_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->may_be_main_role = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->needs_charge_letter = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->is_key = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->default_guardgroup = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->min = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->max = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->forfait_retribution = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->charge_notes = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->confirmation_notes = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->charge_havingregardto = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->confirmation_havingregardto = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->rank = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Role object", $e);
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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RolePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collsfGuardUserProfiles = null;
			$this->lastsfGuardUserProfileCriteria = null;

			$this->collUserTeams = null;
			$this->lastUserTeamCriteria = null;

			$this->collProjResourceTypes = null;
			$this->lastProjResourceTypeCriteria = null;

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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				RolePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				RolePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = RolePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RolePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RolePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collsfGuardUserProfiles !== null) {
				foreach ($this->collsfGuardUserProfiles as $referrerFK) {
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

			if ($this->collProjResourceTypes !== null) {
				foreach ($this->collProjResourceTypes as $referrerFK) {
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


			if (($retval = RolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserProfiles !== null) {
					foreach ($this->collsfGuardUserProfiles as $referrerFK) {
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

				if ($this->collProjResourceTypes !== null) {
					foreach ($this->collProjResourceTypes as $referrerFK) {
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
		$pos = RolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMaleDescription();
				break;
			case 2:
				return $this->getFemaleDescription();
				break;
			case 3:
				return $this->getQualityCode();
				break;
			case 4:
				return $this->getPosixName();
				break;
			case 5:
				return $this->getMayBeMainRole();
				break;
			case 6:
				return $this->getNeedsChargeLetter();
				break;
			case 7:
				return $this->getIsKey();
				break;
			case 8:
				return $this->getDefaultGuardgroup();
				break;
			case 9:
				return $this->getMin();
				break;
			case 10:
				return $this->getMax();
				break;
			case 11:
				return $this->getForfaitRetribution();
				break;
			case 12:
				return $this->getChargeNotes();
				break;
			case 13:
				return $this->getConfirmationNotes();
				break;
			case 14:
				return $this->getChargeHavingregardto();
				break;
			case 15:
				return $this->getConfirmationHavingregardto();
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
		$keys = RolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMaleDescription(),
			$keys[2] => $this->getFemaleDescription(),
			$keys[3] => $this->getQualityCode(),
			$keys[4] => $this->getPosixName(),
			$keys[5] => $this->getMayBeMainRole(),
			$keys[6] => $this->getNeedsChargeLetter(),
			$keys[7] => $this->getIsKey(),
			$keys[8] => $this->getDefaultGuardgroup(),
			$keys[9] => $this->getMin(),
			$keys[10] => $this->getMax(),
			$keys[11] => $this->getForfaitRetribution(),
			$keys[12] => $this->getChargeNotes(),
			$keys[13] => $this->getConfirmationNotes(),
			$keys[14] => $this->getChargeHavingregardto(),
			$keys[15] => $this->getConfirmationHavingregardto(),
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
		$pos = RolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMaleDescription($value);
				break;
			case 2:
				$this->setFemaleDescription($value);
				break;
			case 3:
				$this->setQualityCode($value);
				break;
			case 4:
				$this->setPosixName($value);
				break;
			case 5:
				$this->setMayBeMainRole($value);
				break;
			case 6:
				$this->setNeedsChargeLetter($value);
				break;
			case 7:
				$this->setIsKey($value);
				break;
			case 8:
				$this->setDefaultGuardgroup($value);
				break;
			case 9:
				$this->setMin($value);
				break;
			case 10:
				$this->setMax($value);
				break;
			case 11:
				$this->setForfaitRetribution($value);
				break;
			case 12:
				$this->setChargeNotes($value);
				break;
			case 13:
				$this->setConfirmationNotes($value);
				break;
			case 14:
				$this->setChargeHavingregardto($value);
				break;
			case 15:
				$this->setConfirmationHavingregardto($value);
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
		$keys = RolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMaleDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFemaleDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQualityCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPosixName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMayBeMainRole($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNeedsChargeLetter($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsKey($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDefaultGuardgroup($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMin($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMax($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setForfaitRetribution($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setChargeNotes($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setConfirmationNotes($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setChargeHavingregardto($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setConfirmationHavingregardto($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setRank($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RolePeer::DATABASE_NAME);

		if ($this->isColumnModified(RolePeer::ID)) $criteria->add(RolePeer::ID, $this->id);
		if ($this->isColumnModified(RolePeer::MALE_DESCRIPTION)) $criteria->add(RolePeer::MALE_DESCRIPTION, $this->male_description);
		if ($this->isColumnModified(RolePeer::FEMALE_DESCRIPTION)) $criteria->add(RolePeer::FEMALE_DESCRIPTION, $this->female_description);
		if ($this->isColumnModified(RolePeer::QUALITY_CODE)) $criteria->add(RolePeer::QUALITY_CODE, $this->quality_code);
		if ($this->isColumnModified(RolePeer::POSIX_NAME)) $criteria->add(RolePeer::POSIX_NAME, $this->posix_name);
		if ($this->isColumnModified(RolePeer::MAY_BE_MAIN_ROLE)) $criteria->add(RolePeer::MAY_BE_MAIN_ROLE, $this->may_be_main_role);
		if ($this->isColumnModified(RolePeer::NEEDS_CHARGE_LETTER)) $criteria->add(RolePeer::NEEDS_CHARGE_LETTER, $this->needs_charge_letter);
		if ($this->isColumnModified(RolePeer::IS_KEY)) $criteria->add(RolePeer::IS_KEY, $this->is_key);
		if ($this->isColumnModified(RolePeer::DEFAULT_GUARDGROUP)) $criteria->add(RolePeer::DEFAULT_GUARDGROUP, $this->default_guardgroup);
		if ($this->isColumnModified(RolePeer::MIN)) $criteria->add(RolePeer::MIN, $this->min);
		if ($this->isColumnModified(RolePeer::MAX)) $criteria->add(RolePeer::MAX, $this->max);
		if ($this->isColumnModified(RolePeer::FORFAIT_RETRIBUTION)) $criteria->add(RolePeer::FORFAIT_RETRIBUTION, $this->forfait_retribution);
		if ($this->isColumnModified(RolePeer::CHARGE_NOTES)) $criteria->add(RolePeer::CHARGE_NOTES, $this->charge_notes);
		if ($this->isColumnModified(RolePeer::CONFIRMATION_NOTES)) $criteria->add(RolePeer::CONFIRMATION_NOTES, $this->confirmation_notes);
		if ($this->isColumnModified(RolePeer::CHARGE_HAVINGREGARDTO)) $criteria->add(RolePeer::CHARGE_HAVINGREGARDTO, $this->charge_havingregardto);
		if ($this->isColumnModified(RolePeer::CONFIRMATION_HAVINGREGARDTO)) $criteria->add(RolePeer::CONFIRMATION_HAVINGREGARDTO, $this->confirmation_havingregardto);
		if ($this->isColumnModified(RolePeer::RANK)) $criteria->add(RolePeer::RANK, $this->rank);

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
		$criteria = new Criteria(RolePeer::DATABASE_NAME);

		$criteria->add(RolePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Role (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMaleDescription($this->male_description);

		$copyObj->setFemaleDescription($this->female_description);

		$copyObj->setQualityCode($this->quality_code);

		$copyObj->setPosixName($this->posix_name);

		$copyObj->setMayBeMainRole($this->may_be_main_role);

		$copyObj->setNeedsChargeLetter($this->needs_charge_letter);

		$copyObj->setIsKey($this->is_key);

		$copyObj->setDefaultGuardgroup($this->default_guardgroup);

		$copyObj->setMin($this->min);

		$copyObj->setMax($this->max);

		$copyObj->setForfaitRetribution($this->forfait_retribution);

		$copyObj->setChargeNotes($this->charge_notes);

		$copyObj->setConfirmationNotes($this->confirmation_notes);

		$copyObj->setChargeHavingregardto($this->charge_havingregardto);

		$copyObj->setConfirmationHavingregardto($this->confirmation_havingregardto);

		$copyObj->setRank($this->rank);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getsfGuardUserProfiles() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserTeams() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserTeam($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getProjResourceTypes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjResourceType($relObj->copy($deepCopy));
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
	 * @return     Role Clone of current object.
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
	 * @return     RolePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RolePeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collsfGuardUserProfiles collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardUserProfiles()
	 */
	public function clearsfGuardUserProfiles()
	{
		$this->collsfGuardUserProfiles = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardUserProfiles collection (array).
	 *
	 * By default this just sets the collsfGuardUserProfiles collection to an empty array (like clearcollsfGuardUserProfiles());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfGuardUserProfiles()
	{
		$this->collsfGuardUserProfiles = array();
	}

	/**
	 * Gets an array of sfGuardUserProfile objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Role has previously been saved, it will retrieve
	 * related sfGuardUserProfiles from storage. If this Role is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfGuardUserProfile[]
	 * @throws     PropelException
	 */
	public function getsfGuardUserProfiles($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $this->collsfGuardUserProfiles;
	}

	/**
	 * Returns the number of related sfGuardUserProfile objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardUserProfile objects.
	 * @throws     PropelException
	 */
	public function countsfGuardUserProfiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				$count = sfGuardUserProfilePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$count = sfGuardUserProfilePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collsfGuardUserProfiles);
				}
			} else {
				$count = count($this->collsfGuardUserProfiles);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfGuardUserProfile object to this object
	 * through the sfGuardUserProfile foreign key attribute.
	 *
	 * @param      sfGuardUserProfile $l sfGuardUserProfile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->initsfGuardUserProfiles();
		}
		if (!in_array($l, $this->collsfGuardUserProfiles, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfGuardUserProfiles, $l);
			$l->setRole($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related sfGuardUserProfiles from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getsfGuardUserProfilesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

			if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;

		return $this->collsfGuardUserProfiles;
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
	 * Otherwise if this Role has previously been saved, it will retrieve
	 * related UserTeams from storage. If this Role is new, it will return
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
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
			   $this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

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
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
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

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				$count = UserTeamPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

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
			$l->setRole($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related UserTeams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getUserTeamsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

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
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related UserTeams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getUserTeamsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}

	/**
	 * Clears out the collProjResourceTypes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjResourceTypes()
	 */
	public function clearProjResourceTypes()
	{
		$this->collProjResourceTypes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjResourceTypes collection (array).
	 *
	 * By default this just sets the collProjResourceTypes collection to an empty array (like clearcollProjResourceTypes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjResourceTypes()
	{
		$this->collProjResourceTypes = array();
	}

	/**
	 * Gets an array of ProjResourceType objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Role has previously been saved, it will retrieve
	 * related ProjResourceTypes from storage. If this Role is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjResourceType[]
	 * @throws     PropelException
	 */
	public function getProjResourceTypes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResourceTypes === null) {
			if ($this->isNew()) {
			   $this->collProjResourceTypes = array();
			} else {

				$criteria->add(ProjResourceTypePeer::ROLE_ID, $this->id);

				ProjResourceTypePeer::addSelectColumns($criteria);
				$this->collProjResourceTypes = ProjResourceTypePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjResourceTypePeer::ROLE_ID, $this->id);

				ProjResourceTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastProjResourceTypeCriteria) || !$this->lastProjResourceTypeCriteria->equals($criteria)) {
					$this->collProjResourceTypes = ProjResourceTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjResourceTypeCriteria = $criteria;
		return $this->collProjResourceTypes;
	}

	/**
	 * Returns the number of related ProjResourceType objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ProjResourceType objects.
	 * @throws     PropelException
	 */
	public function countProjResourceTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjResourceTypes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjResourceTypePeer::ROLE_ID, $this->id);

				$count = ProjResourceTypePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjResourceTypePeer::ROLE_ID, $this->id);

				if (!isset($this->lastProjResourceTypeCriteria) || !$this->lastProjResourceTypeCriteria->equals($criteria)) {
					$count = ProjResourceTypePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjResourceTypes);
				}
			} else {
				$count = count($this->collProjResourceTypes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ProjResourceType object to this object
	 * through the ProjResourceType foreign key attribute.
	 *
	 * @param      ProjResourceType $l ProjResourceType
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjResourceType(ProjResourceType $l)
	{
		if ($this->collProjResourceTypes === null) {
			$this->initProjResourceTypes();
		}
		if (!in_array($l, $this->collProjResourceTypes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjResourceTypes, $l);
			$l->setRole($this);
		}
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
			if ($this->collsfGuardUserProfiles) {
				foreach ((array) $this->collsfGuardUserProfiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserTeams) {
				foreach ((array) $this->collUserTeams as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collProjResourceTypes) {
				foreach ((array) $this->collProjResourceTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collsfGuardUserProfiles = null;
		$this->collUserTeams = null;
		$this->collProjResourceTypes = null;
	}

} // BaseRole
