<?php

/**
 * SuggestionPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SuggestionPeer extends BaseSuggestionPeer {

public static function retrieveAllByRank()
	{
		$c=new Criteria();
		$c->add(self::IS_SELECTABLE, true);
    $c->addAscendingOrderByColumn(SuggestionPeer::RANK);
    
		return parent::doSelect($c);
	}



} // SuggestionPeer
