<?php


abstract class BasesfGuardUserProfile extends BaseObject  implements Persistent {


  const PEER = 'sfGuardUserProfilePeer';

	
	protected static $peer;

	
	protected $user_id;

	
	protected $first_name;

	
	protected $middle_name;

	
	protected $last_name;

	
	protected $pronunciation;

	
	protected $role_id;

	
	protected $gender;

	
	protected $email;

	
	protected $email_state;

	
	protected $email_verification_code;

	
	protected $birthdate;

	
	protected $birthplace;

	
	protected $import_code;

	
	protected $system_alerts;

	
	protected $asfGuardUser;

	
	protected $aRole;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->email_state = 0;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getFirstName()
	{
		return $this->first_name;
	}

	
	public function getMiddleName()
	{
		return $this->middle_name;
	}

	
	public function getLastName()
	{
		return $this->last_name;
	}

	
	public function getPronunciation()
	{
		return $this->pronunciation;
	}

	
	public function getRoleId()
	{
		return $this->role_id;
	}

	
	public function getGender()
	{
		return $this->gender;
	}

	
	public function getEmail()
	{
		return $this->email;
	}

	
	public function getEmailState()
	{
		return $this->email_state;
	}

	
	public function getEmailVerificationCode()
	{
		return $this->email_verification_code;
	}

	
	public function getBirthdate($format = 'Y-m-d')
	{
		if ($this->birthdate === null) {
			return null;
		}


		if ($this->birthdate === '0000-00-00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->birthdate);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->birthdate, true), $x);
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

	
	public function getBirthplace()
	{
		return $this->birthplace;
	}

	
	public function getImportCode()
	{
		return $this->import_code;
	}

	
	public function getSystemAlerts()
	{
		return $this->system_alerts;
	}

	
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::FIRST_NAME;
		}

		return $this;
	} 
	
