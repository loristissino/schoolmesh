<?php


abstract class BaseWorkstation extends BaseObject  implements Persistent {


  const PEER = 'WorkstationPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $ip_cidr;

	
	protected $mac_address;

	
	protected $is_enabled;

	
	protected $subnet_id;

	
	protected $aSubnet;

	
	protected $collLanlogs;

	
	private $lastLanlogCriteria = null;

	
	protected $collWorkstationServices;

	
	private $lastWorkstationServiceCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->is_enabled = false;
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

	
	public function getMacAddress()
	{
		return $this->mac_address;
	}

	
	public function getIsEnabled()
	{
		return $this->is_enabled;
	}

	
	public function getSubnetId()
	{
		return $this->subnet_id;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WorkstationPeer::ID;
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
			$this->modifiedColumns[] = WorkstationPeer::NAME;
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
			$this->modifiedColumns[] = WorkstationPeer::IP_CIDR;
		}

		return $this;
	} 
	
	public function setMacAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mac_address !== $v) {
			$this->mac_address = $v;
			$this->modifiedColumns[] = WorkstationPeer::MAC_ADDRESS;
		}

		return $this;
	} 
	
	public function setIsEnabled($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_enabled !== $v || $v === false) {
			$this->is_enabled = $v;
			$this->modifiedColumns[] = WorkstationPeer::IS_ENABLED;
		}

		return $this;
	} 
	
	public function setSubnetId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->subnet_id !== $v) {
			$this->subnet_id = $v;
			$this->modifiedColumns[] = WorkstationPeer::SUBNET_ID;
		}

		if ($this->aSubnet !== null && $this->aSubnet->getId() !== $v) {
			$this->aSubnet = null;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(WorkstationPeer::IS_ENABLED))) {
				return false;
			}

			if ($this->is_enabled !== false) {
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
			$this->mac_address = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->is_enabled = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->subnet_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Workstation object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aSubnet !== null && $this->subnet_id !== $this->aSubnet->getId()) {
			$this->aSubnet = null;
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
			$con = Propel::getConnection(WorkstationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WorkstationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aSubnet = null;
			$this->collLanlogs = null;
			$this->lastLanlogCriteria = null;

			$this->collWorkstationServices = null;
			$this->lastWorkstationServiceCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkstationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WorkstationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WorkstationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WorkstationPeer::addInstanceToPool($this);
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

												
			if ($this->aSubnet !== null) {
				if ($this->aSubnet->isModified() || $this->aSubnet->isNew()) {
					$affectedRows += $this->aSubnet->save($con);
				}
				$this->setSubnet($this->aSubnet);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WorkstationPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkstationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WorkstationPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collLanlogs !== null) {
				foreach ($this->collLanlogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWorkstationServices !== null) {
				foreach ($this->collWorkstationServices as $referrerFK) {
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


												
			if ($this->aSubnet !== null) {
				if (!$this->aSubnet->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSubnet->getValidationFailures());
				}
			}


			if (($retval = WorkstationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLanlogs !== null) {
					foreach ($this->collLanlogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWorkstationServices !== null) {
					foreach ($this->collWorkstationServices as $referrerFK) {
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
		$pos = WorkstationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 3:
				return $this->getMacAddress();
				break;
			case 4:
				return $this->getIsEnabled();
				break;
			case 5:
				return $this->getSubnetId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WorkstationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIpCidr(),
			$keys[3] => $this->getMacAddress(),
			$keys[4] => $this->getIsEnabled(),
			$keys[5] => $this->getSubnetId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkstationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 3:
				$this->setMacAddress($value);
				break;
			case 4:
				$this->setIsEnabled($value);
				break;
			case 5:
				$this->setSubnetId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkstationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIpCidr($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMacAddress($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsEnabled($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSubnetId($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkstationPeer::ID)) $criteria->add(WorkstationPeer::ID, $this->id);
		if ($this->isColumnModified(WorkstationPeer::NAME)) $criteria->add(WorkstationPeer::NAME, $this->name);
		if ($this->isColumnModified(WorkstationPeer::IP_CIDR)) $criteria->add(WorkstationPeer::IP_CIDR, $this->ip_cidr);
		if ($this->isColumnModified(WorkstationPeer::MAC_ADDRESS)) $criteria->add(WorkstationPeer::MAC_ADDRESS, $this->mac_address);
		if ($this->isColumnModified(WorkstationPeer::IS_ENABLED)) $criteria->add(WorkstationPeer::IS_ENABLED, $this->is_enabled);
		if ($this->isColumnModified(WorkstationPeer::SUBNET_ID)) $criteria->add(WorkstationPeer::SUBNET_ID, $this->subnet_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);

		$criteria->add(WorkstationPeer::ID, $this->id);

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

		$copyObj->setMacAddress($this->mac_address);

		$copyObj->setIsEnabled($this->is_enabled);

		$copyObj->setSubnetId($this->subnet_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getLanlogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addLanlog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWorkstationServices() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWorkstationService($relObj->copy($deepCopy));
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
			self::$peer = new WorkstationPeer();
		}
		return self::$peer;
	}

	
	public function setSubnet(Subnet $v = null)
	{
		if ($v === null) {
			$this->setSubnetId(NULL);
		} else {
			$this->setSubnetId($v->getId());
		}

		$this->aSubnet = $v;

						if ($v !== null) {
			$v->addWorkstation($this);
		}

		return $this;
	}


	
	public function getSubnet(PropelPDO $con = null)
	{
		if ($this->aSubnet === null && ($this->subnet_id !== null)) {
			$c = new Criteria(SubnetPeer::DATABASE_NAME);
			$c->add(SubnetPeer::ID, $this->subnet_id);
			$this->aSubnet = SubnetPeer::doSelectOne($c, $con);
			
		}
		return $this->aSubnet;
	}

	
	public function clearLanlogs()
	{
		$this->collLanlogs = null; 	}

	
	public function initLanlogs()
	{
		$this->collLanlogs = array();
	}

	
	public function getLanlogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
			   $this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
					$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanlogCriteria = $criteria;
		return $this->collLanlogs;
	}

	
	public function countLanlogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				$count = LanlogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
					$count = LanlogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collLanlogs);
				}
			} else {
				$count = count($this->collLanlogs);
			}
		}
		$this->lastLanlogCriteria = $criteria;
		return $count;
	}

	
	public function addLanlog(Lanlog $l)
	{
		if ($this->collLanlogs === null) {
			$this->initLanlogs();
		}
		if (!in_array($l, $this->collLanlogs, true)) { 			array_push($this->collLanlogs, $l);
			$l->setWorkstation($this);
		}
	}


	
	public function getLanlogsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

				$this->collLanlogs = LanlogPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(LanlogPeer::WORKSTATION_ID, $this->id);

			if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
				$this->collLanlogs = LanlogPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastLanlogCriteria = $criteria;

		return $this->collLanlogs;
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
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkstationServices === null) {
			if ($this->isNew()) {
			   $this->collWorkstationServices = array();
			} else {

				$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->id);

				WorkstationServicePeer::addSelectColumns($criteria);
				$this->collWorkstationServices = WorkstationServicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->id);

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
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
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

				$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->id);

				$count = WorkstationServicePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->id);

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
			$l->setWorkstation($this);
		}
	}


	
	public function getWorkstationServicesJoinService($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WorkstationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkstationServices === null) {
			if ($this->isNew()) {
				$this->collWorkstationServices = array();
			} else {

				$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->id);

				$this->collWorkstationServices = WorkstationServicePeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->id);

			if (!isset($this->lastWorkstationServiceCriteria) || !$this->lastWorkstationServiceCriteria->equals($criteria)) {
				$this->collWorkstationServices = WorkstationServicePeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkstationServiceCriteria = $criteria;

		return $this->collWorkstationServices;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collLanlogs) {
				foreach ((array) $this->collLanlogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWorkstationServices) {
				foreach ((array) $this->collWorkstationServices as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collLanlogs = null;
		$this->collWorkstationServices = null;
			$this->aSubnet = null;
	}

} 