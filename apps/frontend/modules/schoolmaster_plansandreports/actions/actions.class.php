<?php

require_once dirname(__FILE__).'/../lib/schoolmaster_plansandreportsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/schoolmaster_plansandreportsGeneratorHelper.class.php';

/**
 * schoolmaster_plansandreports actions.
 *
 * @package    schoolmesh
 * @subpackage schoolmaster_plansandreports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class schoolmaster_plansandreportsActions extends autoSchoolmaster_plansandreportsActions
{
	
	public function executeListView(sfWebRequest $request)
	{
	$id = $this->getRoute()->getObject()->getId();

	$this->redirect('plansandreports/view?id='.$id);
		
	}

	public function executeListApprove(sfWebRequest $request)
	{
	$workplan = $this->getRoute()->getObject();

	if ($workplan->schoolmasterApprove($this->getUser()->getProfile()->getSfGuardUser()->getId()))
		$this->getUser()->setFlash('notice', 'The workplan has been approved.');
	else
		$this->getUser()->setFlash('error', 'The workplan could not be approved.');
		

	$this->redirect('@appointment');
		
	}



}
