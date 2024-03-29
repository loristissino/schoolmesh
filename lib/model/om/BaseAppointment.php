<?php

/**
 * Base class that represents a row from the 'appointment' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseAppointment extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AppointmentPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the subject_id field.
	 * @var        int
	 */
	protected $subject_id;

	/**
	 * The value for the schoolclass_id field.
	 * @var        string
	 */
	protected $schoolclass_id;

	/**
	 * The value for the team_id field.
	 * @var        int
	 */
	protected $team_id;

	/**
	 * The value for the year_id field.
	 * @var        int
	 */
	protected $year_id;

	/**
	 * The value for the state field.
	 * @var        int
	 */
	protected $state;

	/**
	 * The value for the hours field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hours;

	/**
	 * The value for the is_public field.
	 * @var        boolean
	 */
	protected $is_public;

	/**
	 * The value for the syllabus_id field.
	 * @var        int
	 */
	protected $syllabus_id;

	/**
	 * The value for the appointment_type_id field.
	 * @var        int
	 */
	protected $appointment_type_id;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * The value for the import_code field.
	 * @var        string
	 */
	protected $import_code;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        Subject
	 */
	protected $aSubject;

	/**
	 * @var        Schoolclass
	 */
	protected $aSchoolclass;

	/**
	 * @var        Team
	 */
	protected $aTeam;

	/**
	 * @var        Year
	 */
	protected $aYear;

	/**
	 * @var        Syllabus
	 */
	protected $aSyllabus;

	/**
	 * @var        AppointmentType
	 */
	protected $aAppointmentType;

	/**
	 * @var        array Wpinfo[] Collection to store aggregation of Wpinfo objects.
	 */
	protected $collWpinfos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWpinfos.
	 */
	private $lastWpinfoCriteria = null;

	/**
	 * @var        array WptoolAppointment[] Collection to store aggregation of WptoolAppointment objects.
	 */
	protected $collWptoolAppointments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWptoolAppointments.
	 */
	private $lastWptoolAppointmentCriteria = null;

	/**
	 * @var        array Wpmodule[] Collection to store aggregation of Wpmodule objects.
	 */
	protected $collWpmodules;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWpmodules.
	 */
	private $lastWpmoduleCriteria = null;

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
	
	const PEER = 'AppointmentPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->hours = 0;
	}

	/**
	 * Initializes internal state of BaseAppointment object.
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
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [subject_id] column value.
	 * 
	 * @return     int
	 */
	public function getSubjectId()
	{
		return $this->subject_id;
	}

	/**
	 * Get the [schoolclass_id] column value.
	 * 
	 * @return     string
	 */
	public function getSchoolclassId()
	{
		return $this->schoolclass_id;
	}

	/**
	 * Get the [team_id] column value.
	 * 
	 * @return     int
	 */
	public function getTeamId()
	{
		return $this->team_id;
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
	 * Get the [state] column value.
	 * 
	 * @return     int
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Get the [hours] column value.
	 * 
	 * @return     int
	 */
	public function getHours()
	{
		return $this->hours;
	}

	/**
	 * Get the [is_public] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPublic()
	{
		return $this->is_public;
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
	 * Get the [appointment_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getAppointmentTypeId()
	{
		return $this->appointment_type_id;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
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
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
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
	 * Get the [import_code] column value.
	 * 
	 * @return     string
	 */
	public function getImportCode()
	{
		return $this->import_code;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AppointmentPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [subject_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setSubjectId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->subject_id !== $v) {
			$this->subject_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::SUBJECT_ID;
		}

		if ($this->aSubject !== null && $this->aSubject->getId() !== $v) {
			$this->aSubject = null;
		}

		return $this;
	} // setSubjectId()

	/**
	 * Set the value of [schoolclass_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setSchoolclassId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->schoolclass_id !== $v) {
			$this->schoolclass_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::SCHOOLCLASS_ID;
		}

		if ($this->aSchoolclass !== null && $this->aSchoolclass->getId() !== $v) {
			$this->aSchoolclass = null;
		}

		return $this;
	} // setSchoolclassId()

	/**
	 * Set the value of [team_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setTeamId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->team_id !== $v) {
			$this->team_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::TEAM_ID;
		}

		if ($this->aTeam !== null && $this->aTeam->getId() !== $v) {
			$this->aTeam = null;
		}

		return $this;
	} // setTeamId()

	/**
	 * Set the value of [year_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setYearId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->year_id !== $v) {
			$this->year_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::YEAR_ID;
		}

		if ($this->aYear !== null && $this->aYear->getId() !== $v) {
			$this->aYear = null;
		}

		return $this;
	} // setYearId()

	/**
	 * Set the value of [state] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setState($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = AppointmentPeer::STATE;
		}

		return $this;
	} // setState()

	/**
	 * Set the value of [hours] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setHours($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hours !== $v || $this->isNew()) {
			$this->hours = $v;
			$this->modifiedColumns[] = AppointmentPeer::HOURS;
		}

		return $this;
	} // setHours()

	/**
	 * Set the value of [is_public] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setIsPublic($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_public !== $v) {
			$this->is_public = $v;
			$this->modifiedColumns[] = AppointmentPeer::IS_PUBLIC;
		}

		return $this;
	} // setIsPublic()

	/**
	 * Set the value of [syllabus_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setSyllabusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->syllabus_id !== $v) {
			$this->syllabus_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::SYLLABUS_ID;
		}

		if ($this->aSyllabus !== null && $this->aSyllabus->getId() !== $v) {
			$this->aSyllabus = null;
		}

		return $this;
	} // setSyllabusId()

	/**
	 * Set the value of [appointment_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setAppointmentTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->appointment_type_id !== $v) {
			$this->appointment_type_id = $v;
			$this->modifiedColumns[] = AppointmentPeer::APPOINTMENT_TYPE_ID;
		}

		if ($this->aAppointmentType !== null && $this->aAppointmentType->getId() !== $v) {
			$this->aAppointmentType = null;
		}

		return $this;
	} // setAppointmentTypeId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
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

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AppointmentPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
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

		if ( $this->updated_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AppointmentPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Set the value of [import_code] column.
	 * 
	 * @param      string $v new value
	 * @return     Appointment The current object (for fluent API support)
	 */
	public function setImportCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->import_code !== $v) {
			$this->import_code = $v;
			$this->modifiedColumns[] = AppointmentPeer::IMPORT_CODE;
		}

		return $this;
	} // setImportCode()

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
			if ($this->hours !== 0) {
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
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->subject_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->schoolclass_id = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->team_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->year_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->state = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->hours = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->is_public = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->syllabus_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->appointment_type_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->created_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->updated_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->import_code = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Appointment object", $e);
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

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aSubject !== null && $this->subject_id !== $this->aSubject->getId()) {
			$this->aSubject = null;
		}
		if ($this->aSchoolclass !== null && $this->schoolclass_id !== $this->aSchoolclass->getId()) {
			$this->aSchoolclass = null;
		}
		if ($this->aTeam !== null && $this->team_id !== $this->aTeam->getId()) {
			$this->aTeam = null;
		}
		if ($this->aYear !== null && $this->year_id !== $this->aYear->getId()) {
			$this->aYear = null;
		}
		if ($this->aSyllabus !== null && $this->syllabus_id !== $this->aSyllabus->getId()) {
			$this->aSyllabus = null;
		}
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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AppointmentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfGuardUser = null;
			$this->aSubject = null;
			$this->aSchoolclass = null;
			$this->aTeam = null;
			$this->aYear = null;
			$this->aSyllabus = null;
			$this->aAppointmentType = null;
			$this->collWpinfos = null;
			$this->lastWpinfoCriteria = null;

			$this->collWptoolAppointments = null;
			$this->lastWptoolAppointmentCriteria = null;

			$this->collWpmodules = null;
			$this->lastWpmoduleCriteria = null;

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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				AppointmentPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_timestampable behavior
			if ($this->isModified() && !$this->isColumnModified(AppointmentPeer::UPDATED_AT))
			{
			  $this->setUpdatedAt(time());
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(AppointmentPeer::CREATED_AT))
				{
				  $this->setCreatedAt(time());
				}

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
				AppointmentPeer::addInstanceToPool($this);
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

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aSubject !== null) {
				if ($this->aSubject->isModified() || $this->aSubject->isNew()) {
					$affectedRows += $this->aSubject->save($con);
				}
				$this->setSubject($this->aSubject);
			}

			if ($this->aSchoolclass !== null) {
				if ($this->aSchoolclass->isModified() || $this->aSchoolclass->isNew()) {
					$affectedRows += $this->aSchoolclass->save($con);
				}
				$this->setSchoolclass($this->aSchoolclass);
			}

			if ($this->aTeam !== null) {
				if ($this->aTeam->isModified() || $this->aTeam->isNew()) {
					$affectedRows += $this->aTeam->save($con);
				}
				$this->setTeam($this->aTeam);
			}

			if ($this->aYear !== null) {
				if ($this->aYear->isModified() || $this->aYear->isNew()) {
					$affectedRows += $this->aYear->save($con);
				}
				$this->setYear($this->aYear);
			}

			if ($this->aSyllabus !== null) {
				if ($this->aSyllabus->isModified() || $this->aSyllabus->isNew()) {
					$affectedRows += $this->aSyllabus->save($con);
				}
				$this->setSyllabus($this->aSyllabus);
			}

			if ($this->aAppointmentType !== null) {
				if ($this->aAppointmentType->isModified() || $this->aAppointmentType->isNew()) {
					$affectedRows += $this->aAppointmentType->save($con);
				}
				$this->setAppointmentType($this->aAppointmentType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AppointmentPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AppointmentPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AppointmentPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collWpinfos !== null) {
				foreach ($this->collWpinfos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWptoolAppointments !== null) {
				foreach ($this->collWptoolAppointments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWpmodules !== null) {
				foreach ($this->collWpmodules as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aSubject !== null) {
				if (!$this->aSubject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSubject->getValidationFailures());
				}
			}

			if ($this->aSchoolclass !== null) {
				if (!$this->aSchoolclass->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchoolclass->getValidationFailures());
				}
			}

			if ($this->aTeam !== null) {
				if (!$this->aTeam->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTeam->getValidationFailures());
				}
			}

			if ($this->aYear !== null) {
				if (!$this->aYear->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aYear->getValidationFailures());
				}
			}

			if ($this->aSyllabus !== null) {
				if (!$this->aSyllabus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSyllabus->getValidationFailures());
				}
			}

			if ($this->aAppointmentType !== null) {
				if (!$this->aAppointmentType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAppointmentType->getValidationFailures());
				}
			}


			if (($retval = AppointmentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpinfos !== null) {
					foreach ($this->collWpinfos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWptoolAppointments !== null) {
					foreach ($this->collWptoolAppointments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWpmodules !== null) {
					foreach ($this->collWpmodules as $referrerFK) {
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
		$pos = AppointmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 2:
				return $this->getSubjectId();
				break;
			case 3:
				return $this->getSchoolclassId();
				break;
			case 4:
				return $this->getTeamId();
				break;
			case 5:
				return $this->getYearId();
				break;
			case 6:
				return $this->getState();
				break;
			case 7:
				return $this->getHours();
				break;
			case 8:
				return $this->getIsPublic();
				break;
			case 9:
				return $this->getSyllabusId();
				break;
			case 10:
				return $this->getAppointmentTypeId();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			case 13:
				return $this->getImportCode();
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
		$keys = AppointmentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getSubjectId(),
			$keys[3] => $this->getSchoolclassId(),
			$keys[4] => $this->getTeamId(),
			$keys[5] => $this->getYearId(),
			$keys[6] => $this->getState(),
			$keys[7] => $this->getHours(),
			$keys[8] => $this->getIsPublic(),
			$keys[9] => $this->getSyllabusId(),
			$keys[10] => $this->getAppointmentTypeId(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
			$keys[13] => $this->getImportCode(),
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
		$pos = AppointmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUserId($value);
				break;
			case 2:
				$this->setSubjectId($value);
				break;
			case 3:
				$this->setSchoolclassId($value);
				break;
			case 4:
				$this->setTeamId($value);
				break;
			case 5:
				$this->setYearId($value);
				break;
			case 6:
				$this->setState($value);
				break;
			case 7:
				$this->setHours($value);
				break;
			case 8:
				$this->setIsPublic($value);
				break;
			case 9:
				$this->setSyllabusId($value);
				break;
			case 10:
				$this->setAppointmentTypeId($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
			case 13:
				$this->setImportCode($value);
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
		$keys = AppointmentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSubjectId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSchoolclassId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTeamId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setYearId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setState($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHours($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsPublic($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSyllabusId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setAppointmentTypeId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setImportCode($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);

		if ($this->isColumnModified(AppointmentPeer::ID)) $criteria->add(AppointmentPeer::ID, $this->id);
		if ($this->isColumnModified(AppointmentPeer::USER_ID)) $criteria->add(AppointmentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(AppointmentPeer::SUBJECT_ID)) $criteria->add(AppointmentPeer::SUBJECT_ID, $this->subject_id);
		if ($this->isColumnModified(AppointmentPeer::SCHOOLCLASS_ID)) $criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->schoolclass_id);
		if ($this->isColumnModified(AppointmentPeer::TEAM_ID)) $criteria->add(AppointmentPeer::TEAM_ID, $this->team_id);
		if ($this->isColumnModified(AppointmentPeer::YEAR_ID)) $criteria->add(AppointmentPeer::YEAR_ID, $this->year_id);
		if ($this->isColumnModified(AppointmentPeer::STATE)) $criteria->add(AppointmentPeer::STATE, $this->state);
		if ($this->isColumnModified(AppointmentPeer::HOURS)) $criteria->add(AppointmentPeer::HOURS, $this->hours);
		if ($this->isColumnModified(AppointmentPeer::IS_PUBLIC)) $criteria->add(AppointmentPeer::IS_PUBLIC, $this->is_public);
		if ($this->isColumnModified(AppointmentPeer::SYLLABUS_ID)) $criteria->add(AppointmentPeer::SYLLABUS_ID, $this->syllabus_id);
		if ($this->isColumnModified(AppointmentPeer::APPOINTMENT_TYPE_ID)) $criteria->add(AppointmentPeer::APPOINTMENT_TYPE_ID, $this->appointment_type_id);
		if ($this->isColumnModified(AppointmentPeer::CREATED_AT)) $criteria->add(AppointmentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AppointmentPeer::UPDATED_AT)) $criteria->add(AppointmentPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(AppointmentPeer::IMPORT_CODE)) $criteria->add(AppointmentPeer::IMPORT_CODE, $this->import_code);

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
		$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);

		$criteria->add(AppointmentPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Appointment (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setSubjectId($this->subject_id);

		$copyObj->setSchoolclassId($this->schoolclass_id);

		$copyObj->setTeamId($this->team_id);

		$copyObj->setYearId($this->year_id);

		$copyObj->setState($this->state);

		$copyObj->setHours($this->hours);

		$copyObj->setIsPublic($this->is_public);

		$copyObj->setSyllabusId($this->syllabus_id);

		$copyObj->setAppointmentTypeId($this->appointment_type_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setImportCode($this->import_code);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getWpinfos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWpinfo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWptoolAppointments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWptoolAppointment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpmodules() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWpmodule($relObj->copy($deepCopy));
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
	 * @return     Appointment Clone of current object.
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
	 * @return     AppointmentPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AppointmentPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Appointment The current object (for fluent API support)
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
			$v->addAppointment($this);
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
			   $this->asfGuardUser->addAppointments($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Declares an association between this object and a Subject object.
	 *
	 * @param      Subject $v
	 * @return     Appointment The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSubject(Subject $v = null)
	{
		if ($v === null) {
			$this->setSubjectId(NULL);
		} else {
			$this->setSubjectId($v->getId());
		}

		$this->aSubject = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Subject object, it will not be re-added.
		if ($v !== null) {
			$v->addAppointment($this);
		}

		return $this;
	}


	/**
	 * Get the associated Subject object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Subject The associated Subject object.
	 * @throws     PropelException
	 */
	public function getSubject(PropelPDO $con = null)
	{
		if ($this->aSubject === null && ($this->subject_id !== null)) {
			$this->aSubject = SubjectPeer::retrieveByPk($this->subject_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSubject->addAppointments($this);
			 */
		}
		return $this->aSubject;
	}

	/**
	 * Declares an association between this object and a Schoolclass object.
	 *
	 * @param      Schoolclass $v
	 * @return     Appointment The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSchoolclass(Schoolclass $v = null)
	{
		if ($v === null) {
			$this->setSchoolclassId(NULL);
		} else {
			$this->setSchoolclassId($v->getId());
		}

		$this->aSchoolclass = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Schoolclass object, it will not be re-added.
		if ($v !== null) {
			$v->addAppointment($this);
		}

		return $this;
	}


	/**
	 * Get the associated Schoolclass object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Schoolclass The associated Schoolclass object.
	 * @throws     PropelException
	 */
	public function getSchoolclass(PropelPDO $con = null)
	{
		if ($this->aSchoolclass === null && (($this->schoolclass_id !== "" && $this->schoolclass_id !== null))) {
			$this->aSchoolclass = SchoolclassPeer::retrieveByPk($this->schoolclass_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSchoolclass->addAppointments($this);
			 */
		}
		return $this->aSchoolclass;
	}

	/**
	 * Declares an association between this object and a Team object.
	 *
	 * @param      Team $v
	 * @return     Appointment The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTeam(Team $v = null)
	{
		if ($v === null) {
			$this->setTeamId(NULL);
		} else {
			$this->setTeamId($v->getId());
		}

		$this->aTeam = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Team object, it will not be re-added.
		if ($v !== null) {
			$v->addAppointment($this);
		}

		return $this;
	}


	/**
	 * Get the associated Team object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Team The associated Team object.
	 * @throws     PropelException
	 */
	public function getTeam(PropelPDO $con = null)
	{
		if ($this->aTeam === null && ($this->team_id !== null)) {
			$this->aTeam = TeamPeer::retrieveByPk($this->team_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTeam->addAppointments($this);
			 */
		}
		return $this->aTeam;
	}

	/**
	 * Declares an association between this object and a Year object.
	 *
	 * @param      Year $v
	 * @return     Appointment The current object (for fluent API support)
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
			$v->addAppointment($this);
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
			   $this->aYear->addAppointments($this);
			 */
		}
		return $this->aYear;
	}

	/**
	 * Declares an association between this object and a Syllabus object.
	 *
	 * @param      Syllabus $v
	 * @return     Appointment The current object (for fluent API support)
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
			$v->addAppointment($this);
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
			   $this->aSyllabus->addAppointments($this);
			 */
		}
		return $this->aSyllabus;
	}

	/**
	 * Declares an association between this object and a AppointmentType object.
	 *
	 * @param      AppointmentType $v
	 * @return     Appointment The current object (for fluent API support)
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
			$v->addAppointment($this);
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
			   $this->aAppointmentType->addAppointments($this);
			 */
		}
		return $this->aAppointmentType;
	}

	/**
	 * Clears out the collWpinfos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWpinfos()
	 */
	public function clearWpinfos()
	{
		$this->collWpinfos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWpinfos collection (array).
	 *
	 * By default this just sets the collWpinfos collection to an empty array (like clearcollWpinfos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWpinfos()
	{
		$this->collWpinfos = array();
	}

	/**
	 * Gets an array of Wpinfo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Appointment has previously been saved, it will retrieve
	 * related Wpinfos from storage. If this Appointment is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Wpinfo[]
	 * @throws     PropelException
	 */
	public function getWpinfos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpinfos === null) {
			if ($this->isNew()) {
			   $this->collWpinfos = array();
			} else {

				$criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->id);

				WpinfoPeer::addSelectColumns($criteria);
				$this->collWpinfos = WpinfoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->id);

				WpinfoPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpinfoCriteria) || !$this->lastWpinfoCriteria->equals($criteria)) {
					$this->collWpinfos = WpinfoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpinfoCriteria = $criteria;
		return $this->collWpinfos;
	}

	/**
	 * Returns the number of related Wpinfo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Wpinfo objects.
	 * @throws     PropelException
	 */
	public function countWpinfos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpinfos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->id);

				$count = WpinfoPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->id);

				if (!isset($this->lastWpinfoCriteria) || !$this->lastWpinfoCriteria->equals($criteria)) {
					$count = WpinfoPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWpinfos);
				}
			} else {
				$count = count($this->collWpinfos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Wpinfo object to this object
	 * through the Wpinfo foreign key attribute.
	 *
	 * @param      Wpinfo $l Wpinfo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWpinfo(Wpinfo $l)
	{
		if ($this->collWpinfos === null) {
			$this->initWpinfos();
		}
		if (!in_array($l, $this->collWpinfos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWpinfos, $l);
			$l->setAppointment($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related Wpinfos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getWpinfosJoinWpinfoType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpinfos === null) {
			if ($this->isNew()) {
				$this->collWpinfos = array();
			} else {

				$criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->id);

				$this->collWpinfos = WpinfoPeer::doSelectJoinWpinfoType($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastWpinfoCriteria) || !$this->lastWpinfoCriteria->equals($criteria)) {
				$this->collWpinfos = WpinfoPeer::doSelectJoinWpinfoType($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpinfoCriteria = $criteria;

		return $this->collWpinfos;
	}

	/**
	 * Clears out the collWptoolAppointments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWptoolAppointments()
	 */
	public function clearWptoolAppointments()
	{
		$this->collWptoolAppointments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWptoolAppointments collection (array).
	 *
	 * By default this just sets the collWptoolAppointments collection to an empty array (like clearcollWptoolAppointments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWptoolAppointments()
	{
		$this->collWptoolAppointments = array();
	}

	/**
	 * Gets an array of WptoolAppointment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Appointment has previously been saved, it will retrieve
	 * related WptoolAppointments from storage. If this Appointment is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WptoolAppointment[]
	 * @throws     PropelException
	 */
	public function getWptoolAppointments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWptoolAppointments === null) {
			if ($this->isNew()) {
			   $this->collWptoolAppointments = array();
			} else {

				$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->id);

				WptoolAppointmentPeer::addSelectColumns($criteria);
				$this->collWptoolAppointments = WptoolAppointmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->id);

				WptoolAppointmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastWptoolAppointmentCriteria) || !$this->lastWptoolAppointmentCriteria->equals($criteria)) {
					$this->collWptoolAppointments = WptoolAppointmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWptoolAppointmentCriteria = $criteria;
		return $this->collWptoolAppointments;
	}

	/**
	 * Returns the number of related WptoolAppointment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WptoolAppointment objects.
	 * @throws     PropelException
	 */
	public function countWptoolAppointments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWptoolAppointments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->id);

				$count = WptoolAppointmentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->id);

				if (!isset($this->lastWptoolAppointmentCriteria) || !$this->lastWptoolAppointmentCriteria->equals($criteria)) {
					$count = WptoolAppointmentPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWptoolAppointments);
				}
			} else {
				$count = count($this->collWptoolAppointments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WptoolAppointment object to this object
	 * through the WptoolAppointment foreign key attribute.
	 *
	 * @param      WptoolAppointment $l WptoolAppointment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWptoolAppointment(WptoolAppointment $l)
	{
		if ($this->collWptoolAppointments === null) {
			$this->initWptoolAppointments();
		}
		if (!in_array($l, $this->collWptoolAppointments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWptoolAppointments, $l);
			$l->setAppointment($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related WptoolAppointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getWptoolAppointmentsJoinWptoolItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWptoolAppointments === null) {
			if ($this->isNew()) {
				$this->collWptoolAppointments = array();
			} else {

				$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->id);

				$this->collWptoolAppointments = WptoolAppointmentPeer::doSelectJoinWptoolItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastWptoolAppointmentCriteria) || !$this->lastWptoolAppointmentCriteria->equals($criteria)) {
				$this->collWptoolAppointments = WptoolAppointmentPeer::doSelectJoinWptoolItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastWptoolAppointmentCriteria = $criteria;

		return $this->collWptoolAppointments;
	}

	/**
	 * Clears out the collWpmodules collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWpmodules()
	 */
	public function clearWpmodules()
	{
		$this->collWpmodules = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWpmodules collection (array).
	 *
	 * By default this just sets the collWpmodules collection to an empty array (like clearcollWpmodules());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWpmodules()
	{
		$this->collWpmodules = array();
	}

	/**
	 * Gets an array of Wpmodule objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Appointment has previously been saved, it will retrieve
	 * related Wpmodules from storage. If this Appointment is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Wpmodule[]
	 * @throws     PropelException
	 */
	public function getWpmodules($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
			   $this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpmoduleCriteria = $criteria;
		return $this->collWpmodules;
	}

	/**
	 * Returns the number of related Wpmodule objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Wpmodule objects.
	 * @throws     PropelException
	 */
	public function countWpmodules(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

				$count = WpmodulePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$count = WpmodulePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWpmodules);
				}
			} else {
				$count = count($this->collWpmodules);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Wpmodule object to this object
	 * through the Wpmodule foreign key attribute.
	 *
	 * @param      Wpmodule $l Wpmodule
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWpmodule(Wpmodule $l)
	{
		if ($this->collWpmodules === null) {
			$this->initWpmodules();
		}
		if (!in_array($l, $this->collWpmodules, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWpmodules, $l);
			$l->setAppointment($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related Wpmodules from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getWpmodulesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

				$this->collWpmodules = WpmodulePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
				$this->collWpmodules = WpmodulePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;

		return $this->collWpmodules;
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
	 * Otherwise if this Appointment has previously been saved, it will retrieve
	 * related StudentSuggestions from storage. If this Appointment is new, it will return
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
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
			   $this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

				StudentSuggestionPeer::addSelectColumns($criteria);
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

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
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
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

				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

				$count = StudentSuggestionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

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
			$l->setAppointment($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentSuggestionsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastStudentSuggestionCriteria) || !$this->lastStudentSuggestionCriteria->equals($criteria)) {
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSuggestionCriteria = $criteria;

		return $this->collStudentSuggestions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentSuggestionsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

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
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentSuggestionsJoinSuggestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinSuggestion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::APPOINTMENT_ID, $this->id);

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
	 * Otherwise if this Appointment has previously been saved, it will retrieve
	 * related StudentHints from storage. If this Appointment is new, it will return
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
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
			   $this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

				StudentHintPeer::addSelectColumns($criteria);
				$this->collStudentHints = StudentHintPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

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
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
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

				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

				$count = StudentHintPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

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
			$l->setAppointment($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentHintsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastStudentHintCriteria) || !$this->lastStudentHintCriteria->equals($criteria)) {
				$this->collStudentHints = StudentHintPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentHintCriteria = $criteria;

		return $this->collStudentHints;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentHintsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

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
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentHintsJoinRecuperationHint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinRecuperationHint($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::APPOINTMENT_ID, $this->id);

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
	 * Otherwise if this Appointment has previously been saved, it will retrieve
	 * related StudentSyllabusItems from storage. If this Appointment is new, it will return
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
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
			   $this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

				StudentSyllabusItemPeer::addSelectColumns($criteria);
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

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
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
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

				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

				$count = StudentSyllabusItemPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

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
			$l->setAppointment($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentSyllabusItemsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSyllabusItemCriteria = $criteria;

		return $this->collStudentSyllabusItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentSyllabusItemsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

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
	 * Otherwise if this Appointment is new, it will return
	 * an empty collection; or if this Appointment has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Appointment.
	 */
	public function getStudentSyllabusItemsJoinSyllabusItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::APPOINTMENT_ID, $this->id);

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
			if ($this->collWpinfos) {
				foreach ((array) $this->collWpinfos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWptoolAppointments) {
				foreach ((array) $this->collWptoolAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpmodules) {
				foreach ((array) $this->collWpmodules as $o) {
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

		$this->collWpinfos = null;
		$this->collWptoolAppointments = null;
		$this->collWpmodules = null;
		$this->collStudentSuggestions = null;
		$this->collStudentHints = null;
		$this->collStudentSyllabusItems = null;
			$this->asfGuardUser = null;
			$this->aSubject = null;
			$this->aSchoolclass = null;
			$this->aTeam = null;
			$this->aYear = null;
			$this->aSyllabus = null;
			$this->aAppointmentType = null;
	}

} // BaseAppointment
