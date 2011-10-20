<?php

/**
 * Base class that represents a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasesfGuardUserProfile extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfGuardUserProfilePeer
	 */
	protected static $peer;

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
	 * The value for the first_name field.
	 * @var        string
	 */
	protected $first_name;

	/**
	 * The value for the middle_name field.
	 * @var        string
	 */
	protected $middle_name;

	/**
	 * The value for the last_name field.
	 * @var        string
	 */
	protected $last_name;

	/**
	 * The value for the pronunciation field.
	 * @var        string
	 */
	protected $pronunciation;

	/**
	 * The value for the info field.
	 * @var        string
	 */
	protected $info;

	/**
	 * The value for the role_id field.
	 * @var        int
	 */
	protected $role_id;

	/**
	 * The value for the gender field.
	 * @var        string
	 */
	protected $gender;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the email_state field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $email_state;

	/**
	 * The value for the email_verification_code field.
	 * @var        string
	 */
	protected $email_verification_code;

	/**
	 * The value for the birthdate field.
	 * @var        string
	 */
	protected $birthdate;

	/**
	 * The value for the birthplace field.
	 * @var        string
	 */
	protected $birthplace;

	/**
	 * The value for the import_code field.
	 * @var        string
	 */
	protected $import_code;

	/**
	 * The value for the system_alerts field.
	 * @var        string
	 */
	protected $system_alerts;

	/**
	 * The value for the is_scheduled_for_deletion field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_scheduled_for_deletion;

	/**
	 * The value for the prefers_richtext field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $prefers_richtext;

	/**
	 * The value for the last_action_at field.
	 * @var        string
	 */
	protected $last_action_at;

	/**
	 * The value for the last_login_at field.
	 * @var        string
	 */
	protected $last_login_at;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        Role
	 */
	protected $aRole;

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
	
	const PEER = 'sfGuardUserProfilePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->email_state = 0;
		$this->is_scheduled_for_deletion = false;
		$this->prefers_richtext = true;
	}

	/**
	 * Initializes internal state of BasesfGuardUserProfile object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
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
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getFirstName()
	{
		return $this->first_name;
	}

	/**
	 * Get the [middle_name] column value.
	 * 
	 * @return     string
	 */
	public function getMiddleName()
	{
		return $this->middle_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getLastName()
	{
		return $this->last_name;
	}

	/**
	 * Get the [pronunciation] column value.
	 * 
	 * @return     string
	 */
	public function getPronunciation()
	{
		return $this->pronunciation;
	}

	/**
	 * Get the [info] column value.
	 * 
	 * @return     string
	 */
	public function getInfo()
	{
		return $this->info;
	}

	/**
	 * Get the [role_id] column value.
	 * 
	 * @return     int
	 */
	public function getRoleId()
	{
		return $this->role_id;
	}

	/**
	 * Get the [gender] column value.
	 * 
	 * @return     string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the [email_state] column value.
	 * 
	 * @return     int
	 */
	public function getEmailState()
	{
		return $this->email_state;
	}

	/**
	 * Get the [email_verification_code] column value.
	 * 
	 * @return     string
	 */
	public function getEmailVerificationCode()
	{
		return $this->email_verification_code;
	}

	/**
	 * Get the [optionally formatted] temporal [birthdate] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getBirthdate($format = 'Y-m-d')
	{
		if ($this->birthdate === null) {
			return null;
		}


		if ($this->birthdate === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->birthdate);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->birthdate, true), $x);
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
	 * Get the [birthplace] column value.
	 * 
	 * @return     string
	 */
	public function getBirthplace()
	{
		return $this->birthplace;
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
	 * Get the [system_alerts] column value.
	 * 
	 * @return     string
	 */
	public function getSystemAlerts()
	{
		return $this->system_alerts;
	}

	/**
	 * Get the [is_scheduled_for_deletion] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsScheduledForDeletion()
	{
		return $this->is_scheduled_for_deletion;
	}

	/**
	 * Get the [prefers_richtext] column value.
	 * 
	 * @return     boolean
	 */
	public function getPrefersRichtext()
	{
		return $this->prefers_richtext;
	}

	/**
	 * Get the [optionally formatted] temporal [last_action_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getLastActionAt($format = 'Y-m-d H:i:s')
	{
		if ($this->last_action_at === null) {
			return null;
		}


		if ($this->last_action_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_action_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_action_at, true), $x);
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
	 * Get the [optionally formatted] temporal [last_login_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getLastLoginAt($format = 'Y-m-d H:i:s')
	{
		if ($this->last_login_at === null) {
			return null;
		}


		if ($this->last_login_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_login_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login_at, true), $x);
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
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::USER_ID;
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
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::FIRST_NAME;
		}

		return $this;
	} // setFirstName()

	/**
	 * Set the value of [middle_name] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setMiddleName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->middle_name !== $v) {
			$this->middle_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::MIDDLE_NAME;
		}

		return $this;
	} // setMiddleName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::LAST_NAME;
		}

		return $this;
	} // setLastName()

	/**
	 * Set the value of [pronunciation] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setPronunciation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pronunciation !== $v) {
			$this->pronunciation = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::PRONUNCIATION;
		}

		return $this;
	} // setPronunciation()

	/**
	 * Set the value of [info] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setInfo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->info !== $v) {
			$this->info = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::INFO;
		}

		return $this;
	} // setInfo()

	/**
	 * Set the value of [role_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setRoleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->role_id !== $v) {
			$this->role_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::ROLE_ID;
		}

		if ($this->aRole !== null && $this->aRole->getId() !== $v) {
			$this->aRole = null;
		}

		return $this;
	} // setRoleId()

	/**
	 * Set the value of [gender] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setGender($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::GENDER;
		}

		return $this;
	} // setGender()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [email_state] column.
	 * 
	 * @param      int $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setEmailState($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->email_state !== $v || $this->isNew()) {
			$this->email_state = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL_STATE;
		}

		return $this;
	} // setEmailState()

	/**
	 * Set the value of [email_verification_code] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setEmailVerificationCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email_verification_code !== $v) {
			$this->email_verification_code = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE;
		}

		return $this;
	} // setEmailVerificationCode()

	/**
	 * Sets the value of [birthdate] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setBirthdate($v)
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

		if ( $this->birthdate !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->birthdate !== null && $tmpDt = new DateTime($this->birthdate)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->birthdate = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = sfGuardUserProfilePeer::BIRTHDATE;
			}
		} // if either are not null

		return $this;
	} // setBirthdate()

	/**
	 * Set the value of [birthplace] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setBirthplace($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->birthplace !== $v) {
			$this->birthplace = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::BIRTHPLACE;
		}

		return $this;
	} // setBirthplace()

	/**
	 * Set the value of [import_code] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setImportCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->import_code !== $v) {
			$this->import_code = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::IMPORT_CODE;
		}

		return $this;
	} // setImportCode()

	/**
	 * Set the value of [system_alerts] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setSystemAlerts($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->system_alerts !== $v) {
			$this->system_alerts = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::SYSTEM_ALERTS;
		}

		return $this;
	} // setSystemAlerts()

	/**
	 * Set the value of [is_scheduled_for_deletion] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setIsScheduledForDeletion($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_scheduled_for_deletion !== $v || $this->isNew()) {
			$this->is_scheduled_for_deletion = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::IS_SCHEDULED_FOR_DELETION;
		}

		return $this;
	} // setIsScheduledForDeletion()

	/**
	 * Set the value of [prefers_richtext] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setPrefersRichtext($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->prefers_richtext !== $v || $this->isNew()) {
			$this->prefers_richtext = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::PREFERS_RICHTEXT;
		}

		return $this;
	} // setPrefersRichtext()

	/**
	 * Sets the value of [last_action_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setLastActionAt($v)
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

		if ( $this->last_action_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->last_action_at !== null && $tmpDt = new DateTime($this->last_action_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->last_action_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = sfGuardUserProfilePeer::LAST_ACTION_AT;
			}
		} // if either are not null

		return $this;
	} // setLastActionAt()

	/**
	 * Sets the value of [last_login_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 */
	public function setLastLoginAt($v)
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

		if ( $this->last_login_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->last_login_at !== null && $tmpDt = new DateTime($this->last_login_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->last_login_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = sfGuardUserProfilePeer::LAST_LOGIN_AT;
			}
		} // if either are not null

		return $this;
	} // setLastLoginAt()

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
			if ($this->email_state !== 0) {
				return false;
			}

			if ($this->is_scheduled_for_deletion !== false) {
				return false;
			}

			if ($this->prefers_richtext !== true) {
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

			$this->user_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->first_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->middle_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->last_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->pronunciation = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->info = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->role_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->gender = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->email = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->email_state = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->email_verification_code = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->birthdate = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->birthplace = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->import_code = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->system_alerts = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->is_scheduled_for_deletion = ($row[$startcol + 16] !== null) ? (boolean) $row[$startcol + 16] : null;
			$this->prefers_richtext = ($row[$startcol + 17] !== null) ? (boolean) $row[$startcol + 17] : null;
			$this->last_action_at = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->last_login_at = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 20; // 20 = sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUserProfile object", $e);
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
		if ($this->aRole !== null && $this->role_id !== $this->aRole->getId()) {
			$this->aRole = null;
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = sfGuardUserProfilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfGuardUser = null;
			$this->aRole = null;
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				sfGuardUserProfilePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				sfGuardUserProfilePeer::addInstanceToPool($this);
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

			if ($this->aRole !== null) {
				if ($this->aRole->isModified() || $this->aRole->isNew()) {
					$affectedRows += $this->aRole->save($con);
				}
				$this->setRole($this->aRole);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserProfilePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserProfilePeer::doUpdate($this, $con);
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

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aRole !== null) {
				if (!$this->aRole->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRole->getValidationFailures());
				}
			}


			if (($retval = sfGuardUserProfilePeer::doValidate($this, $columns)) !== true) {
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
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getMiddleName();
				break;
			case 4:
				return $this->getLastName();
				break;
			case 5:
				return $this->getPronunciation();
				break;
			case 6:
				return $this->getInfo();
				break;
			case 7:
				return $this->getRoleId();
				break;
			case 8:
				return $this->getGender();
				break;
			case 9:
				return $this->getEmail();
				break;
			case 10:
				return $this->getEmailState();
				break;
			case 11:
				return $this->getEmailVerificationCode();
				break;
			case 12:
				return $this->getBirthdate();
				break;
			case 13:
				return $this->getBirthplace();
				break;
			case 14:
				return $this->getImportCode();
				break;
			case 15:
				return $this->getSystemAlerts();
				break;
			case 16:
				return $this->getIsScheduledForDeletion();
				break;
			case 17:
				return $this->getPrefersRichtext();
				break;
			case 18:
				return $this->getLastActionAt();
				break;
			case 19:
				return $this->getLastLoginAt();
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
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getMiddleName(),
			$keys[4] => $this->getLastName(),
			$keys[5] => $this->getPronunciation(),
			$keys[6] => $this->getInfo(),
			$keys[7] => $this->getRoleId(),
			$keys[8] => $this->getGender(),
			$keys[9] => $this->getEmail(),
			$keys[10] => $this->getEmailState(),
			$keys[11] => $this->getEmailVerificationCode(),
			$keys[12] => $this->getBirthdate(),
			$keys[13] => $this->getBirthplace(),
			$keys[14] => $this->getImportCode(),
			$keys[15] => $this->getSystemAlerts(),
			$keys[16] => $this->getIsScheduledForDeletion(),
			$keys[17] => $this->getPrefersRichtext(),
			$keys[18] => $this->getLastActionAt(),
			$keys[19] => $this->getLastLoginAt(),
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
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUserId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setMiddleName($value);
				break;
			case 4:
				$this->setLastName($value);
				break;
			case 5:
				$this->setPronunciation($value);
				break;
			case 6:
				$this->setInfo($value);
				break;
			case 7:
				$this->setRoleId($value);
				break;
			case 8:
				$this->setGender($value);
				break;
			case 9:
				$this->setEmail($value);
				break;
			case 10:
				$this->setEmailState($value);
				break;
			case 11:
				$this->setEmailVerificationCode($value);
				break;
			case 12:
				$this->setBirthdate($value);
				break;
			case 13:
				$this->setBirthplace($value);
				break;
			case 14:
				$this->setImportCode($value);
				break;
			case 15:
				$this->setSystemAlerts($value);
				break;
			case 16:
				$this->setIsScheduledForDeletion($value);
				break;
			case 17:
				$this->setPrefersRichtext($value);
				break;
			case 18:
				$this->setLastActionAt($value);
				break;
			case 19:
				$this->setLastLoginAt($value);
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
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMiddleName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPronunciation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setInfo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRoleId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setGender($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEmail($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEmailState($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEmailVerificationCode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setBirthdate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setBirthplace($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setImportCode($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setSystemAlerts($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setIsScheduledForDeletion($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setPrefersRichtext($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setLastActionAt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setLastLoginAt($arr[$keys[19]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserProfilePeer::USER_ID)) $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::TITLE)) $criteria->add(sfGuardUserProfilePeer::TITLE, $this->title);
		if ($this->isColumnModified(sfGuardUserProfilePeer::FIRST_NAME)) $criteria->add(sfGuardUserProfilePeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::MIDDLE_NAME)) $criteria->add(sfGuardUserProfilePeer::MIDDLE_NAME, $this->middle_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::LAST_NAME)) $criteria->add(sfGuardUserProfilePeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::PRONUNCIATION)) $criteria->add(sfGuardUserProfilePeer::PRONUNCIATION, $this->pronunciation);
		if ($this->isColumnModified(sfGuardUserProfilePeer::INFO)) $criteria->add(sfGuardUserProfilePeer::INFO, $this->info);
		if ($this->isColumnModified(sfGuardUserProfilePeer::ROLE_ID)) $criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->role_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::GENDER)) $criteria->add(sfGuardUserProfilePeer::GENDER, $this->gender);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL)) $criteria->add(sfGuardUserProfilePeer::EMAIL, $this->email);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL_STATE)) $criteria->add(sfGuardUserProfilePeer::EMAIL_STATE, $this->email_state);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE)) $criteria->add(sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE, $this->email_verification_code);
		if ($this->isColumnModified(sfGuardUserProfilePeer::BIRTHDATE)) $criteria->add(sfGuardUserProfilePeer::BIRTHDATE, $this->birthdate);
		if ($this->isColumnModified(sfGuardUserProfilePeer::BIRTHPLACE)) $criteria->add(sfGuardUserProfilePeer::BIRTHPLACE, $this->birthplace);
		if ($this->isColumnModified(sfGuardUserProfilePeer::IMPORT_CODE)) $criteria->add(sfGuardUserProfilePeer::IMPORT_CODE, $this->import_code);
		if ($this->isColumnModified(sfGuardUserProfilePeer::SYSTEM_ALERTS)) $criteria->add(sfGuardUserProfilePeer::SYSTEM_ALERTS, $this->system_alerts);
		if ($this->isColumnModified(sfGuardUserProfilePeer::IS_SCHEDULED_FOR_DELETION)) $criteria->add(sfGuardUserProfilePeer::IS_SCHEDULED_FOR_DELETION, $this->is_scheduled_for_deletion);
		if ($this->isColumnModified(sfGuardUserProfilePeer::PREFERS_RICHTEXT)) $criteria->add(sfGuardUserProfilePeer::PREFERS_RICHTEXT, $this->prefers_richtext);
		if ($this->isColumnModified(sfGuardUserProfilePeer::LAST_ACTION_AT)) $criteria->add(sfGuardUserProfilePeer::LAST_ACTION_AT, $this->last_action_at);
		if ($this->isColumnModified(sfGuardUserProfilePeer::LAST_LOGIN_AT)) $criteria->add(sfGuardUserProfilePeer::LAST_LOGIN_AT, $this->last_login_at);

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
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getUserId();
	}

	/**
	 * Generic method to set the primary key (user_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setUserId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of sfGuardUserProfile (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setTitle($this->title);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setMiddleName($this->middle_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setPronunciation($this->pronunciation);

		$copyObj->setInfo($this->info);

		$copyObj->setRoleId($this->role_id);

		$copyObj->setGender($this->gender);

		$copyObj->setEmail($this->email);

		$copyObj->setEmailState($this->email_state);

		$copyObj->setEmailVerificationCode($this->email_verification_code);

		$copyObj->setBirthdate($this->birthdate);

		$copyObj->setBirthplace($this->birthplace);

		$copyObj->setImportCode($this->import_code);

		$copyObj->setSystemAlerts($this->system_alerts);

		$copyObj->setIsScheduledForDeletion($this->is_scheduled_for_deletion);

		$copyObj->setPrefersRichtext($this->prefers_richtext);

		$copyObj->setLastActionAt($this->last_action_at);

		$copyObj->setLastLoginAt($this->last_login_at);


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
	 * @return     sfGuardUserProfile Clone of current object.
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
	 * @return     sfGuardUserProfilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfGuardUserProfilePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     sfGuardUserProfile The current object (for fluent API support)
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

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setsfGuardUserProfile($this);
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
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->asfGuardUser->setsfGuardUserProfile($this);
		}
		return $this->asfGuardUser;
	}

	/**
	 * Declares an association between this object and a Role object.
	 *
	 * @param      Role $v
	 * @return     sfGuardUserProfile The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRole(Role $v = null)
	{
		if ($v === null) {
			$this->setRoleId(NULL);
		} else {
			$this->setRoleId($v->getId());
		}

		$this->aRole = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Role object, it will not be re-added.
		if ($v !== null) {
			$v->addsfGuardUserProfile($this);
		}

		return $this;
	}


	/**
	 * Get the associated Role object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Role The associated Role object.
	 * @throws     PropelException
	 */
	public function getRole(PropelPDO $con = null)
	{
		if ($this->aRole === null && ($this->role_id !== null)) {
			$this->aRole = RolePeer::retrieveByPk($this->role_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aRole->addsfGuardUserProfiles($this);
			 */
		}
		return $this->aRole;
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

			$this->asfGuardUser = null;
			$this->aRole = null;
	}

} // BasesfGuardUserProfile
