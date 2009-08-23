<?php


abstract class BaseRole extends BaseObject  implements Persistent {


  const PEER = 'RolePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $male_description;

	
	protected $female_description;

	
	protected $quality_code;

	
	protected $posix_name;

	
	protected $may_be_main_role;

	
	protected $default_guardgroup;

	
	protected $collsfGuardUserProfiles;

	
	private $lastsfGuardUserProfileCriteria = null;

	
	protected $collUserTeams;

	
	private $lastUserTeamCriteria = null;

	
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

	
	public function getMaleDescription()
	{
		return $this->male_description;
	}

	
	public function getFemaleDescription()
	{
		return $this->female_description;
	}

	
	public function getQualityCode()
	{
		return $this->quality_code;
	}

	
	public function getPosixName()
	{
		return $this->posix_name;
	}

	
	public function getMayBeMainRole()
	{
		return $this->may_be_main_role;
	}

	
	public function getDefaultGuardgroup()
	{
		return $this->default_guardgroup;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RolePeer::ID;
		}

		return $this;
	} 
	
	public function setMaleDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->male_description !== $v) {
			$this->male_description = $v;
			$this->modifiedColumns[] = RolePeer::MALE_DESCRIPTION;
		}

		return $this;
	} 
	
	public function setFemaleDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->female_description !== $v) {
			$this->female_description = $v;
			$this->modifiedColumns[] = RolePeer::FEMALE_DESCRIPTION;
		}

		return $this;
	} 
	
	public function setQualityCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->quality_code !== $v) {
			$this->quality_code = $v;
			$this->modifiedColumns[] = RolePeer::QUALITY_CODE;
		}

		return $this;
	} 
	
	public function setPosixName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->posix_name !== $v) {
			$this->posix_name = $v;
			$this->modifiedColumns[] = RolePeer::POSIX_NAME;
		}

		return $this;
	} 
	
	public function setMayBeMainRole($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->may_be_main_role !== $v) {
			$this->may_be_main_role = $v;
			$this->modifiedColumns[] = RolePeer::MAY_BE_MAIN_ROLE;
		}

		return $this;
	} 
	
	public function setDefaultGuardgroup($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->default_guardgroup !== $v) {
			$this->default_guardgroup = $v;
			$this->modifiedColumns[] = RolePeer::DEFAULT_GUARDGROUP;
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
			$this->male_description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->female_description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->quality_code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->posix_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->may_be_main_role = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->default_guardgroup = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Role object", $e);
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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RolePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collsfGuardUserProfiles = null;
			$this->lastsfGuardUserProfileCriteria = null;

			$this->collUserTeams = null;
			$this->lastUserTeamCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RolePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RolePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			RolePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = RolePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RolePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RolePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collsfGuardUserProfiles !== null) {
				foreach ($this->collsfGuardUserProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserTeams !== null) {
				foreach ($this->collUserTeams as $referrerFK) {
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


			if (($retval = RolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserProfiles !== null) {
					foreach ($this->collsfGuardUserProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserTeams !== null) {
					foreach ($this->collUserTeams as $referrerFK) {
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
		$pos = RolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMaleDescription();
				break;
			case 2:
				return $this->getFemaleDescription();
				break;
			case 3:
				return $this->getQualityCode();
				break;
			case 4:
				return $this->getPosixName();
				break;
			case 5:
				return $this->getMayBeMainRole();
				break;
			case 6:
				return $this->getDefaultGuardgroup();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMaleDescription(),
			$keys[2] => $this->getFemaleDescription(),
			$keys[3] => $this->getQualityCode(),
			$keys[4] => $this->getPosixName(),
			$keys[5] => $this->getMayBeMainRole(),
			$keys[6] => $this->getDefaultGuardgroup(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setMaleDescription($value);
				break;
			case 2:
				$this->setFemaleDescription($value);
				break;
			case 3:
				$this->setQualityCode($value);
				break;
			case 4:
				$this->setPosixName($value);
				break;
			case 5:
				$this->setMayBeMainRole($value);
				break;
			case 6:
				$this->setDefaultGuardgroup($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMaleDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFemaleDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQualityCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPosixName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMayBeMainRole($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDefaultGuardgroup($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RolePeer::DATABASE_NAME);

		if ($this->isColumnModified(RolePeer::ID)) $criteria->add(RolePeer::ID, $this->id);
		if ($this->isColumnModified(RolePeer::MALE_DESCRIPTION)) $criteria->add(RolePeer::MALE_DESCRIPTION, $this->male_description);
		if ($this->isColumnModified(RolePeer::FEMALE_DESCRIPTION)) $criteria->add(RolePeer::FEMALE_DESCRIPTION, $this->female_description);
		if ($this->isColumnModified(RolePeer::QUALITY_CODE)) $criteria->add(RolePeer::QUALITY_CODE, $this->quality_code);
		if ($this->isColumnModified(RolePeer::POSIX_NAME)) $criteria->add(RolePeer::POSIX_NAME, $this->posix_name);
		if ($this->isColumnModified(RolePeer::MAY_BE_MAIN_ROLE)) $criteria->add(RolePeer::MAY_BE_MAIN_ROLE, $this->may_be_main_role);
		if ($this->isColumnModified(RolePeer::DEFAULT_GUARDGROUP)) $criteria->add(RolePeer::DEFAULT_GUARDGROUP, $this->default_guardgroup);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RolePeer::DATABASE_NAME);

		$criteria->add(RolePeer::ID, $this->id);

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

		$copyObj->setMaleDescription($this->male_description);

		$copyObj->setFemaleDescription($this->female_description);

		$copyObj->setQualityCode($this->quality_code);

		$copyObj->setPosixName($this->posix_name);

		$copyObj->setMayBeMainRole($this->may_be_main_role);

		$copyObj->setDefaultGuardgroup($this->default_guardgroup);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getsfGuardUserProfiles() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserTeams() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addUserTeam($relObj->copy($deepCopy));
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
			self::$peer = new RolePeer();
		}
		return self::$peer;
	}

	
	public function clearsfGuardUserProfiles()
	{
		$this->collsfGuardUserProfiles = null; 	}

	
	public function initsfGuardUserProfiles()
	{
		$this->collsfGuardUserProfiles = array();
	}

	
	public function getsfGuardUserProfiles($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $this->collsfGuardUserProfiles;
	}

	
	public function countsfGuardUserProfiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				$count = sfGuardUserProfilePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$count = sfGuardUserProfilePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfGuardUserProfiles);
				}
			} else {
				$count = count($this->collsfGuardUserProfiles);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $count;
	}

	
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->initsfGuardUserProfiles();
		}
		if (!in_array($l, $this->collsfGuardUserProfiles, true)) { 			array_push($this->collsfGuardUserProfiles, $l);
			$l->setRole($this);
		}
	}


	
	public function getsfGuardUserProfilesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->id);

			if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;

		return $this->collsfGuardUserProfiles;
	}

	
	public function clearUserTeams()
	{
		$this->collUserTeams = null; 	}

	
	public function initUserTeams()
	{
		$this->collUserTeams = array();
	}

	
	public function getUserTeams($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
			   $this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
					$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserTeamCriteria = $criteria;
		return $this->collUserTeams;
	}

	
	public function countUserTeams(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				$count = UserTeamPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
					$count = UserTeamPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserTeams);
				}
			} else {
				$count = count($this->collUserTeams);
			}
		}
		$this->lastUserTeamCriteria = $criteria;
		return $count;
	}

	
	public function addUserTeam(UserTeam $l)
	{
		if ($this->collUserTeams === null) {
			$this->initUserTeams();
		}
		if (!in_array($l, $this->collUserTeams, true)) { 			array_push($this->collUserTeams, $l);
			$l->setRole($this);
		}
	}


	
	public function getUserTeamsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}


	
	public function getUserTeamsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RolePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UserTeamPeer::ROLE_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collsfGuardUserProfiles) {
				foreach ((array) $this->collsfGuardUserProfiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserTeams) {
				foreach ((array) $this->collUserTeams as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collsfGuardUserProfiles = null;
		$this->collUserTeams = null;
	}

} 