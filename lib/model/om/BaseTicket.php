<?php


abstract class BaseTicket extends BaseObject  implements Persistent {


  const PEER = 'TicketPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $referrer;

	
	protected $ticket_type_id;

	
	protected $updated_at;

	
	protected $state;

	
	protected $aTicketType;

	
	protected $collTicketEvents;

	
	private $lastTicketEventCriteria = null;

	
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

	
	public function getReferrer()
	{
		return $this->referrer;
	}

	
	public function getTicketTypeId()
	{
		return $this->ticket_type_id;
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

	
	public function getState()
	{
		return $this->state;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TicketPeer::ID;
		}

		return $this;
	} 
	
	public function setReferrer($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->referrer !== $v) {
			$this->referrer = $v;
			$this->modifiedColumns[] = TicketPeer::REFERRER;
		}

		return $this;
	} 
	
	public function setTicketTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ticket_type_id !== $v) {
			$this->ticket_type_id = $v;
			$this->modifiedColumns[] = TicketPeer::TICKET_TYPE_ID;
		}

		if ($this->aTicketType !== null && $this->aTicketType->getId() !== $v) {
			$this->aTicketType = null;
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
				$this->modifiedColumns[] = TicketPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setState($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = TicketPeer::STATE;
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
			$this->referrer = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ticket_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->state = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ticket object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTicketType !== null && $this->ticket_type_id !== $this->aTicketType->getId()) {
			$this->aTicketType = null;
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
			$con = Propel::getConnection(TicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TicketPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTicketType = null;
			$this->collTicketEvents = null;
			$this->lastTicketEventCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TicketPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(TicketPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TicketPeer::addInstanceToPool($this);
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

												
			if ($this->aTicketType !== null) {
				if ($this->aTicketType->isModified() || $this->aTicketType->isNew()) {
					$affectedRows += $this->aTicketType->save($con);
				}
				$this->setTicketType($this->aTicketType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TicketPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TicketPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TicketPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collTicketEvents !== null) {
				foreach ($this->collTicketEvents as $referrerFK) {
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


												
			if ($this->aTicketType !== null) {
				if (!$this->aTicketType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTicketType->getValidationFailures());
				}
			}


			if (($retval = TicketPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTicketEvents !== null) {
					foreach ($this->collTicketEvents as $referrerFK) {
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
		$pos = TicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getReferrer();
				break;
			case 2:
				return $this->getTicketTypeId();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			case 4:
				return $this->getState();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TicketPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getReferrer(),
			$keys[2] => $this->getTicketTypeId(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getState(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setReferrer($value);
				break;
			case 2:
				$this->setTicketTypeId($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
			case 4:
				$this->setState($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TicketPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setReferrer($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTicketTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setState($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TicketPeer::DATABASE_NAME);

		if ($this->isColumnModified(TicketPeer::ID)) $criteria->add(TicketPeer::ID, $this->id);
		if ($this->isColumnModified(TicketPeer::REFERRER)) $criteria->add(TicketPeer::REFERRER, $this->referrer);
		if ($this->isColumnModified(TicketPeer::TICKET_TYPE_ID)) $criteria->add(TicketPeer::TICKET_TYPE_ID, $this->ticket_type_id);
		if ($this->isColumnModified(TicketPeer::UPDATED_AT)) $criteria->add(TicketPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(TicketPeer::STATE)) $criteria->add(TicketPeer::STATE, $this->state);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TicketPeer::DATABASE_NAME);

		$criteria->add(TicketPeer::ID, $this->id);

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

		$copyObj->setReferrer($this->referrer);

		$copyObj->setTicketTypeId($this->ticket_type_id);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setState($this->state);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getTicketEvents() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTicketEvent($relObj->copy($deepCopy));
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
			self::$peer = new TicketPeer();
		}
		return self::$peer;
	}

	
	public function setTicketType(TicketType $v = null)
	{
		if ($v === null) {
			$this->setTicketTypeId(NULL);
		} else {
			$this->setTicketTypeId($v->getId());
		}

		$this->aTicketType = $v;

						if ($v !== null) {
			$v->addTicket($this);
		}

		return $this;
	}


	
	public function getTicketType(PropelPDO $con = null)
	{
		if ($this->aTicketType === null && ($this->ticket_type_id !== null)) {
			$c = new Criteria(TicketTypePeer::DATABASE_NAME);
			$c->add(TicketTypePeer::ID, $this->ticket_type_id);
			$this->aTicketType = TicketTypePeer::doSelectOne($c, $con);
			
		}
		return $this->aTicketType;
	}

	
	public function clearTicketEvents()
	{
		$this->collTicketEvents = null; 	}

	
	public function initTicketEvents()
	{
		$this->collTicketEvents = array();
	}

	
	public function getTicketEvents($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEvents === null) {
			if ($this->isNew()) {
			   $this->collTicketEvents = array();
			} else {

				$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

				TicketEventPeer::addSelectColumns($criteria);
				$this->collTicketEvents = TicketEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

				TicketEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastTicketEventCriteria) || !$this->lastTicketEventCriteria->equals($criteria)) {
					$this->collTicketEvents = TicketEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTicketEventCriteria = $criteria;
		return $this->collTicketEvents;
	}

	
	public function countTicketEvents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TicketPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTicketEvents === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

				$count = TicketEventPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

				if (!isset($this->lastTicketEventCriteria) || !$this->lastTicketEventCriteria->equals($criteria)) {
					$count = TicketEventPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTicketEvents);
				}
			} else {
				$count = count($this->collTicketEvents);
			}
		}
		$this->lastTicketEventCriteria = $criteria;
		return $count;
	}

	
	public function addTicketEvent(TicketEvent $l)
	{
		if ($this->collTicketEvents === null) {
			$this->initTicketEvents();
		}
		if (!in_array($l, $this->collTicketEvents, true)) { 			array_push($this->collTicketEvents, $l);
			$l->setTicket($this);
		}
	}


	
	public function getTicketEventsJoinsfGuardUserRelatedByUserId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEvents === null) {
			if ($this->isNew()) {
				$this->collTicketEvents = array();
			} else {

				$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

				$this->collTicketEvents = TicketEventPeer::doSelectJoinsfGuardUserRelatedByUserId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

			if (!isset($this->lastTicketEventCriteria) || !$this->lastTicketEventCriteria->equals($criteria)) {
				$this->collTicketEvents = TicketEventPeer::doSelectJoinsfGuardUserRelatedByUserId($criteria, $con, $join_behavior);
			}
		}
		$this->lastTicketEventCriteria = $criteria;

		return $this->collTicketEvents;
	}


	
	public function getTicketEventsJoinsfGuardUserRelatedByAssigneeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTicketEvents === null) {
			if ($this->isNew()) {
				$this->collTicketEvents = array();
			} else {

				$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

				$this->collTicketEvents = TicketEventPeer::doSelectJoinsfGuardUserRelatedByAssigneeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(TicketEventPeer::TICKET_ID, $this->id);

			if (!isset($this->lastTicketEventCriteria) || !$this->lastTicketEventCriteria->equals($criteria)) {
				$this->collTicketEvents = TicketEventPeer::doSelectJoinsfGuardUserRelatedByAssigneeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastTicketEventCriteria = $criteria;

		return $this->collTicketEvents;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTicketEvents) {
				foreach ((array) $this->collTicketEvents as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collTicketEvents = null;
			$this->aTicketType = null;
	}

} 