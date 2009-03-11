<?php


abstract class BaseLanlogPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'lanlog';

	
	const CLASS_DEFAULT = 'lib.model.Lanlog';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'lanlog.ID';

	
	const USER_ID = 'lanlog.USER_ID';

	
	const WORKSTATION_ID = 'lanlog.WORKSTATION_ID';

	
	const CREATED_AT = 'lanlog.CREATED_AT';

	
	const UPDATED_AT = 'lanlog.UPDATED_AT';

	
	const IS_ONLINE = 'lanlog.IS_ONLINE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'WorkstationId', 'CreatedAt', 'UpdatedAt', 'IsOnline', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userId', 'workstationId', 'createdAt', 'updatedAt', 'isOnline', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USER_ID, self::WORKSTATION_ID, self::CREATED_AT, self::UPDATED_AT, self::IS_ONLINE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'workstation_id', 'created_at', 'updated_at', 'is_online', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'WorkstationId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'IsOnline' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userId' => 1, 'workstationId' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'isOnline' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USER_ID => 1, self::WORKSTATION_ID => 2, self::CREATED_AT => 3, self::UPDATED_AT => 4, self::IS_ONLINE => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'workstation_id' => 2, 'created_at' => 3, 'updated_at' => 4, 'is_online' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new LanlogMapBuilder();
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
		return str_replace(LanlogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(LanlogPeer::ID);

		$criteria->addSelectColumn(LanlogPeer::USER_ID);

		$criteria->addSelectColumn(LanlogPeer::WORKSTATION_ID);

		$criteria->addSelectColumn(LanlogPeer::CREATED_AT);

		$criteria->addSelectColumn(LanlogPeer::UPDATED_AT);

		$criteria->addSelectColumn(LanlogPeer::IS_ONLINE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(LanlogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanlogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = LanlogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return LanlogPeer::populateObjects(LanlogPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			LanlogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Lanlog $obj, $key = null)
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
			if (is_object($value) && $value instanceof Lanlog) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Lanlog object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = LanlogPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = LanlogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = LanlogPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				LanlogPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(LanlogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanlogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(LanlogPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinWorkstation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(LanlogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanlogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(LanlogPeer::WORKSTATION_ID,), array(WorkstationPeer::ID,), $join_behavior);

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

		LanlogPeer::addSelectColumns($c);
		$startcol = (LanlogPeer::NUM_COLUMNS - LanlogPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(LanlogPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanlogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanlogPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = LanlogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanlogPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addLanlog($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinWorkstation(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LanlogPeer::addSelectColumns($c);
		$startcol = (LanlogPeer::NUM_COLUMNS - LanlogPeer::NUM_LAZY_LOAD_COLUMNS);
		WorkstationPeer::addSelectColumns($c);

		$c->addJoin(array(LanlogPeer::WORKSTATION_ID,), array(WorkstationPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanlogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanlogPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = LanlogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanlogPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = WorkstationPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = WorkstationPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = WorkstationPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					WorkstationPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addLanlog($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(LanlogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanlogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(LanlogPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$criteria->addJoin(array(LanlogPeer::WORKSTATION_ID,), array(WorkstationPeer::ID,), $join_behavior);
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

		LanlogPeer::addSelectColumns($c);
		$startcol2 = (LanlogPeer::NUM_COLUMNS - LanlogPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		WorkstationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (WorkstationPeer::NUM_COLUMNS - WorkstationPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(LanlogPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$c->addJoin(array(LanlogPeer::WORKSTATION_ID,), array(WorkstationPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanlogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanlogPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = LanlogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanlogPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addLanlog($obj1);
			} 
			
			$key3 = WorkstationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = WorkstationPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = WorkstationPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					WorkstationPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addLanlog($obj1);
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
			LanlogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(LanlogPeer::WORKSTATION_ID,), array(WorkstationPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptWorkstation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanlogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(LanlogPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
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

		LanlogPeer::addSelectColumns($c);
		$startcol2 = (LanlogPeer::NUM_COLUMNS - LanlogPeer::NUM_LAZY_LOAD_COLUMNS);

		WorkstationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (WorkstationPeer::NUM_COLUMNS - WorkstationPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(LanlogPeer::WORKSTATION_ID,), array(WorkstationPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanlogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanlogPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = LanlogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanlogPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = WorkstationPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = WorkstationPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = WorkstationPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					WorkstationPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addLanlog($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptWorkstation(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LanlogPeer::addSelectColumns($c);
		$startcol2 = (LanlogPeer::NUM_COLUMNS - LanlogPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(LanlogPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanlogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanlogPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = LanlogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanlogPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addLanlog($obj1);

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
		return LanlogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(LanlogPeer::ID) && $criteria->keyContainsValue(LanlogPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.LanlogPeer::ID.')');
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
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(LanlogPeer::ID);
			$selectCriteria->add(LanlogPeer::ID, $criteria->remove(LanlogPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(LanlogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												LanlogPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Lanlog) {
						LanlogPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(LanlogPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								LanlogPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Lanlog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(LanlogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LanlogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(LanlogPeer::DATABASE_NAME, LanlogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = LanlogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = LanlogPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(LanlogPeer::DATABASE_NAME);
		$criteria->add(LanlogPeer::ID, $pk);

		$v = LanlogPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(LanlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(LanlogPeer::DATABASE_NAME);
			$criteria->add(LanlogPeer::ID, $pks, Criteria::IN);
			$objs = LanlogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseLanlogPeer::DATABASE_NAME)->addTableBuilder(BaseLanlogPeer::TABLE_NAME, BaseLanlogPeer::getMapBuilder());

