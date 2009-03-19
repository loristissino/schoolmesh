<?php

class Workplan extends BaseWorkplan
{
	
public function __toString()
	{
			return $this->getSubject() . ' (' . $this->getSchoolclass() . ', ' . $this->getYear() . ')';
	}

public function getWpmodules($criteria = null, PropelPDO $con = null)
	{

	if (is_null($criteria))
		{
				$criteria=new Criteria();
		}
	else
		{
				$criteria = clone $criteria;
		}

		$criteria->addAscendingOrderByColumn(WpmodulePeer::RANK);
		
		return parent::getWpmodules($criteria, $con);
	}



public function getStatus()
	{
	/*
# status can be one of the following:
#    0: draft (can be completely edited)
#           wpsubmitted_at == NULL
#    1: workplan submitted (cannot be edited, schoolmaster can put it back to 0 or approve it)
#           wpsubmitted_at != NULL and wpapproved_at == NULL
#    2: workplan approved (cannot be edited anymore, but a teacher can add evaluation for the final report)
#           wpapproved_at != NULL and frsubmitted_at == NULL
#    3: final report submitted (cannt be edited, schoolmaster can put it back to 2 or approve it)
#           frsubmitted_at != NULL and frapproved_at == NULL
#    4: final report approved (cannot be edited anymore)
#           frapproved_at != NULL
*/

	if (!$this->wpsubmitted_at)
		return 0;
	
	if ($this->wpsubmitted_at and !$this->wpapproved_at)
		return 1;
	
	if ($this->wpapproved_at and !$this->frsubmitted_at)
		return 2;

	if ($this->frsubmitted_at and !$this->frapproved_at)
		return 3;

	if ($this->frapproved_at)
		return 4;
	}

}
