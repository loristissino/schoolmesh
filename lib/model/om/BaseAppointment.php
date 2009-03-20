<?php


abstract class BaseAppointment extends BaseObject  implements Persistent {


  const PEER = 'AppointmentPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $user_id;

	
	protected $subject_id;

	
	protected $schoolclass_id;

	
	protected $year_id;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $import_code;

	
	protected $asfGuardUser;

	
	protected $aSubject;

	
	protected $aSchoolclass;

	
	protected $aYear;

	
	protected $collWpevents;

	
	private $lastWpeventCriteria = null;

	
	protected $collWpmodules;

	
	private $lastWpmoduleCriteria = null;

	
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

	
	public function getSubjectId()
	{
		return $this->subject_id;
	}

	
	public function getSchoolclassId()
	{
		return $this->schoolclass_id;
	}

	
	public function getYearId()
	{
		return $this->year_id;
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

	
	public function getImportCode()
	{
		return $this->import_code;
	}

	
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
	} 
	
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
	} 
	
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
	} 
	
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
	} 
	
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
				$this->modifiedColumns[] = AppointmentPeer::CREATED_AT;
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
				$this->modifiedColumns[] = AppointmentPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
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
			$this->subject_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->schoolclass_id = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->year_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->import_code = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Appointment object", $e);
		}
	}

	
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
		if ($this->aYear !== null && $this->year_id !== $this->aYear->getId()) {
			$this->aYear = null;
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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AppointmentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->aSubject = null;
			$this->aSchoolclass = null;
			$this->aYear = null;
			$this->collWpevents = null;
			$this->lastWpeventCriteria = null;

			$this->collWpmodules = null;
			$this->lastWpmoduleCriteria = null;

		} 	}

	
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
			AppointmentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(AppointmentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AppointmentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			AppointmentPeer::addInstanceToPool($this);
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

			if ($this->aYear !== null) {
				if ($this->aYear->isModified() || $this->aYear->isNew()) {
					$affectedRows += $this->aYear->save($con);
				}
				$this->setYear($this->aYear);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AppointmentPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AppointmentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AppointmentPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWpevents !== null) {
				foreach ($this->collWpevents as $referrerFK) {
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

			if ($this->aYear !== null) {
				if (!$this->aYear->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aYear->getValidationFailures());
				}
			}


			if (($retval = AppointmentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpevents !== null) {
					foreach ($this->collWpevents as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AppointmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSubjectId();
				break;
			case 3:
				return $this->getSchoolclassId();
				break;
			case 4:
				return $this->getYearId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getImportCode();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AppointmentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getSubjectId(),
			$keys[3] => $this->getSchoolclassId(),
			$keys[4] => $this->getYearId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getImportCode(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AppointmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSubjectId($value);
				break;
			case 3:
				$this->setSchoolclassId($value);
				break;
			case 4:
				$this->setYearId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setImportCode($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AppointmentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSubjectId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSchoolclassId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setYearId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setImportCode($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);

		if ($this->isColumnModified(AppointmentPeer::ID)) $criteria->add(AppointmentPeer::ID, $this->id);
		if ($this->isColumnModified(AppointmentPeer::USER_ID)) $criteria->add(AppointmentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(AppointmentPeer::SUBJECT_ID)) $criteria->add(AppointmentPeer::SUBJECT_ID, $this->subject_id);
		if ($this->isColumnModified(AppointmentPeer::SCHOOLCLASS_ID)) $criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->schoolclass_id);
		if ($this->isColumnModified(AppointmentPeer::YEAR_ID)) $criteria->add(AppointmentPeer::YEAR_ID, $this->year_id);
		if ($this->isColumnModified(AppointmentPeer::CREATED_AT)) $criteria->add(AppointmentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AppointmentPeer::UPDATED_AT)) $criteria->add(AppointmentPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(AppointmentPeer::IMPORT_CODE)) $criteria->add(AppointmentPeer::IMPORT_CODE, $this->import_code);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);

		$criteria->add(AppointmentPeer::ID, $this->id);

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

		$copyObj->setSubjectId($this->subject_id);

		$copyObj->setSchoolclassId($this->schoolclass_id);

		$copyObj->setYearId($this->year_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setImportCode($this->import_code);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWpevents() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpevent($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpmodules() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpmodule($relObj->copy($deepCopy));
				}
			}

		} 

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
			self::$peer = new AppointmentPeer();
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
			$v->addAppointment($this);
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

	
	public function setSubject(Subject $v = null)
	{
		if ($v === null) {
			$this->setSubjectId(NULL);
		} else {
			$this->setSubjectId($v->getId());
		}

		$this->aSubject = $v;

						if ($v !== null) {
			$v->addAppointment($this);
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

	
	public function setSchoolclass(Schoolclass $v = null)
	{
		if ($v === null) {
			$this->setSchoolclassId(NULL);
		} else {
			$this->setSchoolclassId($v->getId());
		}

		$this->aSchoolclass = $v;

						if ($v !== null) {
			$v->addAppointment($this);
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

	
	public function setYear(Year $v = null)
	{
		if ($v === null) {
			$this->setYearId(NULL);
		} else {
			$this->setYearId($v->getId());
		}

		$this->aYear = $v;

						if ($v !== null) {
			$v->addAppointment($this);
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

	
	public function clearWpevents()
	{
		$this->collWpevents = null; 	}

	
	public function initWpevents()
	{
		$this->collWpevents = array();
	}

	
	public function getWpevents($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpevents === null) {
			if ($this->isNew()) {
			   $this->collWpevents = array();
			} else {

				$criteria->add(WpeventPeer::APPOINTMENT_ID, $this->id);

				WpeventPeer::addSelectColumns($criteria);
				$this->collWpevents = WpeventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpeventPeer::APPOINTMENT_ID, $this->id);

				WpeventPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpeventCriteria) || !$this->lastWpeventCriteria->equals($criteria)) {
					$this->collWpevents = WpeventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpeventCriteria = $criteria;
		return $this->collWpevents;
	}

	
	public function countWpevents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
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

		if ($this->collWpevents === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpeventPeer::APPOINTMENT_ID, $this->id);

				$count = WpeventPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpeventPeer::APPOINTMENT_ID, $this->id);

				if (!isset($this->lastWpeventCriteria) || !$this->lastWpeventCriteria->equals($criteria)) {
					$count = WpeventPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpevents);
				}
			} else {
				$count = count($this->collWpevents);
			}
		}
		$this->lastWpeventCriteria = $criteria;
		return $count;
	}

	
	public function addWpevent(Wpevent $l)
	{
		if ($this->collWpevents === null) {
			$this->initWpevents();
		}
		if (!in_array($l, $this->collWpevents, true)) { 			array_push($this->collWpevents, $l);
			$l->setAppointment($this);
		}
	}


	
	public function getWpeventsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpevents === null) {
			if ($this->isNew()) {
				$this->collWpevents = array();
			} else {

				$criteria->add(WpeventPeer::APPOINTMENT_ID, $this->id);

				$this->collWpevents = WpeventPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpeventPeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastWpeventCriteria) || !$this->lastWpeventCriteria->equals($criteria)) {
				$this->collWpevents = WpeventPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpeventCriteria = $criteria;

		return $this->collWpevents;
	}

	
	public function clearWpmodules()
	{
		$this->collWpmodules = null; 	}

	
	public function initWpmodules()
	{
		$this->collWpmodules = array();
	}

	
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
						if (!$this->isNew()) {
												

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

				$count = WpmodulePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$count = WpmodulePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpmodules);
				}
			} else {
				$count = count($this->collWpmodules);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;
		return $count;
	}

	
	public function addWpmodule(Wpmodule $l)
	{
		if ($this->collWpmodules === null) {
			$this->initWpmodules();
		}
		if (!in_array($l, $this->collWpmodules, true)) { 			array_push($this->collWpmodules, $l);
			$l->setAppointment($this);
		}
	}


	
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
									
			$criteria->add(WpmodulePeer::APPOINTMENT_ID, $this->id);

			if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
				$this->collWpmodules = WpmodulePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;

		return $this->collWpmodules;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWpevents) {
				foreach ((array) $this->collWpevents as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpmodules) {
				foreach ((array) $this->collWpmodules as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWpevents = null;
		$this->collWpmodules = null;
			$this->asfGuardUser = null;
			$this->aSubject = null;
			$this->aSchoolclass = null;
			$this->aYear = null;
	}

} 