<?php

require 'lib/model/om/BaseSuggestionPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'suggestion' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SuggestionPeer extends BaseSuggestionPeer {

public static function retrieveAllByRank()
	{
		$c=new Criteria();
		$c->addAscendingOrderByColumn(SuggestionPeer::RANK);
		return parent::doSelect($c);
	}



} // SuggestionPeer