	public function setMiddleName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->middle_name !== $v) {
			$this->middle_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::MIDDLE_NAME;
		}

		return $this;
	} 
	
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::LAST_NAME;
		}

		return $this;
	} 
	
	public function setPronunciation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pronunciation !== $v) {
			$this->pronunciation = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::PRONUNCIATION;
		}

		return $this;
	} 
	
	public function setRoleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->role_id !== $v) {
			$this->role_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::ROLE_ID;
		}

		if ($this->aRole !== null && $this->aRole->getId() !== $v) {
			$this->aRole = null;
		}

		return $this;
	} 
	
	public function setGender($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::GENDER;
		}

		return $this;
	} 
	
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL;
		}

		return $this;
	} 
	
	public function setEmailState($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->email_state !== $v || $v === 0) {
			$this->email_state = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL_STATE;
		}

		return $this;
	} 
	
	public function setEmailVerificationCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email_verification_code !== $v) {
			$this->email_verification_code = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE;
		}

		return $this;
	} 
	
	public function setBirthdate($v)
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

		if ( $this->birthdate !== null || $dt !== null ) {
			
			$currNorm = ($this->birthdate !== null && $tmpDt = new DateTime($this->birthdate)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->birthdate = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = sfGuardUserProfilePeer::BIRTHDATE;
			}
		} 
		return $this;
	} 
	
	public function setBirthplace($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->birthplace !== $v) {
			$this->birthplace = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::BIRTHPLACE;
		}

		return $this;
	} 
	
	public function setImportCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->import_code !== $v) {
			$this->import_code = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::IMPORT_CODE;
		}

		return $this;
	} 
	
	public function setSystemAlerts($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->system_alerts !== $v) {
			$this->system_alerts = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::SYSTEM_ALERTS;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(sfGuardUserProfilePeer::EMAIL_STATE))) {
				return false;
			}

			if ($this->email_state !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->user_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->first_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->middle_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->last_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->pronunciation = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->role_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->gender = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->email = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->email_state = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->email_verification_code = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->birthdate = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->birthplace = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->import_code = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->system_alerts = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUserProfile object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aRole !== null && $this->role_id !== $this->aRole->getId()) {
			$this->aRole = null;
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = sfGuardUserProfilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->aRole = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			sfGuardUserProfilePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			sfGuardUserProfilePeer::addInstanceToPool($this);
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

			if ($this->aRole !== null) {
				if ($this->aRole->isModified() || $this->aRole->isNew()) {
					$affectedRows += $this->aRole->save($con);
				}
				$this->setRole($this->aRole);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserProfilePeer::doUpdate($this, $con);
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

			if ($this->aRole !== null) {
				if (!$this->aRole->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRole->getValidationFailures());
				}
			}


			if (($retval = sfGuardUserProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getFirstName();
				break;
			case 2:
				return $this->getMiddleName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getPronunciation();
				break;
			case 5:
				return $this->getRoleId();
				break;
			case 6:
				return $this->getGender();
				break;
			case 7:
				return $this->getEmail();
				break;
			case 8:
				return $this->getEmailState();
				break;
			case 9:
				return $this->getEmailVerificationCode();
				break;
			case 10:
				return $this->getBirthdate();
				break;
			case 11:
				return $this->getBirthplace();
				break;
			case 12:
				return $this->getImportCode();
				break;
			case 13:
				return $this->getSystemAlerts();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getFirstName(),
			$keys[2] => $this->getMiddleName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getPronunciation(),
			$keys[5] => $this->getRoleId(),
			$keys[6] => $this->getGender(),
			$keys[7] => $this->getEmail(),
			$keys[8] => $this->getEmailState(),
			$keys[9] => $this->getEmailVerificationCode(),
			$keys[10] => $this->getBirthdate(),
			$keys[11] => $this->getBirthplace(),
			$keys[12] => $this->getImportCode(),
			$keys[13] => $this->getSystemAlerts(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setFirstName($value);
				break;
			case 2:
				$this->setMiddleName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setPronunciation($value);
				break;
			case 5:
				$this->setRoleId($value);
				break;
			case 6:
				$this->setGender($value);
				break;
			case 7:
				$this->setEmail($value);
				break;
			case 8:
				$this->setEmailState($value);
				break;
			case 9:
				$this->setEmailVerificationCode($value);
				break;
			case 10:
				$this->setBirthdate($value);
				break;
			case 11:
				$this->setBirthplace($value);
				break;
			case 12:
				$this->setImportCode($value);
				break;
			case 13:
				$this->setSystemAlerts($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFirstName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMiddleName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPronunciation($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRoleId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setGender($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEmailState($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEmailVerificationCode($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBirthdate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBirthplace($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setImportCode($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setSystemAlerts($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserProfilePeer::USER_ID)) $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::FIRST_NAME)) $criteria->add(sfGuardUserProfilePeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::MIDDLE_NAME)) $criteria->add(sfGuardUserProfilePeer::MIDDLE_NAME, $this->middle_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::LAST_NAME)) $criteria->add(sfGuardUserProfilePeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::PRONUNCIATION)) $criteria->add(sfGuardUserProfilePeer::PRONUNCIATION, $this->pronunciation);
		if ($this->isColumnModified(sfGuardUserProfilePeer::ROLE_ID)) $criteria->add(sfGuardUserProfilePeer::ROLE_ID, $this->role_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::GENDER)) $criteria->add(sfGuardUserProfilePeer::GENDER, $this->gender);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL)) $criteria->add(sfGuardUserProfilePeer::EMAIL, $this->email);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL_STATE)) $criteria->add(sfGuardUserProfilePeer::EMAIL_STATE, $this->email_state);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE)) $criteria->add(sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE, $this->email_verification_code);
		if ($this->isColumnModified(sfGuardUserProfilePeer::BIRTHDATE)) $criteria->add(sfGuardUserProfilePeer::BIRTHDATE, $this->birthdate);
		if ($this->isColumnModified(sfGuardUserProfilePeer::BIRTHPLACE)) $criteria->add(sfGuardUserProfilePeer::BIRTHPLACE, $this->birthplace);
		if ($this->isColumnModified(sfGuardUserProfilePeer::IMPORT_CODE)) $criteria->add(sfGuardUserProfilePeer::IMPORT_CODE, $this->import_code);
		if ($this->isColumnModified(sfGuardUserProfilePeer::SYSTEM_ALERTS)) $criteria->add(sfGuardUserProfilePeer::SYSTEM_ALERTS, $this->system_alerts);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUserId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUserId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setMiddleName($this->middle_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setPronunciation($this->pronunciation);

		$copyObj->setRoleId($this->role_id);

		$copyObj->setGender($this->gender);

		$copyObj->setEmail($this->email);

		$copyObj->setEmailState($this->email_state);

		$copyObj->setEmailVerificationCode($this->email_verification_code);

		$copyObj->setBirthdate($this->birthdate);

		$copyObj->setBirthplace($this->birthplace);

		$copyObj->setImportCode($this->import_code);

		$copyObj->setSystemAlerts($this->system_alerts);


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
			self::$peer = new sfGuardUserProfilePeer();
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
			$v->setsfGuardUserProfile($this);
		}

		return $this;
	}


	
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->user_id);
			$this->asfGuardUser = sfGuardUserPeer::doSelectOne($c, $con);
						$this->asfGuardUser->setsfGuardUserProfile($this);
		}
		return $this->asfGuardUser;
	}

	
	public function setRole(Role $v = null)
	{
		if ($v === null) {
			$this->setRoleId(NULL);
		} else {
			$this->setRoleId($v->getId());
		}

		$this->aRole = $v;

						if ($v !== null) {
			$v->addsfGuardUserProfile($this);
		}

		return $this;
	}


	
	public function getRole(PropelPDO $con = null)
	{
		if ($this->aRole === null && ($this->role_id !== null)) {
			$c = new Criteria(RolePeer::DATABASE_NAME);
			$c->add(RolePeer::ID, $this->role_id);
			$this->aRole = RolePeer::doSelectOne($c, $con);
			
		}
		return $this->aRole;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->asfGuardUser = null;
			$this->aRole = null;
	}

} 