<?php


abstract class BaseWpinfoType extends BaseObject  implements Persistent {


  const PEER = 'WpinfoTypePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $title;

	
	protected $description;

	
	protected $rank;

	
	protected $state;

	
	protected $collWpinfos;

	
	private $lastWpinfoCriteria = null;

	
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpinfoTypePeer::ID;
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
			$this->modifiedColumns[] = WpinfoTypePeer::TITLE;
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
			$this->modifiedColumns[] = WpinfoTypePeer::DESCRIPTION;
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
			$this->modifiedColumns[] = WpinfoTypePeer::RANK;
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
			$this->modifiedColumns[] = WpinfoTypePeer::STATE;
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
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WpinfoType object", $e);
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
			$con = Propel::getConnection(WpinfoTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpinfoTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collWpinfos = null;
			$this->lastWpinfoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpinfoTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpinfoTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WpinfoTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpinfoTypePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = WpinfoTypePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpinfoTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpinfoTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWpinfos !== null) {
				foreach ($this->collWpinfos as $referrerFK) {
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


			if (($retval = WpinfoTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpinfos !== null) {
					foreach ($this->collWpinfos as $referrerFK) {
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
		$pos = WpinfoTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WpinfoTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getRank(),
			$keys[4] => $this->getState(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpinfoTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpinfoTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setState($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpinfoTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(WpinfoTypePeer::ID)) $criteria->add(WpinfoTypePeer::ID, $this->id);
		if ($this->isColumnModified(WpinfoTypePeer::TITLE)) $criteria->add(WpinfoTypePeer::TITLE, $this->title);
		if ($this->isColumnModified(WpinfoTypePeer::DESCRIPTION)) $criteria->add(WpinfoTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WpinfoTypePeer::RANK)) $criteria->add(WpinfoTypePeer::RANK, $this->rank);
		if ($this->isColumnModified(WpinfoTypePeer::STATE)) $criteria->add(WpinfoTypePeer::STATE, $this->state);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpinfoTypePeer::DATABASE_NAME);

		$criteria->add(WpinfoTypePeer::ID, $this->id);

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


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWpinfos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpinfo($relObj->copy($deepCopy));
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
			self::$peer = new WpinfoTypePeer();
		}
		return self::$peer;
	}

	
	public function clearWpinfos()
	{
		$this->collWpinfos = null; 	}

	
	public function initWpinfos()
	{
		$this->collWpinfos = array();
	}

	
	public function getWpinfos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpinfoTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpinfos === null) {
			if ($this->isNew()) {
			   $this->collWpinfos = array();
			} else {

				$criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->id);

				WpinfoPeer::addSelectColumns($criteria);
				$this->collWpinfos = WpinfoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->id);

				WpinfoPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpinfoCriteria) || !$this->lastWpinfoCriteria->equals($criteria)) {
					$this->collWpinfos = WpinfoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpinfoCriteria = $criteria;
		return $this->collWpinfos;
	}

	
	public function countWpinfos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpinfoTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpinfos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->id);

				$count = WpinfoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->id);

				if (!isset($this->lastWpinfoCriteria) || !$this->lastWpinfoCriteria->equals($criteria)) {
					$count = WpinfoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpinfos);
				}
			} else {
				$count = count($this->collWpinfos);
			}
		}
		$this->lastWpinfoCriteria = $criteria;
		return $count;
	}

	
	public function addWpinfo(Wpinfo $l)
	{
		if ($this->collWpinfos === null) {
			$this->initWpinfos();
		}
		if (!in_array($l, $this->collWpinfos, true)) { 			array_push($this->collWpinfos, $l);
			$l->setWpinfoType($this);
		}
	}


	
	public function getWpinfosJoinAppointment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpinfoTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpinfos === null) {
			if ($this->isNew()) {
				$this->collWpinfos = array();
			} else {

				$criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->id);

				$this->collWpinfos = WpinfoPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpinfoPeer::WPINFO_TYPE_ID, $this->id);

			if (!isset($this->lastWpinfoCriteria) || !$this->lastWpinfoCriteria->equals($criteria)) {
				$this->collWpinfos = WpinfoPeer::doSelectJoinAppointment($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpinfoCriteria = $criteria;

		return $this->collWpinfos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWpinfos) {
				foreach ((array) $this->collWpinfos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWpinfos = null;
	}

} 