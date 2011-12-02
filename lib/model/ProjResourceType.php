<?php

/**
 * ProjResourceType class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class ProjResourceType extends BaseProjResourceType {

  public function __toString()
  {
    return $this->getDescription();
  }

} // ProjResourceType
