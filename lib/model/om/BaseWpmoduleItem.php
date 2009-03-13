<?php


abstract class BaseWpmoduleItem extends BaseObject  implements Persistent {


  const PEER = 'WpmoduleItemPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $wpitem_type_id;

	
	protected $wpmodule_id;

	
	protected $rank;

	
	protected $content;

	
	protected $aWpitemType;

	
	protected $aWpmodule;

	
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

	
	public function getRank()
	{
		return $this->rank;
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
			$this->modifiedColumns[] = WpmoduleItemPeer::ID;
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
			$this->modifiedColumns[] = WpmoduleItemPeer::WPITEM_TYPE_ID;
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
			$this->modifiedColumns[] = WpmoduleItemPeer::WPMODULE_ID;
		}

		if ($this->aWpmodule !== null && $this->aWpmodule->getId() !== $v) {
			$this->aWpmodule = null;
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
			$this->modifiedColumns[] = WpmoduleItemPeer::RANK;
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
			$this->modifiedColumns[] = WpmoduleItemPeer::CONTENT;
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
			$this->rank = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->content = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WpmoduleItem object", $e);
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
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpmoduleItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aWpitemType = null;
			$this->aWpmodule = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpmoduleItemPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpmoduleItemPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = WpmoduleItemPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpmoduleItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpmoduleItemPeer::doUpdate($this, $con);
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


			if (($retval = WpmoduleItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpmoduleItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 3:
				return $this->getRank();
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
		$keys = WpmoduleItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWpitemTypeId(),
			$keys[2] => $this->getWpmoduleId(),
			$keys[3] => $this->getRank(),
			$keys[4] => $this->getContent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpmoduleItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 3:
				$this->setRank($value);
				break;
			case 4:
				$this->setContent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpmoduleItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWpitemTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWpmoduleId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpmoduleItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(WpmoduleItemPeer::ID)) $criteria->add(WpmoduleItemPeer::ID, $this->id);
		if ($this->isColumnModified(WpmoduleItemPeer::WPITEM_TYPE_ID)) $criteria->add(WpmoduleItemPeer::WPITEM_TYPE_ID, $this->wpitem_type_id);
		if ($this->isColumnModified(WpmoduleItemPeer::WPMODULE_ID)) $criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->wpmodule_id);
		if ($this->isColumnModified(WpmoduleItemPeer::RANK)) $criteria->add(WpmoduleItemPeer::RANK, $this->rank);
		if ($this->isColumnModified(WpmoduleItemPeer::CONTENT)) $criteria->add(WpmoduleItemPeer::CONTENT, $this->content);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpmoduleItemPeer::DATABASE_NAME);

		$criteria->add(WpmoduleItemPeer::ID, $this->id);

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

		$copyObj->setRank($this->rank);

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
			self::$peer = new WpmoduleItemPeer();
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
			$v->addWpmoduleItem($this);
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
			$v->addWpmoduleItem($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aWpitemType = null;
			$this->aWpmodule = null;
	}

} 