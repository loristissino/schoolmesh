<?php

class Wpinfo extends BaseWpinfo
{
	public function setContent($v)
	{
		$v=chop(html_entity_decode(strip_tags(str_replace('</p>', '<br />',$v), '<br><em>')));
		parent::setContent($v);
	}
}
