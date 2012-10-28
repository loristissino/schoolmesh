<?php

/**
 * Base class that represents a row from the 'document' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseDocument extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DocumentPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the doctype_id field.
	 * @var        int
	 */
	protected $doctype_id;

	/**
	 * The value for the code field.
	 * @var        string
	 */
	protected $code;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the is_form field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_form;

	/**
	 * The value for the docrevision_id field.
	 * @var        int
	 */
	protected $docrevision_id;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the is_deprecated field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_deprecated;

	/**
	 * The value for the notes field.
	 * @var        string
	 */
	protected $notes;

	/**
	 * The value for the syllabus_item_id field.
	 * @var        int
	 */
	protected $syllabus_item_id;

	/**
	 * @var        Doctype
	 */
	protected $aDoctype;

	/**
	 * @var        Docrevision
	 */
	protected $aDocrevision;

	/**
	 * @var        SyllabusItem
	 */
	protected $aSyllabusItem;

	/**
	 * @var        array Docrevision[] Collection to store aggregation of Docrevision objects.
	 */
	protected $collDocrevisions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collDocrevisions.
	 */
	private $lastDocrevisionCriteria = null;

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
	
	const PEER = 'DocumentPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_form = false;
		$this->is_active = true;
		$this->is_deprecated = false;
	}

	/**
	 * Initializes internal state of BaseDocument object.
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
	 * Get the [doctype_id] column value.
	 * 
	 * @return     int
	 */
	public function getDoctypeId()
	{
		return $this->doctype_id;
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
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [is_form] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsForm()
	{
		return $this->is_form;
	}

	/**
	 * Get the [docrevision_id] column value.
	 * 
	 * @return     int
	 */
	public function getDocrevisionId()
	{
		return $this->docrevision_id;
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
	 * Get the [is_deprecated] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsDeprecated()
	{
		return $this->is_deprecated;
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
	 * Get the [syllabus_item_id] column value.
	 * 
	 * @return     int
	 */
	public function getSyllabusItemId()
	{
		return $this->syllabus_item_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DocumentPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [doctype_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setDoctypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->doctype_id !== $v) {
			$this->doctype_id = $v;
			$this->modifiedColumns[] = DocumentPeer::DOCTYPE_ID;
		}

		if ($this->aDoctype !== null && $this->aDoctype->getId() !== $v) {
			$this->aDoctype = null;
		}

		return $this;
	} // setDoctypeId()

	/**
	 * Set the value of [code] column.
	 * 
	 * @param      string $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = DocumentPeer::CODE;
		}

		return $this;
	} // setCode()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = DocumentPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [is_form] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setIsForm($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_form !== $v || $this->isNew()) {
			$this->is_form = $v;
			$this->modifiedColumns[] = DocumentPeer::IS_FORM;
		}

		return $this;
	} // setIsForm()

	/**
	 * Set the value of [docrevision_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setDocrevisionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->docrevision_id !== $v) {
			$this->docrevision_id = $v;
			$this->modifiedColumns[] = DocumentPeer::DOCREVISION_ID;
		}

		if ($this->aDocrevision !== null && $this->aDocrevision->getId() !== $v) {
			$this->aDocrevision = null;
		}

		return $this;
	} // setDocrevisionId()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = DocumentPeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [is_deprecated] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setIsDeprecated($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_deprecated !== $v || $this->isNew()) {
			$this->is_deprecated = $v;
			$this->modifiedColumns[] = DocumentPeer::IS_DEPRECATED;
		}

		return $this;
	} // setIsDeprecated()

	/**
	 * Set the value of [notes] column.
	 * 
	 * @param      string $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setNotes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->notes !== $v) {
			$this->notes = $v;
			$this->modifiedColumns[] = DocumentPeer::NOTES;
		}

		return $this;
	} // setNotes()

	/**
	 * Set the value of [syllabus_item_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Document The current object (for fluent API support)
	 */
	public function setSyllabusItemId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->syllabus_item_id !== $v) {
			$this->syllabus_item_id = $v;
			$this->modifiedColumns[] = DocumentPeer::SYLLABUS_ITEM_ID;
		}

		if ($this->aSyllabusItem !== null && $this->aSyllabusItem->getId() !== $v) {
			$this->aSyllabusItem = null;
		}

		return $this;
	} // setSyllabusItemId()

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
			if ($this->is_form !== false) {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->is_deprecated !== false) {
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
			$this->doctype_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->code = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->title = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->is_form = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->docrevision_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->is_active = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->is_deprecated = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->notes = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->syllabus_item_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = DocumentPeer::NUM_COLUMNS - DocumentPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Document object", $e);
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

		if ($this->aDoctype !== null && $this->doctype_id !== $this->aDoctype->getId()) {
			$this->aDoctype = null;
		}
		if ($this->aDocrevision !== null && $this->docrevision_id !== $this->aDocrevision->getId()) {
			$this->aDocrevision = null;
		}
		if ($this->aSyllabusItem !== null && $this->syllabus_item_id !== $this->aSyllabusItem->getId()) {
			$this->aSyllabusItem = null;
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
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = DocumentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aDoctype = null;
			$this->aDocrevision = null;
			$this->aSyllabusItem = null;
			$this->collDocrevisions = null;
			$this->lastDocrevisionCriteria = null;

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
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				DocumentPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				DocumentPeer::addInstanceToPool($this);
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

			if ($this->aDoctype !== null) {
				if ($this->aDoctype->isModified() || $this->aDoctype->isNew()) {
					$affectedRows += $this->aDoctype->save($con);
				}
				$this->setDoctype($this->aDoctype);
			}

			if ($this->aDocrevision !== null) {
				if ($this->aDocrevision->isModified() || $this->aDocrevision->isNew()) {
					$affectedRows += $this->aDocrevision->save($con);
				}
				$this->setDocrevision($this->aDocrevision);
			}

			if ($this->aSyllabusItem !== null) {
				if ($this->aSyllabusItem->isModified() || $this->aSyllabusItem->isNew()) {
					$affectedRows += $this->aSyllabusItem->save($con);
				}
				$this->setSyllabusItem($this->aSyllabusItem);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = DocumentPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DocumentPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DocumentPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDocrevisions !== null) {
				foreach ($this->collDocrevisions as $referrerFK) {
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

			if ($this->aDoctype !== null) {
				if (!$this->aDoctype->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDoctype->getValidationFailures());
				}
			}

			if ($this->aDocrevision !== null) {
				if (!$this->aDocrevision->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDocrevision->getValidationFailures());
				}
			}

			if ($this->aSyllabusItem !== null) {
				if (!$this->aSyllabusItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSyllabusItem->getValidationFailures());
				}
			}


			if (($retval = DocumentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDocrevisions !== null) {
					foreach ($this->collDocrevisions as $referrerFK) {
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
		$pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDoctypeId();
				break;
			case 2:
				return $this->getCode();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getIsForm();
				break;
			case 5:
				return $this->getDocrevisionId();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getIsDeprecated();
				break;
			case 8:
				return $this->getNotes();
				break;
			case 9:
				return $this->getSyllabusItemId();
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
		$keys = DocumentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDoctypeId(),
			$keys[2] => $this->getCode(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getIsForm(),
			$keys[5] => $this->getDocrevisionId(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getIsDeprecated(),
			$keys[8] => $this->getNotes(),
			$keys[9] => $this->getSyllabusItemId(),
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
		$pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDoctypeId($value);
				break;
			case 2:
				$this->setCode($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setIsForm($value);
				break;
			case 5:
				$this->setDocrevisionId($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setIsDeprecated($value);
				break;
			case 8:
				$this->setNotes($value);
				break;
			case 9:
				$this->setSyllabusItemId($value);
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
		$keys = DocumentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDoctypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsForm($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDocrevisionId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsDeprecated($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setNotes($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSyllabusItemId($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(DocumentPeer::DATABASE_NAME);

		if ($this->isColumnModified(DocumentPeer::ID)) $criteria->add(DocumentPeer::ID, $this->id);
		if ($this->isColumnModified(DocumentPeer::DOCTYPE_ID)) $criteria->add(DocumentPeer::DOCTYPE_ID, $this->doctype_id);
		if ($this->isColumnModified(DocumentPeer::CODE)) $criteria->add(DocumentPeer::CODE, $this->code);
		if ($this->isColumnModified(DocumentPeer::TITLE)) $criteria->add(DocumentPeer::TITLE, $this->title);
		if ($this->isColumnModified(DocumentPeer::IS_FORM)) $criteria->add(DocumentPeer::IS_FORM, $this->is_form);
		if ($this->isColumnModified(DocumentPeer::DOCREVISION_ID)) $criteria->add(DocumentPeer::DOCREVISION_ID, $this->docrevision_id);
		if ($this->isColumnModified(DocumentPeer::IS_ACTIVE)) $criteria->add(DocumentPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(DocumentPeer::IS_DEPRECATED)) $criteria->add(DocumentPeer::IS_DEPRECATED, $this->is_deprecated);
		if ($this->isColumnModified(DocumentPeer::NOTES)) $criteria->add(DocumentPeer::NOTES, $this->notes);
		if ($this->isColumnModified(DocumentPeer::SYLLABUS_ITEM_ID)) $criteria->add(DocumentPeer::SYLLABUS_ITEM_ID, $this->syllabus_item_id);

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
		$criteria = new Criteria(DocumentPeer::DATABASE_NAME);

		$criteria->add(DocumentPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Document (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDoctypeId($this->doctype_id);

		$copyObj->setCode($this->code);

		$copyObj->setTitle($this->title);

		$copyObj->setIsForm($this->is_form);

		$copyObj->setDocrevisionId($this->docrevision_id);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeprecated($this->is_deprecated);

		$copyObj->setNotes($this->notes);

		$copyObj->setSyllabusItemId($this->syllabus_item_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getDocrevisions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDocrevision($relObj->copy($deepCopy));
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
	 * @return     Document Clone of current object.
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
	 * @return     DocumentPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DocumentPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Doctype object.
	 *
	 * @param      Doctype $v
	 * @return     Document The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDoctype(Doctype $v = null)
	{
		if ($v === null) {
			$this->setDoctypeId(NULL);
		} else {
			$this->setDoctypeId($v->getId());
		}

		$this->aDoctype = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Doctype object, it will not be re-added.
		if ($v !== null) {
			$v->addDocument($this);
		}

		return $this;
	}


	/**
	 * Get the associated Doctype object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Doctype The associated Doctype object.
	 * @throws     PropelException
	 */
	public function getDoctype(PropelPDO $con = null)
	{
		if ($this->aDoctype === null && ($this->doctype_id !== null)) {
			$this->aDoctype = DoctypePeer::retrieveByPk($this->doctype_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aDoctype->addDocuments($this);
			 */
		}
		return $this->aDoctype;
	}

	/**
	 * Declares an association between this object and a Docrevision object.
	 *
	 * @param      Docrevision $v
	 * @return     Document The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDocrevision(Docrevision $v = null)
	{
		if ($v === null) {
			$this->setDocrevisionId(NULL);
		} else {
			$this->setDocrevisionId($v->getId());
		}

		$this->aDocrevision = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Docrevision object, it will not be re-added.
		if ($v !== null) {
			$v->addDocument($this);
		}

		return $this;
	}


	/**
	 * Get the associated Docrevision object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Docrevision The associated Docrevision object.
	 * @throws     PropelException
	 */
	public function getDocrevision(PropelPDO $con = null)
	{
		if ($this->aDocrevision === null && ($this->docrevision_id !== null)) {
			$this->aDocrevision = DocrevisionPeer::retrieveByPk($this->docrevision_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aDocrevision->addDocuments($this);
			 */
		}
		return $this->aDocrevision;
	}

	/**
	 * Declares an association between this object and a SyllabusItem object.
	 *
	 * @param      SyllabusItem $v
	 * @return     Document The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSyllabusItem(SyllabusItem $v = null)
	{
		if ($v === null) {
			$this->setSyllabusItemId(NULL);
		} else {
			$this->setSyllabusItemId($v->getId());
		}

		$this->aSyllabusItem = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SyllabusItem object, it will not be re-added.
		if ($v !== null) {
			$v->addDocument($this);
		}

		return $this;
	}


	/**
	 * Get the associated SyllabusItem object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SyllabusItem The associated SyllabusItem object.
	 * @throws     PropelException
	 */
	public function getSyllabusItem(PropelPDO $con = null)
	{
		if ($this->aSyllabusItem === null && ($this->syllabus_item_id !== null)) {
			$this->aSyllabusItem = SyllabusItemPeer::retrieveByPk($this->syllabus_item_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSyllabusItem->addDocuments($this);
			 */
		}
		return $this->aSyllabusItem;
	}

	/**
	 * Clears out the collDocrevisions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDocrevisions()
	 */
	public function clearDocrevisions()
	{
		$this->collDocrevisions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDocrevisions collection (array).
	 *
	 * By default this just sets the collDocrevisions collection to an empty array (like clearcollDocrevisions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initDocrevisions()
	{
		$this->collDocrevisions = array();
	}

	/**
	 * Gets an array of Docrevision objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Document has previously been saved, it will retrieve
	 * related Docrevisions from storage. If this Document is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Docrevision[]
	 * @throws     PropelException
	 */
	public function getDocrevisions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocumentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisions === null) {
			if ($this->isNew()) {
			   $this->collDocrevisions = array();
			} else {

				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				DocrevisionPeer::addSelectColumns($criteria);
				$this->collDocrevisions = DocrevisionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				DocrevisionPeer::addSelectColumns($criteria);
				if (!isset($this->lastDocrevisionCriteria) || !$this->lastDocrevisionCriteria->equals($criteria)) {
					$this->collDocrevisions = DocrevisionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDocrevisionCriteria = $criteria;
		return $this->collDocrevisions;
	}

	/**
	 * Returns the number of related Docrevision objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Docrevision objects.
	 * @throws     PropelException
	 */
	public function countDocrevisions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocumentPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collDocrevisions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				$count = DocrevisionPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				if (!isset($this->lastDocrevisionCriteria) || !$this->lastDocrevisionCriteria->equals($criteria)) {
					$count = DocrevisionPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collDocrevisions);
				}
			} else {
				$count = count($this->collDocrevisions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Docrevision object to this object
	 * through the Docrevision foreign key attribute.
	 *
	 * @param      Docrevision $l Docrevision
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDocrevision(Docrevision $l)
	{
		if ($this->collDocrevisions === null) {
			$this->initDocrevisions();
		}
		if (!in_array($l, $this->collDocrevisions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collDocrevisions, $l);
			$l->setDocument($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Document is new, it will return
	 * an empty collection; or if this Document has previously
	 * been saved, it will retrieve related Docrevisions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Document.
	 */
	public function getDocrevisionsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocumentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisions === null) {
			if ($this->isNew()) {
				$this->collDocrevisions = array();
			} else {

				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				$this->collDocrevisions = DocrevisionPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionCriteria) || !$this->lastDocrevisionCriteria->equals($criteria)) {
				$this->collDocrevisions = DocrevisionPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionCriteria = $criteria;

		return $this->collDocrevisions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Document is new, it will return
	 * an empty collection; or if this Document has previously
	 * been saved, it will retrieve related Docrevisions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Document.
	 */
	public function getDocrevisionsJoinAttachmentFileRelatedBySourceAttachmentId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocumentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisions === null) {
			if ($this->isNew()) {
				$this->collDocrevisions = array();
			} else {

				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				$this->collDocrevisions = DocrevisionPeer::doSelectJoinAttachmentFileRelatedBySourceAttachmentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionCriteria) || !$this->lastDocrevisionCriteria->equals($criteria)) {
				$this->collDocrevisions = DocrevisionPeer::doSelectJoinAttachmentFileRelatedBySourceAttachmentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionCriteria = $criteria;

		return $this->collDocrevisions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Document is new, it will return
	 * an empty collection; or if this Document has previously
	 * been saved, it will retrieve related Docrevisions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Document.
	 */
	public function getDocrevisionsJoinAttachmentFileRelatedByPublishedAttachmentId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DocumentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocrevisions === null) {
			if ($this->isNew()) {
				$this->collDocrevisions = array();
			} else {

				$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

				$this->collDocrevisions = DocrevisionPeer::doSelectJoinAttachmentFileRelatedByPublishedAttachmentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DocrevisionPeer::DOCUMENT_ID, $this->id);

			if (!isset($this->lastDocrevisionCriteria) || !$this->lastDocrevisionCriteria->equals($criteria)) {
				$this->collDocrevisions = DocrevisionPeer::doSelectJoinAttachmentFileRelatedByPublishedAttachmentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastDocrevisionCriteria = $criteria;

		return $this->collDocrevisions;
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
			if ($this->collDocrevisions) {
				foreach ((array) $this->collDocrevisions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collDocrevisions = null;
			$this->aDoctype = null;
			$this->aDocrevision = null;
			$this->aSyllabusItem = null;
	}

} // BaseDocument
