<?php

require 'lib/model/om/BaseSchoolproject.php';


/**
 * Skeleton subclass for representing a row from the 'schoolproject' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Schoolproject extends BaseSchoolproject {

	public function __toString()
	{
		return $this->getTitle();
	}
	
	public function getProjDeadlines($criteria = null, PropelPDO $con = null)
	{
		$criteria=new Criteria();
		$criteria->addAscendingOrderByColumn(ProjDeadlinePeer::ORIGINAL_DEADLINE_DATE);
		$criteria->addAscendingOrderByColumn(ProjDeadlinePeer::DESCRIPTION);
		return parent::getProjDeadlines($criteria);
	}
	
	
	public function getOdf($doctype, sfContext $sfContext=null, $template='', $complete=true)
	{
		
		if ($template=='')
		{
			$template='project_resume.odt';
		}
			
		try
		{
			$odf=new OdfDoc($template, $this->__toString(). '.' . $doctype, $doctype);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		
		$owner=$this->getSfGuardUser()->getProfile();
		
		$odfdoc->setVars('salutation', $this->getSfGuardUser()->getProfile()->getSalutation($sfContext));
		$odfdoc->setVars('year',  $this->getYear()->__toString());
		$odfdoc->setVars('coordinator',  $this->getSfGuardUser()->getProfile()->getFullName());
		$odfdoc->setVars('title', $this->getTitle());
		$odfdoc->setVars('category',  $this->getProjCategory()->getTitle());
		$odfdoc->setVars('hours_approved', $this->getHoursApproved());
		
		$projDeadlines=$this->getProjDeadlines();
		
		$deadlines=$odfdoc->setSegment('deadlines');
		foreach($projDeadlines as $projDeadline)
		{
			$deadlines->infoDescription($projDeadline->getDescription());
			$deadlines->infoDeadlineDate($projDeadline->getOriginalDeadlineDate('d/m/Y'));
			$deadlines->infoAssignee($projDeadline->getsfGuardUser()->getProfile()->getFullName());
			$deadlines->merge();
		}
		
		$odfdoc->mergeSegment($deadlines);
		
		return $odf;
	}

	

} // Schoolproject
