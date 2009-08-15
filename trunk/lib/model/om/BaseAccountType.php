<?php


abstract class BaseAccountType extends BaseObject  implements Persistent {


  const PEER = 'AccountTypePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $description;

	
	protected $is_external;

	
	protected $collAccounts;

	
	private $lastAccountCriteria = null;

	
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

	
	public function getDescription()
	{
		return $this->description;
	}

	
	public function getIsExternal()
	{
		return $this->is_external;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AccountTypePeer::ID;
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
			$this->modifiedColumns[] = AccountTypePeer::NAME;
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
			$this->modifiedColumns[] = AccountTypePeer::DESCRIPTION;
		}

		return $this;
	} 
	
	public function setIsExternal($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_external !== $v) {
			$this->is_external = $v;
			$this->modifiedColumns[] = AccountTypePeer::IS_EXTERNAL;
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
			$this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->is_external = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AccountType object", $e);
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
			$con = Propel::getConnection(AccountTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AccountTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collAccounts = null;
			$this->lastAccountCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccountTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AccountTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AccountTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			AccountTypePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = AccountTypePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AccountTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AccountTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAccounts !== null) {
				foreach ($this->collAccounts as $referrerFK) {
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


			if (($retval = AccountTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAccounts !== null) {
					foreach ($this->collAccounts as $referrerFK) {
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
		$pos = AccountTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescription();
				break;
			case 3:
				return $this->getIsExternal();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AccountTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getIsExternal(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccountTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDescription($value);
				break;
			case 3:
				$this->setIsExternal($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccountTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsExternal($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AccountTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(AccountTypePeer::ID)) $criteria->add(AccountTypePeer::ID, $this->id);
		if ($this->isColumnModified(AccountTypePeer::NAME)) $criteria->add(AccountTypePeer::NAME, $this->name);
		if ($this->isColumnModified(AccountTypePeer::DESCRIPTION)) $criteria->add(AccountTypePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(AccountTypePeer::IS_EXTERNAL)) $criteria->add(AccountTypePeer::IS_EXTERNAL, $this->is_external);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AccountTypePeer::DATABASE_NAME);

		$criteria->add(AccountTypePeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setIsExternal($this->is_external);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAccounts() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAccount($relObj->copy($deepCopy));
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
			self::$peer = new AccountTypePeer();
		}
		return self::$peer;
	}

	
	public function clearAccounts()
	{
		$this->collAccounts = null; 	}

	
	public function initAccounts()
	{
		$this->collAccounts = array();
	}

	
	public function getAccounts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AccountTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccounts === null) {
			if ($this->isNew()) {
			   $this->collAccounts = array();
			} else {

				$criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->id);

				AccountPeer::addSelectColumns($criteria);
				$this->collAccounts = AccountPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->id);

				AccountPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccountCriteria) || !$this->lastAccountCriteria->equals($criteria)) {
					$this->collAccounts = AccountPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccountCriteria = $criteria;
		return $this->collAccounts;
	}

	
	public function countAccounts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AccountTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAccounts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->id);

				$count = AccountPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->id);

				if (!isset($this->lastAccountCriteria) || !$this->lastAccountCriteria->equals($criteria)) {
					$count = AccountPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAccounts);
				}
			} else {
				$count = count($this->collAccounts);
			}
		}
		$this->lastAccountCriteria = $criteria;
		return $count;
	}

	
	public function addAccount(Account $l)
	{
		if ($this->collAccounts === null) {
			$this->initAccounts();
		}
		if (!in_array($l, $this->collAccounts, true)) { 			array_push($this->collAccounts, $l);
			$l->setAccountType($this);
		}
	}


	
	public function getAccountsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AccountTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccounts === null) {
			if ($this->isNew()) {
				$this->collAccounts = array();
			} else {

				$criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->id);

				$this->collAccounts = AccountPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->id);

			if (!isset($this->lastAccountCriteria) || !$this->lastAccountCriteria->equals($criteria)) {
				$this->collAccounts = AccountPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastAccountCriteria = $criteria;

		return $this->collAccounts;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAccounts) {
				foreach ((array) $this->collAccounts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAccounts = null;
	}

} 