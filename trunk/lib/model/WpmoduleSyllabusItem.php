<?php

/**
 * WpmoduleSyllabusItem class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WpmoduleSyllabusItem extends BaseWpmoduleSyllabusItem {

  public function __toString()
  {
    return (string)$this->getId();
  }

} // WpmoduleSyllabusItem
