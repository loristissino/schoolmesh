<?php

require 'lib/model/om/BaseProjDetailType.php';


/**
 * Skeleton subclass for representing a row from the 'proj_detail_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjDetailType extends BaseProjDetailType {

  public function getFieldName()
  {
    return sprintf('detail_%s', $this->getCode());
  }

} // ProjDetailType
