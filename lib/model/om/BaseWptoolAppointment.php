<?php


abstract class BaseWptoolAppointment extends BaseObject  implements Persistent {


  const PEER = 'WptoolAppointmentPeer';

	
	protected static $peer;

	
	protected $appointment_id;

	
	protected $wptool_item_id;

	
	protected $aAppointment;

	
	protected $aWptoolItem;

	
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

	
	public function getAppointmentId()
	{
		return $this->appointment_id;
	}

	
	public function getWptoolItemId()
	{
		return $this->wptool_item_id;
	}

	
	public function setAppointmentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->appointment_id !== $v) {
			$this->appointment_id = $v;
			$this->modifiedColumns[] = WptoolAppointmentPeer::APPOINTMENT_ID;
		}

		if ($this->aAppointment !== null && $this->aAppointment->getId() !== $v) {
			$this->aAppointment = null;
		}

		return $this;
	} 
	
	public function setWptoolItemId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wptool_item_id !== $v) {
			$this->wptool_item_id = $v;
			$this->modifiedColumns[] = WptoolAppointmentPeer::WPTOOL_ITEM_ID;
		}

		if ($this->aWptoolItem !== null && $this->aWptoolItem->getId() !== $v) {
			$this->aWptoolItem = null;
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

			$this->appointment_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->wptool_item_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WptoolAppointment object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAppointment !== null && $this->appointment_id !== $this->aAppointment->getId()) {
			$this->aAppointment = null;
		}
		if ($this->aWptoolItem !== null && $this->wptool_item_id !== $this->aWptoolItem->getId()) {
			$this->aWptoolItem = null;
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
			$con = Propel::getConnection(WptoolAppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WptoolAppointmentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aAppointment = null;
			$this->aWptoolItem = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WptoolAppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WptoolAppointmentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WptoolAppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WptoolAppointmentPeer::addInstanceToPool($this);
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

			if ($this->aWptoolItem !== null) {
				if ($this->aWptoolItem->isModified() || $this->aWptoolItem->isNew()) {
					$affectedRows += $this->aWptoolItem->save($con);
				}
				$this->setWptoolItem($this->aWptoolItem);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WptoolAppointmentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += WptoolAppointmentPeer::doUpdate($this, $con);
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

			if ($this->aWptoolItem !== null) {
				if (!$this->aWptoolItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWptoolItem->getValidationFailures());
				}
			}


			if (($retval = WptoolAppointmentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WptoolAppointmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getAppointmentId();
				break;
			case 1:
				return $this->getWptoolItemId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WptoolAppointmentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getAppointmentId(),
			$keys[1] => $this->getWptoolItemId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WptoolAppointmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setAppointmentId($value);
				break;
			case 1:
				$this->setWptoolItemId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WptoolAppointmentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setAppointmentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWptoolItemId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WptoolAppointmentPeer::DATABASE_NAME);

		if ($this->isColumnModified(WptoolAppointmentPeer::APPOINTMENT_ID)) $criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->appointment_id);
		if ($this->isColumnModified(WptoolAppointmentPeer::WPTOOL_ITEM_ID)) $criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->wptool_item_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WptoolAppointmentPeer::DATABASE_NAME);

		$criteria->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->appointment_id);
		$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->wptool_item_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getAppointmentId();

		$pks[1] = $this->getWptoolItemId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setAppointmentId($keys[0]);

		$this->setWptoolItemId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setAppointmentId($this->appointment_id);

		$copyObj->setWptoolItemId($this->wptool_item_id);


		$copyObj->setNew(true);

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
			self::$peer = new WptoolAppointmentPeer();
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
			$v->addWptoolAppointment($this);
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

	
	public function setWptoolItem(WptoolItem $v = null)
	{
		if ($v === null) {
			$this->setWptoolItemId(NULL);
		} else {
			$this->setWptoolItemId($v->getId());
		}

		$this->aWptoolItem = $v;

						if ($v !== null) {
			$v->addWptoolAppointment($this);
		}

		return $this;
	}


	
	public function getWptoolItem(PropelPDO $con = null)
	{
		if ($this->aWptoolItem === null && ($this->wptool_item_id !== null)) {
			$c = new Criteria(WptoolItemPeer::DATABASE_NAME);
			$c->add(WptoolItemPeer::ID, $this->wptool_item_id);
			$this->aWptoolItem = WptoolItemPeer::doSelectOne($c, $con);
			
		}
		return $this->aWptoolItem;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aAppointment = null;
			$this->aWptoolItem = null;
	}

} 