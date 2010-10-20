<?php

require 'lib/model/om/BaseProjCategory.php';


/**
 * Skeleton subclass for representing a row from the 'proj_category' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjCategory extends BaseProjCategory {

	public function __toString()
	{
		return $this->getTitle();
	}

} // ProjCategory