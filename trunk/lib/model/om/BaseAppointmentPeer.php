<?php


abstract class BaseAppointmentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'appointment';

	
	const CLASS_DEFAULT = 'lib.model.Appointment';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'appointment.ID';

	
	const USER_ID = 'appointment.USER_ID';

	
	const SUBJECT_ID = 'appointment.SUBJECT_ID';

	
	const SCHOOLCLASS_ID = 'appointment.SCHOOLCLASS_ID';

	
	const YEAR_ID = 'appointment.YEAR_ID';

	
	const STATE = 'appointment.STATE';

	
	const HOURS = 'appointment.HOURS';

	
	const CREATED_AT = 'appointment.CREATED_AT';

	
	const UPDATED_AT = 'appointment.UPDATED_AT';

	
	const IMPORT_CODE = 'appointment.IMPORT_CODE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'SubjectId', 'SchoolclassId', 'YearId', 'State', 'Hours', 'CreatedAt', 'UpdatedAt', 'ImportCode', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userId', 'subjectId', 'schoolclassId', 'yearId', 'state', 'hours', 'createdAt', 'updatedAt', 'importCode', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USER_ID, self::SUBJECT_ID, self::SCHOOLCLASS_ID, self::YEAR_ID, self::STATE, self::HOURS, self::CREATED_AT, self::UPDATED_AT, self::IMPORT_CODE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'subject_id', 'schoolclass_id', 'year_id', 'state', 'hours', 'created_at', 'updated_at', 'import_code', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'SubjectId' => 2, 'SchoolclassId' => 3, 'YearId' => 4, 'State' => 5, 'Hours' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'ImportCode' => 9, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userId' => 1, 'subjectId' => 2, 'schoolclassId' => 3, 'yearId' => 4, 'state' => 5, 'hours' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'importCode' => 9, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USER_ID => 1, self::SUBJECT_ID => 2, self::SCHOOLCLASS_ID => 3, self::YEAR_ID => 4, self::STATE => 5, self::HOURS => 6, self::CREATED_AT => 7, self::UPDATED_AT => 8, self::IMPORT_CODE => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'subject_id' => 2, 'schoolclass_id' => 3, 'year_id' => 4, 'state' => 5, 'hours' => 6, 'created_at' => 7, 'updated_at' => 8, 'import_code' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AppointmentMapBuilder();
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
		return str_replace(AppointmentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AppointmentPeer::ID);

		$criteria->addSelectColumn(AppointmentPeer::USER_ID);

		$criteria->addSelectColumn(AppointmentPeer::SUBJECT_ID);

		$criteria->addSelectColumn(AppointmentPeer::SCHOOLCLASS_ID);

		$criteria->addSelectColumn(AppointmentPeer::YEAR_ID);

		$criteria->addSelectColumn(AppointmentPeer::STATE);

		$criteria->addSelectColumn(AppointmentPeer::HOURS);

		$criteria->addSelectColumn(AppointmentPeer::CREATED_AT);

		$criteria->addSelectColumn(AppointmentPeer::UPDATED_AT);

		$criteria->addSelectColumn(AppointmentPeer::IMPORT_CODE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = AppointmentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AppointmentPeer::populateObjects(AppointmentPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AppointmentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Appointment $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Appointment) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Appointment object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = AppointmentPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AppointmentPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AppointmentPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinSubject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinSchoolclass(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinYear(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

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

		AppointmentPeer::addSelectColumns($c);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinSubject(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($c);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		SubjectPeer::addSelectColumns($c);

		$c->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SubjectPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SubjectPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SubjectPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinSchoolclass(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($c);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		SchoolclassPeer::addSelectColumns($c);

		$c->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SchoolclassPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SchoolclassPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SchoolclassPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinYear(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($c);
		$startcol = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);
		YearPeer::addSelectColumns($c);

		$c->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = YearPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = YearPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					YearPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AppointmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$criteria->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
		$criteria->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
		$criteria->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
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

		AppointmentPeer::addSelectColumns($c);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$c->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
		$c->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
		$c->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAppointment($obj1);
			} 
			
			$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = SubjectPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = SubjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addAppointment($obj1);
			} 
			
			$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = SchoolclassPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addAppointment($obj1);
			} 
			
			$key5 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = YearPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = YearPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					YearPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addAppointment($obj1);
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
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptSubject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptSchoolclass(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptYear(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AppointmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
				$criteria->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
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

		AppointmentPeer::addSelectColumns($c);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = SubjectPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = SubjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SubjectPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAppointment($obj1);

			} 
				
				$key3 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SchoolclassPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = SchoolclassPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SchoolclassPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addAppointment($obj1);

			} 
				
				$key4 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = YearPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = YearPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					YearPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptSubject(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($c);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAppointment($obj1);

			} 
				
				$key3 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SchoolclassPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = SchoolclassPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SchoolclassPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addAppointment($obj1);

			} 
				
				$key4 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = YearPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = YearPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					YearPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptSchoolclass(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($c);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAppointment($obj1);

			} 
				
				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = SubjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addAppointment($obj1);

			} 
				
				$key4 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = YearPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = YearPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					YearPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptYear(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AppointmentPeer::addSelectColumns($c);
		$startcol2 = (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SubjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SubjectPeer::NUM_COLUMNS - SubjectPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(AppointmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::SUBJECT_ID,), array(SubjectPeer::ID,), $join_behavior);
				$c->addJoin(array(AppointmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AppointmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AppointmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AppointmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AppointmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAppointment($obj1);

			} 
				
				$key3 = SubjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = SubjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = SubjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					SubjectPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addAppointment($obj1);

			} 
				
				$key4 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = SchoolclassPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = SchoolclassPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					SchoolclassPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addAppointment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array(array('user_id', 'subject_id', 'schoolclass_id', 'year_id'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return AppointmentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(AppointmentPeer::ID) && $criteria->keyContainsValue(AppointmentPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.AppointmentPeer::ID.')');
		}


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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AppointmentPeer::ID);
			$selectCriteria->add(AppointmentPeer::ID, $criteria->remove(AppointmentPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AppointmentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AppointmentPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Appointment) {
						AppointmentPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AppointmentPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								AppointmentPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

						WptoolAppointmentPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(Appointment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AppointmentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AppointmentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AppointmentPeer::DATABASE_NAME, AppointmentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AppointmentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AppointmentPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
		$criteria->add(AppointmentPeer::ID, $pk);

		$v = AppointmentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AppointmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AppointmentPeer::DATABASE_NAME);
			$criteria->add(AppointmentPeer::ID, $pks, Criteria::IN);
			$objs = AppointmentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseAppointmentPeer::DATABASE_NAME)->addTableBuilder(BaseAppointmentPeer::TABLE_NAME, BaseAppointmentPeer::getMapBuilder());

