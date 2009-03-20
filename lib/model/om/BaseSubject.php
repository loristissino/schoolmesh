<?php


abstract class BaseSubject extends BaseObject  implements Persistent {


  const PEER = 'SubjectPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $shortcut;

	
	protected $description;

	
	protected $rank;

	
	protected $collAppointments;

	
	private $lastAppointmentCriteria = null;

	
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

	
	public function getRank()
	{
		return $this->rank;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SubjectPeer::ID;
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
			$this->modifiedColumns[] = SubjectPeer::SHORTCUT;
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
			$this->modifiedColumns[] = SubjectPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = SubjectPeer::RANK;
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
			$this->rank = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Subject object", $e);
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
			$con = Propel::getConnection(SubjectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SubjectPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SubjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SubjectPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SubjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			SubjectPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = SubjectPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SubjectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SubjectPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAppointments !== null) {
				foreach ($this->collAppointments as $referrerFK) {
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


			if (($retval = SubjectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
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
		$pos = SubjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 3:
				return $this->getRank();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SubjectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getShortcut(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getRank(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SubjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 3:
				$this->setRank($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SubjectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setShortcut($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SubjectPeer::DATABASE_NAME);

		if ($this->isColumnModified(SubjectPeer::ID)) $criteria->add(SubjectPeer::ID, $this->id);
		if ($this->isColumnModified(SubjectPeer::SHORTCUT)) $criteria->add(SubjectPeer::SHORTCUT, $this->shortcut);
		if ($this->isColumnModified(SubjectPeer::DESCRIPTION)) $criteria->add(SubjectPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SubjectPeer::RANK)) $criteria->add(SubjectPeer::RANK, $this->rank);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SubjectPeer::DATABASE_NAME);

		$criteria->add(SubjectPeer::ID, $this->id);

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

		$copyObj->setRank($this->rank);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAppointment($relObj->copy($deepCopy));
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
			self::$peer = new SubjectPeer();
		}
		return self::$peer;
	}

	
	public function clearAppointments()
	{
		$this->collAppointments = null; 	}

	
	public function initAppointments()
	{
		$this->collAppointments = array();
	}

	
	public function getAppointments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAppointmentCriteria = $criteria;
		return $this->collAppointments;
	}

	
	public function countAppointments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubjectPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$count = AppointmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAppointments);
				}
			} else {
				$count = count($this->collAppointments);
			}
		}
		$this->lastAppointmentCriteria = $criteria;
		return $count;
	}

	
	public function addAppointment(Appointment $l)
	{
		if ($this->collAppointments === null) {
			$this->initAppointments();
		}
		if (!in_array($l, $this->collAppointments, true)) { 			array_push($this->collAppointments, $l);
			$l->setSubject($this);
		}
	}


	
	public function getAppointmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::SUBJECT_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAppointments) {
				foreach ((array) $this->collAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAppointments = null;
	}

} 