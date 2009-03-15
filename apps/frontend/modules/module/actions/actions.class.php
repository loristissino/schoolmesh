<?php

/**
 * unit actions.
 *
 * @package   schoolmesh
 * @subpackage unit
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class unitActions extends sfActions
{
  public function executeIndex()
  {
    $this->unitList = UnitPeer::doSelect(new Criteria());
  }

  public function executeCreate()
  {
    $this->form = new UnitForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = new UnitForm(UnitPeer::retrieveByPk($request->getParameter('id')));
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new UnitForm(UnitPeer::retrieveByPk($request->getParameter('id')));

    $this->form->bind($request->getParameter('unit'));
    if ($this->form->isValid())
    {
      $unit = $this->form->save();

      $this->redirect('unit/edit?id='.$unit->getId());
    }

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($unit = UnitPeer::retrieveByPk($request->getParameter('id')));

    $unit->delete();

    $this->redirect('unit/index');
  }
}
