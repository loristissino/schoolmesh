<?php

class WptoolItemTypePeer extends BaseWptoolItemTypePeer
{
	
		static public function getByDescription($description)
	{
		$c=new Criteria();
	    $c->add(parent::DESCRIPTION, $description);
		return parent::doSelectOne($c);
	}

	
}
