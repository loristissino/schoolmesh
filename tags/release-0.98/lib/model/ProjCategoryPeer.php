<?php

/**
 * ProjCategoryPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class ProjCategoryPeer extends BaseProjCategoryPeer {
	
	public static function retrieveByTitle($title)
	{
		$c=new Criteria();
		$c->add(self::TITLE, $title);
		return self::doSelectOne($c);
		
	}

} // ProjCategoryPeer
