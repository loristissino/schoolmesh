<?php

/**
 * unititem actions.
 *
 * @package   schoolmesh
 * @subpackage unititem
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class unititemActions extends sfActions
{
  public function executeIndex()
  {
    $this->unit_itemList = UnitItemPeer::doSelect(new Criteria());
  }

  public function executeCreate()
  {
    $this->form = new UnitItemForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = new UnitItemForm(UnitItemPeer::retrieveByPk($request->getParameter('id')));
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new UnitItemForm(UnitItemPeer::retrieveByPk($request->getParameter('id')));

    $this->form->bind($request->getParameter('unit_item'));
    if ($this->form->isValid())
    {
      $unit_item = $this->form->save();

      $this->redirect('unititem/edit?id='.$unit_item->getId());
    }

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($unit_item = UnitItemPeer::retrieveByPk($request->getParameter('id')));

    $unit_item->delete();

    $this->redirect('unititem/index');
  }
}
