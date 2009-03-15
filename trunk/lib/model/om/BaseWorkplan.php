<?php


abstract class BaseWorkplan extends BaseObject  implements Persistent {


  const PEER = 'WorkplanPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $user_id;

	
	protected $year_id;

	
	protected $schoolclass_id;

	
	protected $subject_id;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $is_locked;

	
	protected $asfGuardUser;

	
	protected $aYear;

	
	protected $aSchoolclass;

	
	protected $aSubject;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getYearId()
	{
		return $this->year_id;
	}

	
	public function getSchoolclassId()
	{
		return $this->schoolclass_id;
	}

	
	public function getSubjectId()
	{
		return $this->subject_id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getIsLocked()
	{
		return $this->is_locked;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WorkplanPeer::ID;
		}

		return $this;
	} 
	
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setYearId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->year_id !== $v) {
			$this->year_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::YEAR_ID;
		}

		if ($this->aYear !== null && $this->aYear->getId() !== $v) {
			$this->aYear = null;
		}

		return $this;
	} 
	
	public function setSchoolclassId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->schoolclass_id !== $v) {
			$this->schoolclass_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::SCHOOLCLASS_ID;
		}

		if ($this->aSchoolclass !== null && $this->aSchoolclass->getId() !== $v) {
			$this->aSchoolclass = null;
		}

		return $this;
	} 
	
	public function setSubjectId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->subject_id !== $v) {
			$this->subject_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::SUBJECT_ID;
		}

		if ($this->aSubject !== null && $this->aSubject->getId() !== $v) {
			$this->aSubject = null;
		}

		return $this;
	} 
	
	public function setCreatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			
			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = WorkplanPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setUpdatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			
			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = WorkplanPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setIsLocked($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_locked !== $v) {
			$this->is_locked = $v;
			$this->modifiedColumns[] = WorkplanPeer::IS_LOCKED;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->year_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->schoolclass_id = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->subject_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->is_locked = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Workplan object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aYear !== null && $this->year_id !== $this->aYear->getId()) {
			$this->aYear = null;
		}
		if ($this->aSchoolclass !== null && $this->schoolclass_id !== $this->aSchoolclass->getId()) {
			$this->aSchoolclass = null;
		}
		if ($this->aSubject !== null && $this->subject_id !== $this->aSubject->getId()) {
			$this->aSubject = null;
		}
	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkplanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WorkplanPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->aYear = null;
			$this->aSchoolclass = null;
			$this->aSubject = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkplanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WorkplanPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WorkplanPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(WorkplanPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkplanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WorkplanPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aYear !== null) {
				if ($this->aYear->isModified() || $this->aYear->isNew()) {
					$affectedRows += $this->aYear->save($con);
				}
				$this->setYear($this->aYear);
			}

			if ($this->aSchoolclass !== null) {
				if ($this->aSchoolclass->isModified() || $this->aSchoolclass->isNew()) {
					$affectedRows += $this->aSchoolclass->save($con);
				}
				$this->setSchoolclass($this->aSchoolclass);
			}

			if ($this->aSubject !== null) {
				if ($this->aSubject->isModified() || $this->aSubject->isNew()) {
					$affectedRows += $this->aSubject->save($con);
				}
				$this->setSubject($this->aSubject);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WorkplanPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkplanPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WorkplanPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
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

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aYear !== null) {
				if (!$this->aYear->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aYear->getValidationFailures());
				}
			}

			if ($this->aSchoolclass !== null) {
				if (!$this->aSchoolclass->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchoolclass->getValidationFailures());
				}
			}

			if ($this->aSubject !== null) {
				if (!$this->aSubject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSubject->getValidationFailures());
				}
			}


			if (($retval = WorkplanPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkplanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
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
				return $this->getYearId();
				break;
			case 3:
				return $this->getSchoolclassId();
				break;
			case 4:
				return $this->getSubjectId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getIsLocked();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WorkplanPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getYearId(),
			$keys[3] => $this->getSchoolclassId(),
			$keys[4] => $this->getSubjectId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getIsLocked(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkplanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
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
				$this->setYearId($value);
				break;
			case 3:
				$this->setSchoolclassId($value);
				break;
			case 4:
				$this->setSubjectId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setIsLocked($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkplanPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setYearId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSchoolclassId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSubjectId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsLocked($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkplanPeer::ID)) $criteria->add(WorkplanPeer::ID, $this->id);
		if ($this->isColumnModified(WorkplanPeer::USER_ID)) $criteria->add(WorkplanPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(WorkplanPeer::YEAR_ID)) $criteria->add(WorkplanPeer::YEAR_ID, $this->year_id);
		if ($this->isColumnModified(WorkplanPeer::SCHOOLCLASS_ID)) $criteria->add(WorkplanPeer::SCHOOLCLASS_ID, $this->schoolclass_id);
		if ($this->isColumnModified(WorkplanPeer::SUBJECT_ID)) $criteria->add(WorkplanPeer::SUBJECT_ID, $this->subject_id);
		if ($this->isColumnModified(WorkplanPeer::CREATED_AT)) $criteria->add(WorkplanPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WorkplanPeer::UPDATED_AT)) $criteria->add(WorkplanPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(WorkplanPeer::IS_LOCKED)) $criteria->add(WorkplanPeer::IS_LOCKED, $this->is_locked);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);

		$criteria->add(WorkplanPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setYearId($this->year_id);

		$copyObj->setSchoolclassId($this->schoolclass_id);

		$copyObj->setSubjectId($this->subject_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setIsLocked($this->is_locked);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WorkplanPeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUser = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->user_id);
			$this->asfGuardUser = sfGuardUserPeer::doSelectOne($c, $con);
			
		}
		return $this->asfGuardUser;
	}

	
	public function setYear(Year $v = null)
	{
		if ($v === null) {
			$this->setYearId(NULL);
		} else {
			$this->setYearId($v->getId());
		}

		$this->aYear = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getYear(PropelPDO $con = null)
	{
		if ($this->aYear === null && ($this->year_id !== null)) {
			$c = new Criteria(YearPeer::DATABASE_NAME);
			$c->add(YearPeer::ID, $this->year_id);
			$this->aYear = YearPeer::doSelectOne($c, $con);
			
		}
		return $this->aYear;
	}

	
	public function setSchoolclass(Schoolclass $v = null)
	{
		if ($v === null) {
			$this->setSchoolclassId(NULL);
		} else {
			$this->setSchoolclassId($v->getId());
		}

		$this->aSchoolclass = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getSchoolclass(PropelPDO $con = null)
	{
		if ($this->aSchoolclass === null && (($this->schoolclass_id !== "" && $this->schoolclass_id !== null))) {
			$c = new Criteria(SchoolclassPeer::DATABASE_NAME);
			$c->add(SchoolclassPeer::ID, $this->schoolclass_id);
			$this->aSchoolclass = SchoolclassPeer::doSelectOne($c, $con);
			
		}
		return $this->aSchoolclass;
	}

	
	public function setSubject(Subject $v = null)
	{
		if ($v === null) {
			$this->setSubjectId(NULL);
		} else {
			$this->setSubjectId($v->getId());
		}

		$this->aSubject = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getSubject(PropelPDO $con = null)
	{
		if ($this->aSubject === null && ($this->subject_id !== null)) {
			$c = new Criteria(SubjectPeer::DATABASE_NAME);
			$c->add(SubjectPeer::ID, $this->subject_id);
			$this->aSubject = SubjectPeer::doSelectOne($c, $con);
			
		}
		return $this->aSubject;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->asfGuardUser = null;
			$this->aYear = null;
			$this->aSchoolclass = null;
			$this->aSubject = null;
	}

} 