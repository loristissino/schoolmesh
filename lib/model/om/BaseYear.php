<?php


abstract class BaseYear extends BaseObject  implements Persistent {


  const PEER = 'YearPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $description;

	
	protected $collAppointments;

	
	private $lastAppointmentCriteria = null;

	
	protected $collEnrolments;

	
	private $lastEnrolmentCriteria = null;

	
	protected $collWorkplans;

	
	private $lastWorkplanCriteria = null;

	
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = YearPeer::ID;
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
			$this->modifiedColumns[] = YearPeer::DESCRIPTION;
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
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Year object", $e);
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
			$con = Propel::getConnection(YearPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = YearPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

			$this->collEnrolments = null;
			$this->lastEnrolmentCriteria = null;

			$this->collWorkplans = null;
			$this->lastWorkplanCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(YearPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			YearPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(YearPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			YearPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = YearPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += YearPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAppointments !== null) {
				foreach ($this->collAppointments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEnrolments !== null) {
				foreach ($this->collEnrolments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWorkplans !== null) {
				foreach ($this->collWorkplans as $referrerFK) {
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


			if (($retval = YearPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEnrolments !== null) {
					foreach ($this->collEnrolments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWorkplans !== null) {
					foreach ($this->collWorkplans as $referrerFK) {
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
		$pos = YearPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = YearPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = YearPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = YearPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(YearPeer::DATABASE_NAME);

		if ($this->isColumnModified(YearPeer::ID)) $criteria->add(YearPeer::ID, $this->id);
		if ($this->isColumnModified(YearPeer::DESCRIPTION)) $criteria->add(YearPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(YearPeer::DATABASE_NAME);

		$criteria->add(YearPeer::ID, $this->id);

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

		$copyObj->setId($this->id);

		$copyObj->setDescription($this->description);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAppointment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEnrolments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addEnrolment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWorkplans() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWorkplan($relObj->copy($deepCopy));
				}
			}

		} 

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
			self::$peer = new YearPeer();
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
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

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
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
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

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

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
			$l->setYear($this);
		}
	}


	
	public function getAppointmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::YEAR_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}

	
	public function clearEnrolments()
	{
		$this->collEnrolments = null; 	}

	
	public function initEnrolments()
	{
		$this->collEnrolments = array();
	}

	
	public function getEnrolments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
			   $this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
					$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEnrolmentCriteria = $criteria;
		return $this->collEnrolments;
	}

	
	public function countEnrolments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

				$count = EnrolmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

				if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
					$count = EnrolmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collEnrolments);
				}
			} else {
				$count = count($this->collEnrolments);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;
		return $count;
	}

	
	public function addEnrolment(Enrolment $l)
	{
		if ($this->collEnrolments === null) {
			$this->initEnrolments();
		}
		if (!in_array($l, $this->collEnrolments, true)) { 			array_push($this->collEnrolments, $l);
			$l->setYear($this);
		}
	}


	
	public function getEnrolmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
	}


	
	public function getEnrolmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(EnrolmentPeer::YEAR_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
	}

	
	public function clearWorkplans()
	{
		$this->collWorkplans = null; 	}

	
	public function initWorkplans()
	{
		$this->collWorkplans = array();
	}

	
	public function getWorkplans($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
			   $this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				WorkplanPeer::addSelectColumns($criteria);
				$this->collWorkplans = WorkplanPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				WorkplanPeer::addSelectColumns($criteria);
				if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
					$this->collWorkplans = WorkplanPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWorkplanCriteria = $criteria;
		return $this->collWorkplans;
	}

	
	public function countWorkplans(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				$count = WorkplanPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
					$count = WorkplanPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWorkplans);
				}
			} else {
				$count = count($this->collWorkplans);
			}
		}
		$this->lastWorkplanCriteria = $criteria;
		return $count;
	}

	
	public function addWorkplan(Workplan $l)
	{
		if ($this->collWorkplans === null) {
			$this->initWorkplans();
		}
		if (!in_array($l, $this->collWorkplans, true)) { 			array_push($this->collWorkplans, $l);
			$l->setYear($this);
		}
	}


	
	public function getWorkplansJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				$this->collWorkplans = WorkplanPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

			if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
				$this->collWorkplans = WorkplanPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkplanCriteria = $criteria;

		return $this->collWorkplans;
	}


	
	public function getWorkplansJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				$this->collWorkplans = WorkplanPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

			if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
				$this->collWorkplans = WorkplanPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkplanCriteria = $criteria;

		return $this->collWorkplans;
	}


	
	public function getWorkplansJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(YearPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

				$this->collWorkplans = WorkplanPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkplanPeer::YEAR_ID, $this->id);

			if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
				$this->collWorkplans = WorkplanPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkplanCriteria = $criteria;

		return $this->collWorkplans;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAppointments) {
				foreach ((array) $this->collAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEnrolments) {
				foreach ((array) $this->collEnrolments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWorkplans) {
				foreach ((array) $this->collWorkplans as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAppointments = null;
		$this->collEnrolments = null;
		$this->collWorkplans = null;
	}

} 