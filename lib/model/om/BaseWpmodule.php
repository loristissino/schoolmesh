<?php


abstract class BaseWpmodule extends BaseObject  implements Persistent {


  const PEER = 'WpmodulePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $shortcut;

	
	protected $user_id;

	
	protected $title;

	
	protected $period;

	
	protected $is_public;

	
	protected $is_locked;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $asfGuardUser;

	
	protected $collWpmoduleItems;

	
	private $lastWpmoduleItemCriteria = null;

	
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

	
	public function getShortcut()
	{
		return $this->shortcut;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getTitle()
	{
		return $this->title;
	}

	
	public function getPeriod()
	{
		return $this->period;
	}

	
	public function getIsPublic()
	{
		return $this->is_public;
	}

	
	public function getIsLocked()
	{
		return $this->is_locked;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WpmodulePeer::ID;
		}

		return $this;
	} 
	
	public function setShortcut($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->shortcut !== $v) {
			$this->shortcut = $v;
			$this->modifiedColumns[] = WpmodulePeer::SHORTCUT;
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
			$this->modifiedColumns[] = WpmodulePeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = WpmodulePeer::TITLE;
		}

		return $this;
	} 
	
	public function setPeriod($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->period !== $v) {
			$this->period = $v;
			$this->modifiedColumns[] = WpmodulePeer::PERIOD;
		}

		return $this;
	} 
	
	public function setIsPublic($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_public !== $v) {
			$this->is_public = $v;
			$this->modifiedColumns[] = WpmodulePeer::IS_PUBLIC;
		}

		return $this;
	} 
	
	public function setIsLocked($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_locked !== $v) {
			$this->is_locked = $v;
			$this->modifiedColumns[] = WpmodulePeer::IS_LOCKED;
		}

		return $this;
	} 
	
	public function setCreatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			
			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = WpmodulePeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setUpdatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			
			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = WpmodulePeer::UPDATED_AT;
			}
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
			$this->shortcut = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->user_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->title = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->period = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_public = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->is_locked = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Wpmodule object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
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
			$con = Propel::getConnection(WpmodulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = WpmodulePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->collWpmoduleItems = null;
			$this->lastWpmoduleItemCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpmodulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WpmodulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WpmodulePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(WpmodulePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WpmodulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WpmodulePeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WpmodulePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WpmodulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WpmodulePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collWpmoduleItems !== null) {
				foreach ($this->collWpmoduleItems as $referrerFK) {
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


			if (($retval = WpmodulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWpmoduleItems !== null) {
					foreach ($this->collWpmoduleItems as $referrerFK) {
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
		$pos = WpmodulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getShortcut();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getPeriod();
				break;
			case 5:
				return $this->getIsPublic();
				break;
			case 6:
				return $this->getIsLocked();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = WpmodulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getShortcut(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getPeriod(),
			$keys[5] => $this->getIsPublic(),
			$keys[6] => $this->getIsLocked(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WpmodulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setShortcut($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setPeriod($value);
				break;
			case 5:
				$this->setIsPublic($value);
				break;
			case 6:
				$this->setIsLocked($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WpmodulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setShortcut($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPeriod($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsPublic($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsLocked($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WpmodulePeer::DATABASE_NAME);

		if ($this->isColumnModified(WpmodulePeer::ID)) $criteria->add(WpmodulePeer::ID, $this->id);
		if ($this->isColumnModified(WpmodulePeer::SHORTCUT)) $criteria->add(WpmodulePeer::SHORTCUT, $this->shortcut);
		if ($this->isColumnModified(WpmodulePeer::USER_ID)) $criteria->add(WpmodulePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(WpmodulePeer::TITLE)) $criteria->add(WpmodulePeer::TITLE, $this->title);
		if ($this->isColumnModified(WpmodulePeer::PERIOD)) $criteria->add(WpmodulePeer::PERIOD, $this->period);
		if ($this->isColumnModified(WpmodulePeer::IS_PUBLIC)) $criteria->add(WpmodulePeer::IS_PUBLIC, $this->is_public);
		if ($this->isColumnModified(WpmodulePeer::IS_LOCKED)) $criteria->add(WpmodulePeer::IS_LOCKED, $this->is_locked);
		if ($this->isColumnModified(WpmodulePeer::CREATED_AT)) $criteria->add(WpmodulePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WpmodulePeer::UPDATED_AT)) $criteria->add(WpmodulePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WpmodulePeer::DATABASE_NAME);

		$criteria->add(WpmodulePeer::ID, $this->id);

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

		$copyObj->setShortcut($this->shortcut);

		$copyObj->setUserId($this->user_id);

		$copyObj->setTitle($this->title);

		$copyObj->setPeriod($this->period);

		$copyObj->setIsPublic($this->is_public);

		$copyObj->setIsLocked($this->is_locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getWpmoduleItems() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpmoduleItem($relObj->copy($deepCopy));
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
			self::$peer = new WpmodulePeer();
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
			$v->addWpmodule($this);
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

	
	public function clearWpmoduleItems()
	{
		$this->collWpmoduleItems = null; 	}

	
	public function initWpmoduleItems()
	{
		$this->collWpmoduleItems = array();
	}

	
	public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpmodulePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmoduleItems === null) {
			if ($this->isNew()) {
			   $this->collWpmoduleItems = array();
			} else {

				$criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->id);

				WpmoduleItemPeer::addSelectColumns($criteria);
				$this->collWpmoduleItems = WpmoduleItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->id);

				WpmoduleItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastWpmoduleItemCriteria) || !$this->lastWpmoduleItemCriteria->equals($criteria)) {
					$this->collWpmoduleItems = WpmoduleItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpmoduleItemCriteria = $criteria;
		return $this->collWpmoduleItems;
	}

	
	public function countWpmoduleItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpmodulePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpmoduleItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->id);

				$count = WpmoduleItemPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->id);

				if (!isset($this->lastWpmoduleItemCriteria) || !$this->lastWpmoduleItemCriteria->equals($criteria)) {
					$count = WpmoduleItemPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpmoduleItems);
				}
			} else {
				$count = count($this->collWpmoduleItems);
			}
		}
		$this->lastWpmoduleItemCriteria = $criteria;
		return $count;
	}

	
	public function addWpmoduleItem(WpmoduleItem $l)
	{
		if ($this->collWpmoduleItems === null) {
			$this->initWpmoduleItems();
		}
		if (!in_array($l, $this->collWpmoduleItems, true)) { 			array_push($this->collWpmoduleItems, $l);
			$l->setWpmodule($this);
		}
	}


	
	public function getWpmoduleItemsJoinWpitemType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WpmodulePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmoduleItems === null) {
			if ($this->isNew()) {
				$this->collWpmoduleItems = array();
			} else {

				$criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->id);

				$this->collWpmoduleItems = WpmoduleItemPeer::doSelectJoinWpitemType($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpmoduleItemPeer::WPMODULE_ID, $this->id);

			if (!isset($this->lastWpmoduleItemCriteria) || !$this->lastWpmoduleItemCriteria->equals($criteria)) {
				$this->collWpmoduleItems = WpmoduleItemPeer::doSelectJoinWpitemType($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpmoduleItemCriteria = $criteria;

		return $this->collWpmoduleItems;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collWpmoduleItems) {
				foreach ((array) $this->collWpmoduleItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collWpmoduleItems = null;
			$this->asfGuardUser = null;
	}

} 