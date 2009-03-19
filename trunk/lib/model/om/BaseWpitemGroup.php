<?php


abstract class BaseWpitemGroup extends BaseObject  implements Persistent {


  const PEER = 'WpitemGroupPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $wpitem_type_id;

	
	protected $wpmodule_id;

	
	protected $aWpitemType;

	
	protected $aWpmodule;

	
	protected $collWpmoduleItems;

	
	private $lastWpmoduleItemCriteria = null;

	
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

	
	public function getWpitemTypeId()
	{
		return $this->wpitem_type_id;
	}

	
	public function getWpmoduleId()
	{
		return $this->wpmodule_id;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpitemGroupPeer::ID;
		}

		return $this;
	} 
	
	public function setWpitemTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wpitem_type_id !== $v) {
			$this->wpitem_type_id = $v;
			$this->modifiedColumns[] = WpitemGroupPeer::WPITEM_TYPE_ID;
		}

		if ($this->aWpitemType !== null && $this->aWpitemType->getId() !== $v) {
			$this->aWpitemType = null;
		}

		return $this;
	} 
	
	public function setWpmoduleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wpmodule_id !== $v) {
			$this->wpmodule_id = $v;
			$this->modifiedColumns[] = WpitemGroupPeer::WPMODULE_ID;
		}

		if ($this->aWpmodule !== null && $this->aWpmodule->getId() !== $v) {
			$this->aWpmodule = null;
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
			$this->wpitem_type_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->wpmodule_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WpitemGroup object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aWpitemType !== null && $this->wpitem_type_id !== $this->aWpitemType->getId()) {
			$this->aWpitemType = null;
		}
		if ($this->aWpmodule !== null && $this->wpmodule_id !== $this->aWpmodule->getId()) {
			$this->aWpmodule = null;
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
			$con = Propel::getConnection(WpitemGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpitemGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aWpitemType = null;
			$this->aWpmodule = null;
			$this->collWpmoduleItems = null;
			$this->lastWpmoduleItemCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpitemGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpitemGroupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WpitemGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpitemGroupPeer::addInstanceToPool($this);
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

												
			if ($this->aWpitemType !== null) {
				if ($this->aWpitemType->isModified() || $this->aWpitemType->isNew()) {
					$affectedRows += $this->aWpitemType->save($con);
				}
				$this->setWpitemType($this->aWpitemType);
			}

			if ($this->aWpmodule !== null) {
				if ($this->aWpmodule->isModified() || $this->aWpmodule->isNew()) {
					$affectedRows += $this->aWpmodule->save($con);
				}
				$this->setWpmodule($this->aWpmodule);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WpitemGroupPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpitemGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpitemGroupPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWpmoduleItems !== null) {
				foreach ($this->collWpmoduleItems as $referrerFK) {
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


												
			if ($this->aWpitemType !== null) {
				if (!$this->aWpitemType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWpitemType->getValidationFailures());
				}
			}

			if ($this->aWpmodule !== null) {
				if (!$this->aWpmodule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWpmodule->getValidationFailures());
				}
			}


			if (($retval = WpitemGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpmoduleItems !== null) {
					foreach ($this->collWpmoduleItems as $referrerFK) {
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
		$pos = WpitemGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWpitemTypeId();
				break;
			case 2:
				return $this->getWpmoduleId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WpitemGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWpitemTypeId(),
			$keys[2] => $this->getWpmoduleId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpitemGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setWpitemTypeId($value);
				break;
			case 2:
				$this->setWpmoduleId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpitemGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWpitemTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWpmoduleId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpitemGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(WpitemGroupPeer::ID)) $criteria->add(WpitemGroupPeer::ID, $this->id);
		if ($this->isColumnModified(WpitemGroupPeer::WPITEM_TYPE_ID)) $criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->wpitem_type_id);
		if ($this->isColumnModified(WpitemGroupPeer::WPMODULE_ID)) $criteria->add(WpitemGroupPeer::WPMODULE_ID, $this->wpmodule_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpitemGroupPeer::DATABASE_NAME);

		$criteria->add(WpitemGroupPeer::ID, $this->id);

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

		$copyObj->setWpitemTypeId($this->wpitem_type_id);

		$copyObj->setWpmoduleId($this->wpmodule_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWpmoduleItems() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpmoduleItem($relObj->copy($deepCopy));
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
			self::$peer = new WpitemGroupPeer();
		}
		return self::$peer;
	}

	
	public function setWpitemType(WpitemType $v = null)
	{
		if ($v === null) {
			$this->setWpitemTypeId(NULL);
		} else {
			$this->setWpitemTypeId($v->getId());
		}

		$this->aWpitemType = $v;

						if ($v !== null) {
			$v->addWpitemGroup($this);
		}

		return $this;
	}


	
	public function getWpitemType(PropelPDO $con = null)
	{
		if ($this->aWpitemType === null && ($this->wpitem_type_id !== null)) {
			$c = new Criteria(WpitemTypePeer::DATABASE_NAME);
			$c->add(WpitemTypePeer::ID, $this->wpitem_type_id);
			$this->aWpitemType = WpitemTypePeer::doSelectOne($c, $con);
			
		}
		return $this->aWpitemType;
	}

	
	public function setWpmodule(Wpmodule $v = null)
	{
		if ($v === null) {
			$this->setWpmoduleId(NULL);
		} else {
			$this->setWpmoduleId($v->getId());
		}

		$this->aWpmodule = $v;

						if ($v !== null) {
			$v->addWpitemGroup($this);
		}

		return $this;
	}


	
	public function getWpmodule(PropelPDO $con = null)
	{
		if ($this->aWpmodule === null && ($this->wpmodule_id !== null)) {
			$c = new Criteria(WpmodulePeer::DATABASE_NAME);
			$c->add(WpmodulePeer::ID, $this->wpmodule_id);
			$this->aWpmodule = WpmodulePeer::doSelectOne($c, $con);
			
		}
		return $this->aWpmodule;
	}

	
	public function clearWpmoduleItems()
	{
		$this->collWpmoduleItems = null; 	}

	
	public function initWpmoduleItems()
	{
		$this->collWpmoduleItems = array();
	}

	
	public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmoduleItems === null) {
			if ($this->isNew()) {
			   $this->collWpmoduleItems = array();
			} else {

				$criteria->add(WpmoduleItemPeer::WPITEM_GROUP_ID, $this->id);

				WpmoduleItemPeer::addSelectColumns($criteria);
				$this->collWpmoduleItems = WpmoduleItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmoduleItemPeer::WPITEM_GROUP_ID, $this->id);

				WpmoduleItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpmoduleItemCriteria) || !$this->lastWpmoduleItemCriteria->equals($criteria)) {
					$this->collWpmoduleItems = WpmoduleItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpmoduleItemCriteria = $criteria;
		return $this->collWpmoduleItems;
	}

	
	public function countWpmoduleItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpmoduleItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpmoduleItemPeer::WPITEM_GROUP_ID, $this->id);

				$count = WpmoduleItemPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmoduleItemPeer::WPITEM_GROUP_ID, $this->id);

				if (!isset($this->lastWpmoduleItemCriteria) || !$this->lastWpmoduleItemCriteria->equals($criteria)) {
					$count = WpmoduleItemPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpmoduleItems);
				}
			} else {
				$count = count($this->collWpmoduleItems);
			}
		}
		$this->lastWpmoduleItemCriteria = $criteria;
		return $count;
	}

	
	public function addWpmoduleItem(WpmoduleItem $l)
	{
		if ($this->collWpmoduleItems === null) {
			$this->initWpmoduleItems();
		}
		if (!in_array($l, $this->collWpmoduleItems, true)) { 			array_push($this->collWpmoduleItems, $l);
			$l->setWpitemGroup($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWpmoduleItems) {
				foreach ((array) $this->collWpmoduleItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWpmoduleItems = null;
			$this->aWpitemType = null;
			$this->aWpmodule = null;
	}

} 