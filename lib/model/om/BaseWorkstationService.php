<?php


abstract class BaseWorkstationService extends BaseObject  implements Persistent {


  const PEER = 'WorkstationServicePeer';

	
	protected static $peer;

	
	protected $workstation_id;

	
	protected $service_id;

	
	protected $aWorkstation;

	
	protected $aService;

	
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

	
	public function getWorkstationId()
	{
		return $this->workstation_id;
	}

	
	public function getServiceId()
	{
		return $this->service_id;
	}

	
	public function setWorkstationId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->workstation_id !== $v) {
			$this->workstation_id = $v;
			$this->modifiedColumns[] = WorkstationServicePeer::WORKSTATION_ID;
		}

		if ($this->aWorkstation !== null && $this->aWorkstation->getId() !== $v) {
			$this->aWorkstation = null;
		}

		return $this;
	} 
	
	public function setServiceId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = WorkstationServicePeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
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

			$this->workstation_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->service_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WorkstationService object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aWorkstation !== null && $this->workstation_id !== $this->aWorkstation->getId()) {
			$this->aWorkstation = null;
		}
		if ($this->aService !== null && $this->service_id !== $this->aService->getId()) {
			$this->aService = null;
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
			$con = Propel::getConnection(WorkstationServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WorkstationServicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aWorkstation = null;
			$this->aService = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkstationServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WorkstationServicePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WorkstationServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WorkstationServicePeer::addInstanceToPool($this);
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

												
			if ($this->aWorkstation !== null) {
				if ($this->aWorkstation->isModified() || $this->aWorkstation->isNew()) {
					$affectedRows += $this->aWorkstation->save($con);
				}
				$this->setWorkstation($this->aWorkstation);
			}

			if ($this->aService !== null) {
				if ($this->aService->isModified() || $this->aService->isNew()) {
					$affectedRows += $this->aService->save($con);
				}
				$this->setService($this->aService);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkstationServicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += WorkstationServicePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

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


												
			if ($this->aWorkstation !== null) {
				if (!$this->aWorkstation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWorkstation->getValidationFailures());
				}
			}

			if ($this->aService !== null) {
				if (!$this->aService->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aService->getValidationFailures());
				}
			}


			if (($retval = WorkstationServicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkstationServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getWorkstationId();
				break;
			case 1:
				return $this->getServiceId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WorkstationServicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getWorkstationId(),
			$keys[1] => $this->getServiceId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkstationServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setWorkstationId($value);
				break;
			case 1:
				$this->setServiceId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkstationServicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setWorkstationId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setServiceId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkstationServicePeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkstationServicePeer::WORKSTATION_ID)) $criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->workstation_id);
		if ($this->isColumnModified(WorkstationServicePeer::SERVICE_ID)) $criteria->add(WorkstationServicePeer::SERVICE_ID, $this->service_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkstationServicePeer::DATABASE_NAME);

		$criteria->add(WorkstationServicePeer::WORKSTATION_ID, $this->workstation_id);
		$criteria->add(WorkstationServicePeer::SERVICE_ID, $this->service_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getWorkstationId();

		$pks[1] = $this->getServiceId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setWorkstationId($keys[0]);

		$this->setServiceId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setWorkstationId($this->workstation_id);

		$copyObj->setServiceId($this->service_id);


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
			self::$peer = new WorkstationServicePeer();
		}
		return self::$peer;
	}

	
	public function setWorkstation(Workstation $v = null)
	{
		if ($v === null) {
			$this->setWorkstationId(NULL);
		} else {
			$this->setWorkstationId($v->getId());
		}

		$this->aWorkstation = $v;

						if ($v !== null) {
			$v->addWorkstationService($this);
		}

		return $this;
	}


	
	public function getWorkstation(PropelPDO $con = null)
	{
		if ($this->aWorkstation === null && ($this->workstation_id !== null)) {
			$c = new Criteria(WorkstationPeer::DATABASE_NAME);
			$c->add(WorkstationPeer::ID, $this->workstation_id);
			$this->aWorkstation = WorkstationPeer::doSelectOne($c, $con);
			
		}
		return $this->aWorkstation;
	}

	
	public function setService(Service $v = null)
	{
		if ($v === null) {
			$this->setServiceId(NULL);
		} else {
			$this->setServiceId($v->getId());
		}

		$this->aService = $v;

						if ($v !== null) {
			$v->addWorkstationService($this);
		}

		return $this;
	}


	
	public function getService(PropelPDO $con = null)
	{
		if ($this->aService === null && ($this->service_id !== null)) {
			$c = new Criteria(ServicePeer::DATABASE_NAME);
			$c->add(ServicePeer::ID, $this->service_id);
			$this->aService = ServicePeer::doSelectOne($c, $con);
			
		}
		return $this->aService;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aWorkstation = null;
			$this->aService = null;
	}

} 