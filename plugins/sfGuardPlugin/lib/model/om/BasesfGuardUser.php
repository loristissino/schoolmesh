<?php


abstract class BasesfGuardUser extends BaseObject  implements Persistent {


  const PEER = 'sfGuardUserPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $username;

	
	protected $algorithm;

	
	protected $salt;

	
	protected $password;

	
	protected $created_at;

	
	protected $last_login;

	
	protected $is_active;

	
	protected $is_super_admin;

	
	protected $collsfGuardUserPermissions;

	
	private $lastsfGuardUserPermissionCriteria = null;

	
	protected $collsfGuardUserGroups;

	
	private $lastsfGuardUserGroupCriteria = null;

	
	protected $collsfGuardRememberKeys;

	
	private $lastsfGuardRememberKeyCriteria = null;

	
	protected $singlesfGuardUserProfile;

	
	protected $collAppointments;

	
	private $lastAppointmentCriteria = null;

	
	protected $collEnrolments;

	
	private $lastEnrolmentCriteria = null;

	
	protected $collUserTeams;

	
	private $lastUserTeamCriteria = null;

	
	protected $collWorkplans;

	
	private $lastWorkplanCriteria = null;

	
	protected $collWpmodules;

	
	private $lastWpmoduleCriteria = null;

	
	protected $collLanlogs;

	
	private $lastLanlogCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->algorithm = 'sha1';
		$this->is_active = true;
		$this->is_super_admin = false;
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getUsername()
	{
		return $this->username;
	}

	
	public function getAlgorithm()
	{
		return $this->algorithm;
	}

	
	public function getSalt()
	{
		return $this->salt;
	}

	
	public function getPassword()
	{
		return $this->password;
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

	
	public function getLastLogin($format = 'Y-m-d H:i:s')
	{
		if ($this->last_login === null) {
			return null;
		}


		if ($this->last_login === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->last_login);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login, true), $x);
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

	
	public function getIsActive()
	{
		return $this->is_active;
	}

	
	public function getIsSuperAdmin()
	{
		return $this->is_super_admin;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ID;
		}

