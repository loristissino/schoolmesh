<?php


abstract class BaseSystemMessage extends BaseObject  implements Persistent {


  const PEER = 'SystemMessagePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $key;

	
	protected $collSystemMessageI18ns;

	
	private $lastSystemMessageI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
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

	
	public function getKey()
	{
		return $this->key;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SystemMessagePeer::ID;
		}

		return $this;
	} 
	
	public function setKey($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->key !== $v) {
			$this->key = $v;
			$this->modifiedColumns[] = SystemMessagePeer::KEY;
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
			$this->key = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SystemMessage object", $e);
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
			$con = Propel::getConnection(SystemMessagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SystemMessagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collSystemMessageI18ns = null;
			$this->lastSystemMessageI18nCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SystemMessagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SystemMessagePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SystemMessagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			SystemMessagePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = SystemMessagePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SystemMessagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SystemMessagePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collSystemMessageI18ns !== null) {
				foreach ($this->collSystemMessageI18ns as $referrerFK) {
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


			if (($retval = SystemMessagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSystemMessageI18ns !== null) {
					foreach ($this->collSystemMessageI18ns as $referrerFK) {
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
		$pos = SystemMessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getKey();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SystemMessagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKey(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SystemMessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKey($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SystemMessagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKey($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SystemMessagePeer::DATABASE_NAME);

		if ($this->isColumnModified(SystemMessagePeer::ID)) $criteria->add(SystemMessagePeer::ID, $this->id);
		if ($this->isColumnModified(SystemMessagePeer::KEY)) $criteria->add(SystemMessagePeer::KEY, $this->key);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SystemMessagePeer::DATABASE_NAME);

		$criteria->add(SystemMessagePeer::ID, $this->id);

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

		$copyObj->setKey($this->key);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getSystemMessageI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addSystemMessageI18n($relObj->copy($deepCopy));
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
			self::$peer = new SystemMessagePeer();
		}
		return self::$peer;
	}

	
	public function clearSystemMessageI18ns()
	{
		$this->collSystemMessageI18ns = null; 	}

	
	public function initSystemMessageI18ns()
	{
		$this->collSystemMessageI18ns = array();
	}

	
	public function getSystemMessageI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SystemMessagePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSystemMessageI18ns === null) {
			if ($this->isNew()) {
			   $this->collSystemMessageI18ns = array();
			} else {

				$criteria->add(SystemMessageI18nPeer::ID, $this->id);

				SystemMessageI18nPeer::addSelectColumns($criteria);
				$this->collSystemMessageI18ns = SystemMessageI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SystemMessageI18nPeer::ID, $this->id);

				SystemMessageI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastSystemMessageI18nCriteria) || !$this->lastSystemMessageI18nCriteria->equals($criteria)) {
					$this->collSystemMessageI18ns = SystemMessageI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSystemMessageI18nCriteria = $criteria;
		return $this->collSystemMessageI18ns;
	}

	
	public function countSystemMessageI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SystemMessagePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSystemMessageI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SystemMessageI18nPeer::ID, $this->id);

				$count = SystemMessageI18nPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SystemMessageI18nPeer::ID, $this->id);

				if (!isset($this->lastSystemMessageI18nCriteria) || !$this->lastSystemMessageI18nCriteria->equals($criteria)) {
					$count = SystemMessageI18nPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSystemMessageI18ns);
				}
			} else {
				$count = count($this->collSystemMessageI18ns);
			}
		}
		$this->lastSystemMessageI18nCriteria = $criteria;
		return $count;
	}

	
	public function addSystemMessageI18n(SystemMessageI18n $l)
	{
		if ($this->collSystemMessageI18ns === null) {
			$this->initSystemMessageI18ns();
		}
		if (!in_array($l, $this->collSystemMessageI18ns, true)) { 			array_push($this->collSystemMessageI18ns, $l);
			$l->setSystemMessage($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collSystemMessageI18ns) {
				foreach ((array) $this->collSystemMessageI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collSystemMessageI18ns = null;
	}


  
  public function getCulture()
  {
    return $this->culture;
  }

  
  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getContent($culture = null)
  {
    return $this->getCurrentSystemMessageI18n($culture)->getContent();
  }

  public function setContent($value, $culture = null)
  {
    $this->getCurrentSystemMessageI18n($culture)->setContent($value);
  }

  protected $current_i18n = array();

  public function getCurrentSystemMessageI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = SystemMessageI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setSystemMessageI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setSystemMessageI18nForCulture(new SystemMessageI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setSystemMessageI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addSystemMessageI18n($object);
  }

} 