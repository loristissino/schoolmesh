<?php


abstract class BaseWorkplan extends BaseObject  implements Persistent {


  const PEER = 'WorkplanPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $user_id;

	
	protected $year_id;

	
	protected $schoolclass_id;

	
	protected $subject_id;

	
	protected $asfGuardUser;

	
	protected $aYear;

	
	protected $aSchoolclass;

	
	protected $aSubject;

	
	protected $collWpevents;

	
	private $lastWpeventCriteria = null;

	
	protected $collWpmodules;

	
	private $lastWpmoduleCriteria = null;

	
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

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getYearId()
	{
		return $this->year_id;
	}

	
	public function getSchoolclassId()
	{
		return $this->schoolclass_id;
	}

	
	public function getSubjectId()
	{
		return $this->subject_id;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WorkplanPeer::ID;
		}

		return $this;
	} 
	
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setYearId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->year_id !== $v) {
			$this->year_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::YEAR_ID;
		}

		if ($this->aYear !== null && $this->aYear->getId() !== $v) {
			$this->aYear = null;
		}

		return $this;
	} 
	
	public function setSchoolclassId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->schoolclass_id !== $v) {
			$this->schoolclass_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::SCHOOLCLASS_ID;
		}

		if ($this->aSchoolclass !== null && $this->aSchoolclass->getId() !== $v) {
			$this->aSchoolclass = null;
		}

		return $this;
	} 
	
	public function setSubjectId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->subject_id !== $v) {
			$this->subject_id = $v;
			$this->modifiedColumns[] = WorkplanPeer::SUBJECT_ID;
		}

		if ($this->aSubject !== null && $this->aSubject->getId() !== $v) {
			$this->aSubject = null;
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
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->year_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->schoolclass_id = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->subject_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Workplan object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aYear !== null && $this->year_id !== $this->aYear->getId()) {
			$this->aYear = null;
		}
		if ($this->aSchoolclass !== null && $this->schoolclass_id !== $this->aSchoolclass->getId()) {
			$this->aSchoolclass = null;
		}
		if ($this->aSubject !== null && $this->subject_id !== $this->aSubject->getId()) {
			$this->aSubject = null;
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
			$con = Propel::getConnection(WorkplanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WorkplanPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->aYear = null;
			$this->aSchoolclass = null;
			$this->aSubject = null;
			$this->collWpevents = null;
			$this->lastWpeventCriteria = null;

			$this->collWpmodules = null;
			$this->lastWpmoduleCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkplanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WorkplanPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WorkplanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WorkplanPeer::addInstanceToPool($this);
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

												
			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aYear !== null) {
				if ($this->aYear->isModified() || $this->aYear->isNew()) {
					$affectedRows += $this->aYear->save($con);
				}
				$this->setYear($this->aYear);
			}

			if ($this->aSchoolclass !== null) {
				if ($this->aSchoolclass->isModified() || $this->aSchoolclass->isNew()) {
					$affectedRows += $this->aSchoolclass->save($con);
				}
				$this->setSchoolclass($this->aSchoolclass);
			}

			if ($this->aSubject !== null) {
				if ($this->aSubject->isModified() || $this->aSubject->isNew()) {
					$affectedRows += $this->aSubject->save($con);
				}
				$this->setSubject($this->aSubject);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WorkplanPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkplanPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WorkplanPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWpevents !== null) {
				foreach ($this->collWpevents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWpmodules !== null) {
				foreach ($this->collWpmodules as $referrerFK) {
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


												
			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aYear !== null) {
				if (!$this->aYear->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aYear->getValidationFailures());
				}
			}

			if ($this->aSchoolclass !== null) {
				if (!$this->aSchoolclass->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchoolclass->getValidationFailures());
				}
			}

			if ($this->aSubject !== null) {
				if (!$this->aSubject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSubject->getValidationFailures());
				}
			}


			if (($retval = WorkplanPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpevents !== null) {
					foreach ($this->collWpevents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWpmodules !== null) {
					foreach ($this->collWpmodules as $referrerFK) {
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
		$pos = WorkplanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 2:
				return $this->getYearId();
				break;
			case 3:
				return $this->getSchoolclassId();
				break;
			case 4:
				return $this->getSubjectId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WorkplanPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getYearId(),
			$keys[3] => $this->getSchoolclassId(),
			$keys[4] => $this->getSubjectId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkplanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setYearId($value);
				break;
			case 3:
				$this->setSchoolclassId($value);
				break;
			case 4:
				$this->setSubjectId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkplanPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setYearId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSchoolclassId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSubjectId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkplanPeer::ID)) $criteria->add(WorkplanPeer::ID, $this->id);
		if ($this->isColumnModified(WorkplanPeer::USER_ID)) $criteria->add(WorkplanPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(WorkplanPeer::YEAR_ID)) $criteria->add(WorkplanPeer::YEAR_ID, $this->year_id);
		if ($this->isColumnModified(WorkplanPeer::SCHOOLCLASS_ID)) $criteria->add(WorkplanPeer::SCHOOLCLASS_ID, $this->schoolclass_id);
		if ($this->isColumnModified(WorkplanPeer::SUBJECT_ID)) $criteria->add(WorkplanPeer::SUBJECT_ID, $this->subject_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);

		$criteria->add(WorkplanPeer::ID, $this->id);

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

		$copyObj->setUserId($this->user_id);

		$copyObj->setYearId($this->year_id);

		$copyObj->setSchoolclassId($this->schoolclass_id);

		$copyObj->setSubjectId($this->subject_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWpevents() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpevent($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpmodules() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpmodule($relObj->copy($deepCopy));
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
			self::$peer = new WorkplanPeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUser = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->user_id);
			$this->asfGuardUser = sfGuardUserPeer::doSelectOne($c, $con);
			
		}
		return $this->asfGuardUser;
	}

	
	public function setYear(Year $v = null)
	{
		if ($v === null) {
			$this->setYearId(NULL);
		} else {
			$this->setYearId($v->getId());
		}

		$this->aYear = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getYear(PropelPDO $con = null)
	{
		if ($this->aYear === null && ($this->year_id !== null)) {
			$c = new Criteria(YearPeer::DATABASE_NAME);
			$c->add(YearPeer::ID, $this->year_id);
			$this->aYear = YearPeer::doSelectOne($c, $con);
			
		}
		return $this->aYear;
	}

	
	public function setSchoolclass(Schoolclass $v = null)
	{
		if ($v === null) {
			$this->setSchoolclassId(NULL);
		} else {
			$this->setSchoolclassId($v->getId());
		}

		$this->aSchoolclass = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getSchoolclass(PropelPDO $con = null)
	{
		if ($this->aSchoolclass === null && (($this->schoolclass_id !== "" && $this->schoolclass_id !== null))) {
			$c = new Criteria(SchoolclassPeer::DATABASE_NAME);
			$c->add(SchoolclassPeer::ID, $this->schoolclass_id);
			$this->aSchoolclass = SchoolclassPeer::doSelectOne($c, $con);
			
		}
		return $this->aSchoolclass;
	}

	
	public function setSubject(Subject $v = null)
	{
		if ($v === null) {
			$this->setSubjectId(NULL);
		} else {
			$this->setSubjectId($v->getId());
		}

		$this->aSubject = $v;

						if ($v !== null) {
			$v->addWorkplan($this);
		}

		return $this;
	}


	
	public function getSubject(PropelPDO $con = null)
	{
		if ($this->aSubject === null && ($this->subject_id !== null)) {
			$c = new Criteria(SubjectPeer::DATABASE_NAME);
			$c->add(SubjectPeer::ID, $this->subject_id);
			$this->aSubject = SubjectPeer::doSelectOne($c, $con);
			
		}
		return $this->aSubject;
	}

	
	public function clearWpevents()
	{
		$this->collWpevents = null; 	}

	
	public function initWpevents()
	{
		$this->collWpevents = array();
	}

	
	public function getWpevents($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpevents === null) {
			if ($this->isNew()) {
			   $this->collWpevents = array();
			} else {

				$criteria->add(WpeventPeer::WORKPLAN_ID, $this->id);

				WpeventPeer::addSelectColumns($criteria);
				$this->collWpevents = WpeventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpeventPeer::WORKPLAN_ID, $this->id);

				WpeventPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpeventCriteria) || !$this->lastWpeventCriteria->equals($criteria)) {
					$this->collWpevents = WpeventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpeventCriteria = $criteria;
		return $this->collWpevents;
	}

	
	public function countWpevents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpevents === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpeventPeer::WORKPLAN_ID, $this->id);

				$count = WpeventPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpeventPeer::WORKPLAN_ID, $this->id);

				if (!isset($this->lastWpeventCriteria) || !$this->lastWpeventCriteria->equals($criteria)) {
					$count = WpeventPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpevents);
				}
			} else {
				$count = count($this->collWpevents);
			}
		}
		$this->lastWpeventCriteria = $criteria;
		return $count;
	}

	
	public function addWpevent(Wpevent $l)
	{
		if ($this->collWpevents === null) {
			$this->initWpevents();
		}
		if (!in_array($l, $this->collWpevents, true)) { 			array_push($this->collWpevents, $l);
			$l->setWorkplan($this);
		}
	}


	
	public function getWpeventsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpevents === null) {
			if ($this->isNew()) {
				$this->collWpevents = array();
			} else {

				$criteria->add(WpeventPeer::WORKPLAN_ID, $this->id);

				$this->collWpevents = WpeventPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpeventPeer::WORKPLAN_ID, $this->id);

			if (!isset($this->lastWpeventCriteria) || !$this->lastWpeventCriteria->equals($criteria)) {
				$this->collWpevents = WpeventPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpeventCriteria = $criteria;

		return $this->collWpevents;
	}

	
	public function clearWpmodules()
	{
		$this->collWpmodules = null; 	}

	
	public function initWpmodules()
	{
		$this->collWpmodules = array();
	}

	
	public function getWpmodules($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
			   $this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::WORKPLAN_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmodulePeer::WORKPLAN_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpmoduleCriteria = $criteria;
		return $this->collWpmodules;
	}

	
	public function countWpmodules(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpmodulePeer::WORKPLAN_ID, $this->id);

				$count = WpmodulePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmodulePeer::WORKPLAN_ID, $this->id);

				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$count = WpmodulePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpmodules);
				}
			} else {
				$count = count($this->collWpmodules);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;
		return $count;
	}

	
	public function addWpmodule(Wpmodule $l)
	{
		if ($this->collWpmodules === null) {
			$this->initWpmodules();
		}
		if (!in_array($l, $this->collWpmodules, true)) { 			array_push($this->collWpmodules, $l);
			$l->setWorkplan($this);
		}
	}


	
	public function getWpmodulesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkplanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::WORKPLAN_ID, $this->id);

				$this->collWpmodules = WpmodulePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpmodulePeer::WORKPLAN_ID, $this->id);

			if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
				$this->collWpmodules = WpmodulePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;

		return $this->collWpmodules;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWpevents) {
				foreach ((array) $this->collWpevents as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpmodules) {
				foreach ((array) $this->collWpmodules as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWpevents = null;
		$this->collWpmodules = null;
			$this->asfGuardUser = null;
			$this->aYear = null;
			$this->aSchoolclass = null;
			$this->aSubject = null;
	}

} 