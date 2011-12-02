<?php

/**
 * WpmoduleItemPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpmoduleItemPeer extends BaseWpmoduleItemPeer
{
	
	static function retrieveByRank($rank=1, $wpitemGroupId=1)
	{
	$c = new Criteria;
    $c->add(self::RANK, $rank);
    $c->add(self::WPITEM_GROUP_ID, $wpitemGroupId);
	return self::doSelectOne($c); 	
	
	}
	
	
	static function retrieveOneByContent($content)
	{
		$c=new Criteria();
		$c->add(self::CONTENT, $content);
		return self::doSelectOne($c);
	}

}
