<?php


abstract class BaseSchoolclass extends BaseObject  implements Persistent {


  const PEER = 'SchoolclassPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $grade;

	
	protected $section;

	
	protected $track_id;

	
	protected $description;

	
	protected $aTrack;

	
	protected $collAppointments;

	
	private $lastAppointmentCriteria = null;

	
	protected $collEnrolments;

	
	private $lastEnrolmentCriteria = null;

	
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

	
	public function getGrade()
	{
		return $this->grade;
	}

	
	public function getSection()
	{
		return $this->section;
	}

	
	public function getTrackId()
	{
		return $this->track_id;
	}

	
	public function getDescription()
	{
		return $this->description;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SchoolclassPeer::ID;
		}

		return $this;
	} 
	
	public function setGrade($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->grade !== $v) {
			$this->grade = $v;
			$this->modifiedColumns[] = SchoolclassPeer::GRADE;
		}

		return $this;
	} 
	
	public function setSection($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->section !== $v) {
			$this->section = $v;
			$this->modifiedColumns[] = SchoolclassPeer::SECTION;
		}

		return $this;
	} 
	
	public function setTrackId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->track_id !== $v) {
			$this->track_id = $v;
			$this->modifiedColumns[] = SchoolclassPeer::TRACK_ID;
		}

		if ($this->aTrack !== null && $this->aTrack->getId() !== $v) {
			$this->aTrack = null;
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
			$this->modifiedColumns[] = SchoolclassPeer::DESCRIPTION;
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

			$this->id = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->grade = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->section = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->track_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->description = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Schoolclass object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTrack !== null && $this->track_id !== $this->aTrack->getId()) {
			$this->aTrack = null;
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
			$con = Propel::getConnection(SchoolclassPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SchoolclassPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTrack = null;
			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

			$this->collEnrolments = null;
			$this->lastEnrolmentCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchoolclassPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SchoolclassPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SchoolclassPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			SchoolclassPeer::addInstanceToPool($this);
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

												
			if ($this->aTrack !== null) {
				if ($this->aTrack->isModified() || $this->aTrack->isNew()) {
					$affectedRows += $this->aTrack->save($con);
				}
				$this->setTrack($this->aTrack);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SchoolclassPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SchoolclassPeer::doUpdate($this, $con);
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


												
			if ($this->aTrack !== null) {
				if (!$this->aTrack->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrack->getValidationFailures());
				}
			}


			if (($retval = SchoolclassPeer::doValidate($this, $columns)) !== true) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchoolclassPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGrade();
				break;
			case 2:
				return $this->getSection();
				break;
			case 3:
				return $this->getTrackId();
				break;
			case 4:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SchoolclassPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGrade(),
			$keys[2] => $this->getSection(),
			$keys[3] => $this->getTrackId(),
			$keys[4] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchoolclassPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setGrade($value);
				break;
			case 2:
				$this->setSection($value);
				break;
			case 3:
				$this->setTrackId($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchoolclassPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGrade($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSection($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTrackId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchoolclassPeer::ID)) $criteria->add(SchoolclassPeer::ID, $this->id);
		if ($this->isColumnModified(SchoolclassPeer::GRADE)) $criteria->add(SchoolclassPeer::GRADE, $this->grade);
		if ($this->isColumnModified(SchoolclassPeer::SECTION)) $criteria->add(SchoolclassPeer::SECTION, $this->section);
		if ($this->isColumnModified(SchoolclassPeer::TRACK_ID)) $criteria->add(SchoolclassPeer::TRACK_ID, $this->track_id);
		if ($this->isColumnModified(SchoolclassPeer::DESCRIPTION)) $criteria->add(SchoolclassPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);

		$criteria->add(SchoolclassPeer::ID, $this->id);

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

		$copyObj->setGrade($this->grade);

		$copyObj->setSection($this->section);

		$copyObj->setTrackId($this->track_id);

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
			self::$peer = new SchoolclassPeer();
		}
		return self::$peer;
	}

	
	public function setTrack(Track $v = null)
	{
		if ($v === null) {
			$this->setTrackId(NULL);
		} else {
			$this->setTrackId($v->getId());
		}

		$this->aTrack = $v;

						if ($v !== null) {
			$v->addSchoolclass($this);
		}

		return $this;
	}


	
	public function getTrack(PropelPDO $con = null)
	{
		if ($this->aTrack === null && ($this->track_id !== null)) {
			$c = new Criteria(TrackPeer::DATABASE_NAME);
			$c->add(TrackPeer::ID, $this->track_id);
			$this->aTrack = TrackPeer::doSelectOne($c, $con);
			
		}
		return $this->aTrack;
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
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

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
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
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

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

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
			$l->setSchoolclass($this);
		}
	}


	
	public function getAppointmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

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
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::SCHOOLCLASS_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
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
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
			   $this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

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
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
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

				$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

				$count = EnrolmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

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
			$l->setSchoolclass($this);
		}
	}


	
	public function getEnrolmentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
	}


	
	public function getEnrolmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SchoolclassPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
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
		} 
		$this->collAppointments = null;
		$this->collEnrolments = null;
			$this->aTrack = null;
	}

} 