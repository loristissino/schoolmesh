<?php


abstract class BaseEnrolmentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'enrolment';

	
	const CLASS_DEFAULT = 'lib.model.Enrolment';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'enrolment.ID';

	
	const USER_ID = 'enrolment.USER_ID';

	
	const SCHOOLCLASS_ID = 'enrolment.SCHOOLCLASS_ID';

	
	const YEAR_ID = 'enrolment.YEAR_ID';

	
	const CREATED_AT = 'enrolment.CREATED_AT';

	
	const UPDATED_AT = 'enrolment.UPDATED_AT';

	
	const IMPORT_CODE = 'enrolment.IMPORT_CODE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'SchoolclassId', 'YearId', 'CreatedAt', 'UpdatedAt', 'ImportCode', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userId', 'schoolclassId', 'yearId', 'createdAt', 'updatedAt', 'importCode', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USER_ID, self::SCHOOLCLASS_ID, self::YEAR_ID, self::CREATED_AT, self::UPDATED_AT, self::IMPORT_CODE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'schoolclass_id', 'year_id', 'created_at', 'updated_at', 'import_code', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'SchoolclassId' => 2, 'YearId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'ImportCode' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userId' => 1, 'schoolclassId' => 2, 'yearId' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'importCode' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USER_ID => 1, self::SCHOOLCLASS_ID => 2, self::YEAR_ID => 3, self::CREATED_AT => 4, self::UPDATED_AT => 5, self::IMPORT_CODE => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'schoolclass_id' => 2, 'year_id' => 3, 'created_at' => 4, 'updated_at' => 5, 'import_code' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new EnrolmentMapBuilder();
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
		return str_replace(EnrolmentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EnrolmentPeer::ID);

		$criteria->addSelectColumn(EnrolmentPeer::USER_ID);

		$criteria->addSelectColumn(EnrolmentPeer::SCHOOLCLASS_ID);

		$criteria->addSelectColumn(EnrolmentPeer::YEAR_ID);

		$criteria->addSelectColumn(EnrolmentPeer::CREATED_AT);

		$criteria->addSelectColumn(EnrolmentPeer::UPDATED_AT);

		$criteria->addSelectColumn(EnrolmentPeer::IMPORT_CODE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EnrolmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = EnrolmentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return EnrolmentPeer::populateObjects(EnrolmentPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			EnrolmentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Enrolment $obj, $key = null)
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
			if (is_object($value) && $value instanceof Enrolment) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Enrolment object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = EnrolmentPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = EnrolmentPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				EnrolmentPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EnrolmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

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

								$criteria->setPrimaryTableName(EnrolmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);

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

								$criteria->setPrimaryTableName(EnrolmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

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

		EnrolmentPeer::addSelectColumns($c);
		$startcol = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addEnrolment($obj1);

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

		EnrolmentPeer::addSelectColumns($c);
		$startcol = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);
		SchoolclassPeer::addSelectColumns($c);

		$c->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addEnrolment($obj1);

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

		EnrolmentPeer::addSelectColumns($c);
		$startcol = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);
		YearPeer::addSelectColumns($c);

		$c->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addEnrolment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EnrolmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$criteria->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
		$criteria->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
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

		EnrolmentPeer::addSelectColumns($c);
		$startcol2 = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$c->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
		$c->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addEnrolment($obj1);
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
								$obj3->addEnrolment($obj1);
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
								$obj4->addEnrolment($obj1);
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
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
				$criteria->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
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
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$criteria->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);
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
			EnrolmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$criteria->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
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

		EnrolmentPeer::addSelectColumns($c);
		$startcol2 = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);
				$c->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = SchoolclassPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = SchoolclassPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = SchoolclassPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SchoolclassPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addEnrolment($obj1);

			} 
				
				$key3 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = YearPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = YearPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					YearPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addEnrolment($obj1);

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

		EnrolmentPeer::addSelectColumns($c);
		$startcol2 = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		YearPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (YearPeer::NUM_COLUMNS - YearPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$c->addJoin(array(EnrolmentPeer::YEAR_ID,), array(YearPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addEnrolment($obj1);

			} 
				
				$key3 = YearPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = YearPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = YearPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					YearPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addEnrolment($obj1);

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

		EnrolmentPeer::addSelectColumns($c);
		$startcol2 = (EnrolmentPeer::NUM_COLUMNS - EnrolmentPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		SchoolclassPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (SchoolclassPeer::NUM_COLUMNS - SchoolclassPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(EnrolmentPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$c->addJoin(array(EnrolmentPeer::SCHOOLCLASS_ID,), array(SchoolclassPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EnrolmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EnrolmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = EnrolmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EnrolmentPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addEnrolment($obj1);

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
								$obj3->addEnrolment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array(array('user_id', 'schoolclass_id', 'year_id'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return EnrolmentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(EnrolmentPeer::ID) && $criteria->keyContainsValue(EnrolmentPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.EnrolmentPeer::ID.')');
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
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(EnrolmentPeer::ID);
			$selectCriteria->add(EnrolmentPeer::ID, $criteria->remove(EnrolmentPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(EnrolmentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												EnrolmentPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Enrolment) {
						EnrolmentPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EnrolmentPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								EnrolmentPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Enrolment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EnrolmentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EnrolmentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EnrolmentPeer::DATABASE_NAME, EnrolmentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EnrolmentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = EnrolmentPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(EnrolmentPeer::DATABASE_NAME);
		$criteria->add(EnrolmentPeer::ID, $pk);

		$v = EnrolmentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EnrolmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(EnrolmentPeer::DATABASE_NAME);
			$criteria->add(EnrolmentPeer::ID, $pks, Criteria::IN);
			$objs = EnrolmentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseEnrolmentPeer::DATABASE_NAME)->addTableBuilder(BaseEnrolmentPeer::TABLE_NAME, BaseEnrolmentPeer::getMapBuilder());

