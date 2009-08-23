<?php


abstract class BaseTicketEvent extends BaseObject  implements Persistent {


  const PEER = 'TicketEventPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $ticket_id;

	
	protected $user_id;

	
	protected $created_at;

	
	protected $content;

	
	protected $state;

	
	protected $assignee_id;

	
	protected $aTicket;

	
	protected $asfGuardUserRelatedByUserId;

	
	protected $asfGuardUserRelatedByAssigneeId;

	
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

	
	public function getTicketId()
	{
		return $this->ticket_id;
	}

	
	public function getUserId()
	{
		return $this->user_id;
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

	
	public function getContent()
	{
		return $this->content;
	}

	
	public function getState()
	{
		return $this->state;
	}

	
	public function getAssigneeId()
	{
		return $this->assignee_id;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TicketEventPeer::ID;
		}

		return $this;
	} 
	
	public function setTicketId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ticket_id !== $v) {
			$this->ticket_id = $v;
			$this->modifiedColumns[] = TicketEventPeer::TICKET_ID;
		}

		if ($this->aTicket !== null && $this->aTicket->getId() !== $v) {
			$this->aTicket = null;
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
			$this->modifiedColumns[] = TicketEventPeer::USER_ID;
		}

		if ($this->asfGuardUserRelatedByUserId !== null && $this->asfGuardUserRelatedByUserId->getId() !== $v) {
			$this->asfGuardUserRelatedByUserId = null;
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
				$this->modifiedColumns[] = TicketEventPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = TicketEventPeer::CONTENT;
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
			$this->modifiedColumns[] = TicketEventPeer::STATE;
		}

		return $this;
	} 
	
	public function setAssigneeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->assignee_id !== $v) {
			$this->assignee_id = $v;
			$this->modifiedColumns[] = TicketEventPeer::ASSIGNEE_ID;
		}

		if ($this->asfGuardUserRelatedByAssigneeId !== null && $this->asfGuardUserRelatedByAssigneeId->getId() !== $v) {
			$this->asfGuardUserRelatedByAssigneeId = null;
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
			$this->ticket_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->user_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->created_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->content = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->state = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->assignee_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TicketEvent object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTicket !== null && $this->ticket_id !== $this->aTicket->getId()) {
			$this->aTicket = null;
		}
		if ($this->asfGuardUserRelatedByUserId !== null && $this->user_id !== $this->asfGuardUserRelatedByUserId->getId()) {
			$this->asfGuardUserRelatedByUserId = null;
		}
		if ($this->asfGuardUserRelatedByAssigneeId !== null && $this->assignee_id !== $this->asfGuardUserRelatedByAssigneeId->getId()) {
			$this->asfGuardUserRelatedByAssigneeId = null;
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
			$con = Propel::getConnection(TicketEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TicketEventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTicket = null;
			$this->asfGuardUserRelatedByUserId = null;
			$this->asfGuardUserRelatedByAssigneeId = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TicketEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TicketEventPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TicketEventPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TicketEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TicketEventPeer::addInstanceToPool($this);
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

												
			if ($this->aTicket !== null) {
				if ($this->aTicket->isModified() || $this->aTicket->isNew()) {
					$affectedRows += $this->aTicket->save($con);
				}
				$this->setTicket($this->aTicket);
			}

			if ($this->asfGuardUserRelatedByUserId !== null) {
				if ($this->asfGuardUserRelatedByUserId->isModified() || $this->asfGuardUserRelatedByUserId->isNew()) {
					$affectedRows += $this->asfGuardUserRelatedByUserId->save($con);
				}
				$this->setsfGuardUserRelatedByUserId($this->asfGuardUserRelatedByUserId);
			}

			if ($this->asfGuardUserRelatedByAssigneeId !== null) {
				if ($this->asfGuardUserRelatedByAssigneeId->isModified() || $this->asfGuardUserRelatedByAssigneeId->isNew()) {
					$affectedRows += $this->asfGuardUserRelatedByAssigneeId->save($con);
				}
				$this->setsfGuardUserRelatedByAssigneeId($this->asfGuardUserRelatedByAssigneeId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TicketEventPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TicketEventPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TicketEventPeer::doUpdate($this, $con);
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


												
			if ($this->aTicket !== null) {
				if (!$this->aTicket->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTicket->getValidationFailures());
				}
			}

			if ($this->asfGuardUserRelatedByUserId !== null) {
				if (!$this->asfGuardUserRelatedByUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserRelatedByUserId->getValidationFailures());
				}
			}

			if ($this->asfGuardUserRelatedByAssigneeId !== null) {
				if (!$this->asfGuardUserRelatedByAssigneeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserRelatedByAssigneeId->getValidationFailures());
				}
			}


			if (($retval = TicketEventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TicketEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTicketId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getContent();
				break;
			case 5:
				return $this->getState();
				break;
			case 6:
				return $this->getAssigneeId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TicketEventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTicketId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getContent(),
			$keys[5] => $this->getState(),
			$keys[6] => $this->getAssigneeId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TicketEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTicketId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setContent($value);
				break;
			case 5:
				$this->setState($value);
				break;
			case 6:
				$this->setAssigneeId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TicketEventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTicketId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setState($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAssigneeId($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TicketEventPeer::DATABASE_NAME);

		if ($this->isColumnModified(TicketEventPeer::ID)) $criteria->add(TicketEventPeer::ID, $this->id);
		if ($this->isColumnModified(TicketEventPeer::TICKET_ID)) $criteria->add(TicketEventPeer::TICKET_ID, $this->ticket_id);
		if ($this->isColumnModified(TicketEventPeer::USER_ID)) $criteria->add(TicketEventPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(TicketEventPeer::CREATED_AT)) $criteria->add(TicketEventPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TicketEventPeer::CONTENT)) $criteria->add(TicketEventPeer::CONTENT, $this->content);
		if ($this->isColumnModified(TicketEventPeer::STATE)) $criteria->add(TicketEventPeer::STATE, $this->state);
		if ($this->isColumnModified(TicketEventPeer::ASSIGNEE_ID)) $criteria->add(TicketEventPeer::ASSIGNEE_ID, $this->assignee_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TicketEventPeer::DATABASE_NAME);

		$criteria->add(TicketEventPeer::ID, $this->id);

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

		$copyObj->setTicketId($this->ticket_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setContent($this->content);

		$copyObj->setState($this->state);

		$copyObj->setAssigneeId($this->assignee_id);


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
			self::$peer = new TicketEventPeer();
		}
		return self::$peer;
	}

	
	public function setTicket(Ticket $v = null)
	{
		if ($v === null) {
			$this->setTicketId(NULL);
		} else {
			$this->setTicketId($v->getId());
		}

		$this->aTicket = $v;

						if ($v !== null) {
			$v->addTicketEvent($this);
		}

		return $this;
	}


	
	public function getTicket(PropelPDO $con = null)
	{
		if ($this->aTicket === null && ($this->ticket_id !== null)) {
			$c = new Criteria(TicketPeer::DATABASE_NAME);
			$c->add(TicketPeer::ID, $this->ticket_id);
			$this->aTicket = TicketPeer::doSelectOne($c, $con);
			
		}
		return $this->aTicket;
	}

	
	public function setsfGuardUserRelatedByUserId(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUserRelatedByUserId = $v;

						if ($v !== null) {
			$v->addTicketEventRelatedByUserId($this);
		}

		return $this;
	}


	
	public function getsfGuardUserRelatedByUserId(PropelPDO $con = null)
	{
		if ($this->asfGuardUserRelatedByUserId === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->user_id);
			$this->asfGuardUserRelatedByUserId = sfGuardUserPeer::doSelectOne($c, $con);
			
		}
		return $this->asfGuardUserRelatedByUserId;
	}

	
	public function setsfGuardUserRelatedByAssigneeId(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setAssigneeId(NULL);
		} else {
			$this->setAssigneeId($v->getId());
		}

		$this->asfGuardUserRelatedByAssigneeId = $v;

						if ($v !== null) {
			$v->addTicketEventRelatedByAssigneeId($this);
		}

		return $this;
	}


	
	public function getsfGuardUserRelatedByAssigneeId(PropelPDO $con = null)
	{
		if ($this->asfGuardUserRelatedByAssigneeId === null && ($this->assignee_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->assignee_id);
			$this->asfGuardUserRelatedByAssigneeId = sfGuardUserPeer::doSelectOne($c, $con);
			
		}
		return $this->asfGuardUserRelatedByAssigneeId;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTicket = null;
			$this->asfGuardUserRelatedByUserId = null;
			$this->asfGuardUserRelatedByAssigneeId = null;
	}

} 