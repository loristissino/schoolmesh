<?php

require 'lib/model/om/BaseProjCategoryPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'proj_category' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjCategoryPeer extends BaseProjCategoryPeer {
	
	public static function retrieveByTitle($title)
	{
		$c=new Criteria();
		$c->add(self::TITLE, $title);
		return self::doSelectOne($c);
		
	}

} // ProjCategoryPeer
