<?php


abstract class BaseTrack extends BaseObject  implements Persistent {


  const PEER = 'TrackPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $shortcut;

	
	protected $description;

	
	protected $collSchoolclasss;

	
	private $lastSchoolclassCriteria = null;

	
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

	
	public function getShortcut()
	{
		return $this->shortcut;
	}

	
	public function getDescription()
	{
		return $this->description;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TrackPeer::ID;
		}

		return $this;
	} 
	
	public function setShortcut($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->shortcut !== $v) {
			$this->shortcut = $v;
			$this->modifiedColumns[] = TrackPeer::SHORTCUT;
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
			$this->modifiedColumns[] = TrackPeer::DESCRIPTION;
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
			$this->shortcut = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Track object", $e);
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
			$con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TrackPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collSchoolclasss = null;
			$this->lastSchoolclassCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrackPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TrackPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TrackPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TrackPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collSchoolclasss !== null) {
				foreach ($this->collSchoolclasss as $referrerFK) {
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


			if (($retval = TrackPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSchoolclasss !== null) {
					foreach ($this->collSchoolclasss as $referrerFK) {
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
		$pos = TrackPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getShortcut();
				break;
			case 2:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TrackPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getShortcut(),
			$keys[2] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setShortcut($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrackPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setShortcut($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackPeer::ID)) $criteria->add(TrackPeer::ID, $this->id);
		if ($this->isColumnModified(TrackPeer::SHORTCUT)) $criteria->add(TrackPeer::SHORTCUT, $this->shortcut);
		if ($this->isColumnModified(TrackPeer::DESCRIPTION)) $criteria->add(TrackPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TrackPeer::DATABASE_NAME);

		$criteria->add(TrackPeer::ID, $this->id);

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

		$copyObj->setShortcut($this->shortcut);

		$copyObj->setDescription($this->description);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getSchoolclasss() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addSchoolclass($relObj->copy($deepCopy));
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
			self::$peer = new TrackPeer();
		}
		return self::$peer;
	}

	
	public function clearSchoolclasss()
	{
		$this->collSchoolclasss = null; 	}

	
	public function initSchoolclasss()
	{
		$this->collSchoolclasss = array();
	}

	
	public function getSchoolclasss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchoolclasss === null) {
			if ($this->isNew()) {
			   $this->collSchoolclasss = array();
			} else {

				$criteria->add(SchoolclassPeer::TRACK_ID, $this->id);

				SchoolclassPeer::addSelectColumns($criteria);
				$this->collSchoolclasss = SchoolclassPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SchoolclassPeer::TRACK_ID, $this->id);

				SchoolclassPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchoolclassCriteria) || !$this->lastSchoolclassCriteria->equals($criteria)) {
					$this->collSchoolclasss = SchoolclassPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchoolclassCriteria = $criteria;
		return $this->collSchoolclasss;
	}

	
	public function countSchoolclasss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSchoolclasss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SchoolclassPeer::TRACK_ID, $this->id);

				$count = SchoolclassPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SchoolclassPeer::TRACK_ID, $this->id);

				if (!isset($this->lastSchoolclassCriteria) || !$this->lastSchoolclassCriteria->equals($criteria)) {
					$count = SchoolclassPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSchoolclasss);
				}
			} else {
				$count = count($this->collSchoolclasss);
			}
		}
		$this->lastSchoolclassCriteria = $criteria;
		return $count;
	}

	
	public function addSchoolclass(Schoolclass $l)
	{
		if ($this->collSchoolclasss === null) {
			$this->initSchoolclasss();
		}
		if (!in_array($l, $this->collSchoolclasss, true)) { 			array_push($this->collSchoolclasss, $l);
			$l->setTrack($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collSchoolclasss) {
				foreach ((array) $this->collSchoolclasss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collSchoolclasss = null;
	}

} 