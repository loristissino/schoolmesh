<?php


abstract class BaseSubnet extends BaseObject  implements Persistent {


  const PEER = 'SubnetPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $ip_cidr;

	
	protected $collWorkstations;

	
	private $lastWorkstationCriteria = null;

	
	protected $collSubnetServices;

	
	private $lastSubnetServiceCriteria = null;

	
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

	
	public function getName()
	{
		return $this->name;
	}

	
	public function getIpCidr()
	{
		return $this->ip_cidr;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SubnetPeer::ID;
		}

		return $this;
	} 
	
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SubnetPeer::NAME;
		}

		return $this;
	} 
	
	public function setIpCidr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ip_cidr !== $v) {
			$this->ip_cidr = $v;
			$this->modifiedColumns[] = SubnetPeer::IP_CIDR;
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
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ip_cidr = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Subnet object", $e);
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
			$con = Propel::getConnection(SubnetPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SubnetPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collWorkstations = null;
			$this->lastWorkstationCriteria = null;

			$this->collSubnetServices = null;
			$this->lastSubnetServiceCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SubnetPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SubnetPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SubnetPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			SubnetPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = SubnetPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SubnetPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SubnetPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWorkstations !== null) {
				foreach ($this->collWorkstations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSubnetServices !== null) {
				foreach ($this->collSubnetServices as $referrerFK) {
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


			if (($retval = SubnetPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWorkstations !== null) {
					foreach ($this->collWorkstations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSubnetServices !== null) {
					foreach ($this->collSubnetServices as $referrerFK) {
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
		$pos = SubnetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getIpCidr();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SubnetPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIpCidr(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SubnetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setIpCidr($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SubnetPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIpCidr($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SubnetPeer::DATABASE_NAME);

		if ($this->isColumnModified(SubnetPeer::ID)) $criteria->add(SubnetPeer::ID, $this->id);
		if ($this->isColumnModified(SubnetPeer::NAME)) $criteria->add(SubnetPeer::NAME, $this->name);
		if ($this->isColumnModified(SubnetPeer::IP_CIDR)) $criteria->add(SubnetPeer::IP_CIDR, $this->ip_cidr);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SubnetPeer::DATABASE_NAME);

		$criteria->add(SubnetPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setIpCidr($this->ip_cidr);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWorkstations() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWorkstation($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSubnetServices() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addSubnetService($relObj->copy($deepCopy));
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
			self::$peer = new SubnetPeer();
		}
		return self::$peer;
	}

	
	public function clearWorkstations()
	{
		$this->collWorkstations = null; 	}

	
	public function initWorkstations()
	{
		$this->collWorkstations = array();
	}

	
	public function getWorkstations($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubnetPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkstations === null) {
			if ($this->isNew()) {
			   $this->collWorkstations = array();
			} else {

				$criteria->add(WorkstationPeer::SUBNET_ID, $this->id);

				WorkstationPeer::addSelectColumns($criteria);
				$this->collWorkstations = WorkstationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkstationPeer::SUBNET_ID, $this->id);

				WorkstationPeer::addSelectColumns($criteria);
				if (!isset($this->lastWorkstationCriteria) || !$this->lastWorkstationCriteria->equals($criteria)) {
					$this->collWorkstations = WorkstationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWorkstationCriteria = $criteria;
		return $this->collWorkstations;
	}

	
	public function countWorkstations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubnetPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWorkstations === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WorkstationPeer::SUBNET_ID, $this->id);

				$count = WorkstationPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkstationPeer::SUBNET_ID, $this->id);

				if (!isset($this->lastWorkstationCriteria) || !$this->lastWorkstationCriteria->equals($criteria)) {
					$count = WorkstationPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWorkstations);
				}
			} else {
				$count = count($this->collWorkstations);
			}
		}
		$this->lastWorkstationCriteria = $criteria;
		return $count;
	}

	
	public function addWorkstation(Workstation $l)
	{
		if ($this->collWorkstations === null) {
			$this->initWorkstations();
		}
		if (!in_array($l, $this->collWorkstations, true)) { 			array_push($this->collWorkstations, $l);
			$l->setSubnet($this);
		}
	}

	
	public function clearSubnetServices()
	{
		$this->collSubnetServices = null; 	}

	
	public function initSubnetServices()
	{
		$this->collSubnetServices = array();
	}

	
	public function getSubnetServices($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubnetPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubnetServices === null) {
			if ($this->isNew()) {
			   $this->collSubnetServices = array();
			} else {

				$criteria->add(SubnetServicePeer::SUBNET_ID, $this->id);

				SubnetServicePeer::addSelectColumns($criteria);
				$this->collSubnetServices = SubnetServicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SubnetServicePeer::SUBNET_ID, $this->id);

				SubnetServicePeer::addSelectColumns($criteria);
				if (!isset($this->lastSubnetServiceCriteria) || !$this->lastSubnetServiceCriteria->equals($criteria)) {
					$this->collSubnetServices = SubnetServicePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSubnetServiceCriteria = $criteria;
		return $this->collSubnetServices;
	}

	
	public function countSubnetServices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubnetPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSubnetServices === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SubnetServicePeer::SUBNET_ID, $this->id);

				$count = SubnetServicePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SubnetServicePeer::SUBNET_ID, $this->id);

				if (!isset($this->lastSubnetServiceCriteria) || !$this->lastSubnetServiceCriteria->equals($criteria)) {
					$count = SubnetServicePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSubnetServices);
				}
			} else {
				$count = count($this->collSubnetServices);
			}
		}
		$this->lastSubnetServiceCriteria = $criteria;
		return $count;
	}

	
	public function addSubnetService(SubnetService $l)
	{
		if ($this->collSubnetServices === null) {
			$this->initSubnetServices();
		}
		if (!in_array($l, $this->collSubnetServices, true)) { 			array_push($this->collSubnetServices, $l);
			$l->setSubnet($this);
		}
	}


	
	public function getSubnetServicesJoinService($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SubnetPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubnetServices === null) {
			if ($this->isNew()) {
				$this->collSubnetServices = array();
			} else {

				$criteria->add(SubnetServicePeer::SUBNET_ID, $this->id);

				$this->collSubnetServices = SubnetServicePeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(SubnetServicePeer::SUBNET_ID, $this->id);

			if (!isset($this->lastSubnetServiceCriteria) || !$this->lastSubnetServiceCriteria->equals($criteria)) {
				$this->collSubnetServices = SubnetServicePeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		}
		$this->lastSubnetServiceCriteria = $criteria;

		return $this->collSubnetServices;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWorkstations) {
				foreach ((array) $this->collWorkstations as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSubnetServices) {
				foreach ((array) $this->collSubnetServices as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWorkstations = null;
		$this->collSubnetServices = null;
	}

} 