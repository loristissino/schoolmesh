<?php


abstract class BaseWpevent extends BaseObject  implements Persistent {


  const PEER = 'WpeventPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $created_at;

	
	protected $appointment_id;

	
	protected $user_id;

	
	protected $comment;

	
	protected $status;

	
	protected $aAppointment;

	
	protected $asfGuardUser;

	
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

	
	public function getAppointmentId()
	{
		return $this->appointment_id;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getComment()
	{
		return $this->comment;
	}

	
	public function getStatus()
	{
		return $this->status;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpeventPeer::ID;
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
				$this->modifiedColumns[] = WpeventPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setAppointmentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->appointment_id !== $v) {
			$this->appointment_id = $v;
			$this->modifiedColumns[] = WpeventPeer::APPOINTMENT_ID;
		}

		if ($this->aAppointment !== null && $this->aAppointment->getId() !== $v) {
			$this->aAppointment = null;
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
			$this->modifiedColumns[] = WpeventPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setComment($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = WpeventPeer::COMMENT;
		}

		return $this;
	} 
	
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = WpeventPeer::STATUS;
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
			$this->created_at = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->appointment_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->user_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->comment = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->status = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Wpevent object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAppointment !== null && $this->appointment_id !== $this->aAppointment->getId()) {
			$this->aAppointment = null;
		}
		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
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
			$con = Propel::getConnection(WpeventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpeventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aAppointment = null;
			$this->asfGuardUser = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpeventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpeventPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WpeventPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpeventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpeventPeer::addInstanceToPool($this);
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

												
			if ($this->aAppointment !== null) {
				if ($this->aAppointment->isModified() || $this->aAppointment->isNew()) {
					$affectedRows += $this->aAppointment->save($con);
				}
				$this->setAppointment($this->aAppointment);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WpeventPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpeventPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpeventPeer::doUpdate($this, $con);
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


												
			if ($this->aAppointment !== null) {
				if (!$this->aAppointment->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAppointment->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = WpeventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpeventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getAppointmentId();
				break;
			case 3:
				return $this->getUserId();
				break;
			case 4:
				return $this->getComment();
				break;
			case 5:
				return $this->getStatus();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WpeventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getAppointmentId(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getComment(),
			$keys[5] => $this->getStatus(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpeventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setAppointmentId($value);
				break;
			case 3:
				$this->setUserId($value);
				break;
			case 4:
				$this->setComment($value);
				break;
			case 5:
				$this->setStatus($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpeventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAppointmentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setComment($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStatus($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpeventPeer::DATABASE_NAME);

		if ($this->isColumnModified(WpeventPeer::ID)) $criteria->add(WpeventPeer::ID, $this->id);
		if ($this->isColumnModified(WpeventPeer::CREATED_AT)) $criteria->add(WpeventPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WpeventPeer::APPOINTMENT_ID)) $criteria->add(WpeventPeer::APPOINTMENT_ID, $this->appointment_id);
		if ($this->isColumnModified(WpeventPeer::USER_ID)) $criteria->add(WpeventPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(WpeventPeer::COMMENT)) $criteria->add(WpeventPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(WpeventPeer::STATUS)) $criteria->add(WpeventPeer::STATUS, $this->status);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpeventPeer::DATABASE_NAME);

		$criteria->add(WpeventPeer::ID, $this->id);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setAppointmentId($this->appointment_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setComment($this->comment);

		$copyObj->setStatus($this->status);


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
			self::$peer = new WpeventPeer();
		}
		return self::$peer;
	}

	
	public function setAppointment(Appointment $v = null)
	{
		if ($v === null) {
			$this->setAppointmentId(NULL);
		} else {
			$this->setAppointmentId($v->getId());
		}

		$this->aAppointment = $v;

						if ($v !== null) {
			$v->addWpevent($this);
		}

		return $this;
	}


	
	public function getAppointment(PropelPDO $con = null)
	{
		if ($this->aAppointment === null && ($this->appointment_id !== null)) {
			$c = new Criteria(AppointmentPeer::DATABASE_NAME);
			$c->add(AppointmentPeer::ID, $this->appointment_id);
			$this->aAppointment = AppointmentPeer::doSelectOne($c, $con);
			
		}
		return $this->aAppointment;
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
			$v->addWpevent($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aAppointment = null;
			$this->asfGuardUser = null;
	}

} 