<?php

/**
 * wpitemtype actions.
 *
 * @package    mattiussi
 * @subpackage wpitemtype
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class wpitemtypeActions extends sfActions
{
	
	public function executeUp()
{
  $item = WpitemTypePeer::retrieveByPk($this->getRequestParameter('id'));
  $this->forward404Unless($item);
  $previous_item = WpitemTypePeer::retrieveByRank($item->getRank() - 1);
  $this->forward404Unless($previous_item);
  $item->swapWith($previous_item);
 
  $this->redirect('wpitemtype/list');
}  
 
public function executeDown()
{
  $item = WpitemTypePeer::retrieveByPk($this->getRequestParameter('id'));
  $this->forward404Unless($item);
  $next_item = WpitemTypePeer::retrieveByRank($item->getRank() + 1);
  $this->forward404Unless($next_item);
  $item->swapWith($next_item);
 
  $this->redirect('wpitemtype/list');
}
	
  public function executeIndex(sfWebRequest $request)
  {
    $this->wpitem_type_list = WpitemTypePeer::doSelect(new Criteria());
	
  }

  public function executeList(sfWebRequest $request)
  {
    $this->wpitems = WpitemTypePeer::getAllByRank();
    $this->max_rank = WpitemTypePeer::getMaxRank();
	
  }


  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WpitemTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WpitemTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($wpitem_type = WpitemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpitem_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpitemTypeForm($wpitem_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpitem_type = WpitemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpitem_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpitemTypeForm($wpitem_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($wpitem_type = WpitemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpitem_type does not exist (%s).', $request->getParameter('id')));
    $wpitem_type->delete();

    $this->redirect('wpitemtype/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $wpitem_type = $form->save();

      $this->redirect('wpitemtype/edit?id='.$wpitem_type->getId());
    }
  }
}
