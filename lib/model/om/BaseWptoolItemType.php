<?php


abstract class BaseWptoolItemType extends BaseObject  implements Persistent {


  const PEER = 'WptoolItemTypePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $description;

	
	protected $rank;

	
	protected $state;

	
	protected $collWptoolItems;

	
	private $lastWptoolItemCriteria = null;

	
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

	
	public function getRank()
	{
		return $this->rank;
	}

	
	public function getState()
	{
		return $this->state;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WptoolItemTypePeer::ID;
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
			$this->modifiedColumns[] = WptoolItemTypePeer::DESCRIPTION;
		}

		return $this;
	} 
	
	public function setRank($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = WptoolItemTypePeer::RANK;
		}

		return $this;
	} 
	
	public function setState($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = WptoolItemTypePeer::STATE;
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
			$this->rank = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->state = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WptoolItemType object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(WptoolItemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WptoolItemTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collWptoolItems = null;
			$this->lastWptoolItemCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WptoolItemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WptoolItemTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WptoolItemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WptoolItemTypePeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WptoolItemTypePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WptoolItemTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WptoolItemTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWptoolItems !== null) {
				foreach ($this->collWptoolItems as $referrerFK) {
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


			if (($retval = WptoolItemTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWptoolItems !== null) {
					foreach ($this->collWptoolItems as $referrerFK) {
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
		$pos = WptoolItemTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRank();
				break;
			case 3:
				return $this->getState();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WptoolItemTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getRank(),
			$keys[3] => $this->getState(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WptoolItemTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRank($value);
				break;
			case 3:
				$this->setState($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WptoolItemTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setState($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WptoolItemTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(WptoolItemTypePeer::ID)) $criteria->add(WptoolItemTypePeer::ID, $this->id);
		if ($this->isColumnModified(WptoolItemTypePeer::DESCRIPTION)) $criteria->add(WptoolItemTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WptoolItemTypePeer::RANK)) $criteria->add(WptoolItemTypePeer::RANK, $this->rank);
		if ($this->isColumnModified(WptoolItemTypePeer::STATE)) $criteria->add(WptoolItemTypePeer::STATE, $this->state);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WptoolItemTypePeer::DATABASE_NAME);

		$criteria->add(WptoolItemTypePeer::ID, $this->id);

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

		$copyObj->setRank($this->rank);

		$copyObj->setState($this->state);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWptoolItems() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWptoolItem($relObj->copy($deepCopy));
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
			self::$peer = new WptoolItemTypePeer();
		}
		return self::$peer;
	}

	
	public function clearWptoolItems()
	{
		$this->collWptoolItems = null; 	}

	
	public function initWptoolItems()
	{
		$this->collWptoolItems = array();
	}

	
	public function getWptoolItems($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WptoolItemTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWptoolItems === null) {
			if ($this->isNew()) {
			   $this->collWptoolItems = array();
			} else {

				$criteria->add(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID, $this->id);

				WptoolItemPeer::addSelectColumns($criteria);
				$this->collWptoolItems = WptoolItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID, $this->id);

				WptoolItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastWptoolItemCriteria) || !$this->lastWptoolItemCriteria->equals($criteria)) {
					$this->collWptoolItems = WptoolItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWptoolItemCriteria = $criteria;
		return $this->collWptoolItems;
	}

	
	public function countWptoolItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WptoolItemTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWptoolItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID, $this->id);

				$count = WptoolItemPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WptoolItemPeer::WPTOOL_ITEM_TYPE_ID, $this->id);

				if (!isset($this->lastWptoolItemCriteria) || !$this->lastWptoolItemCriteria->equals($criteria)) {
					$count = WptoolItemPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWptoolItems);
				}
			} else {
				$count = count($this->collWptoolItems);
			}
		}
		$this->lastWptoolItemCriteria = $criteria;
		return $count;
	}

	
	public function addWptoolItem(WptoolItem $l)
	{
		if ($this->collWptoolItems === null) {
			$this->initWptoolItems();
		}
		if (!in_array($l, $this->collWptoolItems, true)) { 			array_push($this->collWptoolItems, $l);
			$l->setWptoolItemType($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWptoolItems) {
				foreach ((array) $this->collWptoolItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWptoolItems = null;
	}

} 