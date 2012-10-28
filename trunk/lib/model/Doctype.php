<?php

require 'lib/model/om/BaseDoctype.php';


/**
 * Skeleton subclass for representing a row from the 'doctype' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Doctype extends BaseDoctype {

  public function __toString()
  {
    return $this->getTitle();
  }

} // Doctype
