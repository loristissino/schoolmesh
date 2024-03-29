<?php

/**
 * SubjectPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SubjectPeer extends BaseSubjectPeer
{
	
	static public function retrieveByShortcut($shortcut)
	{
    $c=new Criteria();
    $c->add(self::SHORTCUT, $shortcut);
    $c->add(self::IS_ACTIVE, true);
    $t = parent::doSelectOne($c);
    return $t;
	}

	static public function retrieveAllByRank()
	{
    $c=new Criteria();
    $c->add(self::IS_ACTIVE, true);
    $c->addAscendingOrderByColumn(SubjectPeer::RANK);
    $t = parent::doSelect($c);
    return $t;
	}




}
