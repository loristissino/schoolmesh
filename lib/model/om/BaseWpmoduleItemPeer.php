<?php


abstract class BaseWpmoduleItemPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'wpmodule_item';

	
	const CLASS_DEFAULT = 'lib.model.WpmoduleItem';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'wpmodule_item.ID';

	
	const WPITEM_GROUP_ID = 'wpmodule_item.WPITEM_GROUP_ID';

	
	const RANK = 'wpmodule_item.RANK';

	
	const CONTENT = 'wpmodule_item.CONTENT';

	
	const EVALUATION = 'wpmodule_item.EVALUATION';

	
	const IS_EDITABLE = 'wpmodule_item.IS_EDITABLE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'WpitemGroupId', 'Rank', 'Content', 'Evaluation', 'IsEditable', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'wpitemGroupId', 'rank', 'content', 'evaluation', 'isEditable', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::WPITEM_GROUP_ID, self::RANK, self::CONTENT, self::EVALUATION, self::IS_EDITABLE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'wpitem_group_id', 'rank', 'content', 'evaluation', 'is_editable', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'WpitemGroupId' => 1, 'Rank' => 2, 'Content' => 3, 'Evaluation' => 4, 'IsEditable' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'wpitemGroupId' => 1, 'rank' => 2, 'content' => 3, 'evaluation' => 4, 'isEditable' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::WPITEM_GROUP_ID => 1, self::RANK => 2, self::CONTENT => 3, self::EVALUATION => 4, self::IS_EDITABLE => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'wpitem_group_id' => 1, 'rank' => 2, 'content' => 3, 'evaluation' => 4, 'is_editable' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new WpmoduleItemMapBuilder();
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
		return str_replace(WpmoduleItemPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WpmoduleItemPeer::ID);

		$criteria->addSelectColumn(WpmoduleItemPeer::WPITEM_GROUP_ID);

		$criteria->addSelectColumn(WpmoduleItemPeer::RANK);

		$criteria->addSelectColumn(WpmoduleItemPeer::CONTENT);

		$criteria->addSelectColumn(WpmoduleItemPeer::EVALUATION);

		$criteria->addSelectColumn(WpmoduleItemPeer::IS_EDITABLE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpmoduleItemPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpmoduleItemPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = WpmoduleItemPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return WpmoduleItemPeer::populateObjects(WpmoduleItemPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			WpmoduleItemPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(WpmoduleItem $obj, $key = null)
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
			if (is_object($value) && $value instanceof WpmoduleItem) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or WpmoduleItem object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = WpmoduleItemPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = WpmoduleItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = WpmoduleItemPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				WpmoduleItemPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinWpitemGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpmoduleItemPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpmoduleItemPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(WpmoduleItemPeer::WPITEM_GROUP_ID,), array(WpitemGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinWpitemGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WpmoduleItemPeer::addSelectColumns($c);
		$startcol = (WpmoduleItemPeer::NUM_COLUMNS - WpmoduleItemPeer::NUM_LAZY_LOAD_COLUMNS);
		WpitemGroupPeer::addSelectColumns($c);

		$c->addJoin(array(WpmoduleItemPeer::WPITEM_GROUP_ID,), array(WpitemGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpmoduleItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpmoduleItemPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = WpmoduleItemPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpmoduleItemPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = WpitemGroupPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = WpitemGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = WpitemGroupPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					WpitemGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpmoduleItem($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(WpmoduleItemPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			WpmoduleItemPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(WpmoduleItemPeer::WPITEM_GROUP_ID,), array(WpitemGroupPeer::ID,), $join_behavior);
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

		WpmoduleItemPeer::addSelectColumns($c);
		$startcol2 = (WpmoduleItemPeer::NUM_COLUMNS - WpmoduleItemPeer::NUM_LAZY_LOAD_COLUMNS);

		WpitemGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (WpitemGroupPeer::NUM_COLUMNS - WpitemGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(WpmoduleItemPeer::WPITEM_GROUP_ID,), array(WpitemGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = WpmoduleItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = WpmoduleItemPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = WpmoduleItemPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				WpmoduleItemPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = WpitemGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = WpitemGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = WpitemGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					WpitemGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addWpmoduleItem($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array(array('id', 'rank'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return WpmoduleItemPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(WpmoduleItemPeer::ID) && $criteria->keyContainsValue(WpmoduleItemPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpmoduleItemPeer::ID.')');
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
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(WpmoduleItemPeer::ID);
			$selectCriteria->add(WpmoduleItemPeer::ID, $criteria->remove(WpmoduleItemPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(WpmoduleItemPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												WpmoduleItemPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof WpmoduleItem) {
						WpmoduleItemPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WpmoduleItemPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								WpmoduleItemPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(WpmoduleItem $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WpmoduleItemPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WpmoduleItemPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WpmoduleItemPeer::DATABASE_NAME, WpmoduleItemPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WpmoduleItemPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = WpmoduleItemPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(WpmoduleItemPeer::DATABASE_NAME);
		$criteria->add(WpmoduleItemPeer::ID, $pk);

		$v = WpmoduleItemPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(WpmoduleItemPeer::DATABASE_NAME);
			$criteria->add(WpmoduleItemPeer::ID, $pks, Criteria::IN);
			$objs = WpmoduleItemPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseWpmoduleItemPeer::DATABASE_NAME)->addTableBuilder(BaseWpmoduleItemPeer::TABLE_NAME, BaseWpmoduleItemPeer::getMapBuilder());

