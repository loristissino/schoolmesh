<?php

/**
 * Base class that represents a row from the 'docrevision' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseDocrevision extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DocrevisionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the document_id field.
	 * @var        int
	 */
	protected $document_id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the revision_number field.
	 * @var        int
	 */
	protected $revision_number;

	/**
	 * The value for the revisioned_at field.
	 * @var        string
	 */
	protected $revisioned_at;

	/**
	 * The value for the uploader_id field.
	 * @var        int
	 */
	protected $uploader_id;

	/**
	 * The value for the revisioner_id field.
	 * @var        int
	 */
	protected $revisioner_id;

	/**
	 * The value for the approved_at field.
	 * @var        string
	 */
	protected $approved_at;

	/**
	 * The value for the approver_id field.
	 * @var        int
	 */
	protected $approver_id;

	/**
	 * The value for the revision_grounds field.
	 * @var        string
	 */
	protected $revision_grounds;

	/**
	 * The value for the content field.
	 * @var        string
	 */
	protected $content;

	/**
	 * The value for the content_type field.
	 * @var        int
	 */
	protected $content_type;

	/**
	 * The value for the source_attachment_id field.
	 * @var        int
	 */
	protected $source_attachment_id;

	/**
	 * The value for the published_attachment_id field.
	 * @var        int
	 */
	protected $published_attachment_id;

	/**
	 * @var        Document
	 */
	protected $aDocument;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUserRelatedByUploaderId;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUserRelatedByRevisionerId;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUserRelatedByApproverId;

	/**
	 * @var        AttachmentFile
	 */
	protected $aAttachmentFileRelatedBySourceAttachmentId;

	/**
	 * @var        AttachmentFile
	 */
	protected $aAttachmentFileRelatedByPublishedAttachmentId;

	/**
	 * @var        array Document[] Collection to store aggregation of Document objects.
	 */
	protected $collDocuments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collDocuments.
	 */
	private $lastDocumentCriteria = null;

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
	
	const PEER = 'DocrevisionPeer';

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
	 * Get the [document_id] column value.
	 * 
	 * @return     int
	 */
	public function getDocumentId()
	{
		return $this->document_id;
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
	 * Get the [revision_number] column value.
	 * 
	 * @return     int
	 */
	public function getRevisionNumber()
	{
		return $this->revision_number;
	}

	/**
	 * Get the [optionally formatted] temporal [revisioned_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getRevisionedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->revisioned_at === null) {
			return null;
		}


		if ($this->revisioned_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->revisioned_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->revisioned_at, true), $x);
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
	 * Get the [uploader_id] column value.
	 * 
	 * @return     int
	 */
	public function getUploaderId()
	{
		return $this->uploader_id;
	}

	/**
	 * Get the [revisioner_id] column value.
	 * 
	 * @return     int
	 */
	public function getRevisionerId()
	{
		return $this->revisioner_id;
	}

	/**
	 * Get the [optionally formatted] temporal [approved_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getApprovedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->approved_at === null) {
			return null;
		}


		if ($this->approved_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->approved_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->approved_at, true), $x);
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
	 * Get the [approver_id] column value.
	 * 
	 * @return     int
	 */
	public function getApproverId()
	{
		return $this->approver_id;
	}

	/**
	 * Get the [revision_grounds] column value.
	 * 
	 * @return     string
	 */
	public function getRevisionGrounds()
	{
		return $this->revision_grounds;
	}

	/**
	 * Get the [content] column value.
	 * 
	 * @return     string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Get the [content_type] column value.
	 * 
	 * @return     int
	 */
	public function getContentType()
	{
		return $this->content_type;
	}

	/**
	 * Get the [source_attachment_id] column value.
	 * 
	 * @return     int
	 */
	public function getSourceAttachmentId()
	{
		return $this->source_attachment_id;
	}

	/**
	 * Get the [published_attachment_id] column value.
	 * 
	 * @return     int
	 */
	public function getPublishedAttachmentId()
	{
		return $this->published_attachment_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [document_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setDocumentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->document_id !== $v) {
			$this->document_id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::DOCUMENT_ID;
		}

		if ($this->aDocument !== null && $this->aDocument->getId() !== $v) {
			$this->aDocument = null;
		}

		return $this;
	} // setDocumentId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = DocrevisionPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [revision_number] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setRevisionNumber($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->revision_number !== $v) {
			$this->revision_number = $v;
			$this->modifiedColumns[] = DocrevisionPeer::REVISION_NUMBER;
		}

		return $this;
	} // setRevisionNumber()

	/**
	 * Sets the value of [revisioned_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setRevisionedAt($v)
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

		if ( $this->revisioned_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->revisioned_at !== null && $tmpDt = new DateTime($this->revisioned_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->revisioned_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = DocrevisionPeer::REVISIONED_AT;
			}
		} // if either are not null

		return $this;
	} // setRevisionedAt()

	/**
	 * Set the value of [uploader_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setUploaderId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->uploader_id !== $v) {
			$this->uploader_id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::UPLOADER_ID;
		}

		if ($this->asfGuardUserRelatedByUploaderId !== null && $this->asfGuardUserRelatedByUploaderId->getId() !== $v) {
			$this->asfGuardUserRelatedByUploaderId = null;
		}

		return $this;
	} // setUploaderId()

	/**
	 * Set the value of [revisioner_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setRevisionerId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->revisioner_id !== $v) {
			$this->revisioner_id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::REVISIONER_ID;
		}

		if ($this->asfGuardUserRelatedByRevisionerId !== null && $this->asfGuardUserRelatedByRevisionerId->getId() !== $v) {
			$this->asfGuardUserRelatedByRevisionerId = null;
		}

		return $this;
	} // setRevisionerId()

	/**
	 * Sets the value of [approved_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setApprovedAt($v)
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

		if ( $this->approved_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->approved_at !== null && $tmpDt = new DateTime($this->approved_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->approved_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = DocrevisionPeer::APPROVED_AT;
			}
		} // if either are not null

		return $this;
	} // setApprovedAt()

	/**
	 * Set the value of [approver_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setApproverId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->approver_id !== $v) {
			$this->approver_id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::APPROVER_ID;
		}

		if ($this->asfGuardUserRelatedByApproverId !== null && $this->asfGuardUserRelatedByApproverId->getId() !== $v) {
			$this->asfGuardUserRelatedByApproverId = null;
		}

		return $this;
	} // setApproverId()

	/**
	 * Set the value of [revision_grounds] column.
	 * 
	 * @param      string $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setRevisionGrounds($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->revision_grounds !== $v) {
			$this->revision_grounds = $v;
			$this->modifiedColumns[] = DocrevisionPeer::REVISION_GROUNDS;
		}

		return $this;
	} // setRevisionGrounds()

	/**
	 * Set the value of [content] column.
	 * 
	 * @param      string $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = DocrevisionPeer::CONTENT;
		}

		return $this;
	} // setContent()

	/**
	 * Set the value of [content_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setContentType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->content_type !== $v) {
			$this->content_type = $v;
			$this->modifiedColumns[] = DocrevisionPeer::CONTENT_TYPE;
		}

		return $this;
	} // setContentType()

	/**
	 * Set the value of [source_attachment_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setSourceAttachmentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->source_attachment_id !== $v) {
			$this->source_attachment_id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::SOURCE_ATTACHMENT_ID;
		}

		if ($this->aAttachmentFileRelatedBySourceAttachmentId !== null && $this->aAttachmentFileRelatedBySourceAttachmentId->getId() !== $v) {
			$this->aAttachmentFileRelatedBySourceAttachmentId = null;
		}

		return $this;
	} // setSourceAttachmentId()

	/**
	 * Set the value of [published_attachment_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Docrevision The current object (for fluent API support)
	 */
	public function setPublishedAttachmentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->published_attachment_id !== $v) {
			$this->published_attachment_id = $v;
			$this->modifiedColumns[] = DocrevisionPeer::PUBLISHED_ATTACHMENT_ID;
		}

		if ($this->aAttachmentFileRelatedByPublishedAttachmentId !== null && $this->aAttachmentFileRelatedByPublishedAttachmentId->getId() !== $v) {
			$this->aAttachmentFileRelatedByPublishedAttachmentId = null;
		}

		return $this;
	} // setPublishedAttachmentId()

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
			$this->document_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->revision_number = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->revisioned_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->uploader_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->revisioner_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->approved_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->approver_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->revision_grounds = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->content = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->content_type = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->source_attachment_id = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->published_attachment_id = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = DocrevisionPeer::NUM_COLUMNS - DocrevisionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Docrevision object", $e);
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

		if ($this->aDocument !== null && $this->document_id !== $this->aDocument->getId()) {
			$this->aDocument = null;
		}
		if ($this->asfGuardUserRelatedByUploaderId !== null && $this->uploader_id !== $this->asfGuardUserRelatedByUploaderId->getId()) {
			$this->asfGuardUserRelatedByUploaderId = null;
		}
		if ($this->asfGuardUserRelatedByRevisionerId !== null && $this->revisioner_id !== $this->asfGuardUserRelatedByRevisionerId->getId()) {
			$this->asfGuardUserRelatedByRevisionerId = null;
		}
		if ($this->asfGuardUserRelatedByApproverId !== null && $this->approver_id !== $this->asfGuardUserRelatedByApproverId->getId()) {
			$this->asfGuardUserRelatedByApproverId = null;
		}
		if ($this->aAttachmentFileRelatedBySourceAttachmentId !== null && $this->source_attachment_id !== $this->aAttachmentFileRelatedBySourceAttachmentId->getId()) {
			$this->aAttachmentFileRelatedBySourceAttachmentId = null;
		}
		if ($this->aAttachmentFileRelatedByPublishedAttachmentId !== null && $this->published_attachment_id !== $this->aAttachmentFileRelatedByPublishedAttachmentId->getId()) {
			$this->aAttachmentFileRelatedByPublishedAttachmentId = null;
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
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = DocrevisionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aDocument = null;
			$this->asfGuardUserRelatedByUploaderId = null;
			$this->asfGuardUserRelatedByRevisionerId = null;
			$this->asfGuardUserRelatedByApproverId = null;
			$this->aAttachmentFileRelatedBySourceAttachmentId = null;
			$this->aAttachmentFileRelatedByPublishedAttachmentId = null;
			$this->collDocuments = null;
			$this->lastDocumentCriteria = null;

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
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				DocrevisionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DocrevisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				DocrevisionPeer::addInstanceToPool($this);
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

			if ($this->aDocument !== null) {
				if ($this->aDocument->isModified() || $this->aDocument->isNew()) {
					$affectedRows += $this->aDocument->save($con);
				}
				$this->setDocument($this->aDocument);
			}

			if ($this->asfGuardUserRelatedByUploaderId !== null) {
				if ($this->asfGuardUserRelatedByUploaderId->isModified() || $this->asfGuardUserRelatedByUploaderId->isNew()) {
					$affectedRows += $this->asfGuardUserRelatedByUploaderId->save($con);
				}
				$this->setsfGuardUserRelatedByUploaderId($this->asfGuardUserRelatedByUploaderId);
			}

			if ($this->asfGuardUserRelatedByRevisionerId !== null) {
				if ($this->asfGuardUserRelatedByRevisionerId->isModified() || $this->asfGuardUserRelatedByRevisionerId->isNew()) {
					$affectedRows += $this->asfGuardUserRelatedByRevisionerId->save($con);
				}
				$this->setsfGuardUserRelatedByRevisionerId($this->asfGuardUserRelatedByRevisionerId);
			}

			if ($this->asfGuardUserRelatedByApproverId !== null) {
				if ($this->asfGuardUserRelatedByApproverId->isModified() || $this->asfGuardUserRelatedByApproverId->isNew()) {
					$affectedRows += $this->asfGuardUserRelatedByApproverId->save($con);
				}
				$this->setsfGuardUserRelatedByApproverId($this->asfGuardUserRelatedByApproverId);
			}

			if ($this->aAttachmentFileRelatedBySourceAttachmentId !== null) {
				if ($this->aAttachmentFileRelatedBySourceAttachmentId->isModified() || $this->aAttachmentFileRelatedBySourceAttachmentId->isNew()) {
					$affectedRows += $this->aAttachmentFileRelatedBySourceAttachmentId->save($con);
				}
				$this->setAttachmentFileRelatedBySourceAttachmentId($this->aAttachmentFileRelatedBySourceAttachmentId);
			}

			if ($this->aAttachmentFileRelatedByPublishedAttachmentId !== null) {
				if ($this->aAttachmentFileRelatedByPublishedAttachmentId->isModified() || $this->aAttachmentFileRelatedByPublishedAttachmentId->isNew()) {
					$affectedRows += $this->aAttachmentFileRelatedByPublishedAttachmentId->save($con);
				}
				$this->setAttachmentFileRelatedByPublishedAttachmentId($this->aAttachmentFileRelatedByPublishedAttachmentId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = DocrevisionPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DocrevisionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DocrevisionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDocuments !== null) {
				foreach ($this->collDocuments as $referrerFK) {
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

			if ($this->aDocument !== null) {
				if (!$this->aDocument->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDocument->getValidationFailures());
				}
			}

			if ($this->asfGuardUserRelatedByUploaderId !== null) {
				if (!$this->asfGuardUserRelatedByUploaderId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserRelatedByUploaderId->getValidationFailures());
				}
			}

			if ($this->asfGuardUserRelatedByRevisionerId !== null) {
				if (!$this->asfGuardUserRelatedByRevisionerId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserRelatedByRevisionerId->getValidationFailures());
				}
			}

			if ($this->asfGuardUserRelatedByApproverId !== null) {
				if (!$this->asfGuardUserRelatedByApproverId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserRelatedByApproverId->getValidationFailures());
				}
			}

			if ($this->aAttachmentFileRelatedBySourceAttachmentId !== null) {
				if (!$this->aAttachmentFileRelatedBySourceAttachmentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAttachmentFileRelatedBySourceAttachmentId->getValidationFailures());
				}
			}

			if ($this->aAttachmentFileRelatedByPublishedAttachmentId !== null) {
				if (!$this->aAttachmentFileRelatedByPublishedAttachmentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAttachmentFileRelatedByPublishedAttachmentId->getValidationFailures());
				}
			}


			if (($retval = DocrevisionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDocuments !== null) {
					foreach ($this->collDocuments as $referrerFK) {
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
		$pos = DocrevisionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDocumentId();
				break;
			case 2:
				return $this->getTitle();
				break;
			case 3:
				return $this->getRevisionNumber();
				break;
			case 4:
				return $this->getRevisionedAt();
				break;
			case 5:
				return $this->getUploaderId();
				break;
			case 6:
				return $this->getRevisionerId();
				break;
			case 7:
				return $this->getApprovedAt();
				break;
			case 8:
				return $this->getApproverId();
				break;
			case 9:
				return $this->getRevisionGrounds();
				break;
			case 10:
				return $this->getContent();
				break;
			case 11:
				return $this->getContentType();
				break;
			case 12:
				return $this->getSourceAttachmentId();
				break;
			case 13:
				return $this->getPublishedAttachmentId();
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
		$keys = DocrevisionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDocumentId(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getRevisionNumber(),
			$keys[4] => $this->getRevisionedAt(),
			$keys[5] => $this->getUploaderId(),
			$keys[6] => $this->getRevisionerId(),
			$keys[7] => $this->getApprovedAt(),
			$keys[8] => $this->getApproverId(),
			$keys[9] => $this->getRevisionGrounds(),
			$keys[10] => $this->getContent(),
			$keys[11] => $this->getContentType(),
			$keys[12] => $this->getSourceAttachmentId(),
			$keys[13] => $this->getPublishedAttachmentId(),
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
		$pos = DocrevisionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDocumentId($value);
				break;
			case 2:
				$this->setTitle($value);
				break;
			case 3:
				$this->setRevisionNumber($value);
				break;
			case 4:
				$this->setRevisionedAt($value);
				break;
			case 5:
				$this->setUploaderId($value);
				break;
			case 6:
				$this->setRevisionerId($value);
				break;
			case 7:
				$this->setApprovedAt($value);
				break;
			case 8:
				$this->setApproverId($value);
				break;
			case 9:
				$this->setRevisionGrounds($value);
				break;
			case 10:
				$this->setContent($value);
				break;
			case 11:
				$this->setContentType($value);
				break;
			case 12:
				$this->setSourceAttachmentId($value);
				break;
			case 13:
				$this->setPublishedAttachmentId($value);
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
		$keys = DocrevisionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDocumentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRevisionNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRevisionedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUploaderId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRevisionerId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setApprovedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setApproverId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setRevisionGrounds($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setContent($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setContentType($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setSourceAttachmentId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPublishedAttachmentId($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);

		if ($this->isColumnModified(DocrevisionPeer::ID)) $criteria->add(DocrevisionPeer::ID, $this->id);
		if ($this->isColumnModified(DocrevisionPeer::DOCUMENT_ID)) $criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->document_id);
		if ($this->isColumnModified(DocrevisionPeer::TITLE)) $criteria->add(DocrevisionPeer::TITLE, $this->title);
		if ($this->isColumnModified(DocrevisionPeer::REVISION_NUMBER)) $criteria->add(DocrevisionPeer::REVISION_NUMBER, $this->revision_number);
		if ($this->isColumnModified(DocrevisionPeer::REVISIONED_AT)) $criteria->add(DocrevisionPeer::REVISIONED_AT, $this->revisioned_at);
		if ($this->isColumnModified(DocrevisionPeer::UPLOADER_ID)) $criteria->add(DocrevisionPeer::UPLOADER_ID, $this->uploader_id);
		if ($this->isColumnModified(DocrevisionPeer::REVISIONER_ID)) $criteria->add(DocrevisionPeer::REVISIONER_ID, $this->revisioner_id);
		if ($this->isColumnModified(DocrevisionPeer::APPROVED_AT)) $criteria->add(DocrevisionPeer::APPROVED_AT, $this->approved_at);
		if ($this->isColumnModified(DocrevisionPeer::APPROVER_ID)) $criteria->add(DocrevisionPeer::APPROVER_ID, $this->approver_id);
		if ($this->isColumnModified(DocrevisionPeer::REVISION_GROUNDS)) $criteria->add(DocrevisionPeer::REVISION_GROUNDS, $this->revision_grounds);
		if ($this->isColumnModified(DocrevisionPeer::CONTENT)) $criteria->add(DocrevisionPeer::CONTENT, $this->content);
		if ($this->isColumnModified(DocrevisionPeer::CONTENT_TYPE)) $criteria->add(DocrevisionPeer::CONTENT_TYPE, $this->content_type);
		if ($this->isColumnModified(DocrevisionPeer::SOURCE_ATTACHMENT_ID)) $criteria->add(DocrevisionPeer::SOURCE_ATTACHMENT_ID, $this->source_attachment_id);
		if ($this->isColumnModified(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID)) $criteria->add(DocrevisionPeer::PUBLISHED_ATTACHMENT_ID, $this->published_attachment_id);

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
		$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);

		$criteria->add(DocrevisionPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Docrevision (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDocumentId($this->document_id);

		$copyObj->setTitle($this->title);

		$copyObj->setRevisionNumber($this->revision_number);

		$copyObj->setRevisionedAt($this->revisioned_at);

		$copyObj->setUploaderId($this->uploader_id);

		$copyObj->setRevisionerId($this->revisioner_id);

		$copyObj->setApprovedAt($this->approved_at);

		$copyObj->setApproverId($this->approver_id);

		$copyObj->setRevisionGrounds($this->revision_grounds);

		$copyObj->setContent($this->content);

		$copyObj->setContentType($this->content_type);

		$copyObj->setSourceAttachmentId($this->source_attachment_id);

		$copyObj->setPublishedAttachmentId($this->published_attachment_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getDocuments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDocument($relObj->copy($deepCopy));
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
	 * @return     Docrevision Clone of current object.
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
	 * @return     DocrevisionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DocrevisionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Document object.
	 *
	 * @param      Document $v
	 * @return     Docrevision The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDocument(Document $v = null)
	{
		if ($v === null) {
			$this->setDocumentId(NULL);
		} else {
			$this->setDocumentId($v->getId());
		}

		$this->aDocument = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Document object, it will not be re-added.
		if ($v !== null) {
			$v->addDocrevision($this);
		}

		return $this;
	}


	/**
	 * Get the associated Document object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Document The associated Document object.
	 * @throws     PropelException
	 */
	public function getDocument(PropelPDO $con = null)
	{
		if ($this->aDocument === null && ($this->document_id !== null)) {
			$this->aDocument = DocumentPeer::retrieveByPk($this->document_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aDocument->addDocrevisions($this);
			 */
		}
		return $this->aDocument;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Docrevision The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUserRelatedByUploaderId(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUploaderId(NULL);
		} else {
			$this->setUploaderId($v->getId());
		}

		$this->asfGuardUserRelatedByUploaderId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addDocrevisionRelatedByUploaderId($this);
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
	public function getsfGuardUserRelatedByUploaderId(PropelPDO $con = null)
	{
		if ($this->asfGuardUserRelatedByUploaderId === null && ($this->uploader_id !== null)) {
			$this->asfGuardUserRelatedByUploaderId = sfGuardUserPeer::retrieveByPk($this->uploader_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfGuardUserRelatedByUploaderId->addDocrevisionsRelatedByUploaderId($this);
			 */
		}
		return $this->asfGuardUserRelatedByUploaderId;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Docrevision The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUserRelatedByRevisionerId(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setRevisionerId(NULL);
		} else {
			$this->setRevisionerId($v->getId());
		}

		$this->asfGuardUserRelatedByRevisionerId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addDocrevisionRelatedByRevisionerId($this);
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
	public function getsfGuardUserRelatedByRevisionerId(PropelPDO $con = null)
	{
		if ($this->asfGuardUserRelatedByRevisionerId === null && ($this->revisioner_id !== null)) {
			$this->asfGuardUserRelatedByRevisionerId = sfGuardUserPeer::retrieveByPk($this->revisioner_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfGuardUserRelatedByRevisionerId->addDocrevisionsRelatedByRevisionerId($this);
			 */
		}
		return $this->asfGuardUserRelatedByRevisionerId;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Docrevision The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUserRelatedByApproverId(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setApproverId(NULL);
		} else {
			$this->setApproverId($v->getId());
		}

		$this->asfGuardUserRelatedByApproverId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addDocrevisionRelatedByApproverId($this);
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
	public function getsfGuardUserRelatedByApproverId(PropelPDO $con = null)
	{
		if ($this->asfGuardUserRelatedByApproverId === null && ($this->approver_id !== null)) {
			$this->asfGuardUserRelatedByApproverId = sfGuardUserPeer::retrieveByPk($this->approver_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfGuardUserRelatedByApproverId->addDocrevisionsRelatedByApproverId($this);
			 */
		}
		return $this->asfGuardUserRelatedByApproverId;
	}

	/**
	 * Declares an association between this object and a AttachmentFile object.
	 *
	 * @param      AttachmentFile $v
	 * @return     Docrevision The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAttachmentFileRelatedBySourceAttachmentId(AttachmentFile $v = null)
	{
		if ($v === null) {
			$this->setSourceAttachmentId(NULL);
		} else {
			$this->setSourceAttachmentId($v->getId());
		}

		$this->aAttachmentFileRelatedBySourceAttachmentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the AttachmentFile object, it will not be re-added.
		if ($v !== null) {
			$v->addDocrevisionRelatedBySourceAttachmentId($this);
		}

		return $this;
	}


	/**
	 * Get the associated AttachmentFile object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     AttachmentFile The associated AttachmentFile object.
	 * @throws     PropelException
	 */
	public function getAttachmentFileRelatedBySourceAttachmentId(PropelPDO $con = null)
	{
		if ($this->aAttachmentFileRelatedBySourceAttachmentId === null && ($this->source_attachment_id !== null)) {
			$this->aAttachmentFileRelatedBySourceAttachmentId = AttachmentFilePeer::retrieveByPk($this->source_attachment_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAttachmentFileRelatedBySourceAttachmentId->addDocrevisionsRelatedBySourceAttachmentId($this);
			 */
		}
		return $this->aAttachmentFileRelatedBySourceAttachmentId;
	}

	/**
	 * Declares an association between this object and a AttachmentFile object.
	 *
	 * @param      AttachmentFile $v
	 * @return     Docrevision The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAttachmentFileRelatedByPublishedAttachmentId(AttachmentFile $v = null)
	{
		if ($v === null) {
			$this->setPublishedAttachmentId(NULL);
		} else {
			$this->setPublishedAttachmentId($v->getId());
		}

		$this->aAttachmentFileRelatedByPublishedAttachmentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the AttachmentFile object, it will not be re-added.
		if ($v !== null) {
			$v->addDocrevisionRelatedByPublishedAttachmentId($this);
		}

		return $this;
	}


	/**
	 * Get the associated AttachmentFile object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     AttachmentFile The associated AttachmentFile object.
	 * @throws     PropelException
	 */
	public function getAttachmentFileRelatedByPublishedAttachmentId(PropelPDO $con = null)
	{
		if ($this->aAttachmentFileRelatedByPublishedAttachmentId === null && ($this->published_attachment_id !== null)) {
			$this->aAttachmentFileRelatedByPublishedAttachmentId = AttachmentFilePeer::retrieveByPk($this->published_attachment_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAttachmentFileRelatedByPublishedAttachmentId->addDocrevisionsRelatedByPublishedAttachmentId($this);
			 */
		}
		return $this->aAttachmentFileRelatedByPublishedAttachmentId;
	}

	/**
	 * Clears out the collDocuments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDocuments()
	 */
	public function clearDocuments()
	{
		$this->collDocuments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDocuments collection (array).
	 *
	 * By default this just sets the collDocuments collection to an empty array (like clearcollDocuments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initDocuments()
	{
		$this->collDocuments = array();
	}

	/**
	 * Gets an array of Document objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Docrevision has previously been saved, it will retrieve
	 * related Documents from storage. If this Docrevision is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Document[]
	 * @throws     PropelException
	 */
	public function getDocuments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocuments === null) {
			if ($this->isNew()) {
			   $this->collDocuments = array();
			} else {

				$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

				DocumentPeer::addSelectColumns($criteria);
				$this->collDocuments = DocumentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

				DocumentPeer::addSelectColumns($criteria);
				if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
					$this->collDocuments = DocumentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDocumentCriteria = $criteria;
		return $this->collDocuments;
	}

	/**
	 * Returns the number of related Document objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Document objects.
	 * @throws     PropelException
	 */
	public function countDocuments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collDocuments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

				$count = DocumentPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

				if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
					$count = DocumentPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collDocuments);
				}
			} else {
				$count = count($this->collDocuments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Document object to this object
	 * through the Document foreign key attribute.
	 *
	 * @param      Document $l Document
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDocument(Document $l)
	{
		if ($this->collDocuments === null) {
			$this->initDocuments();
		}
		if (!in_array($l, $this->collDocuments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collDocuments, $l);
			$l->setDocrevision($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Docrevision is new, it will return
	 * an empty collection; or if this Docrevision has previously
	 * been saved, it will retrieve related Documents from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Docrevision.
	 */
	public function getDocumentsJoinDoctype($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocuments === null) {
			if ($this->isNew()) {
				$this->collDocuments = array();
			} else {

				$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

				$this->collDocuments = DocumentPeer::doSelectJoinDoctype($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

			if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
				$this->collDocuments = DocumentPeer::doSelectJoinDoctype($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocumentCriteria = $criteria;

		return $this->collDocuments;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Docrevision is new, it will return
	 * an empty collection; or if this Docrevision has previously
	 * been saved, it will retrieve related Documents from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Docrevision.
	 */
	public function getDocumentsJoinSyllabusItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocrevisionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocuments === null) {
			if ($this->isNew()) {
				$this->collDocuments = array();
			} else {

				$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

				$this->collDocuments = DocumentPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocumentPeer::DOCREVISION_ID, $this->id);

			if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
				$this->collDocuments = DocumentPeer::doSelectJoinSyllabusItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocumentCriteria = $criteria;

		return $this->collDocuments;
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
			if ($this->collDocuments) {
				foreach ((array) $this->collDocuments as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collDocuments = null;
			$this->aDocument = null;
			$this->asfGuardUserRelatedByUploaderId = null;
			$this->asfGuardUserRelatedByRevisionerId = null;
			$this->asfGuardUserRelatedByApproverId = null;
			$this->aAttachmentFileRelatedBySourceAttachmentId = null;
			$this->aAttachmentFileRelatedByPublishedAttachmentId = null;
	}

} // BaseDocrevision
