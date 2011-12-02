<?php

/**
 * WptoolItemPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WptoolItemPeer extends BaseWptoolItemPeer
{
	static public function getByDescription($description)
	{
		$c=new Criteria();
	    $c->add(parent::DESCRIPTION, $description);
		return parent::doSelectOne($c);
	}




}
