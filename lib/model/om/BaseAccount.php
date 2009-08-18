<?php


abstract class BaseAccount extends BaseObject  implements Persistent {


  const PEER = 'AccountPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $user_id;

	
	protected $account_type_id;

	
	protected $info;

	
	protected $settings;

	
	protected $exists;

	
	protected $is_locked;

	
	protected $temporary_password;

	
	protected $info_updated_at;

	
	protected $last_known_login_at;

	
	protected $quota_percentage;

	
	protected $updated_at;

	
	protected $created_at;

	
	protected $asfGuardUser;

	
	protected $aAccountType;

	
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

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getAccountTypeId()
	{
		return $this->account_type_id;
	}

	
	public function getInfo()
	{
		return $this->info;
	}

	
	public function getSettings()
	{
		return $this->settings;
	}

	
	public function getExists()
	{
		return $this->exists;
	}

	
	public function getIsLocked()
	{
		return $this->is_locked;
	}

	
	public function getTemporaryPassword()
	{
		return $this->temporary_password;
	}

	
	public function getInfoUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->info_updated_at === null) {
			return null;
		}


		if ($this->info_updated_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->info_updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->info_updated_at, true), $x);
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

	
	public function getLastKnownLoginAt($format = 'Y-m-d H:i:s')
	{
		if ($this->last_known_login_at === null) {
			return null;
		}


		if ($this->last_known_login_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->last_known_login_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_known_login_at, true), $x);
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

	
	public function getQuotaPercentage()
	{
		return $this->quota_percentage;
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AccountPeer::ID;
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
			$this->modifiedColumns[] = AccountPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setAccountTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->account_type_id !== $v) {
			$this->account_type_id = $v;
			$this->modifiedColumns[] = AccountPeer::ACCOUNT_TYPE_ID;
		}

		if ($this->aAccountType !== null && $this->aAccountType->getId() !== $v) {
			$this->aAccountType = null;
		}

		return $this;
	} 
	
	public function setInfo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->info !== $v) {
			$this->info = $v;
			$this->modifiedColumns[] = AccountPeer::INFO;
		}

		return $this;
	} 
	
	public function setSettings($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->settings !== $v) {
			$this->settings = $v;
			$this->modifiedColumns[] = AccountPeer::SETTINGS;
		}

		return $this;
	} 
	
	public function setExists($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->exists !== $v) {
			$this->exists = $v;
			$this->modifiedColumns[] = AccountPeer::EXISTS;
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
			$this->modifiedColumns[] = AccountPeer::IS_LOCKED;
		}

		return $this;
	} 
	
	public function setTemporaryPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->temporary_password !== $v) {
			$this->temporary_password = $v;
			$this->modifiedColumns[] = AccountPeer::TEMPORARY_PASSWORD;
		}

		return $this;
	} 
	
	public function setInfoUpdatedAt($v)
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

		if ( $this->info_updated_at !== null || $dt !== null ) {
			
			$currNorm = ($this->info_updated_at !== null && $tmpDt = new DateTime($this->info_updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->info_updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AccountPeer::INFO_UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setLastKnownLoginAt($v)
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

		if ( $this->last_known_login_at !== null || $dt !== null ) {
			
			$currNorm = ($this->last_known_login_at !== null && $tmpDt = new DateTime($this->last_known_login_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->last_known_login_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AccountPeer::LAST_KNOWN_LOGIN_AT;
			}
		} 
		return $this;
	} 
	
	public function setQuotaPercentage($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->quota_percentage !== $v) {
			$this->quota_percentage = $v;
			$this->modifiedColumns[] = AccountPeer::QUOTA_PERCENTAGE;
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
				$this->modifiedColumns[] = AccountPeer::UPDATED_AT;
			}
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
				$this->modifiedColumns[] = AccountPeer::CREATED_AT;
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
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->account_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->info = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->settings = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->exists = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->is_locked = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->temporary_password = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->info_updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->last_known_login_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->quota_percentage = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->created_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Account object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aAccountType !== null && $this->account_type_id !== $this->aAccountType->getId()) {
			$this->aAccountType = null;
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
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AccountPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->aAccountType = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AccountPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(AccountPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

    if ($this->isNew() && !$this->isColumnModified(AccountPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			AccountPeer::addInstanceToPool($this);
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

			if ($this->aAccountType !== null) {
				if ($this->aAccountType->isModified() || $this->aAccountType->isNew()) {
					$affectedRows += $this->aAccountType->save($con);
				}
				$this->setAccountType($this->aAccountType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AccountPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AccountPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AccountPeer::doUpdate($this, $con);
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


												
			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aAccountType !== null) {
				if (!$this->aAccountType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAccountType->getValidationFailures());
				}
			}


			if (($retval = AccountPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 2:
				return $this->getAccountTypeId();
				break;
			case 3:
				return $this->getInfo();
				break;
			case 4:
				return $this->getSettings();
				break;
			case 5:
				return $this->getExists();
				break;
			case 6:
				return $this->getIsLocked();
				break;
			case 7:
				return $this->getTemporaryPassword();
				break;
			case 8:
				return $this->getInfoUpdatedAt();
				break;
			case 9:
				return $this->getLastKnownLoginAt();
				break;
			case 10:
				return $this->getQuotaPercentage();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AccountPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getAccountTypeId(),
			$keys[3] => $this->getInfo(),
			$keys[4] => $this->getSettings(),
			$keys[5] => $this->getExists(),
			$keys[6] => $this->getIsLocked(),
			$keys[7] => $this->getTemporaryPassword(),
			$keys[8] => $this->getInfoUpdatedAt(),
			$keys[9] => $this->getLastKnownLoginAt(),
			$keys[10] => $this->getQuotaPercentage(),
			$keys[11] => $this->getUpdatedAt(),
			$keys[12] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setAccountTypeId($value);
				break;
			case 3:
				$this->setInfo($value);
				break;
			case 4:
				$this->setSettings($value);
				break;
			case 5:
				$this->setExists($value);
				break;
			case 6:
				$this->setIsLocked($value);
				break;
			case 7:
				$this->setTemporaryPassword($value);
				break;
			case 8:
				$this->setInfoUpdatedAt($value);
				break;
			case 9:
				$this->setLastKnownLoginAt($value);
				break;
			case 10:
				$this->setQuotaPercentage($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccountPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAccountTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInfo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSettings($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setExists($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsLocked($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTemporaryPassword($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInfoUpdatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLastKnownLoginAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setQuotaPercentage($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AccountPeer::DATABASE_NAME);

		if ($this->isColumnModified(AccountPeer::ID)) $criteria->add(AccountPeer::ID, $this->id);
		if ($this->isColumnModified(AccountPeer::USER_ID)) $criteria->add(AccountPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(AccountPeer::ACCOUNT_TYPE_ID)) $criteria->add(AccountPeer::ACCOUNT_TYPE_ID, $this->account_type_id);
		if ($this->isColumnModified(AccountPeer::INFO)) $criteria->add(AccountPeer::INFO, $this->info);
		if ($this->isColumnModified(AccountPeer::SETTINGS)) $criteria->add(AccountPeer::SETTINGS, $this->settings);
		if ($this->isColumnModified(AccountPeer::EXISTS)) $criteria->add(AccountPeer::EXISTS, $this->exists);
		if ($this->isColumnModified(AccountPeer::IS_LOCKED)) $criteria->add(AccountPeer::IS_LOCKED, $this->is_locked);
		if ($this->isColumnModified(AccountPeer::TEMPORARY_PASSWORD)) $criteria->add(AccountPeer::TEMPORARY_PASSWORD, $this->temporary_password);
		if ($this->isColumnModified(AccountPeer::INFO_UPDATED_AT)) $criteria->add(AccountPeer::INFO_UPDATED_AT, $this->info_updated_at);
		if ($this->isColumnModified(AccountPeer::LAST_KNOWN_LOGIN_AT)) $criteria->add(AccountPeer::LAST_KNOWN_LOGIN_AT, $this->last_known_login_at);
		if ($this->isColumnModified(AccountPeer::QUOTA_PERCENTAGE)) $criteria->add(AccountPeer::QUOTA_PERCENTAGE, $this->quota_percentage);
		if ($this->isColumnModified(AccountPeer::UPDATED_AT)) $criteria->add(AccountPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(AccountPeer::CREATED_AT)) $criteria->add(AccountPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AccountPeer::DATABASE_NAME);

		$criteria->add(AccountPeer::ID, $this->id);

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

		$copyObj->setUserId($this->user_id);

		$copyObj->setAccountTypeId($this->account_type_id);

		$copyObj->setInfo($this->info);

		$copyObj->setSettings($this->settings);

		$copyObj->setExists($this->exists);

		$copyObj->setIsLocked($this->is_locked);

		$copyObj->setTemporaryPassword($this->temporary_password);

		$copyObj->setInfoUpdatedAt($this->info_updated_at);

		$copyObj->setLastKnownLoginAt($this->last_known_login_at);

		$copyObj->setQuotaPercentage($this->quota_percentage);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new AccountPeer();
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
			$v->addAccount($this);
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

	
	public function setAccountType(AccountType $v = null)
	{
		if ($v === null) {
			$this->setAccountTypeId(NULL);
		} else {
			$this->setAccountTypeId($v->getId());
		}

		$this->aAccountType = $v;

						if ($v !== null) {
			$v->addAccount($this);
		}

		return $this;
	}


	
	public function getAccountType(PropelPDO $con = null)
	{
		if ($this->aAccountType === null && ($this->account_type_id !== null)) {
			$c = new Criteria(AccountTypePeer::DATABASE_NAME);
			$c->add(AccountTypePeer::ID, $this->account_type_id);
			$this->aAccountType = AccountTypePeer::doSelectOne($c, $con);
			
		}
		return $this->aAccountType;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->asfGuardUser = null;
			$this->aAccountType = null;
	}

} 