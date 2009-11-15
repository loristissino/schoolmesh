<?php

/**
 * Subclass for performing query and update operations on the 'subject' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SubjectPeer extends BaseSubjectPeer
{
	
	
	static public function retrieveByShortcut($shortcut)
	{
	$c=new Criteria();
	$c->add(self::SHORTCUT, $shortcut);
	$t = parent::doSelectOne($c);
	return $t;
		
	}

	static public function retrieveAllByRank()
	{
	$c=new Criteria();
	$c->addAscendingOrderByColumn(SubjectPeer::RANK);
	$t = parent::doSelect($c);
	return $t;
		
	}




}
