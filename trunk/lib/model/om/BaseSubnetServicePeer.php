<?php


abstract class BaseSubnetServicePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'subnet_service';

	
	const CLASS_DEFAULT = 'lib.model.SubnetService';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const SUBNET_ID = 'subnet_service.SUBNET_ID';

	
	const SERVICE_ID = 'subnet_service.SERVICE_ID';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('SubnetId', 'ServiceId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('subnetId', 'serviceId', ),
		BasePeer::TYPE_COLNAME => array (self::SUBNET_ID, self::SERVICE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('subnet_id', 'service_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('SubnetId' => 0, 'ServiceId' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('subnetId' => 0, 'serviceId' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::SUBNET_ID => 0, self::SERVICE_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('subnet_id' => 0, 'service_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new SubnetServiceMapBuilder();
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
		return str_replace(SubnetServicePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SubnetServicePeer::SUBNET_ID);

		$criteria->addSelectColumn(SubnetServicePeer::SERVICE_ID);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SubnetServicePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SubnetServicePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = SubnetServicePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return SubnetServicePeer::populateObjects(SubnetServicePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SubnetServicePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(SubnetService $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getSubnetId(), (string) $obj->getServiceId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof SubnetService) {
				$key = serialize(array((string) $value->getSubnetId(), (string) $value->getServiceId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or SubnetService object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = SubnetServicePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SubnetServicePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SubnetServicePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SubnetServicePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinSubnet(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SubnetServicePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SubnetServicePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SubnetServicePeer::SUBNET_ID,), array(SubnetPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinService(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SubnetServicePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SubnetServicePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SubnetServicePeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinSubnet(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SubnetServicePeer::addSelectColumns($c);
		$startcol = (SubnetServicePeer::NUM_COLUMNS - SubnetServicePeer::NUM_LAZY_LOAD_COLUMNS);
		SubnetPeer::addSelectColumns($c);

		$c->addJoin(array(SubnetServicePeer::SUBNET_ID,), array(SubnetPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SubnetServicePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SubnetServicePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = SubnetServicePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SubnetServicePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = SubnetPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SubnetPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SubnetPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SubnetPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSubnetService($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinService(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SubnetServicePeer::addSelectColumns($c);
		$startcol = (SubnetServicePeer::NUM_COLUMNS - SubnetServicePeer::NUM_LAZY_LOAD_COLUMNS);
		ServicePeer::addSelectColumns($c);

		$c->addJoin(array(SubnetServicePeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SubnetServicePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SubnetServicePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = SubnetServicePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SubnetServicePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ServicePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ServicePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ServicePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ServicePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSubnetService($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SubnetServicePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SubnetServicePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SubnetServicePeer::SUBNET_ID,), array(SubnetPeer::ID,), $join_behavior);
		$criteria->addJoin(array(SubnetServicePeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
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

		SubnetServicePeer::addSelectColumns($c);
		$startcol2 = (SubnetServicePeer::NUM_COLUMNS - SubnetServicePeer::NUM_LAZY_LOAD_COLUMNS);

		SubnetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SubnetPeer::NUM_COLUMNS - SubnetPeer::NUM_LAZY_LOAD_COLUMNS);

		ServicePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(SubnetServicePeer::SUBNET_ID,), array(SubnetPeer::ID,), $join_behavior);
		$c->addJoin(array(SubnetServicePeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SubnetServicePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SubnetServicePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = SubnetServicePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SubnetServicePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = SubnetPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = SubnetPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SubnetPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SubnetPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSubnetService($obj1);
			} 
			
			$key3 = ServicePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ServicePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ServicePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ServicePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addSubnetService($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptSubnet(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SubnetServicePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(SubnetServicePeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptService(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SubnetServicePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(SubnetServicePeer::SUBNET_ID,), array(SubnetPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptSubnet(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SubnetServicePeer::addSelectColumns($c);
		$startcol2 = (SubnetServicePeer::NUM_COLUMNS - SubnetServicePeer::NUM_LAZY_LOAD_COLUMNS);

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(SubnetServicePeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SubnetServicePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SubnetServicePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = SubnetServicePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SubnetServicePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ServicePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ServicePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ServicePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ServicePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSubnetService($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptService(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SubnetServicePeer::addSelectColumns($c);
		$startcol2 = (SubnetServicePeer::NUM_COLUMNS - SubnetServicePeer::NUM_LAZY_LOAD_COLUMNS);

		SubnetPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SubnetPeer::NUM_COLUMNS - SubnetPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(SubnetServicePeer::SUBNET_ID,), array(SubnetPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SubnetServicePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SubnetServicePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = SubnetServicePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SubnetServicePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = SubnetPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = SubnetPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = SubnetPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SubnetPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSubnetService($obj1);

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
		return SubnetServicePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(SubnetServicePeer::SUBNET_ID);
			$selectCriteria->add(SubnetServicePeer::SUBNET_ID, $criteria->remove(SubnetServicePeer::SUBNET_ID), $comparison);

			$comparison = $criteria->getComparison(SubnetServicePeer::SERVICE_ID);
			$selectCriteria->add(SubnetServicePeer::SERVICE_ID, $criteria->remove(SubnetServicePeer::SERVICE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(SubnetServicePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												SubnetServicePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof SubnetService) {
						SubnetServicePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(SubnetServicePeer::SUBNET_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(SubnetServicePeer::SERVICE_ID, $value[1]));
				$criteria->addOr($criterion);

								SubnetServicePeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(SubnetService $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SubnetServicePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SubnetServicePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SubnetServicePeer::DATABASE_NAME, SubnetServicePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SubnetServicePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($subnet_id, $service_id, PropelPDO $con = null) {
		$key = serialize(array((string) $subnet_id, (string) $service_id));
 		if (null !== ($obj = SubnetServicePeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SubnetServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(SubnetServicePeer::DATABASE_NAME);
		$criteria->add(SubnetServicePeer::SUBNET_ID, $subnet_id);
		$criteria->add(SubnetServicePeer::SERVICE_ID, $service_id);
		$v = SubnetServicePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseSubnetServicePeer::DATABASE_NAME)->addTableBuilder(BaseSubnetServicePeer::TABLE_NAME, BaseSubnetServicePeer::getMapBuilder());

