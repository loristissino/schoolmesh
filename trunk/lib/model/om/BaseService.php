<?php


abstract class BaseService extends BaseObject  implements Persistent {


  const PEER = 'ServicePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $is_enabled_by_default;

	
	protected $port;

	
	protected $is_udp;

	
	protected $collWorkstationServices;

	
	private $lastWorkstationServiceCriteria = null;

	
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
		$this->is_enabled_by_default = false;
		$this->is_udp = false;
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getName()
	{
		return $this->name;
	}

	
	public function getIsEnabledByDefault()
	{
		return $this->is_enabled_by_default;
	}

	
	public function getPort()
	{
		return $this->port;
	}

	
	public function getIsUdp()
	{
		return $this->is_udp;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ServicePeer::ID;
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
			$this->modifiedColumns[] = ServicePeer::NAME;
		}

		return $this;
	} 
	
	public function setIsEnabledByDefault($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_enabled_by_default !== $v || $v === false) {
			$this->is_enabled_by_default = $v;
			$this->modifiedColumns[] = ServicePeer::IS_ENABLED_BY_DEFAULT;
		}

		return $this;
	} 
	
	public function setPort($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->port !== $v) {
			$this->port = $v;
			$this->modifiedColumns[] = ServicePeer::PORT;
		}

		return $this;
	} 
	
	public function setIsUdp($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_udp !== $v || $v === false) {
			$this->is_udp = $v;
			$this->modifiedColumns[] = ServicePeer::IS_UDP;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(ServicePeer::IS_ENABLED_BY_DEFAULT,ServicePeer::IS_UDP))) {
				return false;
			}

			if ($this->is_enabled_by_default !== false) {
				return false;
			}

			if ($this->is_udp !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->is_enabled_by_default = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->port = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->is_udp = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Service object", $e);
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
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ServicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collWorkstationServices = null;
			$this->lastWorkstationServiceCriteria = null;

			$this->collSubnetServices = null;
			$this->lastSubnetServiceCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ServicePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ServicePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ServicePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ServicePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWorkstationServices !== null) {
				foreach ($this->collWorkstationServices as $referrerFK) {
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


			if (($retval = ServicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWorkstationServices !== null) {
					foreach ($this->collWorkstationServices as $referrerFK) {
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
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsEnabledByDefault();
				break;
			case 3:
				return $this->getPort();
				break;
			case 4:
				return $this->getIsUdp();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ServicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIsEnabledByDefault(),
			$keys[3] => $this->getPort(),
			$keys[4] => $this->getIsUdp(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIsEnabledByDefault($value);
				break;
			case 3:
				$this->setPort($value);
				break;
			case 4:
				$this->setIsUdp($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsEnabledByDefault($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPort($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsUdp($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		if ($this->isColumnModified(ServicePeer::ID)) $criteria->add(ServicePeer::ID, $this->id);
		if ($this->isColumnModified(ServicePeer::NAME)) $criteria->add(ServicePeer::NAME, $this->name);
		if ($this->isColumnModified(ServicePeer::IS_ENABLED_BY_DEFAULT)) $criteria->add(ServicePeer::IS_ENABLED_BY_DEFAULT, $this->is_enabled_by_default);
		if ($this->isColumnModified(ServicePeer::PORT)) $criteria->add(ServicePeer::PORT, $this->port);
		if ($this->isColumnModified(ServicePeer::IS_UDP)) $criteria->add(ServicePeer::IS_UDP, $this->is_udp);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		$criteria->add(ServicePeer::ID, $this->id);

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

		$copyObj->setIsEnabledByDefault($this->is_enabled_by_default);

		$copyObj->setPort($this->port);

		$copyObj->setIsUdp($this->is_udp);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWorkstationServices() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWorkstationService($relObj->copy($deepCopy));
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
			self::$peer = new ServicePeer();
		}
		return self::$peer;
	}

	
	public function clearWorkstationServices()
	{
		$this->collWorkstationServices = null; 	}

	
	public function initWorkstationServices()
	{
		$this->collWorkstationServices = array();
	}

	
	public function getWorkstationServices($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkstationServices === null) {
			if ($this->isNew()) {
			   $this->collWorkstationServices = array();
			} else {

				$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->id);

				WorkstationServicePeer::addSelectColumns($criteria);
				$this->collWorkstationServices = WorkstationServicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->id);

				WorkstationServicePeer::addSelectColumns($criteria);
				if (!isset($this->lastWorkstationServiceCriteria) || !$this->lastWorkstationServiceCriteria->equals($criteria)) {
					$this->collWorkstationServices = WorkstationServicePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWorkstationServiceCriteria = $criteria;
		return $this->collWorkstationServices;
	}

	
	public function countWorkstationServices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWorkstationServices === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->id);

				$count = WorkstationServicePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->id);

				if (!isset($this->lastWorkstationServiceCriteria) || !$this->lastWorkstationServiceCriteria->equals($criteria)) {
					$count = WorkstationServicePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWorkstationServices);
				}
			} else {
				$count = count($this->collWorkstationServices);
			}
		}
		$this->lastWorkstationServiceCriteria = $criteria;
		return $count;
	}

	
	public function addWorkstationService(WorkstationService $l)
	{
		if ($this->collWorkstationServices === null) {
			$this->initWorkstationServices();
		}
		if (!in_array($l, $this->collWorkstationServices, true)) { 			array_push($this->collWorkstationServices, $l);
			$l->setService($this);
		}
	}


	
	public function getWorkstationServicesJoinWorkstation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkstationServices === null) {
			if ($this->isNew()) {
				$this->collWorkstationServices = array();
			} else {

				$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->id);

				$this->collWorkstationServices = WorkstationServicePeer::doSelectJoinWorkstation($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->id);

			if (!isset($this->lastWorkstationServiceCriteria) || !$this->lastWorkstationServiceCriteria->equals($criteria)) {
				$this->collWorkstationServices = WorkstationServicePeer::doSelectJoinWorkstation($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkstationServiceCriteria = $criteria;

		return $this->collWorkstationServices;
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
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubnetServices === null) {
			if ($this->isNew()) {
			   $this->collSubnetServices = array();
			} else {

				$criteria->add(SubnetServicePeer::SERVICE_ID, $this->id);

				SubnetServicePeer::addSelectColumns($criteria);
				$this->collSubnetServices = SubnetServicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SubnetServicePeer::SERVICE_ID, $this->id);

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
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
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

				$criteria->add(SubnetServicePeer::SERVICE_ID, $this->id);

				$count = SubnetServicePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SubnetServicePeer::SERVICE_ID, $this->id);

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
			$l->setService($this);
		}
	}


	
	public function getSubnetServicesJoinSubnet($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSubnetServices === null) {
			if ($this->isNew()) {
				$this->collSubnetServices = array();
			} else {

				$criteria->add(SubnetServicePeer::SERVICE_ID, $this->id);

				$this->collSubnetServices = SubnetServicePeer::doSelectJoinSubnet($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(SubnetServicePeer::SERVICE_ID, $this->id);

			if (!isset($this->lastSubnetServiceCriteria) || !$this->lastSubnetServiceCriteria->equals($criteria)) {
				$this->collSubnetServices = SubnetServicePeer::doSelectJoinSubnet($criteria, $con, $join_behavior);
			}
		}
		$this->lastSubnetServiceCriteria = $criteria;

		return $this->collSubnetServices;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWorkstationServices) {
				foreach ((array) $this->collWorkstationServices as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSubnetServices) {
				foreach ((array) $this->collSubnetServices as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWorkstationServices = null;
		$this->collSubnetServices = null;
	}

} 