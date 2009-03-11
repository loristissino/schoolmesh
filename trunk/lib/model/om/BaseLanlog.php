<?php


abstract class BaseLanlog extends BaseObject  implements Persistent {


  const PEER = 'LanlogPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $user_id;

	
	protected $workstation_id;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $is_online;

	
	protected $asfGuardUser;

	
	protected $aWorkstation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->is_online = false;
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getWorkstationId()
	{
		return $this->workstation_id;
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

	
	public function getIsOnline()
	{
		return $this->is_online;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LanlogPeer::ID;
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
			$this->modifiedColumns[] = LanlogPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setWorkstationId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->workstation_id !== $v) {
			$this->workstation_id = $v;
			$this->modifiedColumns[] = LanlogPeer::WORKSTATION_ID;
		}

		if ($this->aWorkstation !== null && $this->aWorkstation->getId() !== $v) {
			$this->aWorkstation = null;
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
				$this->modifiedColumns[] = LanlogPeer::CREATED_AT;
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
				$this->modifiedColumns[] = LanlogPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setIsOnline($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_online !== $v || $v === false) {
			$this->is_online = $v;
			$this->modifiedColumns[] = LanlogPeer::IS_ONLINE;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(LanlogPeer::IS_ONLINE))) {
				return false;
			}

			if ($this->is_online !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->workstation_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->created_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->updated_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_online = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Lanlog object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aWorkstation !== null && $this->workstation_id !== $this->aWorkstation->getId()) {
			$this->aWorkstation = null;
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
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = LanlogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->aWorkstation = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			LanlogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(LanlogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(LanlogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			LanlogPeer::addInstanceToPool($this);
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

			if ($this->aWorkstation !== null) {
				if ($this->aWorkstation->isModified() || $this->aWorkstation->isNew()) {
					$affectedRows += $this->aWorkstation->save($con);
				}
				$this->setWorkstation($this->aWorkstation);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = LanlogPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LanlogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += LanlogPeer::doUpdate($this, $con);
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

			if ($this->aWorkstation !== null) {
				if (!$this->aWorkstation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWorkstation->getValidationFailures());
				}
			}


			if (($retval = LanlogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LanlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWorkstationId();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			case 5:
				return $this->getIsOnline();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = LanlogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getWorkstationId(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
			$keys[5] => $this->getIsOnline(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LanlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setWorkstationId($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
			case 5:
				$this->setIsOnline($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LanlogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWorkstationId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsOnline($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LanlogPeer::DATABASE_NAME);

		if ($this->isColumnModified(LanlogPeer::ID)) $criteria->add(LanlogPeer::ID, $this->id);
		if ($this->isColumnModified(LanlogPeer::USER_ID)) $criteria->add(LanlogPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(LanlogPeer::WORKSTATION_ID)) $criteria->add(LanlogPeer::WORKSTATION_ID, $this->workstation_id);
		if ($this->isColumnModified(LanlogPeer::CREATED_AT)) $criteria->add(LanlogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(LanlogPeer::UPDATED_AT)) $criteria->add(LanlogPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(LanlogPeer::IS_ONLINE)) $criteria->add(LanlogPeer::IS_ONLINE, $this->is_online);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LanlogPeer::DATABASE_NAME);

		$criteria->add(LanlogPeer::ID, $this->id);

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

		$copyObj->setWorkstationId($this->workstation_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setIsOnline($this->is_online);


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
			self::$peer = new LanlogPeer();
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
			$v->addLanlog($this);
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

	
	public function setWorkstation(Workstation $v = null)
	{
		if ($v === null) {
			$this->setWorkstationId(NULL);
		} else {
			$this->setWorkstationId($v->getId());
		}

		$this->aWorkstation = $v;

						if ($v !== null) {
			$v->addLanlog($this);
		}

		return $this;
	}


	
	public function getWorkstation(PropelPDO $con = null)
	{
		if ($this->aWorkstation === null && ($this->workstation_id !== null)) {
			$c = new Criteria(WorkstationPeer::DATABASE_NAME);
			$c->add(WorkstationPeer::ID, $this->workstation_id);
			$this->aWorkstation = WorkstationPeer::doSelectOne($c, $con);
			
		}
		return $this->aWorkstation;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->asfGuardUser = null;
			$this->aWorkstation = null;
	}

} 