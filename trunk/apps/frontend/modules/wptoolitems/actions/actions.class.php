<?php

/**
 * wptoolitems actions.
 *
 * @package    schoolmesh
 * @subpackage wptoolitems
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class wptoolitemsActions extends sfActions
{
  /*
  public function executeIndex(sfWebRequest $request)
  {
    $this->WptoolItems = WptoolItemPeer::doSelect(new Criteria());
  }
  */
  public function executeList(sfWebRequest $request)
  {
    $this->forward404Unless($this->WptoolItemType=WptoolItemTypePeer::retrieveByPK($request->getParameter('type')));
    $this->WptoolItems = $this->WptoolItemType->getWptoolItems();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->WptoolItem = WptoolItemPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->WptoolItem);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WptoolItemForm();
    if($request->hasParameter('type'))
    {
      $this->WptoolItemType=WptoolItemTypePeer::retrieveByPK($request->getParameter('type'));
      $this->form->setDefault('wptool_item_type_id', $request->getParameter('type'));
    }

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WptoolItemForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
    
    $this->WptoolItemType=$this->form->getObject()->getWptoolItemType();
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($WptoolItem = WptoolItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object WptoolItem does not exist (%s).', $request->getParameter('id')));
    $this->form = new WptoolItemForm($WptoolItem);
    $this->WptoolItemType=$WptoolItem->getWptoolItemType();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($WptoolItem = WptoolItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object WptoolItem does not exist (%s).', $request->getParameter('id')));
    $this->form = new WptoolItemForm($WptoolItem);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
    $this->WptoolItemType=$WptoolItem->getWptoolItemType();
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($WptoolItem = WptoolItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object WptoolItem does not exist (%s).', $request->getParameter('id')));
    $WptoolItem->delete();

    $this->redirect('wptoolitems/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $WptoolItem = $form->save();

      $this->redirect('wptoolitems/edit?id='.$WptoolItem->getId());
    }
  }
}
