<?php


abstract class BasesfGuardUserProfilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_guard_user_profile';

	
	const CLASS_DEFAULT = 'lib.model.sfGuardUserProfile';

	
	const NUM_COLUMNS = 30;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const USER_ID = 'sf_guard_user_profile.USER_ID';

	
	const FIRST_NAME = 'sf_guard_user_profile.FIRST_NAME';

	
	const MIDDLE_NAME = 'sf_guard_user_profile.MIDDLE_NAME';

	
	const LAST_NAME = 'sf_guard_user_profile.LAST_NAME';

	
	const PRONUNCIATION = 'sf_guard_user_profile.PRONUNCIATION';

	
	const ROLE_ID = 'sf_guard_user_profile.ROLE_ID';

	
	const GENDER = 'sf_guard_user_profile.GENDER';

	
	const EMAIL = 'sf_guard_user_profile.EMAIL';

	
	const EMAIL_STATE = 'sf_guard_user_profile.EMAIL_STATE';

	
	const EMAIL_VERIFICATION_CODE = 'sf_guard_user_profile.EMAIL_VERIFICATION_CODE';

	
	const BIRTHDATE = 'sf_guard_user_profile.BIRTHDATE';

	
	const BIRTHPLACE = 'sf_guard_user_profile.BIRTHPLACE';

	
	const IMPORT_CODE = 'sf_guard_user_profile.IMPORT_CODE';

	
	const POSIX_UID = 'sf_guard_user_profile.POSIX_UID';

	
	const DISK_SET_SOFT_BLOCKS_QUOTA = 'sf_guard_user_profile.DISK_SET_SOFT_BLOCKS_QUOTA';

	
	const DISK_SET_HARD_BLOCKS_QUOTA = 'sf_guard_user_profile.DISK_SET_HARD_BLOCKS_QUOTA';

	
	const DISK_SET_SOFT_FILES_QUOTA = 'sf_guard_user_profile.DISK_SET_SOFT_FILES_QUOTA';

	
	const DISK_SET_HARD_FILES_QUOTA = 'sf_guard_user_profile.DISK_SET_HARD_FILES_QUOTA';

	
	const DISK_USED_BLOCKS = 'sf_guard_user_profile.DISK_USED_BLOCKS';

	
	const DISK_USED_FILES = 'sf_guard_user_profile.DISK_USED_FILES';

	
	const DISK_UPDATED_AT = 'sf_guard_user_profile.DISK_UPDATED_AT';

	
	const SYSTEM_ALERTS = 'sf_guard_user_profile.SYSTEM_ALERTS';

	
	const IS_DELETED = 'sf_guard_user_profile.IS_DELETED';

	
	const GOOGLEAPPS_ACCOUNT_STATUS = 'sf_guard_user_profile.GOOGLEAPPS_ACCOUNT_STATUS';

	
	const GOOGLEAPPS_ACCOUNT_APPROVED_AT = 'sf_guard_user_profile.GOOGLEAPPS_ACCOUNT_APPROVED_AT';

	
	const GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD = 'sf_guard_user_profile.GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD';

	
	const MOODLE_ACCOUNT_STATUS = 'sf_guard_user_profile.MOODLE_ACCOUNT_STATUS';

	
	const MOODLE_ACCOUNT_TEMPORARY_PASSWORD = 'sf_guard_user_profile.MOODLE_ACCOUNT_TEMPORARY_PASSWORD';

	
	const SYSTEM_ACCOUNT_STATUS = 'sf_guard_user_profile.SYSTEM_ACCOUNT_STATUS';

	
	const SYSTEM_ACCOUNT_IS_LOCKED = 'sf_guard_user_profile.SYSTEM_ACCOUNT_IS_LOCKED';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UserId', 'FirstName', 'MiddleName', 'LastName', 'Pronunciation', 'RoleId', 'Gender', 'Email', 'EmailState', 'EmailVerificationCode', 'Birthdate', 'Birthplace', 'ImportCode', 'PosixUid', 'DiskSetSoftBlocksQuota', 'DiskSetHardBlocksQuota', 'DiskSetSoftFilesQuota', 'DiskSetHardFilesQuota', 'DiskUsedBlocks', 'DiskUsedFiles', 'DiskUpdatedAt', 'SystemAlerts', 'IsDeleted', 'GoogleappsAccountStatus', 'GoogleappsAccountApprovedAt', 'GoogleappsAccountTemporaryPassword', 'MoodleAccountStatus', 'MoodleAccountTemporaryPassword', 'SystemAccountStatus', 'SystemAccountIsLocked', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId', 'firstName', 'middleName', 'lastName', 'pronunciation', 'roleId', 'gender', 'email', 'emailState', 'emailVerificationCode', 'birthdate', 'birthplace', 'importCode', 'posixUid', 'diskSetSoftBlocksQuota', 'diskSetHardBlocksQuota', 'diskSetSoftFilesQuota', 'diskSetHardFilesQuota', 'diskUsedBlocks', 'diskUsedFiles', 'diskUpdatedAt', 'systemAlerts', 'isDeleted', 'googleappsAccountStatus', 'googleappsAccountApprovedAt', 'googleappsAccountTemporaryPassword', 'moodleAccountStatus', 'moodleAccountTemporaryPassword', 'systemAccountStatus', 'systemAccountIsLocked', ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID, self::FIRST_NAME, self::MIDDLE_NAME, self::LAST_NAME, self::PRONUNCIATION, self::ROLE_ID, self::GENDER, self::EMAIL, self::EMAIL_STATE, self::EMAIL_VERIFICATION_CODE, self::BIRTHDATE, self::BIRTHPLACE, self::IMPORT_CODE, self::POSIX_UID, self::DISK_SET_SOFT_BLOCKS_QUOTA, self::DISK_SET_HARD_BLOCKS_QUOTA, self::DISK_SET_SOFT_FILES_QUOTA, self::DISK_SET_HARD_FILES_QUOTA, self::DISK_USED_BLOCKS, self::DISK_USED_FILES, self::DISK_UPDATED_AT, self::SYSTEM_ALERTS, self::IS_DELETED, self::GOOGLEAPPS_ACCOUNT_STATUS, self::GOOGLEAPPS_ACCOUNT_APPROVED_AT, self::GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD, self::MOODLE_ACCOUNT_STATUS, self::MOODLE_ACCOUNT_TEMPORARY_PASSWORD, self::SYSTEM_ACCOUNT_STATUS, self::SYSTEM_ACCOUNT_IS_LOCKED, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'first_name', 'middle_name', 'last_name', 'pronunciation', 'role_id', 'gender', 'email', 'email_state', 'email_verification_code', 'birthdate', 'birthplace', 'import_code', 'posix_uid', 'disk_set_soft_blocks_quota', 'disk_set_hard_blocks_quota', 'disk_set_soft_files_quota', 'disk_set_hard_files_quota', 'disk_used_blocks', 'disk_used_files', 'disk_updated_at', 'system_alerts', 'is_deleted', 'googleapps_account_status', 'googleapps_account_approved_at', 'googleapps_account_temporary_password', 'moodle_account_status', 'moodle_account_temporary_password', 'system_account_status', 'system_account_is_locked', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'FirstName' => 1, 'MiddleName' => 2, 'LastName' => 3, 'Pronunciation' => 4, 'RoleId' => 5, 'Gender' => 6, 'Email' => 7, 'EmailState' => 8, 'EmailVerificationCode' => 9, 'Birthdate' => 10, 'Birthplace' => 11, 'ImportCode' => 12, 'PosixUid' => 13, 'DiskSetSoftBlocksQuota' => 14, 'DiskSetHardBlocksQuota' => 15, 'DiskSetSoftFilesQuota' => 16, 'DiskSetHardFilesQuota' => 17, 'DiskUsedBlocks' => 18, 'DiskUsedFiles' => 19, 'DiskUpdatedAt' => 20, 'SystemAlerts' => 21, 'IsDeleted' => 22, 'GoogleappsAccountStatus' => 23, 'GoogleappsAccountApprovedAt' => 24, 'GoogleappsAccountTemporaryPassword' => 25, 'MoodleAccountStatus' => 26, 'MoodleAccountTemporaryPassword' => 27, 'SystemAccountStatus' => 28, 'SystemAccountIsLocked' => 29, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId' => 0, 'firstName' => 1, 'middleName' => 2, 'lastName' => 3, 'pronunciation' => 4, 'roleId' => 5, 'gender' => 6, 'email' => 7, 'emailState' => 8, 'emailVerificationCode' => 9, 'birthdate' => 10, 'birthplace' => 11, 'importCode' => 12, 'posixUid' => 13, 'diskSetSoftBlocksQuota' => 14, 'diskSetHardBlocksQuota' => 15, 'diskSetSoftFilesQuota' => 16, 'diskSetHardFilesQuota' => 17, 'diskUsedBlocks' => 18, 'diskUsedFiles' => 19, 'diskUpdatedAt' => 20, 'systemAlerts' => 21, 'isDeleted' => 22, 'googleappsAccountStatus' => 23, 'googleappsAccountApprovedAt' => 24, 'googleappsAccountTemporaryPassword' => 25, 'moodleAccountStatus' => 26, 'moodleAccountTemporaryPassword' => 27, 'systemAccountStatus' => 28, 'systemAccountIsLocked' => 29, ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID => 0, self::FIRST_NAME => 1, self::MIDDLE_NAME => 2, self::LAST_NAME => 3, self::PRONUNCIATION => 4, self::ROLE_ID => 5, self::GENDER => 6, self::EMAIL => 7, self::EMAIL_STATE => 8, self::EMAIL_VERIFICATION_CODE => 9, self::BIRTHDATE => 10, self::BIRTHPLACE => 11, self::IMPORT_CODE => 12, self::POSIX_UID => 13, self::DISK_SET_SOFT_BLOCKS_QUOTA => 14, self::DISK_SET_HARD_BLOCKS_QUOTA => 15, self::DISK_SET_SOFT_FILES_QUOTA => 16, self::DISK_SET_HARD_FILES_QUOTA => 17, self::DISK_USED_BLOCKS => 18, self::DISK_USED_FILES => 19, self::DISK_UPDATED_AT => 20, self::SYSTEM_ALERTS => 21, self::IS_DELETED => 22, self::GOOGLEAPPS_ACCOUNT_STATUS => 23, self::GOOGLEAPPS_ACCOUNT_APPROVED_AT => 24, self::GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD => 25, self::MOODLE_ACCOUNT_STATUS => 26, self::MOODLE_ACCOUNT_TEMPORARY_PASSWORD => 27, self::SYSTEM_ACCOUNT_STATUS => 28, self::SYSTEM_ACCOUNT_IS_LOCKED => 29, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'first_name' => 1, 'middle_name' => 2, 'last_name' => 3, 'pronunciation' => 4, 'role_id' => 5, 'gender' => 6, 'email' => 7, 'email_state' => 8, 'email_verification_code' => 9, 'birthdate' => 10, 'birthplace' => 11, 'import_code' => 12, 'posix_uid' => 13, 'disk_set_soft_blocks_quota' => 14, 'disk_set_hard_blocks_quota' => 15, 'disk_set_soft_files_quota' => 16, 'disk_set_hard_files_quota' => 17, 'disk_used_blocks' => 18, 'disk_used_files' => 19, 'disk_updated_at' => 20, 'system_alerts' => 21, 'is_deleted' => 22, 'googleapps_account_status' => 23, 'googleapps_account_approved_at' => 24, 'googleapps_account_temporary_password' => 25, 'moodle_account_status' => 26, 'moodle_account_temporary_password' => 27, 'system_account_status' => 28, 'system_account_is_locked' => 29, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new sfGuardUserProfileMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(sfGuardUserProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfGuardUserProfilePeer::USER_ID);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::FIRST_NAME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::MIDDLE_NAME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::LAST_NAME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::PRONUNCIATION);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::ROLE_ID);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::GENDER);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL_STATE);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL_VERIFICATION_CODE);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::BIRTHDATE);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::BIRTHPLACE);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::IMPORT_CODE);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::POSIX_UID);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_SET_SOFT_BLOCKS_QUOTA);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_SET_HARD_BLOCKS_QUOTA);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_SET_SOFT_FILES_QUOTA);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_SET_HARD_FILES_QUOTA);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_USED_BLOCKS);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_USED_FILES);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::DISK_UPDATED_AT);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::SYSTEM_ALERTS);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::IS_DELETED);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_STATUS);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_APPROVED_AT);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::MOODLE_ACCOUNT_STATUS);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::MOODLE_ACCOUNT_TEMPORARY_PASSWORD);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::SYSTEM_ACCOUNT_STATUS);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::SYSTEM_ACCOUNT_IS_LOCKED);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = sfGuardUserProfilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return sfGuardUserProfilePeer::populateObjects(sfGuardUserProfilePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(sfGuardUserProfile $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getUserId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof sfGuardUserProfile) {
				$key = (string) $value->getUserId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or sfGuardUserProfile object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = sfGuardUserProfilePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = sfGuardUserProfilePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				sfGuardUserProfilePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinRole(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfGuardUserProfilePeer::ROLE_ID,), array(RolePeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinRole(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);
		RolePeer::addSelectColumns($c);

		$c->addJoin(array(sfGuardUserProfilePeer::ROLE_ID,), array(RolePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = RolePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = RolePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = RolePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					RolePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$criteria->addJoin(array(sfGuardUserProfilePeer::ROLE_ID,), array(RolePeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		RolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$c->addJoin(array(sfGuardUserProfilePeer::ROLE_ID,), array(RolePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj1->setsfGuardUser($obj2);
			} 
			
			$key3 = RolePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = RolePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = RolePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					RolePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addsfGuardUserProfile($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfGuardUserProfilePeer::ROLE_ID,), array(RolePeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptRole(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		RolePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfGuardUserProfilePeer::ROLE_ID,), array(RolePeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = RolePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = RolePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = RolePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					RolePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptRole(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return sfGuardUserProfilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(sfGuardUserProfilePeer::USER_ID);
			$selectCriteria->add(sfGuardUserProfilePeer::USER_ID, $criteria->remove(sfGuardUserProfilePeer::USER_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(sfGuardUserProfilePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												sfGuardUserProfilePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof sfGuardUserProfile) {
						sfGuardUserProfilePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfGuardUserProfilePeer::USER_ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								sfGuardUserProfilePeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(sfGuardUserProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfGuardUserProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfGuardUserProfilePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(sfGuardUserProfilePeer::DATABASE_NAME, sfGuardUserProfilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfGuardUserProfilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = sfGuardUserProfilePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		$criteria->add(sfGuardUserProfilePeer::USER_ID, $pk);

		$v = sfGuardUserProfilePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$criteria->add(sfGuardUserProfilePeer::USER_ID, $pks, Criteria::IN);
			$objs = sfGuardUserProfilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasesfGuardUserProfilePeer::DATABASE_NAME)->addTableBuilder(BasesfGuardUserProfilePeer::TABLE_NAME, BasesfGuardUserProfilePeer::getMapBuilder());

