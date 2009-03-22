<?php


abstract class BaseWpmoduleItem extends BaseObject  implements Persistent {


  const PEER = 'WpmoduleItemPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $wpitem_group_id;

	
	protected $rank;

	
	protected $content;

	
	protected $evaluation;

	
	protected $aWpitemGroup;

	
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

	
	public function getWpitemGroupId()
	{
		return $this->wpitem_group_id;
	}

	
	public function getRank()
	{
		return $this->rank;
	}

	
	public function getContent()
	{
		return $this->content;
	}

	
	public function getEvaluation()
	{
		return $this->evaluation;
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
	
	public function setWpitemGroupId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wpitem_group_id !== $v) {
			$this->wpitem_group_id = $v;
			$this->modifiedColumns[] = WpmoduleItemPeer::WPITEM_GROUP_ID;
		}

		if ($this->aWpitemGroup !== null && $this->aWpitemGroup->getId() !== $v) {
			$this->aWpitemGroup = null;
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
	
	public function setEvaluation($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation !== $v) {
			$this->evaluation = $v;
			$this->modifiedColumns[] = WpmoduleItemPeer::EVALUATION;
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
			$this->wpitem_group_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->rank = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->content = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->evaluation = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
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

		if ($this->aWpitemGroup !== null && $this->wpitem_group_id !== $this->aWpitemGroup->getId()) {
			$this->aWpitemGroup = null;
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
			$this->aWpitemGroup = null;
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

												
			if ($this->aWpitemGroup !== null) {
				if ($this->aWpitemGroup->isModified() || $this->aWpitemGroup->isNew()) {
					$affectedRows += $this->aWpitemGroup->save($con);
				}
				$this->setWpitemGroup($this->aWpitemGroup);
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


												
			if ($this->aWpitemGroup !== null) {
				if (!$this->aWpitemGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWpitemGroup->getValidationFailures());
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
				return $this->getWpitemGroupId();
				break;
			case 2:
				return $this->getRank();
				break;
			case 3:
				return $this->getContent();
				break;
			case 4:
				return $this->getEvaluation();
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
			$keys[1] => $this->getWpitemGroupId(),
			$keys[2] => $this->getRank(),
			$keys[3] => $this->getContent(),
			$keys[4] => $this->getEvaluation(),
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
				$this->setWpitemGroupId($value);
				break;
			case 2:
				$this->setRank($value);
				break;
			case 3:
				$this->setContent($value);
				break;
			case 4:
				$this->setEvaluation($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpmoduleItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWpitemGroupId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEvaluation($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpmoduleItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(WpmoduleItemPeer::ID)) $criteria->add(WpmoduleItemPeer::ID, $this->id);
		if ($this->isColumnModified(WpmoduleItemPeer::WPITEM_GROUP_ID)) $criteria->add(WpmoduleItemPeer::WPITEM_GROUP_ID, $this->wpitem_group_id);
		if ($this->isColumnModified(WpmoduleItemPeer::RANK)) $criteria->add(WpmoduleItemPeer::RANK, $this->rank);
		if ($this->isColumnModified(WpmoduleItemPeer::CONTENT)) $criteria->add(WpmoduleItemPeer::CONTENT, $this->content);
		if ($this->isColumnModified(WpmoduleItemPeer::EVALUATION)) $criteria->add(WpmoduleItemPeer::EVALUATION, $this->evaluation);

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

		$copyObj->setWpitemGroupId($this->wpitem_group_id);

		$copyObj->setRank($this->rank);

		$copyObj->setContent($this->content);

		$copyObj->setEvaluation($this->evaluation);


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

	
	public function setWpitemGroup(WpitemGroup $v = null)
	{
		if ($v === null) {
			$this->setWpitemGroupId(NULL);
		} else {
			$this->setWpitemGroupId($v->getId());
		}

		$this->aWpitemGroup = $v;

						if ($v !== null) {
			$v->addWpmoduleItem($this);
		}

		return $this;
	}


	
	public function getWpitemGroup(PropelPDO $con = null)
	{
		if ($this->aWpitemGroup === null && ($this->wpitem_group_id !== null)) {
			$c = new Criteria(WpitemGroupPeer::DATABASE_NAME);
			$c->add(WpitemGroupPeer::ID, $this->wpitem_group_id);
			$this->aWpitemGroup = WpitemGroupPeer::doSelectOne($c, $con);
			
		}
		return $this->aWpitemGroup;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aWpitemGroup = null;
	}

} 