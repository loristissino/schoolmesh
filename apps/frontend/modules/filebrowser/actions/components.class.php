<?php

/**
 * filebrowser components.
 *
 * @package    schoolmesh
 * @subpackage filebrowser
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filebrowserComponents extends sfComponents
{
	
  public function executeMimetype(sfWebRequest $request)
  {
	
	switch($this->mimetype)
	{
		case 'regular file, no read permission':
		case 'writable, regular file, no read permission':
			$this->icon_name='extra/forbidden';
			break;
		default:
			$this->icon_name=str_replace('/', '_', $this->mimetype);
	}
  }
  
}

