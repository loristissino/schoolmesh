<?php

/**
 * WpinfoType class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpinfoType extends BaseWpinfoType
{

  public function __toString()
  {
    return $this->getTitle();
  }
	
	public function getRenderedTemplate()
	{
	
    $template = $this->getTemplate();
    $template = str_replace('\d+', sfContext::getInstance()->getI18N()->__('{integer}'), $template);
    return $template;
	}
	
}
