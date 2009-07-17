<?php

class WptoolItemPeer extends BaseWptoolItemPeer
{
	static public function getByDescription($description)
	{
		$c=new Criteria();
	    $c->add(parent::DESCRIPTION, $description);
		return parent::doSelectOne($c);
	}




}
