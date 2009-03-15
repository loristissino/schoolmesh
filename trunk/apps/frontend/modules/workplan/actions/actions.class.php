<?php

/**
 * workplan actions.
 *
 * @package   schoolmesh
 * @subpackage workplan
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class workplanActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->workplan_list = WorkplanPeer::doSelect(new Criteria());
	$this->workplan_list = $this->getUser()->getProfile()->getWorkplans();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WorkplanForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WorkplanForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($workplan = WorkplanPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $this->form = new WorkplanForm($workplan);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($workplan = WorkplanPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $this->form = new WorkplanForm($workplan);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($workplan = WorkplanPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $workplan->delete();

    $this->redirect('workplan/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $workplan = $form->save();

      $this->redirect('workplan/edit?id='.$workplan->getId());
    }
  }
}