		return $this;
	} 
	
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::USERNAME;
		}

		return $this;
	} 
	
	public function setAlgorithm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->algorithm !== $v || $v === 'sha1') {
			$this->algorithm = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ALGORITHM;
		}

		return $this;
	} 
	
	public function setSalt($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::SALT;
		}

		return $this;
	} 
	
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::PASSWORD;
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
				$this->modifiedColumns[] = sfGuardUserPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setLastLogin($v)
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

		if ( $this->last_login !== null || $dt !== null ) {
			
			$currNorm = ($this->last_login !== null && $tmpDt = new DateTime($this->last_login)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->last_login = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = sfGuardUserPeer::LAST_LOGIN;
			}
		} 
		return $this;
	} 
	
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_ACTIVE;
		}

		return $this;
	} 
	
	public function setIsSuperAdmin($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_super_admin !== $v || $v === false) {
			$this->is_super_admin = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_SUPER_ADMIN;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(sfGuardUserPeer::ALGORITHM,sfGuardUserPeer::IS_ACTIVE,sfGuardUserPeer::IS_SUPER_ADMIN))) {
				return false;
			}

			if ($this->algorithm !== 'sha1') {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->is_super_admin !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->algorithm = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->salt = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->password = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->last_login = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->is_active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->is_super_admin = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUser object", $e);
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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = sfGuardUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collsfGuardUserPermissions = null;
			$this->lastsfGuardUserPermissionCriteria = null;

			$this->collsfGuardUserGroups = null;
			$this->lastsfGuardUserGroupCriteria = null;

			$this->collsfGuardRememberKeys = null;
			$this->lastsfGuardRememberKeyCriteria = null;

			$this->singlesfGuardUserProfile = null;

			$this->collAppointments = null;
			$this->lastAppointmentCriteria = null;

			$this->collEnrolments = null;
			$this->lastEnrolmentCriteria = null;

			$this->collUserTeams = null;
			$this->lastUserTeamCriteria = null;

			$this->collWorkplans = null;
			$this->lastWorkplanCriteria = null;

			$this->collWpmodules = null;
			$this->lastWpmoduleCriteria = null;

			$this->collLanlogs = null;
			$this->lastLanlogCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			sfGuardUserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(sfGuardUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			sfGuardUserPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = sfGuardUserPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collsfGuardUserPermissions !== null) {
				foreach ($this->collsfGuardUserPermissions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardUserGroups !== null) {
				foreach ($this->collsfGuardUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardRememberKeys !== null) {
				foreach ($this->collsfGuardRememberKeys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singlesfGuardUserProfile !== null) {
				if (!$this->singlesfGuardUserProfile->isDeleted()) {
						$affectedRows += $this->singlesfGuardUserProfile->save($con);
				}
			}

			if ($this->collAppointments !== null) {
				foreach ($this->collAppointments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEnrolments !== null) {
				foreach ($this->collEnrolments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserTeams !== null) {
				foreach ($this->collUserTeams as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWorkplans !== null) {
				foreach ($this->collWorkplans as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWpmodules !== null) {
				foreach ($this->collWpmodules as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLanlogs !== null) {
				foreach ($this->collLanlogs as $referrerFK) {
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


			if (($retval = sfGuardUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserPermissions !== null) {
					foreach ($this->collsfGuardUserPermissions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserGroups !== null) {
					foreach ($this->collsfGuardUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardRememberKeys !== null) {
					foreach ($this->collsfGuardRememberKeys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singlesfGuardUserProfile !== null) {
					if (!$this->singlesfGuardUserProfile->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singlesfGuardUserProfile->getValidationFailures());
					}
				}

				if ($this->collAppointments !== null) {
					foreach ($this->collAppointments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEnrolments !== null) {
					foreach ($this->collEnrolments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserTeams !== null) {
					foreach ($this->collUserTeams as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWorkplans !== null) {
					foreach ($this->collWorkplans as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWpmodules !== null) {
					foreach ($this->collWpmodules as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLanlogs !== null) {
					foreach ($this->collLanlogs as $referrerFK) {
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getAlgorithm();
				break;
			case 3:
				return $this->getSalt();
				break;
			case 4:
				return $this->getPassword();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getLastLogin();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsSuperAdmin();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = sfGuardUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getAlgorithm(),
			$keys[3] => $this->getSalt(),
			$keys[4] => $this->getPassword(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getLastLogin(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsSuperAdmin(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUsername($value);
				break;
			case 2:
				$this->setAlgorithm($value);
				break;
			case 3:
				$this->setSalt($value);
				break;
			case 4:
				$this->setPassword($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setLastLogin($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsSuperAdmin($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlgorithm($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSalt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastLogin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSuperAdmin($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserPeer::ID)) $criteria->add(sfGuardUserPeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserPeer::USERNAME)) $criteria->add(sfGuardUserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(sfGuardUserPeer::ALGORITHM)) $criteria->add(sfGuardUserPeer::ALGORITHM, $this->algorithm);
		if ($this->isColumnModified(sfGuardUserPeer::SALT)) $criteria->add(sfGuardUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(sfGuardUserPeer::PASSWORD)) $criteria->add(sfGuardUserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(sfGuardUserPeer::CREATED_AT)) $criteria->add(sfGuardUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfGuardUserPeer::LAST_LOGIN)) $criteria->add(sfGuardUserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(sfGuardUserPeer::IS_ACTIVE)) $criteria->add(sfGuardUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(sfGuardUserPeer::IS_SUPER_ADMIN)) $criteria->add(sfGuardUserPeer::IS_SUPER_ADMIN, $this->is_super_admin);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		$criteria->add(sfGuardUserPeer::ID, $this->id);

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

		$copyObj->setUsername($this->username);

		$copyObj->setAlgorithm($this->algorithm);

		$copyObj->setSalt($this->salt);

		$copyObj->setPassword($this->password);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastLogin($this->last_login);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsSuperAdmin($this->is_super_admin);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getsfGuardUserPermissions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addsfGuardUserPermission($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardUserGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addsfGuardUserGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardRememberKeys() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addsfGuardRememberKey($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getsfGuardUserProfile();
			if ($relObj) {
				$copyObj->setsfGuardUserProfile($relObj->copy($deepCopy));
			}

			foreach ($this->getAppointments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAppointment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEnrolments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addEnrolment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserTeams() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addUserTeam($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWorkplans() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWorkplan($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWpmodules() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addWpmodule($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLanlogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addLanlog($relObj->copy($deepCopy));
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
			self::$peer = new sfGuardUserPeer();
		}
		return self::$peer;
	}

	
	public function clearsfGuardUserPermissions()
	{
		$this->collsfGuardUserPermissions = null; 	}

	
	public function initsfGuardUserPermissions()
	{
		$this->collsfGuardUserPermissions = array();
	}

	
	public function getsfGuardUserPermissions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
					$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;
		return $this->collsfGuardUserPermissions;
	}

	
	public function countsfGuardUserPermissions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				$count = sfGuardUserPermissionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
					$count = sfGuardUserPermissionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfGuardUserPermissions);
				}
			} else {
				$count = count($this->collsfGuardUserPermissions);
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;
		return $count;
	}

	
	public function addsfGuardUserPermission(sfGuardUserPermission $l)
	{
		if ($this->collsfGuardUserPermissions === null) {
			$this->initsfGuardUserPermissions();
		}
		if (!in_array($l, $this->collsfGuardUserPermissions, true)) { 			array_push($this->collsfGuardUserPermissions, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getsfGuardUserPermissionsJoinsfGuardPermission($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->id);

			if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;

		return $this->collsfGuardUserPermissions;
	}

	
	public function clearsfGuardUserGroups()
	{
		$this->collsfGuardUserGroups = null; 	}

	
	public function initsfGuardUserGroups()
	{
		$this->collsfGuardUserGroups = array();
	}

	
	public function getsfGuardUserGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
					$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;
		return $this->collsfGuardUserGroups;
	}

	
	public function countsfGuardUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				$count = sfGuardUserGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
					$count = sfGuardUserGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfGuardUserGroups);
				}
			} else {
				$count = count($this->collsfGuardUserGroups);
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;
		return $count;
	}

	
	public function addsfGuardUserGroup(sfGuardUserGroup $l)
	{
		if ($this->collsfGuardUserGroups === null) {
			$this->initsfGuardUserGroups();
		}
		if (!in_array($l, $this->collsfGuardUserGroups, true)) { 			array_push($this->collsfGuardUserGroups, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getsfGuardUserGroupsJoinsfGuardGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->id);

			if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;

		return $this->collsfGuardUserGroups;
	}

	
	public function clearsfGuardRememberKeys()
	{
		$this->collsfGuardRememberKeys = null; 	}

	
	public function initsfGuardRememberKeys()
	{
		$this->collsfGuardRememberKeys = array();
	}

	
	public function getsfGuardRememberKeys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardRememberKeys === null) {
			if ($this->isNew()) {
			   $this->collsfGuardRememberKeys = array();
			} else {

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardRememberKeyCriteria) || !$this->lastsfGuardRememberKeyCriteria->equals($criteria)) {
					$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardRememberKeyCriteria = $criteria;
		return $this->collsfGuardRememberKeys;
	}

	
	public function countsfGuardRememberKeys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardRememberKeys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				$count = sfGuardRememberKeyPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->id);

				if (!isset($this->lastsfGuardRememberKeyCriteria) || !$this->lastsfGuardRememberKeyCriteria->equals($criteria)) {
					$count = sfGuardRememberKeyPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfGuardRememberKeys);
				}
			} else {
				$count = count($this->collsfGuardRememberKeys);
			}
		}
		$this->lastsfGuardRememberKeyCriteria = $criteria;
		return $count;
	}

	
	public function addsfGuardRememberKey(sfGuardRememberKey $l)
	{
		if ($this->collsfGuardRememberKeys === null) {
			$this->initsfGuardRememberKeys();
		}
		if (!in_array($l, $this->collsfGuardRememberKeys, true)) { 			array_push($this->collsfGuardRememberKeys, $l);
			$l->setsfGuardUser($this);
		}
	}

	
	public function getsfGuardUserProfile(PropelPDO $con = null)
	{

		if ($this->singlesfGuardUserProfile === null && !$this->isNew()) {
			$this->singlesfGuardUserProfile = sfGuardUserProfilePeer::retrieveByPK($this->id, $con);
		}

		return $this->singlesfGuardUserProfile;
	}

	
	public function setsfGuardUserProfile(sfGuardUserProfile $v)
	{
		$this->singlesfGuardUserProfile = $v;

				if ($v->getsfGuardUser() === null) {
			$v->setsfGuardUser($this);
		}

		return $this;
	}

	
	public function clearAppointments()
	{
		$this->collAppointments = null; 	}

	
	public function initAppointments()
	{
		$this->collAppointments = array();
	}

	
	public function getAppointments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
			   $this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				AppointmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$this->collAppointments = AppointmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAppointmentCriteria = $criteria;
		return $this->collAppointments;
	}

	
	public function countAppointments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$count = AppointmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
					$count = AppointmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAppointments);
				}
			} else {
				$count = count($this->collAppointments);
			}
		}
		$this->lastAppointmentCriteria = $criteria;
		return $count;
	}

	
	public function addAppointment(Appointment $l)
	{
		if ($this->collAppointments === null) {
			$this->initAppointments();
		}
		if (!in_array($l, $this->collAppointments, true)) { 			array_push($this->collAppointments, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getAppointmentsJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}


	
	public function getAppointmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAppointments === null) {
			if ($this->isNew()) {
				$this->collAppointments = array();
			} else {

				$criteria->add(AppointmentPeer::USER_ID, $this->id);

				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AppointmentPeer::USER_ID, $this->id);

			if (!isset($this->lastAppointmentCriteria) || !$this->lastAppointmentCriteria->equals($criteria)) {
				$this->collAppointments = AppointmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastAppointmentCriteria = $criteria;

		return $this->collAppointments;
	}

	
	public function clearEnrolments()
	{
		$this->collEnrolments = null; 	}

	
	public function initEnrolments()
	{
		$this->collEnrolments = array();
	}

	
	public function getEnrolments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
			   $this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				EnrolmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
					$this->collEnrolments = EnrolmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEnrolmentCriteria = $criteria;
		return $this->collEnrolments;
	}

	
	public function countEnrolments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				$count = EnrolmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
					$count = EnrolmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collEnrolments);
				}
			} else {
				$count = count($this->collEnrolments);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;
		return $count;
	}

	
	public function addEnrolment(Enrolment $l)
	{
		if ($this->collEnrolments === null) {
			$this->initEnrolments();
		}
		if (!in_array($l, $this->collEnrolments, true)) { 			array_push($this->collEnrolments, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getEnrolmentsJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(EnrolmentPeer::USER_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
	}


	
	public function getEnrolmentsJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEnrolments === null) {
			if ($this->isNew()) {
				$this->collEnrolments = array();
			} else {

				$criteria->add(EnrolmentPeer::USER_ID, $this->id);

				$this->collEnrolments = EnrolmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(EnrolmentPeer::USER_ID, $this->id);

			if (!isset($this->lastEnrolmentCriteria) || !$this->lastEnrolmentCriteria->equals($criteria)) {
				$this->collEnrolments = EnrolmentPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastEnrolmentCriteria = $criteria;

		return $this->collEnrolments;
	}

	
	public function clearUserTeams()
	{
		$this->collUserTeams = null; 	}

	
	public function initUserTeams()
	{
		$this->collUserTeams = array();
	}

	
	public function getUserTeams($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
			   $this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				UserTeamPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
					$this->collUserTeams = UserTeamPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserTeamCriteria = $criteria;
		return $this->collUserTeams;
	}

	
	public function countUserTeams(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				$count = UserTeamPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
					$count = UserTeamPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserTeams);
				}
			} else {
				$count = count($this->collUserTeams);
			}
		}
		$this->lastUserTeamCriteria = $criteria;
		return $count;
	}

	
	public function addUserTeam(UserTeam $l)
	{
		if ($this->collUserTeams === null) {
			$this->initUserTeams();
		}
		if (!in_array($l, $this->collUserTeams, true)) { 			array_push($this->collUserTeams, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getUserTeamsJoinTeam($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UserTeamPeer::USER_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinTeam($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}


	
	public function getUserTeamsJoinRole($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTeams === null) {
			if ($this->isNew()) {
				$this->collUserTeams = array();
			} else {

				$criteria->add(UserTeamPeer::USER_ID, $this->id);

				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UserTeamPeer::USER_ID, $this->id);

			if (!isset($this->lastUserTeamCriteria) || !$this->lastUserTeamCriteria->equals($criteria)) {
				$this->collUserTeams = UserTeamPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserTeamCriteria = $criteria;

		return $this->collUserTeams;
	}

	
	public function clearWorkplans()
	{
		$this->collWorkplans = null; 	}

	
	public function initWorkplans()
	{
		$this->collWorkplans = array();
	}

	
	public function getWorkplans($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
			   $this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				WorkplanPeer::addSelectColumns($criteria);
				$this->collWorkplans = WorkplanPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				WorkplanPeer::addSelectColumns($criteria);
				if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
					$this->collWorkplans = WorkplanPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWorkplanCriteria = $criteria;
		return $this->collWorkplans;
	}

	
	public function countWorkplans(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				$count = WorkplanPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
					$count = WorkplanPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWorkplans);
				}
			} else {
				$count = count($this->collWorkplans);
			}
		}
		$this->lastWorkplanCriteria = $criteria;
		return $count;
	}

	
	public function addWorkplan(Workplan $l)
	{
		if ($this->collWorkplans === null) {
			$this->initWorkplans();
		}
		if (!in_array($l, $this->collWorkplans, true)) { 			array_push($this->collWorkplans, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getWorkplansJoinYear($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				$this->collWorkplans = WorkplanPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkplanPeer::USER_ID, $this->id);

			if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
				$this->collWorkplans = WorkplanPeer::doSelectJoinYear($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkplanCriteria = $criteria;

		return $this->collWorkplans;
	}


	
	public function getWorkplansJoinSchoolclass($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				$this->collWorkplans = WorkplanPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkplanPeer::USER_ID, $this->id);

			if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
				$this->collWorkplans = WorkplanPeer::doSelectJoinSchoolclass($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkplanCriteria = $criteria;

		return $this->collWorkplans;
	}


	
	public function getWorkplansJoinSubject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkplans === null) {
			if ($this->isNew()) {
				$this->collWorkplans = array();
			} else {

				$criteria->add(WorkplanPeer::USER_ID, $this->id);

				$this->collWorkplans = WorkplanPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WorkplanPeer::USER_ID, $this->id);

			if (!isset($this->lastWorkplanCriteria) || !$this->lastWorkplanCriteria->equals($criteria)) {
				$this->collWorkplans = WorkplanPeer::doSelectJoinSubject($criteria, $con, $join_behavior);
			}
		}
		$this->lastWorkplanCriteria = $criteria;

		return $this->collWorkplans;
	}

	
	public function clearWpmodules()
	{
		$this->collWpmodules = null; 	}

	
	public function initWpmodules()
	{
		$this->collWpmodules = array();
	}

	
	public function getWpmodules($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
			   $this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				WpmodulePeer::addSelectColumns($criteria);
				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$this->collWpmodules = WpmodulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWpmoduleCriteria = $criteria;
		return $this->collWpmodules;
	}

	
	public function countWpmodules(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				$count = WpmodulePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
					$count = WpmodulePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWpmodules);
				}
			} else {
				$count = count($this->collWpmodules);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;
		return $count;
	}

	
	public function addWpmodule(Wpmodule $l)
	{
		if ($this->collWpmodules === null) {
			$this->initWpmodules();
		}
		if (!in_array($l, $this->collWpmodules, true)) { 			array_push($this->collWpmodules, $l);
			$l->setsfGuardUser($this);
		}
	}


	
	public function getWpmodulesJoinWorkplan($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWpmodules === null) {
			if ($this->isNew()) {
				$this->collWpmodules = array();
			} else {

				$criteria->add(WpmodulePeer::USER_ID, $this->id);

				$this->collWpmodules = WpmodulePeer::doSelectJoinWorkplan($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(WpmodulePeer::USER_ID, $this->id);

			if (!isset($this->lastWpmoduleCriteria) || !$this->lastWpmoduleCriteria->equals($criteria)) {
				$this->collWpmodules = WpmodulePeer::doSelectJoinWorkplan($criteria, $con, $join_behavior);
			}
		}
		$this->lastWpmoduleCriteria = $criteria;

		return $this->collWpmodules;
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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
			   $this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::USER_ID, $this->id);

				LanlogPeer::addSelectColumns($criteria);
				$this->collLanlogs = LanlogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LanlogPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
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

				$criteria->add(LanlogPeer::USER_ID, $this->id);

				$count = LanlogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LanlogPeer::USER_ID, $this->id);

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
			$l->setsfGuardUser($this);
		}
	}


	
	public function getLanlogsJoinWorkstation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanlogs === null) {
			if ($this->isNew()) {
				$this->collLanlogs = array();
			} else {

				$criteria->add(LanlogPeer::USER_ID, $this->id);

				$this->collLanlogs = LanlogPeer::doSelectJoinWorkstation($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(LanlogPeer::USER_ID, $this->id);

			if (!isset($this->lastLanlogCriteria) || !$this->lastLanlogCriteria->equals($criteria)) {
				$this->collLanlogs = LanlogPeer::doSelectJoinWorkstation($criteria, $con, $join_behavior);
			}
		}
		$this->lastLanlogCriteria = $criteria;

		return $this->collLanlogs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collsfGuardUserPermissions) {
				foreach ((array) $this->collsfGuardUserPermissions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardUserGroups) {
				foreach ((array) $this->collsfGuardUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardRememberKeys) {
				foreach ((array) $this->collsfGuardRememberKeys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singlesfGuardUserProfile) {
				$this->singlesfGuardUserProfile->clearAllReferences($deep);
			}
			if ($this->collAppointments) {
				foreach ((array) $this->collAppointments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEnrolments) {
				foreach ((array) $this->collEnrolments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserTeams) {
				foreach ((array) $this->collUserTeams as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWorkplans) {
				foreach ((array) $this->collWorkplans as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWpmodules) {
				foreach ((array) $this->collWpmodules as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLanlogs) {
				foreach ((array) $this->collLanlogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collsfGuardUserPermissions = null;
		$this->collsfGuardUserGroups = null;
		$this->collsfGuardRememberKeys = null;
		$this->singlesfGuardUserProfile = null;
		$this->collAppointments = null;
		$this->collEnrolments = null;
		$this->collUserTeams = null;
		$this->collWorkplans = null;
		$this->collWpmodules = null;
		$this->collLanlogs = null;
	}

} 