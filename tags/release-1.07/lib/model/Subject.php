<?php

/**
 * Subject class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class Subject extends BaseSubject
{

  public function __toString()
  {
        return $this->getDescription(); 
  }


}
