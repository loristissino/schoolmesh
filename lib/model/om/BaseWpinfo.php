<?php


abstract class BaseWpinfo extends BaseObject  implements Persistent {


  const PEER = 'WpinfoPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $appointment_id;

	
	protected $wpinfo_type_id;

	
	protected $updated_at;

	
	protected $content;

	
	protected $aAppointment;

	
	protected $aWpinfoType;

	
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

	
	public function getAppointmentId()
	{
		return $this->appointment_id;
	}

	
	public function getWpinfoTypeId()
	{
		return $this->wpinfo_type_id;
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

	
	public function getContent()
	{
		return $this->content;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpinfoPeer::ID;
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
			$this->modifiedColumns[] = WpinfoPeer::APPOINTMENT_ID;
		}

		if ($this->aAppointment !== null && $this->aAppointment->getId() !== $v) {
			$this->aAppointment = null;
		}

		return $this;
	} 
	
	public function setWpinfoTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wpinfo_type_id !== $v) {
			$this->wpinfo_type_id = $v;
			$this->modifiedColumns[] = WpinfoPeer::WPINFO_TYPE_ID;
		}

		if ($this->aWpinfoType !== null && $this->aWpinfoType->getId() !== $v) {
			$this->aWpinfoType = null;
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
				$this->modifiedColumns[] = WpinfoPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = WpinfoPeer::CONTENT;
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
			$this->appointment_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->wpinfo_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->content = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Wpinfo object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAppointment !== null && $this->appointment_id !== $this->aAppointment->getId()) {
			$this->aAppointment = null;
		}
		if ($this->aWpinfoType !== null && $this->wpinfo_type_id !== $this->aWpinfoType->getId()) {
			$this->aWpinfoType = null;
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
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpinfoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aAppointment = null;
			$this->aWpinfoType = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpinfoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(WpinfoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpinfoPeer::addInstanceToPool($this);
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

			if ($this->aWpinfoType !== null) {
				if ($this->aWpinfoType->isModified() || $this->aWpinfoType->isNew()) {
					$affectedRows += $this->aWpinfoType->save($con);
				}
				$this->setWpinfoType($this->aWpinfoType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WpinfoPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpinfoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpinfoPeer::doUpdate($this, $con);
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

			if ($this->aWpinfoType !== null) {
				if (!$this->aWpinfoType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWpinfoType->getValidationFailures());
				}
			}


			if (($retval = WpinfoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpinfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAppointmentId();
				break;
			case 2:
				return $this->getWpinfoTypeId();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			case 4:
				return $this->getContent();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WpinfoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAppointmentId(),
			$keys[2] => $this->getWpinfoTypeId(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getContent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpinfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAppointmentId($value);
				break;
			case 2:
				$this->setWpinfoTypeId($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
			case 4:
				$this->setContent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpinfoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAppointmentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWpinfoTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpinfoPeer::DATABASE_NAME);

		if ($this->isColumnModified(WpinfoPeer::ID)) $criteria->add(WpinfoPeer::ID, $this->id);
		if ($this->isColumnModified(WpinfoPeer::APPOINTMENT_ID)) $criteria->add(WpinfoPeer::APPOINTMENT_ID, $this->appointment_id);
		if ($this->isColumnModified(WpinfoPeer::WPINFO_TYPE_ID)) $criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->wpinfo_type_id);
		if ($this->isColumnModified(WpinfoPeer::UPDATED_AT)) $criteria->add(WpinfoPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(WpinfoPeer::CONTENT)) $criteria->add(WpinfoPeer::CONTENT, $this->content);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpinfoPeer::DATABASE_NAME);

		$criteria->add(WpinfoPeer::ID, $this->id);

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

		$copyObj->setAppointmentId($this->appointment_id);

		$copyObj->setWpinfoTypeId($this->wpinfo_type_id);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setContent($this->content);


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
			self::$peer = new WpinfoPeer();
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
			$v->addWpinfo($this);
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

	
	public function setWpinfoType(WpinfoType $v = null)
	{
		if ($v === null) {
			$this->setWpinfoTypeId(NULL);
		} else {
			$this->setWpinfoTypeId($v->getId());
		}

		$this->aWpinfoType = $v;

						if ($v !== null) {
			$v->addWpinfo($this);
		}

		return $this;
	}


	
	public function getWpinfoType(PropelPDO $con = null)
	{
		if ($this->aWpinfoType === null && ($this->wpinfo_type_id !== null)) {
			$c = new Criteria(WpinfoTypePeer::DATABASE_NAME);
			$c->add(WpinfoTypePeer::ID, $this->wpinfo_type_id);
			$this->aWpinfoType = WpinfoTypePeer::doSelectOne($c, $con);
			
		}
		return $this->aWpinfoType;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aAppointment = null;
			$this->aWpinfoType = null;
	}

} 