<?php

require 'lib/model/om/BaseProjDeadline.php';


/**
 * Skeleton subclass for representing a row from the 'proj_deadline' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjDeadline extends BaseProjDeadline {

	public function getState()
	{
		if ($this->getCompleted())
		{
			return 'completed';
		}
		
		if ($this->getCurrentDeadlineDate('U') < time())
		{
			return 'overdue';
		}
		
		return 'not yet over';
		
	}
  
  
  public function updateFromForm($params)
  {
    // we need to check which ones are present, because it depends on the state
    Generic::updateObjectFromForm($this, array(
      'original_deadline_date',
      'current_deadline_date',
      'description',
      'notes',
      'completed',
      ), $params);
  }


} // ProjDeadline

