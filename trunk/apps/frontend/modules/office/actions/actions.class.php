<?php

/**
 * office actions.
 *
 * @package    schoolmesh
 * @subpackage office
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class officeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   // $this->forward('default', 'module');

		$this->workplans=AppointmentPeer::getSubmitted(Workflow::WP_WADMC);
		$this->steps = Workflow::getWpfrSteps();

  }

  public function executeReject(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));

	$result = $workplan->Reject($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);

	$this->redirect('@office');

  }


  public function executeApprove(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));

	$result = $workplan->Approve($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);

	$this->redirect('@office');

  }


}
