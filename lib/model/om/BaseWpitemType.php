<?php


abstract class BaseWpitemType extends BaseObject  implements Persistent {


  const PEER = 'WpitemTypePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $title;

	
	protected $description;

	
	protected $rank;

	
	protected $state;

	
	protected $evaluation_min;

	
	protected $evaluation_max;

	
	protected $evaluation_min_description;

	
	protected $evaluation_max_description;

	
	protected $collWpitemGroups;

	
	private $lastWpitemGroupCriteria = null;

	
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

	
	public function getTitle()
	{
		return $this->title;
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

	
	public function getEvaluationMin()
	{
		return $this->evaluation_min;
	}

	
	public function getEvaluationMax()
	{
		return $this->evaluation_max;
	}

	
	public function getEvaluationMinDescription()
	{
		return $this->evaluation_min_description;
	}

	
	public function getEvaluationMaxDescription()
	{
		return $this->evaluation_max_description;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpitemTypePeer::ID;
		}

		return $this;
	} 
	
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = WpitemTypePeer::TITLE;
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
			$this->modifiedColumns[] = WpitemTypePeer::DESCRIPTION;
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
			$this->modifiedColumns[] = WpitemTypePeer::RANK;
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
			$this->modifiedColumns[] = WpitemTypePeer::STATE;
		}

		return $this;
	} 
	
	public function setEvaluationMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation_min !== $v) {
			$this->evaluation_min = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MIN;
		}

		return $this;
	} 
	
	public function setEvaluationMax($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->evaluation_max !== $v) {
			$this->evaluation_max = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MAX;
		}

		return $this;
	} 
	
	public function setEvaluationMinDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->evaluation_min_description !== $v) {
			$this->evaluation_min_description = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MIN_DESCRIPTION;
		}

		return $this;
	} 
	
	public function setEvaluationMaxDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->evaluation_max_description !== $v) {
			$this->evaluation_max_description = $v;
			$this->modifiedColumns[] = WpitemTypePeer::EVALUATION_MAX_DESCRIPTION;
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
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->rank = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->state = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->evaluation_min = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->evaluation_max = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->evaluation_min_description = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->evaluation_max_description = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WpitemType object", $e);
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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpitemTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collWpitemGroups = null;
			$this->lastWpitemGroupCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpitemTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WpitemTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpitemTypePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = WpitemTypePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpitemTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpitemTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWpitemGroups !== null) {
				foreach ($this->collWpitemGroups as $referrerFK) {
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


			if (($retval = WpitemTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpitemGroups !== null) {
					foreach ($this->collWpitemGroups as $referrerFK) {
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
		$pos = WpitemTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getRank();
				break;
			case 4:
				return $this->getState();
				break;
			case 5:
				return $this->getEvaluationMin();
				break;
			case 6:
				return $this->getEvaluationMax();
				break;
			case 7:
				return $this->getEvaluationMinDescription();
				break;
			case 8:
				return $this->getEvaluationMaxDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WpitemTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getRank(),
			$keys[4] => $this->getState(),
			$keys[5] => $this->getEvaluationMin(),
			$keys[6] => $this->getEvaluationMax(),
			$keys[7] => $this->getEvaluationMinDescription(),
			$keys[8] => $this->getEvaluationMaxDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpitemTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setRank($value);
				break;
			case 4:
				$this->setState($value);
				break;
			case 5:
				$this->setEvaluationMin($value);
				break;
			case 6:
				$this->setEvaluationMax($value);
				break;
			case 7:
				$this->setEvaluationMinDescription($value);
				break;
			case 8:
				$this->setEvaluationMaxDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpitemTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setState($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEvaluationMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEvaluationMax($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEvaluationMinDescription($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEvaluationMaxDescription($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(WpitemTypePeer::ID)) $criteria->add(WpitemTypePeer::ID, $this->id);
		if ($this->isColumnModified(WpitemTypePeer::TITLE)) $criteria->add(WpitemTypePeer::TITLE, $this->title);
		if ($this->isColumnModified(WpitemTypePeer::DESCRIPTION)) $criteria->add(WpitemTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WpitemTypePeer::RANK)) $criteria->add(WpitemTypePeer::RANK, $this->rank);
		if ($this->isColumnModified(WpitemTypePeer::STATE)) $criteria->add(WpitemTypePeer::STATE, $this->state);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MIN)) $criteria->add(WpitemTypePeer::EVALUATION_MIN, $this->evaluation_min);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MAX)) $criteria->add(WpitemTypePeer::EVALUATION_MAX, $this->evaluation_max);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MIN_DESCRIPTION)) $criteria->add(WpitemTypePeer::EVALUATION_MIN_DESCRIPTION, $this->evaluation_min_description);
		if ($this->isColumnModified(WpitemTypePeer::EVALUATION_MAX_DESCRIPTION)) $criteria->add(WpitemTypePeer::EVALUATION_MAX_DESCRIPTION, $this->evaluation_max_description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);

		$criteria->add(WpitemTypePeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setRank($this->rank);

		$copyObj->setState($this->state);

		$copyObj->setEvaluationMin($this->evaluation_min);

		$copyObj->setEvaluationMax($this->evaluation_max);

		$copyObj->setEvaluationMinDescription($this->evaluation_min_description);

		$copyObj->setEvaluationMaxDescription($this->evaluation_max_description);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWpitemGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpitemGroup($relObj->copy($deepCopy));
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
			self::$peer = new WpitemTypePeer();
		}
		return self::$peer;
	}

	
	public function clearWpitemGroups()
	{
		$this->collWpitemGroups = null; 	}

	
	public function initWpitemGroups()
	{
		$this->collWpitemGroups = array();
	}

	
	public function getWpitemGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpitemGroups === null) {
			if ($this->isNew()) {
			   $this->collWpitemGroups = array();
			} else {

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				WpitemGroupPeer::addSelectColumns($criteria);
				$this->collWpitemGroups = WpitemGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				WpitemGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpitemGroupCriteria) || !$this->lastWpitemGroupCriteria->equals($criteria)) {
					$this->collWpitemGroups = WpitemGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpitemGroupCriteria = $criteria;
		return $this->collWpitemGroups;
	}

	
	public function countWpitemGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpitemGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				$count = WpitemGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				if (!isset($this->lastWpitemGroupCriteria) || !$this->lastWpitemGroupCriteria->equals($criteria)) {
					$count = WpitemGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpitemGroups);
				}
			} else {
				$count = count($this->collWpitemGroups);
			}
		}
		$this->lastWpitemGroupCriteria = $criteria;
		return $count;
	}

	
	public function addWpitemGroup(WpitemGroup $l)
	{
		if ($this->collWpitemGroups === null) {
			$this->initWpitemGroups();
		}
		if (!in_array($l, $this->collWpitemGroups, true)) { 			array_push($this->collWpitemGroups, $l);
			$l->setWpitemType($this);
		}
	}


	
	public function getWpitemGroupsJoinWpmodule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpitemTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpitemGroups === null) {
			if ($this->isNew()) {
				$this->collWpitemGroups = array();
			} else {

				$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

				$this->collWpitemGroups = WpitemGroupPeer::doSelectJoinWpmodule($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpitemGroupPeer::WPITEM_TYPE_ID, $this->id);

			if (!isset($this->lastWpitemGroupCriteria) || !$this->lastWpitemGroupCriteria->equals($criteria)) {
				$this->collWpitemGroups = WpitemGroupPeer::doSelectJoinWpmodule($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpitemGroupCriteria = $criteria;

		return $this->collWpitemGroups;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWpitemGroups) {
				foreach ((array) $this->collWpitemGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWpitemGroups = null;
	}

} 