<?php

/**
 * workgroup actions.
 *
 * @package   schoolmesh
 * @subpackage workgroup
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class workgroupActions extends sfActions
{
  public function executeIndex()
  {
    $this->workgroupList = WorkgroupPeer::doSelect(new Criteria());
  }

  public function executeShow($request)
  {
    $this->workgroup = WorkgroupPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workgroup);
  }

  public function executeCreate()
  {
    $this->form = new WorkgroupForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = new WorkgroupForm(WorkgroupPeer::retrieveByPk($request->getParameter('id')));
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WorkgroupForm(WorkgroupPeer::retrieveByPk($request->getParameter('id')));

    $this->form->bind($request->getParameter('workgroup'));
    if ($this->form->isValid())
    {
      $workgroup = $this->form->save();

      $this->redirect('workgroup/edit?id='.$workgroup->getId());
    }

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($workgroup = WorkgroupPeer::retrieveByPk($request->getParameter('id')));

    $workgroup->delete();

    $this->redirect('workgroup/index');
  }
}
