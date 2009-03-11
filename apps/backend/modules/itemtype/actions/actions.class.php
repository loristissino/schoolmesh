<?php

/**
 * itemtype actions.
 *
 * @package    mattiussi
 * @subpackage itemtype
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class itemtypeActions extends sfActions
{
  public function executeIndex()
  {
    $this->item_typeList = ItemTypePeer::doSelect(new Criteria());
  }

  public function executeCreate()
  {
    $this->form = new ItemTypeForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = new ItemTypeForm(ItemTypePeer::retrieveByPk($request->getParameter('id')));
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ItemTypeForm(ItemTypePeer::retrieveByPk($request->getParameter('id')));

    $this->form->bind($request->getParameter('item_type'));
    if ($this->form->isValid())
    {
      $item_type = $this->form->save();

      $this->redirect('itemtype/edit?id='.$item_type->getId());
    }

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($item_type = ItemTypePeer::retrieveByPk($request->getParameter('id')));

    $item_type->delete();

    $this->redirect('itemtype/index');
  }
}
