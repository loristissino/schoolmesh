<?php


abstract class BaseTeam extends BaseObject  implements Persistent {


  const PEER = 'TeamPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $description;

	
	protected $posix_name;

	
	protected $quality_code;

	
	protected $needs_folder;

	
	protected $needs_mailing_list;

	
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
		$this->needs_folder = false;
		$this->needs_mailing_list = false;
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getDescription()
	{
		return $this->description;
	}

	
	public function getPosixName()
	{
		return $this->posix_name;
	}

	
	public function getQualityCode()
	{
		return $this->quality_code;
	}

	
	public function getNeedsFolder()
	{
		return $this->needs_folder;
	}

	
	public function getNeedsMailingList()
	{
		return $this->needs_mailing_list;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TeamPeer::ID;
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
			$this->modifiedColumns[] = TeamPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = TeamPeer::POSIX_NAME;
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
			$this->modifiedColumns[] = TeamPeer::QUALITY_CODE;
		}

		return $this;
	} 
	
	public function setNeedsFolder($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->needs_folder !== $v || $v === false) {
			$this->needs_folder = $v;
			$this->modifiedColumns[] = TeamPeer::NEEDS_FOLDER;
		}

		return $this;
	} 
	
	public function setNeedsMailingList($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->needs_mailing_list !== $v || $v === false) {
			$this->needs_mailing_list = $v;
			$this->modifiedColumns[] = TeamPeer::NEEDS_MAILING_LIST;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(TeamPeer::NEEDS_FOLDER,TeamPeer::NEEDS_MAILING_LIST))) {
				return false;
			}

			if ($this->needs_folder !== false) {
				return false;
			}

			if ($this->needs_mailing_list !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->posix_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->quality_code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->needs_folder = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->needs_mailing_list = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Team object", $e);
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
			$con = Propel::getConnection(TeamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TeamPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collUserTeams = null;
			$this->lastUserTeamCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TeamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TeamPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TeamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TeamPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TeamPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TeamPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TeamPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

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


			if (($retval = TeamPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = TeamPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				return $this->getPosixName();
				break;
			case 3:
				return $this->getQualityCode();
				break;
			case 4:
				return $this->getNeedsFolder();
				break;
			case 5:
				return $this->getNeedsMailingList();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TeamPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getPosixName(),
			$keys[3] => $this->getQualityCode(),
			$keys[4] => $this->getNeedsFolder(),
			$keys[5] => $this->getNeedsMailingList(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TeamPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				$this->setPosixName($value);
				break;
			case 3:
				$this->setQualityCode($value);
				break;
			case 4:
				$this->setNeedsFolder($value);
				break;
			case 5:
				$this->setNeedsMailingList($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TeamPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPosixName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQualityCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNeedsFolder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNeedsMailingList($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TeamPeer::DATABASE_NAME);

		if ($this->isColumnModified(TeamPeer::ID)) $criteria->add(TeamPeer::ID, $this->id);
		if ($this->isColumnModified(TeamPeer::DESCRIPTION)) $criteria->add(TeamPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(TeamPeer::POSIX_NAME)) $criteria->add(TeamPeer::POSIX_NAME, $this->posix_name);
		if ($this->isColumnModified(TeamPeer::QUALITY_CODE)) $criteria->add(TeamPeer::QUALITY_CODE, $this->quality_code);
		if ($this->isColumnModified(TeamPeer::NEEDS_FOLDER)) $criteria->add(TeamPeer::NEEDS_FOLDER, $this->needs_folder);
		if ($this->isColumnModified(TeamPeer::NEEDS_MAILING_LIST)) $criteria->add(TeamPeer::NEEDS_MAILING_LIST, $this->needs_mailing_list);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TeamPeer::DATABASE_NAME);

		$criteria->add(TeamPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setPosixName($this->posix_name);

		$copyObj->setQualityCode($this->quality_code);

		$copyObj->setNeedsFolder($this->needs_folder);

		$copyObj->setNeedsMailingList($this->needs_mailing_list);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new TeamPeer();
		}
		return self::$peer;
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
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
			   $this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

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
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
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

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				$count = UserTeamPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

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
			$l->setTeam($this);
		}
	}


	
	public function getUserTeamsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}


	
	public function getUserTeamsJoinRole($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TeamPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UserTeamPeer::TEAM_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collUserTeams) {
				foreach ((array) $this->collUserTeams as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collUserTeams = null;
	}

} 