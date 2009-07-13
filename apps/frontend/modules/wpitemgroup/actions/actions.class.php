<?php

/**
 * wpitemgroup actions.
 *
 * @package    schoolmesh
 * @subpackage wpitemgroup
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class wpitemgroupActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward404();
  }

  public function executeManage(sfWebRequest $request)
  {
	
	$this->wpitemGroup = WpitemGroupPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpitemGroup);

	$this->wpmodule = $this->wpitemGroup->getWpmodule();

	$this->wpitemType = $this->wpitemGroup->getWpitemType();
	$this->wp = $this->wpmodule->getAppointment();
	$this->user=$this->getUser();

    $this->forward404Unless($this->wp->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId()));
	
  }

  public function executeUpdate(sfWebRequest $request)
  {
	
	$this->wpitemGroup = WpitemGroupPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpitemGroup);

	$this->wpmodule = $this->wpitemGroup->getWpmodule();

	$this->wpitemType = $this->wpitemGroup->getWpitemType();
	$this->wp = $this->wpmodule->getAppointment();
    $this->user=$this->getUser();
	$this->forward404Unless($this->wp->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId()));
	$this->forward404Unless($this->wp->getState()==Workflow::WP_DRAFT);
		
	$result=$this->wpitemGroup->replaceItems($request->getParameter('value'));
	
	$this->text=$result;
	
	$this->getUser()->setFlash($result['result'].$this->wpitemGroup->getId(), $this->getContext()->getI18N()->__($result['message']));
	$this->redirect('wpmodule/view?id=' . $this->wpmodule->getId().'#'.$this->wpitemGroup->getId());


  }

}
