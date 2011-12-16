<?php

/**
 * Base class that represents a row from the 'sf_guard_user' table.
 *
 * 
 *
 * @package    plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardUser extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfGuardUserPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;

	/**
	 * The value for the algorithm field.
	 * Note: this column has a database default value of: 'sha1'
	 * @var        string
	 */
	protected $algorithm;

	/**
	 * The value for the salt field.
	 * @var        string
	 */
	protected $salt;

	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the last_login field.
	 * @var        string
	 */
	protected $last_login;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the is_super_admin field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_super_admin;

	/**
	 * @var        array RecuperationHint[] Collection to store aggregation of RecuperationHint objects.
	 */
	protected $collRecuperationHints;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRecuperationHints.
	 */
	private $lastRecuperationHintCriteria = null;

	/**
	 * @var        sfGuardUserProfile one-to-one related sfGuardUserProfile object
	 */
	protected $singlesfGuardUserProfile;

	/**
	 * @var        array Account[] Collection to store aggregation of Account objects.
	 */
	protected $collAccounts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAccounts.
	 */
	private $lastAccountCriteria = null;

	/**
	 * @var        array TicketEvent[] Collection to store aggregation of TicketEvent objects.
	 */
	protected $collTicketEventsRelatedByUserId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collTicketEventsRelatedByUserId.
	 */
	private $lastTicketEventRelatedByUserIdCriteria = null;

	/**
	 * @var        array TicketEvent[] Collection to store aggregation of TicketEvent objects.
	 */
	protected $collTicketEventsRelatedByAssigneeId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collTicketEventsRelatedByAssigneeId.
	 */
	private $lastTicketEventRelatedByAssigneeIdCriteria = null;

	/**
	 * @var        array Appointment[] Collection to store aggregation of Appointment objects.
	 */
	protected $collAppointments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAppointments.
	 */
	private $lastAppointmentCriteria = null;

	/**
	 * @var        array Enrolment[] Collection to store aggregation of Enrolment objects.
	 */
	protected $collEnrolments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collEnrolments.
	 */
	private $lastEnrolmentCriteria = null;

	/**
	 * @var        array UserTeam[] Collection to store aggregation of UserTeam objects.
	 */
	protected $collUserTeams;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserTeams.
	 */
	private $lastUserTeamCriteria = null;

	/**
	 * @var        array Wfevent[] Collection to store aggregation of Wfevent objects.
	 */
	protected $collWfevents;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWfevents.
	 */
	private $lastWfeventCriteria = null;

	/**
	 * @var        array Wpmodule[] Collection to store aggregation of Wpmodule objects.
	 */
	protected $collWpmodules;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWpmodules.
	 */
	private $lastWpmoduleCriteria = null;

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
	 * @var        array Schoolproject[] Collection to store aggregation of Schoolproject objects.
	 */
	protected $collSchoolprojects;

	/**
	 * @var        Criteria The criteria used to select the current contents of collSchoolprojects.
	 */
	private $lastSchoolprojectCriteria = null;

	/**
	 * @var        array ProjDeadline[] Collection to store aggregation of ProjDeadline objects.
	 */
	protected $collProjDeadlines;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjDeadlines.
	 */
	private $lastProjDeadlineCriteria = null;

	/**
	 * @var        array ProjResource[] Collection to store aggregation of ProjResource objects.
	 */
	protected $collProjResources;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjResources.
	 */
	private $lastProjResourceCriteria = null;

	/**
	 * @var        array ProjActivity[] Collection to store aggregation of ProjActivity objects.
	 */
	protected $collProjActivitysRelatedByUserId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjActivitysRelatedByUserId.
	 */
	private $lastProjActivityRelatedByUserIdCriteria = null;

	/**
	 * @var        array ProjActivity[] Collection to store aggregation of ProjActivity objects.
	 */
	protected $collProjActivitysRelatedByAcknowledgerUserId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collProjActivitysRelatedByAcknowledgerUserId.
	 */
	private $lastProjActivityRelatedByAcknowledgerUserIdCriteria = null;

	/**
	 * @var        array Lanlog[] Collection to store aggregation of Lanlog objects.
	 */
	protected $collLanlogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collLanlogs.
	 */
	private $lastLanlogCriteria = null;

	/**
	 * @var        array AttachmentFile[] Collection to store aggregation of AttachmentFile objects.
	 */
	protected $collAttachmentFiles;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAttachmentFiles.
	 */
	private $lastAttachmentFileCriteria = null;

	/**
	 * @var        array sfGuardUserPermission[] Collection to store aggregation of sfGuardUserPermission objects.
	 */
	protected $collsfGuardUserPermissions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfGuardUserPermissions.
	 */
	private $lastsfGuardUserPermissionCriteria = null;

	/**
	 * @var        array sfGuardUserGroup[] Collection to store aggregation of sfGuardUserGroup objects.
	 */
	protected $collsfGuardUserGroups;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfGuardUserGroups.
	 */
	private $lastsfGuardUserGroupCriteria = null;

	/**
	 * @var        array sfGuardRememberKey[] Collection to store aggregation of sfGuardRememberKey objects.
	 */
	protected $collsfGuardRememberKeys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfGuardRememberKeys.
	 */
	private $lastsfGuardRememberKeyCriteria = null;

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
	
	const PEER = 'sfGuardUserPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->algorithm = 'sha1';
		$this->is_active = true;
		$this->is_super_admin = false;
	}

	/**
	 * Initializes internal state of BasesfGuardUser object.
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
	 * Get the [username] column value.
	 * 
	 * @return     string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the [algorithm] column value.
	 * 
	 * @return     string
	 */
	public function getAlgorithm()
	{
		return $this->algorithm;
	}

	/**
	 * Get the [salt] column value.
	 * 
	 * @return     string
	 */
	public function getSalt()
	{
		return $this->salt;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{
		return $this->password;
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
	 * Get the [optionally formatted] temporal [last_login] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getLastLogin($format = 'Y-m-d H:i:s')
	{
		if ($this->last_login === null) {
			return null;
		}


		if ($this->last_login === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_login);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login, true), $x);
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
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{
		return $this->is_active;
	}

	/**
	 * Get the [is_super_admin] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSuperAdmin()
	{
		return $this->is_super_admin;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [username] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::USERNAME;
		}

		return $this;
	} // setUsername()

	/**
	 * Set the value of [algorithm] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setAlgorithm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->algorithm !== $v || $this->isNew()) {
			$this->algorithm = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ALGORITHM;
		}

		return $this;
	} // setAlgorithm()

	/**
	 * Set the value of [salt] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setSalt($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::SALT;
		}

		return $this;
	} // setSalt()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::PASSWORD;
		}

		return $this;
	} // setPassword()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfGuardUser The current object (for fluent API support)
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
				$this->modifiedColumns[] = sfGuardUserPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [last_login] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setLastLogin($v)
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

		if ( $this->last_login !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->last_login !== null && $tmpDt = new DateTime($this->last_login)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->last_login = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = sfGuardUserPeer::LAST_LOGIN;
			}
		} // if either are not null

		return $this;
	} // setLastLogin()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [is_super_admin] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setIsSuperAdmin($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_super_admin !== $v || $this->isNew()) {
			$this->is_super_admin = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_SUPER_ADMIN;
		}

		return $this;
	} // setIsSuperAdmin()

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
			if ($this->algorithm !== 'sha1') {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->is_super_admin !== false) {
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
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->algorithm = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->salt = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->password = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->last_login = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->is_active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->is_super_admin = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUser object", $e);
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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = sfGuardUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collRecuperationHints = null;
			$this->lastRecuperationHintCriteria = null;

			$this->singlesfGuardUserProfile = null;

			$this->collAccounts = null;
			$this->lastAccountCriteria = null;

			$this->collTicketEventsRelatedByUserId = null;
			$this->lastTicketEventRelatedByUserIdCriteria = null;

			$this->collTicketEventsRelatedByAssigneeId = null;
			$this->lastTicketEventRelatedByAssigneeIdCriteria = null;

			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

			$this->collEnrolments = null;
			$this->lastEnrolmentCriteria = null;

			$this->collUserTeams = null;
			$this->lastUserTeamCriteria = null;

			$this->collWfevents = null;
			$this->lastWfeventCriteria = null;

			$this->collWpmodules = null;
			$this->lastWpmoduleCriteria = null;

			$this->collStudentSituations = null;
			$this->lastStudentSituationCriteria = null;

			$this->collStudentSuggestions = null;
			$this->lastStudentSuggestionCriteria = null;

			$this->collStudentHints = null;
			$this->lastStudentHintCriteria = null;

			$this->collStudentSyllabusItems = null;
			$this->lastStudentSyllabusItemCriteria = null;

			$this->collSchoolprojects = null;
			$this->lastSchoolprojectCriteria = null;

			$this->collProjDeadlines = null;
			$this->lastProjDeadlineCriteria = null;

			$this->collProjResources = null;
			$this->lastProjResourceCriteria = null;

			$this->collProjActivitysRelatedByUserId = null;
			$this->lastProjActivityRelatedByUserIdCriteria = null;

			$this->collProjActivitysRelatedByAcknowledgerUserId = null;
			$this->lastProjActivityRelatedByAcknowledgerUserIdCriteria = null;

			$this->collLanlogs = null;
			$this->lastLanlogCriteria = null;

			$this->collAttachmentFiles = null;
			$this->lastAttachmentFileCriteria = null;

			$this->collsfGuardUserPermissions = null;
			$this->lastsfGuardUserPermissionCriteria = null;

			$this->collsfGuardUserGroups = null;
			$this->lastsfGuardUserGroupCriteria = null;

			$this->collsfGuardRememberKeys = null;
			$this->lastsfGuardRememberKeyCriteria = null;

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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				sfGuardUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_timestampable behavior
			
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(sfGuardUserPeer::CREATED_AT))
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
				sfGuardUserPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = sfGuardUserPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRecuperationHints !== null) {
				foreach ($this->collRecuperationHints as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singlesfGuardUserProfile !== null) {
				if (!$this->singlesfGuardUserProfile->isDeleted()) {
						$affectedRows += $this->singlesfGuardUserProfile->save($con);
				}
			}

			if ($this->collAccounts !== null) {
				foreach ($this->collAccounts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTicketEventsRelatedByUserId !== null) {
				foreach ($this->collTicketEventsRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTicketEventsRelatedByAssigneeId !== null) {
				foreach ($this->collTicketEventsRelatedByAssigneeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAppointments !== null) {
				foreach ($this->collAppointments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEnrolments !== null) {
				foreach ($this->collEnrolments as $referrerFK) {
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

			if ($this->collWfevents !== null) {
				foreach ($this->collWfevents as $referrerFK) {
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

			if ($this->collSchoolprojects !== null) {
				foreach ($this->collSchoolprojects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjDeadlines !== null) {
				foreach ($this->collProjDeadlines as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjResources !== null) {
				foreach ($this->collProjResources as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjActivitysRelatedByUserId !== null) {
				foreach ($this->collProjActivitysRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjActivitysRelatedByAcknowledgerUserId !== null) {
				foreach ($this->collProjActivitysRelatedByAcknowledgerUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLanlogs !== null) {
				foreach ($this->collLanlogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAttachmentFiles !== null) {
				foreach ($this->collAttachmentFiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardUserPermissions !== null) {
				foreach ($this->collsfGuardUserPermissions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardUserGroups !== null) {
				foreach ($this->collsfGuardUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardRememberKeys !== null) {
				foreach ($this->collsfGuardRememberKeys as $referrerFK) {
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


			if (($retval = sfGuardUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRecuperationHints !== null) {
					foreach ($this->collRecuperationHints as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singlesfGuardUserProfile !== null) {
					if (!$this->singlesfGuardUserProfile->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singlesfGuardUserProfile->getValidationFailures());
					}
				}

				if ($this->collAccounts !== null) {
					foreach ($this->collAccounts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTicketEventsRelatedByUserId !== null) {
					foreach ($this->collTicketEventsRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTicketEventsRelatedByAssigneeId !== null) {
					foreach ($this->collTicketEventsRelatedByAssigneeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEnrolments !== null) {
					foreach ($this->collEnrolments as $referrerFK) {
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

				if ($this->collWfevents !== null) {
					foreach ($this->collWfevents as $referrerFK) {
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

				if ($this->collSchoolprojects !== null) {
					foreach ($this->collSchoolprojects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjDeadlines !== null) {
					foreach ($this->collProjDeadlines as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjResources !== null) {
					foreach ($this->collProjResources as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjActivitysRelatedByUserId !== null) {
					foreach ($this->collProjActivitysRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjActivitysRelatedByAcknowledgerUserId !== null) {
					foreach ($this->collProjActivitysRelatedByAcknowledgerUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLanlogs !== null) {
					foreach ($this->collLanlogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAttachmentFiles !== null) {
					foreach ($this->collAttachmentFiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserPermissions !== null) {
					foreach ($this->collsfGuardUserPermissions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserGroups !== null) {
					foreach ($this->collsfGuardUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardRememberKeys !== null) {
					foreach ($this->collsfGuardRememberKeys as $referrerFK) {
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getAlgorithm();
				break;
			case 3:
				return $this->getSalt();
				break;
			case 4:
				return $this->getPassword();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getLastLogin();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsSuperAdmin();
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
		$keys = sfGuardUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getAlgorithm(),
			$keys[3] => $this->getSalt(),
			$keys[4] => $this->getPassword(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getLastLogin(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsSuperAdmin(),
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setAlgorithm($value);
				break;
			case 3:
				$this->setSalt($value);
				break;
			case 4:
				$this->setPassword($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setLastLogin($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsSuperAdmin($value);
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
		$keys = sfGuardUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlgorithm($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSalt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastLogin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSuperAdmin($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserPeer::ID)) $criteria->add(sfGuardUserPeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserPeer::USERNAME)) $criteria->add(sfGuardUserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(sfGuardUserPeer::ALGORITHM)) $criteria->add(sfGuardUserPeer::ALGORITHM, $this->algorithm);
		if ($this->isColumnModified(sfGuardUserPeer::SALT)) $criteria->add(sfGuardUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(sfGuardUserPeer::PASSWORD)) $criteria->add(sfGuardUserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(sfGuardUserPeer::CREATED_AT)) $criteria->add(sfGuardUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfGuardUserPeer::LAST_LOGIN)) $criteria->add(sfGuardUserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(sfGuardUserPeer::IS_ACTIVE)) $criteria->add(sfGuardUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(sfGuardUserPeer::IS_SUPER_ADMIN)) $criteria->add(sfGuardUserPeer::IS_SUPER_ADMIN, $this->is_super_admin);

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
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		$criteria->add(sfGuardUserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of sfGuardUser (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUsername($this->username);

		$copyObj->setAlgorithm($this->algorithm);

		$copyObj->setSalt($this->salt);

		$copyObj->setPassword($this->password);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastLogin($this->last_login);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsSuperAdmin($this->is_super_admin);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRecuperationHints() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRecuperationHint($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getsfGuardUserProfile();
			if ($relObj) {
				$copyObj->setsfGuardUserProfile($relObj->copy($deepCopy));
			}

			foreach ($this->getAccounts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAccount($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTicketEventsRelatedByUserId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTicketEventRelatedByUserId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTicketEventsRelatedByAssigneeId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTicketEventRelatedByAssigneeId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAppointment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEnrolments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEnrolment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserTeams() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserTeam($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWfevents() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWfevent($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpmodules() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWpmodule($relObj->copy($deepCopy));
				}
			}

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

			foreach ($this->getSchoolprojects() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSchoolproject($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getProjDeadlines() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjDeadline($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getProjResources() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjResource($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getProjActivitysRelatedByUserId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjActivityRelatedByUserId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getProjActivitysRelatedByAcknowledgerUserId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProjActivityRelatedByAcknowledgerUserId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLanlogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLanlog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAttachmentFiles() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAttachmentFile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardUserPermissions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardUserPermission($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardUserGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardUserGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardRememberKeys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardRememberKey($relObj->copy($deepCopy));
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
	 * @return     sfGuardUser Clone of current object.
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
	 * @return     sfGuardUserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfGuardUserPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collRecuperationHints collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRecuperationHints()
	 */
	public function clearRecuperationHints()
	{
		$this->collRecuperationHints = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRecuperationHints collection (array).
	 *
	 * By default this just sets the collRecuperationHints collection to an empty array (like clearcollRecuperationHints());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRecuperationHints()
	{
		$this->collRecuperationHints = array();
	}

	/**
	 * Gets an array of RecuperationHint objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related RecuperationHints from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RecuperationHint[]
	 * @throws     PropelException
	 */
	public function getRecuperationHints($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecuperationHints === null) {
			if ($this->isNew()) {
			   $this->collRecuperationHints = array();
			} else {

				$criteria->add(RecuperationHintPeer::USER_ID, $this->id);

				RecuperationHintPeer::addSelectColumns($criteria);
				$this->collRecuperationHints = RecuperationHintPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RecuperationHintPeer::USER_ID, $this->id);

				RecuperationHintPeer::addSelectColumns($criteria);
				if (!isset($this->lastRecuperationHintCriteria) || !$this->lastRecuperationHintCriteria->equals($criteria)) {
					$this->collRecuperationHints = RecuperationHintPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecuperationHintCriteria = $criteria;
		return $this->collRecuperationHints;
	}

	/**
	 * Returns the number of related RecuperationHint objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RecuperationHint objects.
	 * @throws     PropelException
	 */
	public function countRecuperationHints(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecuperationHints === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecuperationHintPeer::USER_ID, $this->id);

				$count = RecuperationHintPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RecuperationHintPeer::USER_ID, $this->id);

				if (!isset($this->lastRecuperationHintCriteria) || !$this->lastRecuperationHintCriteria->equals($criteria)) {
					$count = RecuperationHintPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collRecuperationHints);
				}
			} else {
				$count = count($this->collRecuperationHints);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RecuperationHint object to this object
	 * through the RecuperationHint foreign key attribute.
	 *
	 * @param      RecuperationHint $l RecuperationHint
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRecuperationHint(RecuperationHint $l)
	{
		if ($this->collRecuperationHints === null) {
			$this->initRecuperationHints();
		}
		if (!in_array($l, $this->collRecuperationHints, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRecuperationHints, $l);
			$l->setsfGuardUser($this);
		}
	}

	/**
	 * Gets a single sfGuardUserProfile object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     sfGuardUserProfile
	 * @throws     PropelException
	 */
	public function getsfGuardUserProfile(PropelPDO $con = null)
	{

		if ($this->singlesfGuardUserProfile === null && !$this->isNew()) {
			$this->singlesfGuardUserProfile = sfGuardUserProfilePeer::retrieveByPK($this->id, $con);
		}

		return $this->singlesfGuardUserProfile;
	}

	/**
	 * Sets a single sfGuardUserProfile object as related to this object by a one-to-one relationship.
	 *
	 * @param      sfGuardUserProfile $l sfGuardUserProfile
	 * @return     sfGuardUser The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUserProfile(sfGuardUserProfile $v)
	{
		$this->singlesfGuardUserProfile = $v;

		// Make sure that that the passed-in sfGuardUserProfile isn't already associated with this object
		if ($v->getsfGuardUser() === null) {
			$v->setsfGuardUser($this);
		}

		return $this;
	}

	/**
	 * Clears out the collAccounts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAccounts()
	 */
	public function clearAccounts()
	{
		$this->collAccounts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAccounts collection (array).
	 *
	 * By default this just sets the collAccounts collection to an empty array (like clearcollAccounts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAccounts()
	{
		$this->collAccounts = array();
	}

	/**
	 * Gets an array of Account objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Accounts from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Account[]
	 * @throws     PropelException
	 */
	public function getAccounts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccounts === null) {
			if ($this->isNew()) {
			   $this->collAccounts = array();
			} else {

				$criteria->add(AccountPeer::USER_ID, $this->id);

				AccountPeer::addSelectColumns($criteria);
				$this->collAccounts = AccountPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AccountPeer::USER_ID, $this->id);

				AccountPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccountCriteria) || !$this->lastAccountCriteria->equals($criteria)) {
					$this->collAccounts = AccountPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccountCriteria = $criteria;
		return $this->collAccounts;
	}

	/**
	 * Returns the number of related Account objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Account objects.
	 * @throws     PropelException
	 */
	public function countAccounts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAccounts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AccountPeer::USER_ID, $this->id);

				$count = AccountPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AccountPeer::USER_ID, $this->id);

				if (!isset($this->lastAccountCriteria) || !$this->lastAccountCriteria->equals($criteria)) {
					$count = AccountPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAccounts);
				}
			} else {
				$count = count($this->collAccounts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Account object to this object
	 * through the Account foreign key attribute.
	 *
	 * @param      Account $l Account
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAccount(Account $l)
	{
		if ($this->collAccounts === null) {
			$this->initAccounts();
		}
		if (!in_array($l, $this->collAccounts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAccounts, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Accounts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getAccountsJoinAccountType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccounts === null) {
			if ($this->isNew()) {
				$this->collAccounts = array();
			} else {

				$criteria->add(AccountPeer::USER_ID, $this->id);

				$this->collAccounts = AccountPeer::doSelectJoinAccountType($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AccountPeer::USER_ID, $this->id);

			if (!isset($this->lastAccountCriteria) || !$this->lastAccountCriteria->equals($criteria)) {
				$this->collAccounts = AccountPeer::doSelectJoinAccountType($criteria, $con, $join_behavior);
			}
		}
		$this->lastAccountCriteria = $criteria;

		return $this->collAccounts;
	}

	/**
	 * Clears out the collTicketEventsRelatedByUserId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTicketEventsRelatedByUserId()
	 */
	public function clearTicketEventsRelatedByUserId()
	{
		$this->collTicketEventsRelatedByUserId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTicketEventsRelatedByUserId collection (array).
	 *
	 * By default this just sets the collTicketEventsRelatedByUserId collection to an empty array (like clearcollTicketEventsRelatedByUserId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTicketEventsRelatedByUserId()
	{
		$this->collTicketEventsRelatedByUserId = array();
	}

	/**
	 * Gets an array of TicketEvent objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related TicketEventsRelatedByUserId from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array TicketEvent[]
	 * @throws     PropelException
	 */
	public function getTicketEventsRelatedByUserId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEventsRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collTicketEventsRelatedByUserId = array();
			} else {

				$criteria->add(TicketEventPeer::USER_ID, $this->id);

				TicketEventPeer::addSelectColumns($criteria);
				$this->collTicketEventsRelatedByUserId = TicketEventPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TicketEventPeer::USER_ID, $this->id);

				TicketEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastTicketEventRelatedByUserIdCriteria) || !$this->lastTicketEventRelatedByUserIdCriteria->equals($criteria)) {
					$this->collTicketEventsRelatedByUserId = TicketEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTicketEventRelatedByUserIdCriteria = $criteria;
		return $this->collTicketEventsRelatedByUserId;
	}

	/**
	 * Returns the number of related TicketEvent objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TicketEvent objects.
	 * @throws     PropelException
	 */
	public function countTicketEventsRelatedByUserId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTicketEventsRelatedByUserId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TicketEventPeer::USER_ID, $this->id);

				$count = TicketEventPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(TicketEventPeer::USER_ID, $this->id);

				if (!isset($this->lastTicketEventRelatedByUserIdCriteria) || !$this->lastTicketEventRelatedByUserIdCriteria->equals($criteria)) {
					$count = TicketEventPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collTicketEventsRelatedByUserId);
				}
			} else {
				$count = count($this->collTicketEventsRelatedByUserId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a TicketEvent object to this object
	 * through the TicketEvent foreign key attribute.
	 *
	 * @param      TicketEvent $l TicketEvent
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTicketEventRelatedByUserId(TicketEvent $l)
	{
		if ($this->collTicketEventsRelatedByUserId === null) {
			$this->initTicketEventsRelatedByUserId();
		}
		if (!in_array($l, $this->collTicketEventsRelatedByUserId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collTicketEventsRelatedByUserId, $l);
			$l->setsfGuardUserRelatedByUserId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related TicketEventsRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getTicketEventsRelatedByUserIdJoinTicket($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEventsRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collTicketEventsRelatedByUserId = array();
			} else {

				$criteria->add(TicketEventPeer::USER_ID, $this->id);

				$this->collTicketEventsRelatedByUserId = TicketEventPeer::doSelectJoinTicket($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TicketEventPeer::USER_ID, $this->id);

			if (!isset($this->lastTicketEventRelatedByUserIdCriteria) || !$this->lastTicketEventRelatedByUserIdCriteria->equals($criteria)) {
				$this->collTicketEventsRelatedByUserId = TicketEventPeer::doSelectJoinTicket($criteria, $con, $join_behavior);
			}
		}
		$this->lastTicketEventRelatedByUserIdCriteria = $criteria;

		return $this->collTicketEventsRelatedByUserId;
	}

	/**
	 * Clears out the collTicketEventsRelatedByAssigneeId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTicketEventsRelatedByAssigneeId()
	 */
	public function clearTicketEventsRelatedByAssigneeId()
	{
		$this->collTicketEventsRelatedByAssigneeId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTicketEventsRelatedByAssigneeId collection (array).
	 *
	 * By default this just sets the collTicketEventsRelatedByAssigneeId collection to an empty array (like clearcollTicketEventsRelatedByAssigneeId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTicketEventsRelatedByAssigneeId()
	{
		$this->collTicketEventsRelatedByAssigneeId = array();
	}

	/**
	 * Gets an array of TicketEvent objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related TicketEventsRelatedByAssigneeId from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array TicketEvent[]
	 * @throws     PropelException
	 */
	public function getTicketEventsRelatedByAssigneeId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEventsRelatedByAssigneeId === null) {
			if ($this->isNew()) {
			   $this->collTicketEventsRelatedByAssigneeId = array();
			} else {

				$criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->id);

				TicketEventPeer::addSelectColumns($criteria);
				$this->collTicketEventsRelatedByAssigneeId = TicketEventPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->id);

				TicketEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastTicketEventRelatedByAssigneeIdCriteria) || !$this->lastTicketEventRelatedByAssigneeIdCriteria->equals($criteria)) {
					$this->collTicketEventsRelatedByAssigneeId = TicketEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTicketEventRelatedByAssigneeIdCriteria = $criteria;
		return $this->collTicketEventsRelatedByAssigneeId;
	}

	/**
	 * Returns the number of related TicketEvent objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TicketEvent objects.
	 * @throws     PropelException
	 */
	public function countTicketEventsRelatedByAssigneeId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTicketEventsRelatedByAssigneeId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->id);

				$count = TicketEventPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->id);

				if (!isset($this->lastTicketEventRelatedByAssigneeIdCriteria) || !$this->lastTicketEventRelatedByAssigneeIdCriteria->equals($criteria)) {
					$count = TicketEventPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collTicketEventsRelatedByAssigneeId);
				}
			} else {
				$count = count($this->collTicketEventsRelatedByAssigneeId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a TicketEvent object to this object
	 * through the TicketEvent foreign key attribute.
	 *
	 * @param      TicketEvent $l TicketEvent
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTicketEventRelatedByAssigneeId(TicketEvent $l)
	{
		if ($this->collTicketEventsRelatedByAssigneeId === null) {
			$this->initTicketEventsRelatedByAssigneeId();
		}
		if (!in_array($l, $this->collTicketEventsRelatedByAssigneeId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collTicketEventsRelatedByAssigneeId, $l);
			$l->setsfGuardUserRelatedByAssigneeId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related TicketEventsRelatedByAssigneeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getTicketEventsRelatedByAssigneeIdJoinTicket($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEventsRelatedByAssigneeId === null) {
			if ($this->isNew()) {
				$this->collTicketEventsRelatedByAssigneeId = array();
			} else {

				$criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->id);

				$this->collTicketEventsRelatedByAssigneeId = TicketEventPeer::doSelectJoinTicket($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->id);

			if (!isset($this->lastTicketEventRelatedByAssigneeIdCriteria) || !$this->lastTicketEventRelatedByAssigneeIdCriteria->equals($criteria)) {
				$this->collTicketEventsRelatedByAssigneeId = TicketEventPeer::doSelectJoinTicket($criteria, $con, $join_behavior);
			}
		}
		$this->lastTicketEventRelatedByAssigneeIdCriteria = $criteria;

		return $this->collTicketEventsRelatedByAssigneeId;
	}

	/**
	 * Clears out the collAppointments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAppointments()
	 */
	public function clearAppointments()
	{
		$this->collAppointments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAppointments collection (array).
	 *
	 * By default this just sets the collAppointments collection to an empty array (like clearcollAppointments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAppointments()
	{
		$this->collAppointments = array();
	}

	/**
	 * Gets an array of Appointment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Appointments from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Appointment[]
	 * @throws     PropelException
	 */
	public function getAppointments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAppointmentCriteria = $criteria;
		return $this->collAppointments;
	}

	/**
	 * Returns the number of related Appointment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Appointment objects.
	 * @throws     PropelException
	 */
	public function countAppointments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$count = AppointmentPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAppointments);
				}
			} else {
				$count = count($this->collAppointments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Appointment object to this object
	 * through the Appointment foreign key attribute.
	 *
	 * @param      Appointment $l Appointment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAppointment(Appointment $l)
	{
		if ($this->collAppointments === null) {
			$this->initAppointments();
		}
		if (!in_array($l, $this->collAppointments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAppointments, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getAppointmentsJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getAppointmentsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Appointments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getAppointmentsJoinSyllabus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSyllabus($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}

	/**
	 * Clears out the collEnrolments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEnrolments()
	 */
	public function clearEnrolments()
	{
		$this->collEnrolments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEnrolments collection (array).
	 *
	 * By default this just sets the collEnrolments collection to an empty array (like clearcollEnrolments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initEnrolments()
	{
		$this->collEnrolments = array();
	}

	/**
	 * Gets an array of Enrolment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Enrolments from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Enrolment[]
	 * @throws     PropelException
	 */
	public function getEnrolments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
			   $this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
					$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEnrolmentCriteria = $criteria;
		return $this->collEnrolments;
	}

	/**
	 * Returns the number of related Enrolment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Enrolment objects.
	 * @throws     PropelException
	 */
	public function countEnrolments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				$count = EnrolmentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
					$count = EnrolmentPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collEnrolments);
				}
			} else {
				$count = count($this->collEnrolments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Enrolment object to this object
	 * through the Enrolment foreign key attribute.
	 *
	 * @param      Enrolment $l Enrolment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addEnrolment(Enrolment $l)
	{
		if ($this->collEnrolments === null) {
			$this->initEnrolments();
		}
		if (!in_array($l, $this->collEnrolments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collEnrolments, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Enrolments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getEnrolmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(EnrolmentPeer::USER_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Enrolments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getEnrolmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(EnrolmentPeer::USER_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related UserTeams from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
			   $this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserTeamPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				$count = UserTeamPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserTeamPeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related UserTeams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getUserTeamsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserTeamPeer::USER_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related UserTeams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getUserTeamsJoinRole($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserTeamPeer::USER_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}

	/**
	 * Clears out the collWfevents collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWfevents()
	 */
	public function clearWfevents()
	{
		$this->collWfevents = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWfevents collection (array).
	 *
	 * By default this just sets the collWfevents collection to an empty array (like clearcollWfevents());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWfevents()
	{
		$this->collWfevents = array();
	}

	/**
	 * Gets an array of Wfevent objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Wfevents from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Wfevent[]
	 * @throws     PropelException
	 */
	public function getWfevents($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWfevents === null) {
			if ($this->isNew()) {
			   $this->collWfevents = array();
			} else {

				$criteria->add(WfeventPeer::USER_ID, $this->id);

				WfeventPeer::addSelectColumns($criteria);
				$this->collWfevents = WfeventPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WfeventPeer::USER_ID, $this->id);

				WfeventPeer::addSelectColumns($criteria);
				if (!isset($this->lastWfeventCriteria) || !$this->lastWfeventCriteria->equals($criteria)) {
					$this->collWfevents = WfeventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWfeventCriteria = $criteria;
		return $this->collWfevents;
	}

	/**
	 * Returns the number of related Wfevent objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Wfevent objects.
	 * @throws     PropelException
	 */
	public function countWfevents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWfevents === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WfeventPeer::USER_ID, $this->id);

				$count = WfeventPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WfeventPeer::USER_ID, $this->id);

				if (!isset($this->lastWfeventCriteria) || !$this->lastWfeventCriteria->equals($criteria)) {
					$count = WfeventPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collWfevents);
				}
			} else {
				$count = count($this->collWfevents);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Wfevent object to this object
	 * through the Wfevent foreign key attribute.
	 *
	 * @param      Wfevent $l Wfevent
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWfevent(Wfevent $l)
	{
		if ($this->collWfevents === null) {
			$this->initWfevents();
		}
		if (!in_array($l, $this->collWfevents, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWfevents, $l);
			$l->setsfGuardUser($this);
		}
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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Wpmodules from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
			   $this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WpmodulePeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				$count = WpmodulePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WpmodulePeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Wpmodules from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getWpmodulesJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				$this->collWpmodules = WpmodulePeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WpmodulePeer::USER_ID, $this->id);

			if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
				$this->collWpmodules = WpmodulePeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;

		return $this->collWpmodules;
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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related StudentSituations from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
			   $this->collStudentSituations = array();
			} else {

				$criteria->add(StudentSituationPeer::USER_ID, $this->id);

				StudentSituationPeer::addSelectColumns($criteria);
				$this->collStudentSituations = StudentSituationPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSituationPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(StudentSituationPeer::USER_ID, $this->id);

				$count = StudentSituationPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSituationPeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSituations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSituationsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
				$this->collStudentSituations = array();
			} else {

				$criteria->add(StudentSituationPeer::USER_ID, $this->id);

				$this->collStudentSituations = StudentSituationPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSituationPeer::USER_ID, $this->id);

			if (!isset($this->lastStudentSituationCriteria) || !$this->lastStudentSituationCriteria->equals($criteria)) {
				$this->collStudentSituations = StudentSituationPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSituationCriteria = $criteria;

		return $this->collStudentSituations;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSituations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSituationsJoinWpmoduleItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSituations === null) {
			if ($this->isNew()) {
				$this->collStudentSituations = array();
			} else {

				$criteria->add(StudentSituationPeer::USER_ID, $this->id);

				$this->collStudentSituations = StudentSituationPeer::doSelectJoinWpmoduleItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSituationPeer::USER_ID, $this->id);

			if (!isset($this->lastStudentSituationCriteria) || !$this->lastStudentSituationCriteria->equals($criteria)) {
				$this->collStudentSituations = StudentSituationPeer::doSelectJoinWpmoduleItem($criteria, $con, $join_behavior);
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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related StudentSuggestions from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
			   $this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

				StudentSuggestionPeer::addSelectColumns($criteria);
				$this->collStudentSuggestions = StudentSuggestionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

				$count = StudentSuggestionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSuggestionsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSuggestionsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSuggestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSuggestionsJoinSuggestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSuggestions === null) {
			if ($this->isNew()) {
				$this->collStudentSuggestions = array();
			} else {

				$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

				$this->collStudentSuggestions = StudentSuggestionPeer::doSelectJoinSuggestion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSuggestionPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related StudentHints from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
			   $this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::USER_ID, $this->id);

				StudentHintPeer::addSelectColumns($criteria);
				$this->collStudentHints = StudentHintPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentHintPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(StudentHintPeer::USER_ID, $this->id);

				$count = StudentHintPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentHintPeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentHintsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::USER_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentHintsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::USER_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentHints from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentHintsJoinRecuperationHint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentHints === null) {
			if ($this->isNew()) {
				$this->collStudentHints = array();
			} else {

				$criteria->add(StudentHintPeer::USER_ID, $this->id);

				$this->collStudentHints = StudentHintPeer::doSelectJoinRecuperationHint($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentHintPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related StudentSyllabusItems from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
			   $this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

				StudentSyllabusItemPeer::addSelectColumns($criteria);
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

				$count = StudentSyllabusItemPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSyllabusItemsJoinTerm($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinTerm($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSyllabusItemsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StudentSyllabusItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getStudentSyllabusItemsJoinSyllabusItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentSyllabusItems === null) {
			if ($this->isNew()) {
				$this->collStudentSyllabusItems = array();
			} else {

				$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentSyllabusItemPeer::USER_ID, $this->id);

			if (!isset($this->lastStudentSyllabusItemCriteria) || !$this->lastStudentSyllabusItemCriteria->equals($criteria)) {
				$this->collStudentSyllabusItems = StudentSyllabusItemPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentSyllabusItemCriteria = $criteria;

		return $this->collStudentSyllabusItems;
	}

	/**
	 * Clears out the collSchoolprojects collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSchoolprojects()
	 */
	public function clearSchoolprojects()
	{
		$this->collSchoolprojects = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSchoolprojects collection (array).
	 *
	 * By default this just sets the collSchoolprojects collection to an empty array (like clearcollSchoolprojects());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSchoolprojects()
	{
		$this->collSchoolprojects = array();
	}

	/**
	 * Gets an array of Schoolproject objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Schoolprojects from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Schoolproject[]
	 * @throws     PropelException
	 */
	public function getSchoolprojects($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
			   $this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				SchoolprojectPeer::addSelectColumns($criteria);
				$this->collSchoolprojects = SchoolprojectPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				SchoolprojectPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
					$this->collSchoolprojects = SchoolprojectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;
		return $this->collSchoolprojects;
	}

	/**
	 * Returns the number of related Schoolproject objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Schoolproject objects.
	 * @throws     PropelException
	 */
	public function countSchoolprojects(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				$count = SchoolprojectPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
					$count = SchoolprojectPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collSchoolprojects);
				}
			} else {
				$count = count($this->collSchoolprojects);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Schoolproject object to this object
	 * through the Schoolproject foreign key attribute.
	 *
	 * @param      Schoolproject $l Schoolproject
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchoolproject(Schoolproject $l)
	{
		if ($this->collSchoolprojects === null) {
			$this->initSchoolprojects();
		}
		if (!in_array($l, $this->collSchoolprojects, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSchoolprojects, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Schoolprojects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getSchoolprojectsJoinProjCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinProjCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

			if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinProjCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;

		return $this->collSchoolprojects;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Schoolprojects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getSchoolprojectsJoinProjFinancing($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinProjFinancing($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

			if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinProjFinancing($criteria, $con, $join_behavior);
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;

		return $this->collSchoolprojects;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Schoolprojects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getSchoolprojectsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolprojects === null) {
			if ($this->isNew()) {
				$this->collSchoolprojects = array();
			} else {

				$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchoolprojectPeer::USER_ID, $this->id);

			if (!isset($this->lastSchoolprojectCriteria) || !$this->lastSchoolprojectCriteria->equals($criteria)) {
				$this->collSchoolprojects = SchoolprojectPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastSchoolprojectCriteria = $criteria;

		return $this->collSchoolprojects;
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
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related ProjDeadlines from storage. If this sfGuardUser is new, it will return
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjDeadlines === null) {
			if ($this->isNew()) {
			   $this->collProjDeadlines = array();
			} else {

				$criteria->add(ProjDeadlinePeer::USER_ID, $this->id);

				ProjDeadlinePeer::addSelectColumns($criteria);
				$this->collProjDeadlines = ProjDeadlinePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjDeadlinePeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(ProjDeadlinePeer::USER_ID, $this->id);

				$count = ProjDeadlinePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjDeadlinePeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related ProjDeadlines from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getProjDeadlinesJoinSchoolproject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjDeadlines === null) {
			if ($this->isNew()) {
				$this->collProjDeadlines = array();
			} else {

				$criteria->add(ProjDeadlinePeer::USER_ID, $this->id);

				$this->collProjDeadlines = ProjDeadlinePeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjDeadlinePeer::USER_ID, $this->id);

			if (!isset($this->lastProjDeadlineCriteria) || !$this->lastProjDeadlineCriteria->equals($criteria)) {
				$this->collProjDeadlines = ProjDeadlinePeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjDeadlineCriteria = $criteria;

		return $this->collProjDeadlines;
	}

	/**
	 * Clears out the collProjResources collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjResources()
	 */
	public function clearProjResources()
	{
		$this->collProjResources = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjResources collection (array).
	 *
	 * By default this just sets the collProjResources collection to an empty array (like clearcollProjResources());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjResources()
	{
		$this->collProjResources = array();
	}

	/**
	 * Gets an array of ProjResource objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related ProjResources from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjResource[]
	 * @throws     PropelException
	 */
	public function getProjResources($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
			   $this->collProjResources = array();
			} else {

				$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

				ProjResourcePeer::addSelectColumns($criteria);
				$this->collProjResources = ProjResourcePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

				ProjResourcePeer::addSelectColumns($criteria);
				if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
					$this->collProjResources = ProjResourcePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjResourceCriteria = $criteria;
		return $this->collProjResources;
	}

	/**
	 * Returns the number of related ProjResource objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ProjResource objects.
	 * @throws     PropelException
	 */
	public function countProjResources(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

				$count = ProjResourcePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

				if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
					$count = ProjResourcePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjResources);
				}
			} else {
				$count = count($this->collProjResources);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ProjResource object to this object
	 * through the ProjResource foreign key attribute.
	 *
	 * @param      ProjResource $l ProjResource
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjResource(ProjResource $l)
	{
		if ($this->collProjResources === null) {
			$this->initProjResources();
		}
		if (!in_array($l, $this->collProjResources, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjResources, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related ProjResources from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getProjResourcesJoinSchoolproject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
				$this->collProjResources = array();
			} else {

				$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

				$this->collProjResources = ProjResourcePeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

			if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
				$this->collProjResources = ProjResourcePeer::doSelectJoinSchoolproject($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjResourceCriteria = $criteria;

		return $this->collProjResources;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related ProjResources from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getProjResourcesJoinProjResourceType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjResources === null) {
			if ($this->isNew()) {
				$this->collProjResources = array();
			} else {

				$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

				$this->collProjResources = ProjResourcePeer::doSelectJoinProjResourceType($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjResourcePeer::CHARGED_USER_ID, $this->id);

			if (!isset($this->lastProjResourceCriteria) || !$this->lastProjResourceCriteria->equals($criteria)) {
				$this->collProjResources = ProjResourcePeer::doSelectJoinProjResourceType($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjResourceCriteria = $criteria;

		return $this->collProjResources;
	}

	/**
	 * Clears out the collProjActivitysRelatedByUserId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjActivitysRelatedByUserId()
	 */
	public function clearProjActivitysRelatedByUserId()
	{
		$this->collProjActivitysRelatedByUserId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjActivitysRelatedByUserId collection (array).
	 *
	 * By default this just sets the collProjActivitysRelatedByUserId collection to an empty array (like clearcollProjActivitysRelatedByUserId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjActivitysRelatedByUserId()
	{
		$this->collProjActivitysRelatedByUserId = array();
	}

	/**
	 * Gets an array of ProjActivity objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related ProjActivitysRelatedByUserId from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjActivity[]
	 * @throws     PropelException
	 */
	public function getProjActivitysRelatedByUserId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitysRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collProjActivitysRelatedByUserId = array();
			} else {

				$criteria->add(ProjActivityPeer::USER_ID, $this->id);

				ProjActivityPeer::addSelectColumns($criteria);
				$this->collProjActivitysRelatedByUserId = ProjActivityPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjActivityPeer::USER_ID, $this->id);

				ProjActivityPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjActivityRelatedByUserIdCriteria) || !$this->lastProjActivityRelatedByUserIdCriteria->equals($criteria)) {
					$this->collProjActivitysRelatedByUserId = ProjActivityPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjActivityRelatedByUserIdCriteria = $criteria;
		return $this->collProjActivitysRelatedByUserId;
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
	public function countProjActivitysRelatedByUserId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjActivitysRelatedByUserId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjActivityPeer::USER_ID, $this->id);

				$count = ProjActivityPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjActivityPeer::USER_ID, $this->id);

				if (!isset($this->lastProjActivityRelatedByUserIdCriteria) || !$this->lastProjActivityRelatedByUserIdCriteria->equals($criteria)) {
					$count = ProjActivityPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjActivitysRelatedByUserId);
				}
			} else {
				$count = count($this->collProjActivitysRelatedByUserId);
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
	public function addProjActivityRelatedByUserId(ProjActivity $l)
	{
		if ($this->collProjActivitysRelatedByUserId === null) {
			$this->initProjActivitysRelatedByUserId();
		}
		if (!in_array($l, $this->collProjActivitysRelatedByUserId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjActivitysRelatedByUserId, $l);
			$l->setsfGuardUserRelatedByUserId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related ProjActivitysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getProjActivitysRelatedByUserIdJoinProjResource($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collProjActivitysRelatedByUserId = array();
			} else {

				$criteria->add(ProjActivityPeer::USER_ID, $this->id);

				$this->collProjActivitysRelatedByUserId = ProjActivityPeer::doSelectJoinProjResource($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjActivityPeer::USER_ID, $this->id);

			if (!isset($this->lastProjActivityRelatedByUserIdCriteria) || !$this->lastProjActivityRelatedByUserIdCriteria->equals($criteria)) {
				$this->collProjActivitysRelatedByUserId = ProjActivityPeer::doSelectJoinProjResource($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjActivityRelatedByUserIdCriteria = $criteria;

		return $this->collProjActivitysRelatedByUserId;
	}

	/**
	 * Clears out the collProjActivitysRelatedByAcknowledgerUserId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProjActivitysRelatedByAcknowledgerUserId()
	 */
	public function clearProjActivitysRelatedByAcknowledgerUserId()
	{
		$this->collProjActivitysRelatedByAcknowledgerUserId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProjActivitysRelatedByAcknowledgerUserId collection (array).
	 *
	 * By default this just sets the collProjActivitysRelatedByAcknowledgerUserId collection to an empty array (like clearcollProjActivitysRelatedByAcknowledgerUserId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProjActivitysRelatedByAcknowledgerUserId()
	{
		$this->collProjActivitysRelatedByAcknowledgerUserId = array();
	}

	/**
	 * Gets an array of ProjActivity objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related ProjActivitysRelatedByAcknowledgerUserId from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ProjActivity[]
	 * @throws     PropelException
	 */
	public function getProjActivitysRelatedByAcknowledgerUserId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitysRelatedByAcknowledgerUserId === null) {
			if ($this->isNew()) {
			   $this->collProjActivitysRelatedByAcknowledgerUserId = array();
			} else {

				$criteria->add(ProjActivityPeer::ACKNOWLEDGER_USER_ID, $this->id);

				ProjActivityPeer::addSelectColumns($criteria);
				$this->collProjActivitysRelatedByAcknowledgerUserId = ProjActivityPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjActivityPeer::ACKNOWLEDGER_USER_ID, $this->id);

				ProjActivityPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjActivityRelatedByAcknowledgerUserIdCriteria) || !$this->lastProjActivityRelatedByAcknowledgerUserIdCriteria->equals($criteria)) {
					$this->collProjActivitysRelatedByAcknowledgerUserId = ProjActivityPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjActivityRelatedByAcknowledgerUserIdCriteria = $criteria;
		return $this->collProjActivitysRelatedByAcknowledgerUserId;
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
	public function countProjActivitysRelatedByAcknowledgerUserId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collProjActivitysRelatedByAcknowledgerUserId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ProjActivityPeer::ACKNOWLEDGER_USER_ID, $this->id);

				$count = ProjActivityPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ProjActivityPeer::ACKNOWLEDGER_USER_ID, $this->id);

				if (!isset($this->lastProjActivityRelatedByAcknowledgerUserIdCriteria) || !$this->lastProjActivityRelatedByAcknowledgerUserIdCriteria->equals($criteria)) {
					$count = ProjActivityPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collProjActivitysRelatedByAcknowledgerUserId);
				}
			} else {
				$count = count($this->collProjActivitysRelatedByAcknowledgerUserId);
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
	public function addProjActivityRelatedByAcknowledgerUserId(ProjActivity $l)
	{
		if ($this->collProjActivitysRelatedByAcknowledgerUserId === null) {
			$this->initProjActivitysRelatedByAcknowledgerUserId();
		}
		if (!in_array($l, $this->collProjActivitysRelatedByAcknowledgerUserId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collProjActivitysRelatedByAcknowledgerUserId, $l);
			$l->setsfGuardUserRelatedByAcknowledgerUserId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related ProjActivitysRelatedByAcknowledgerUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getProjActivitysRelatedByAcknowledgerUserIdJoinProjResource($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjActivitysRelatedByAcknowledgerUserId === null) {
			if ($this->isNew()) {
				$this->collProjActivitysRelatedByAcknowledgerUserId = array();
			} else {

				$criteria->add(ProjActivityPeer::ACKNOWLEDGER_USER_ID, $this->id);

				$this->collProjActivitysRelatedByAcknowledgerUserId = ProjActivityPeer::doSelectJoinProjResource($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjActivityPeer::ACKNOWLEDGER_USER_ID, $this->id);

			if (!isset($this->lastProjActivityRelatedByAcknowledgerUserIdCriteria) || !$this->lastProjActivityRelatedByAcknowledgerUserIdCriteria->equals($criteria)) {
				$this->collProjActivitysRelatedByAcknowledgerUserId = ProjActivityPeer::doSelectJoinProjResource($criteria, $con, $join_behavior);
			}
		}
		$this->lastProjActivityRelatedByAcknowledgerUserIdCriteria = $criteria;

		return $this->collProjActivitysRelatedByAcknowledgerUserId;
	}

	/**
	 * Clears out the collLanlogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLanlogs()
	 */
	public function clearLanlogs()
	{
		$this->collLanlogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLanlogs collection (array).
	 *
	 * By default this just sets the collLanlogs collection to an empty array (like clearcollLanlogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initLanlogs()
	{
		$this->collLanlogs = array();
	}

	/**
	 * Gets an array of Lanlog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related Lanlogs from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Lanlog[]
	 * @throws     PropelException
	 */
	public function getLanlogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
			   $this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::USER_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LanlogPeer::USER_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
					$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanlogCriteria = $criteria;
		return $this->collLanlogs;
	}

	/**
	 * Returns the number of related Lanlog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Lanlog objects.
	 * @throws     PropelException
	 */
	public function countLanlogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(LanlogPeer::USER_ID, $this->id);

				$count = LanlogPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(LanlogPeer::USER_ID, $this->id);

				if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
					$count = LanlogPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collLanlogs);
				}
			} else {
				$count = count($this->collLanlogs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Lanlog object to this object
	 * through the Lanlog foreign key attribute.
	 *
	 * @param      Lanlog $l Lanlog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLanlog(Lanlog $l)
	{
		if ($this->collLanlogs === null) {
			$this->initLanlogs();
		}
		if (!in_array($l, $this->collLanlogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLanlogs, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Lanlogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getLanlogsJoinWorkstation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::USER_ID, $this->id);

				$this->collLanlogs = LanlogPeer::doSelectJoinWorkstation($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LanlogPeer::USER_ID, $this->id);

			if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
				$this->collLanlogs = LanlogPeer::doSelectJoinWorkstation($criteria, $con, $join_behavior);
			}
		}
		$this->lastLanlogCriteria = $criteria;

		return $this->collLanlogs;
	}

	/**
	 * Clears out the collAttachmentFiles collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAttachmentFiles()
	 */
	public function clearAttachmentFiles()
	{
		$this->collAttachmentFiles = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAttachmentFiles collection (array).
	 *
	 * By default this just sets the collAttachmentFiles collection to an empty array (like clearcollAttachmentFiles());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAttachmentFiles()
	{
		$this->collAttachmentFiles = array();
	}

	/**
	 * Gets an array of AttachmentFile objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related AttachmentFiles from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array AttachmentFile[]
	 * @throws     PropelException
	 */
	public function getAttachmentFiles($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAttachmentFiles === null) {
			if ($this->isNew()) {
			   $this->collAttachmentFiles = array();
			} else {

				$criteria->add(AttachmentFilePeer::USER_ID, $this->id);

				AttachmentFilePeer::addSelectColumns($criteria);
				$this->collAttachmentFiles = AttachmentFilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AttachmentFilePeer::USER_ID, $this->id);

				AttachmentFilePeer::addSelectColumns($criteria);
				if (!isset($this->lastAttachmentFileCriteria) || !$this->lastAttachmentFileCriteria->equals($criteria)) {
					$this->collAttachmentFiles = AttachmentFilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAttachmentFileCriteria = $criteria;
		return $this->collAttachmentFiles;
	}

	/**
	 * Returns the number of related AttachmentFile objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related AttachmentFile objects.
	 * @throws     PropelException
	 */
	public function countAttachmentFiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAttachmentFiles === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AttachmentFilePeer::USER_ID, $this->id);

				$count = AttachmentFilePeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AttachmentFilePeer::USER_ID, $this->id);

				if (!isset($this->lastAttachmentFileCriteria) || !$this->lastAttachmentFileCriteria->equals($criteria)) {
					$count = AttachmentFilePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAttachmentFiles);
				}
			} else {
				$count = count($this->collAttachmentFiles);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a AttachmentFile object to this object
	 * through the AttachmentFile foreign key attribute.
	 *
	 * @param      AttachmentFile $l AttachmentFile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAttachmentFile(AttachmentFile $l)
	{
		if ($this->collAttachmentFiles === null) {
			$this->initAttachmentFiles();
		}
		if (!in_array($l, $this->collAttachmentFiles, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAttachmentFiles, $l);
			$l->setsfGuardUser($this);
		}
	}

	/**
	 * Clears out the collsfGuardUserPermissions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardUserPermissions()
	 */
	public function clearsfGuardUserPermissions()
	{
		$this->collsfGuardUserPermissions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardUserPermissions collection (array).
	 *
	 * By default this just sets the collsfGuardUserPermissions collection to an empty array (like clearcollsfGuardUserPermissions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfGuardUserPermissions()
	{
		$this->collsfGuardUserPermissions = array();
	}

	/**
	 * Gets an array of sfGuardUserPermission objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related sfGuardUserPermissions from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfGuardUserPermission[]
	 * @throws     PropelException
	 */
	public function getsfGuardUserPermissions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
					$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;
		return $this->collsfGuardUserPermissions;
	}

	/**
	 * Returns the number of related sfGuardUserPermission objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardUserPermission objects.
	 * @throws     PropelException
	 */
	public function countsfGuardUserPermissions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				$count = sfGuardUserPermissionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
					$count = sfGuardUserPermissionPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collsfGuardUserPermissions);
				}
			} else {
				$count = count($this->collsfGuardUserPermissions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfGuardUserPermission object to this object
	 * through the sfGuardUserPermission foreign key attribute.
	 *
	 * @param      sfGuardUserPermission $l sfGuardUserPermission
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardUserPermission(sfGuardUserPermission $l)
	{
		if ($this->collsfGuardUserPermissions === null) {
			$this->initsfGuardUserPermissions();
		}
		if (!in_array($l, $this->collsfGuardUserPermissions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfGuardUserPermissions, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserPermissions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getsfGuardUserPermissionsJoinsfGuardPermission($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

			if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;

		return $this->collsfGuardUserPermissions;
	}

	/**
	 * Clears out the collsfGuardUserGroups collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardUserGroups()
	 */
	public function clearsfGuardUserGroups()
	{
		$this->collsfGuardUserGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardUserGroups collection (array).
	 *
	 * By default this just sets the collsfGuardUserGroups collection to an empty array (like clearcollsfGuardUserGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfGuardUserGroups()
	{
		$this->collsfGuardUserGroups = array();
	}

	/**
	 * Gets an array of sfGuardUserGroup objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related sfGuardUserGroups from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfGuardUserGroup[]
	 * @throws     PropelException
	 */
	public function getsfGuardUserGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
					$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;
		return $this->collsfGuardUserGroups;
	}

	/**
	 * Returns the number of related sfGuardUserGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardUserGroup objects.
	 * @throws     PropelException
	 */
	public function countsfGuardUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				$count = sfGuardUserGroupPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
					$count = sfGuardUserGroupPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collsfGuardUserGroups);
				}
			} else {
				$count = count($this->collsfGuardUserGroups);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfGuardUserGroup object to this object
	 * through the sfGuardUserGroup foreign key attribute.
	 *
	 * @param      sfGuardUserGroup $l sfGuardUserGroup
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardUserGroup(sfGuardUserGroup $l)
	{
		if ($this->collsfGuardUserGroups === null) {
			$this->initsfGuardUserGroups();
		}
		if (!in_array($l, $this->collsfGuardUserGroups, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfGuardUserGroups, $l);
			$l->setsfGuardUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getsfGuardUserGroupsJoinsfGuardGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

			if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;

		return $this->collsfGuardUserGroups;
	}

	/**
	 * Clears out the collsfGuardRememberKeys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardRememberKeys()
	 */
	public function clearsfGuardRememberKeys()
	{
		$this->collsfGuardRememberKeys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardRememberKeys collection (array).
	 *
	 * By default this just sets the collsfGuardRememberKeys collection to an empty array (like clearcollsfGuardRememberKeys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfGuardRememberKeys()
	{
		$this->collsfGuardRememberKeys = array();
	}

	/**
	 * Gets an array of sfGuardRememberKey objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously been saved, it will retrieve
	 * related sfGuardRememberKeys from storage. If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfGuardRememberKey[]
	 * @throws     PropelException
	 */
	public function getsfGuardRememberKeys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardRememberKeys === null) {
			if ($this->isNew()) {
			   $this->collsfGuardRememberKeys = array();
			} else {

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardRememberKeyCriteria) || !$this->lastsfGuardRememberKeyCriteria->equals($criteria)) {
					$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardRememberKeyCriteria = $criteria;
		return $this->collsfGuardRememberKeys;
	}

	/**
	 * Returns the number of related sfGuardRememberKey objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardRememberKey objects.
	 * @throws     PropelException
	 */
	public function countsfGuardRememberKeys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardRememberKeys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				$count = sfGuardRememberKeyPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				if (!isset($this->lastsfGuardRememberKeyCriteria) || !$this->lastsfGuardRememberKeyCriteria->equals($criteria)) {
					$count = sfGuardRememberKeyPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collsfGuardRememberKeys);
				}
			} else {
				$count = count($this->collsfGuardRememberKeys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfGuardRememberKey object to this object
	 * through the sfGuardRememberKey foreign key attribute.
	 *
	 * @param      sfGuardRememberKey $l sfGuardRememberKey
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardRememberKey(sfGuardRememberKey $l)
	{
		if ($this->collsfGuardRememberKeys === null) {
			$this->initsfGuardRememberKeys();
		}
		if (!in_array($l, $this->collsfGuardRememberKeys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfGuardRememberKeys, $l);
			$l->setsfGuardUser($this);
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
			if ($this->collRecuperationHints) {
				foreach ((array) $this->collRecuperationHints as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singlesfGuardUserProfile) {
				$this->singlesfGuardUserProfile->clearAllReferences($deep);
			}
			if ($this->collAccounts) {
				foreach ((array) $this->collAccounts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTicketEventsRelatedByUserId) {
				foreach ((array) $this->collTicketEventsRelatedByUserId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTicketEventsRelatedByAssigneeId) {
				foreach ((array) $this->collTicketEventsRelatedByAssigneeId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAppointments) {
				foreach ((array) $this->collAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEnrolments) {
				foreach ((array) $this->collEnrolments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserTeams) {
				foreach ((array) $this->collUserTeams as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWfevents) {
				foreach ((array) $this->collWfevents as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpmodules) {
				foreach ((array) $this->collWpmodules as $o) {
					$o->clearAllReferences($deep);
				}
			}
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
			if ($this->collSchoolprojects) {
				foreach ((array) $this->collSchoolprojects as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collProjDeadlines) {
				foreach ((array) $this->collProjDeadlines as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collProjResources) {
				foreach ((array) $this->collProjResources as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collProjActivitysRelatedByUserId) {
				foreach ((array) $this->collProjActivitysRelatedByUserId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collProjActivitysRelatedByAcknowledgerUserId) {
				foreach ((array) $this->collProjActivitysRelatedByAcknowledgerUserId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLanlogs) {
				foreach ((array) $this->collLanlogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAttachmentFiles) {
				foreach ((array) $this->collAttachmentFiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardUserPermissions) {
				foreach ((array) $this->collsfGuardUserPermissions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardUserGroups) {
				foreach ((array) $this->collsfGuardUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardRememberKeys) {
				foreach ((array) $this->collsfGuardRememberKeys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collRecuperationHints = null;
		$this->singlesfGuardUserProfile = null;
		$this->collAccounts = null;
		$this->collTicketEventsRelatedByUserId = null;
		$this->collTicketEventsRelatedByAssigneeId = null;
		$this->collAppointments = null;
		$this->collEnrolments = null;
		$this->collUserTeams = null;
		$this->collWfevents = null;
		$this->collWpmodules = null;
		$this->collStudentSituations = null;
		$this->collStudentSuggestions = null;
		$this->collStudentHints = null;
		$this->collStudentSyllabusItems = null;
		$this->collSchoolprojects = null;
		$this->collProjDeadlines = null;
		$this->collProjResources = null;
		$this->collProjActivitysRelatedByUserId = null;
		$this->collProjActivitysRelatedByAcknowledgerUserId = null;
		$this->collLanlogs = null;
		$this->collAttachmentFiles = null;
		$this->collsfGuardUserPermissions = null;
		$this->collsfGuardUserGroups = null;
		$this->collsfGuardRememberKeys = null;
	}

} // BasesfGuardUser
