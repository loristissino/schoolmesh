<?php

require_once 'lib/model/om/BaseProjDetailTypePeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'proj_detail_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjDetailTypePeer extends BaseProjDetailTypePeer {

  public static function retrieveActiveByStateAndCategory($state, $category_id=null)
  {
    $c = new Criteria();
    $c->add(self::IS_ACTIVE, true);
    $c->add(self::STATE_MIN, $state, Criteria::LESS_EQUAL);
    $c->add(self::STATE_MAX, $state, Criteria::GREATER_EQUAL);
    $c1=$c->getNewCriterion(self::PROJ_CATEGORY_ID, $category_id);
    $c2=$c->getNewCriterion(self::PROJ_CATEGORY_ID, null, Criteria::ISNULL);
    $c1->addOr($c2);
    $c->add($c1);
    $c->addAscendingOrderByColumn(self::RANK);
    return self::doSelect($c);
  }

  public static function retrieveByCode($code)
  {
    $c = new Criteria();
    $c->add(self::CODE, $code);
    return self::doSelectOne($c);
  }


} // ProjDetailTypePeer

