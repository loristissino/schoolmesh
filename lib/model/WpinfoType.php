<?php

class WpinfoType extends BaseWpinfoType
{
	
	public function getRenderedTemplate()
	{
	
	$template = $this->getTemplate();
	
	$template = str_replace('\d+', sfContext::getInstance()->getI18N()->__('{integer}'), $template);
	return $template;

	}
	
}
