<?php


abstract class BaseWptoolItem extends BaseObject  implements Persistent {


  const PEER = 'WptoolItemPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $description;

	
	protected $wptool_item_type_id;

	
	protected $aWptoolItemType;

	
	protected $collWptoolAppointments;

	
	private $lastWptoolAppointmentCriteria = null;

	
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

	
	public function getDescription()
	{
		return $this->description;
	}

	
	public function getWptoolItemTypeId()
	{
		return $this->wptool_item_type_id;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WptoolItemPeer::ID;
		}

		return $this;
	} 
	
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = WptoolItemPeer::DESCRIPTION;
		}

		return $this;
	} 
	
	public function setWptoolItemTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wptool_item_type_id !== $v) {
			$this->wptool_item_type_id = $v;
			$this->modifiedColumns[] = WptoolItemPeer::WPTOOL_ITEM_TYPE_ID;
		}

		if ($this->aWptoolItemType !== null && $this->aWptoolItemType->getId() !== $v) {
			$this->aWptoolItemType = null;
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
			$this->description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->wptool_item_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WptoolItem object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aWptoolItemType !== null && $this->wptool_item_type_id !== $this->aWptoolItemType->getId()) {
			$this->aWptoolItemType = null;
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
			$con = Propel::getConnection(WptoolItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WptoolItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aWptoolItemType = null;
			$this->collWptoolAppointments = null;
			$this->lastWptoolAppointmentCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WptoolItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WptoolItemPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WptoolItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WptoolItemPeer::addInstanceToPool($this);
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

												
			if ($this->aWptoolItemType !== null) {
				if ($this->aWptoolItemType->isModified() || $this->aWptoolItemType->isNew()) {
					$affectedRows += $this->aWptoolItemType->save($con);
				}
				$this->setWptoolItemType($this->aWptoolItemType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WptoolItemPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WptoolItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WptoolItemPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWptoolAppointments !== null) {
				foreach ($this->collWptoolAppointments as $referrerFK) {
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


												
			if ($this->aWptoolItemType !== null) {
				if (!$this->aWptoolItemType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWptoolItemType->getValidationFailures());
				}
			}


			if (($retval = WptoolItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWptoolAppointments !== null) {
					foreach ($this->collWptoolAppointments as $referrerFK) {
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
		$pos = WptoolItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescription();
				break;
			case 2:
				return $this->getWptoolItemTypeId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WptoolItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getWptoolItemTypeId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WptoolItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDescription($value);
				break;
			case 2:
				$this->setWptoolItemTypeId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WptoolItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWptoolItemTypeId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WptoolItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(WptoolItemPeer::ID)) $criteria->add(WptoolItemPeer::ID, $this->id);
		if ($this->isColumnModified(WptoolItemPeer::DESCRIPTION)) $criteria->add(WptoolItemPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID)) $criteria->add(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID, $this->wptool_item_type_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WptoolItemPeer::DATABASE_NAME);

		$criteria->add(WptoolItemPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setWptoolItemTypeId($this->wptool_item_type_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWptoolAppointments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWptoolAppointment($relObj->copy($deepCopy));
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
			self::$peer = new WptoolItemPeer();
		}
		return self::$peer;
	}

	
	public function setWptoolItemType(WptoolItemType $v = null)
	{
		if ($v === null) {
			$this->setWptoolItemTypeId(NULL);
		} else {
			$this->setWptoolItemTypeId($v->getId());
		}

		$this->aWptoolItemType = $v;

						if ($v !== null) {
			$v->addWptoolItem($this);
		}

		return $this;
	}


	
	public function getWptoolItemType(PropelPDO $con = null)
	{
		if ($this->aWptoolItemType === null && ($this->wptool_item_type_id !== null)) {
			$c = new Criteria(WptoolItemTypePeer::DATABASE_NAME);
			$c->add(WptoolItemTypePeer::ID, $this->wptool_item_type_id);
			$this->aWptoolItemType = WptoolItemTypePeer::doSelectOne($c, $con);
			
		}
		return $this->aWptoolItemType;
	}

	
	public function clearWptoolAppointments()
	{
		$this->collWptoolAppointments = null; 	}

	
	public function initWptoolAppointments()
	{
		$this->collWptoolAppointments = array();
	}

	
	public function getWptoolAppointments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WptoolItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWptoolAppointments === null) {
			if ($this->isNew()) {
			   $this->collWptoolAppointments = array();
			} else {

				$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->id);

				WptoolAppointmentPeer::addSelectColumns($criteria);
				$this->collWptoolAppointments = WptoolAppointmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->id);

				WptoolAppointmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastWptoolAppointmentCriteria) || !$this->lastWptoolAppointmentCriteria->equals($criteria)) {
					$this->collWptoolAppointments = WptoolAppointmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWptoolAppointmentCriteria = $criteria;
		return $this->collWptoolAppointments;
	}

	
	public function countWptoolAppointments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WptoolItemPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWptoolAppointments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->id);

				$count = WptoolAppointmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->id);

				if (!isset($this->lastWptoolAppointmentCriteria) || !$this->lastWptoolAppointmentCriteria->equals($criteria)) {
					$count = WptoolAppointmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWptoolAppointments);
				}
			} else {
				$count = count($this->collWptoolAppointments);
			}
		}
		$this->lastWptoolAppointmentCriteria = $criteria;
		return $count;
	}

	
	public function addWptoolAppointment(WptoolAppointment $l)
	{
		if ($this->collWptoolAppointments === null) {
			$this->initWptoolAppointments();
		}
		if (!in_array($l, $this->collWptoolAppointments, true)) { 			array_push($this->collWptoolAppointments, $l);
			$l->setWptoolItem($this);
		}
	}


	
	public function getWptoolAppointmentsJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WptoolItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWptoolAppointments === null) {
			if ($this->isNew()) {
				$this->collWptoolAppointments = array();
			} else {

				$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->id);

				$this->collWptoolAppointments = WptoolAppointmentPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->id);

			if (!isset($this->lastWptoolAppointmentCriteria) || !$this->lastWptoolAppointmentCriteria->equals($criteria)) {
				$this->collWptoolAppointments = WptoolAppointmentPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		}
		$this->lastWptoolAppointmentCriteria = $criteria;

		return $this->collWptoolAppointments;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWptoolAppointments) {
				foreach ((array) $this->collWptoolAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWptoolAppointments = null;
			$this->aWptoolItemType = null;
	}

} 