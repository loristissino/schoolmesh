<?php

/**
 * ProjFinancing class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class ProjFinancing extends BaseProjFinancing {

  public function __toString()
  {
    return $this->getDescription();
  }

} // ProjFinancing
