<?php 

/**
 * class.
 *
 * @package    schoolmesh
 * @subpackage lib.exceptions
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class NotOwnerException extends Exception
{
	function __construct($message='')
	{
			parent::__construct($message);
	}


};
