<?php


abstract class BaseWpinfoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'wpinfo';

	
	const CLASS_DEFAULT = 'lib.model.Wpinfo';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'wpinfo.ID';

	
	const APPOINTMENT_ID = 'wpinfo.APPOINTMENT_ID';

	
	const WPINFO_TYPE_ID = 'wpinfo.WPINFO_TYPE_ID';

	
	const UPDATED_AT = 'wpinfo.UPDATED_AT';

	
	const CONTENT = 'wpinfo.CONTENT';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AppointmentId', 'WpinfoTypeId', 'UpdatedAt', 'Content', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'appointmentId', 'wpinfoTypeId', 'updatedAt', 'content', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::APPOINTMENT_ID, self::WPINFO_TYPE_ID, self::UPDATED_AT, self::CONTENT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'appointment_id', 'wpinfo_type_id', 'updated_at', 'content', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AppointmentId' => 1, 'WpinfoTypeId' => 2, 'UpdatedAt' => 3, 'Content' => 4, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'appointmentId' => 1, 'wpinfoTypeId' => 2, 'updatedAt' => 3, 'content' => 4, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::APPOINTMENT_ID => 1, self::WPINFO_TYPE_ID => 2, self::UPDATED_AT => 3, self::CONTENT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'appointment_id' => 1, 'wpinfo_type_id' => 2, 'updated_at' => 3, 'content' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new WpinfoMapBuilder();
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
		return str_replace(WpinfoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WpinfoPeer::ID);

		$criteria->addSelectColumn(WpinfoPeer::APPOINTMENT_ID);

		$criteria->addSelectColumn(WpinfoPeer::WPINFO_TYPE_ID);

		$criteria->addSelectColumn(WpinfoPeer::UPDATED_AT);

		$criteria->addSelectColumn(WpinfoPeer::CONTENT);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpinfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpinfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = WpinfoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return WpinfoPeer::populateObjects(WpinfoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			WpinfoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Wpinfo $obj, $key = null)
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
			if (is_object($value) && $value instanceof Wpinfo) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Wpinfo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = WpinfoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = WpinfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = WpinfoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				WpinfoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinAppointment(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpinfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpinfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(WpinfoPeer::APPOINTMENT_ID,), array(AppointmentPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinWpinfoType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpinfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpinfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(WpinfoPeer::WPINFO_TYPE_ID,), array(WpinfoTypePeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAppointment(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WpinfoPeer::addSelectColumns($c);
		$startcol = (WpinfoPeer::NUM_COLUMNS - WpinfoPeer::NUM_LAZY_LOAD_COLUMNS);
		AppointmentPeer::addSelectColumns($c);

		$c->addJoin(array(WpinfoPeer::APPOINTMENT_ID,), array(AppointmentPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpinfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpinfoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = WpinfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpinfoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AppointmentPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AppointmentPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AppointmentPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpinfo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinWpinfoType(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WpinfoPeer::addSelectColumns($c);
		$startcol = (WpinfoPeer::NUM_COLUMNS - WpinfoPeer::NUM_LAZY_LOAD_COLUMNS);
		WpinfoTypePeer::addSelectColumns($c);

		$c->addJoin(array(WpinfoPeer::WPINFO_TYPE_ID,), array(WpinfoTypePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpinfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpinfoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = WpinfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpinfoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = WpinfoTypePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = WpinfoTypePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = WpinfoTypePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					WpinfoTypePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpinfo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpinfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpinfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(WpinfoPeer::APPOINTMENT_ID,), array(AppointmentPeer::ID,), $join_behavior);
		$criteria->addJoin(array(WpinfoPeer::WPINFO_TYPE_ID,), array(WpinfoTypePeer::ID,), $join_behavior);
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

		WpinfoPeer::addSelectColumns($c);
		$startcol2 = (WpinfoPeer::NUM_COLUMNS - WpinfoPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

		WpinfoTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (WpinfoTypePeer::NUM_COLUMNS - WpinfoTypePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(WpinfoPeer::APPOINTMENT_ID,), array(AppointmentPeer::ID,), $join_behavior);
		$c->addJoin(array(WpinfoPeer::WPINFO_TYPE_ID,), array(WpinfoTypePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpinfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpinfoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = WpinfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpinfoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = AppointmentPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AppointmentPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppointmentPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpinfo($obj1);
			} 
			
			$key3 = WpinfoTypePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = WpinfoTypePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = WpinfoTypePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					WpinfoTypePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addWpinfo($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptAppointment(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpinfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(WpinfoPeer::WPINFO_TYPE_ID,), array(WpinfoTypePeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptWpinfoType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpinfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(WpinfoPeer::APPOINTMENT_ID,), array(AppointmentPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptAppointment(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WpinfoPeer::addSelectColumns($c);
		$startcol2 = (WpinfoPeer::NUM_COLUMNS - WpinfoPeer::NUM_LAZY_LOAD_COLUMNS);

		WpinfoTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (WpinfoTypePeer::NUM_COLUMNS - WpinfoTypePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(WpinfoPeer::WPINFO_TYPE_ID,), array(WpinfoTypePeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpinfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpinfoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = WpinfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpinfoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = WpinfoTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = WpinfoTypePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = WpinfoTypePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					WpinfoTypePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpinfo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptWpinfoType(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WpinfoPeer::addSelectColumns($c);
		$startcol2 = (WpinfoPeer::NUM_COLUMNS - WpinfoPeer::NUM_LAZY_LOAD_COLUMNS);

		AppointmentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AppointmentPeer::NUM_COLUMNS - AppointmentPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(WpinfoPeer::APPOINTMENT_ID,), array(AppointmentPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpinfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpinfoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = WpinfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpinfoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = AppointmentPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AppointmentPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = AppointmentPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppointmentPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpinfo($obj1);

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
		return WpinfoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(WpinfoPeer::ID) && $criteria->keyContainsValue(WpinfoPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpinfoPeer::ID.')');
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
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(WpinfoPeer::ID);
			$selectCriteria->add(WpinfoPeer::ID, $criteria->remove(WpinfoPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(WpinfoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												WpinfoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Wpinfo) {
						WpinfoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WpinfoPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								WpinfoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Wpinfo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WpinfoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WpinfoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WpinfoPeer::DATABASE_NAME, WpinfoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WpinfoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = WpinfoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(WpinfoPeer::DATABASE_NAME);
		$criteria->add(WpinfoPeer::ID, $pk);

		$v = WpinfoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpinfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(WpinfoPeer::DATABASE_NAME);
			$criteria->add(WpinfoPeer::ID, $pks, Criteria::IN);
			$objs = WpinfoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseWpinfoPeer::DATABASE_NAME)->addTableBuilder(BaseWpinfoPeer::TABLE_NAME, BaseWpinfoPeer::getMapBuilder());

