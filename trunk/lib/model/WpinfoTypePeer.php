<?php

class WpinfoTypePeer extends BaseWpinfoTypePeer
{
	
	static public function getByTitle($title)
	{
		$c=new Criteria();
	    $c->add(WpinfoTypePeer::TITLE, $title);
		return parent::doSelectOne($c);

	}

	static public function getAll()
	{
		$c=new Criteria();
		return parent::doSelect($c);
	}


}
