<?php

/**
 * tickets actions.
 *
 * @package    schoolmesh
 * @subpackage tickets
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class ticketsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Tickets = TicketPeer::retrieveOpen();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Ticket = TicketPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Ticket);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TicketForm();
    $this->referrer=$request->getReferer();
    $this->form->setDefault('referrer', $this->referrer);
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TicketForm();

    $this->processForm($request, $this->form);
        
    $this->form->setDefault('referrer', $this->referrer);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->Ticket = TicketPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Ticket does not exist (%s).', $request->getParameter('id')));
    $this->form = new TicketForm($this->Ticket);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Ticket = TicketPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Ticket does not exist (%s).', $request->getParameter('id')));
    $this->form = new TicketForm($Ticket);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Ticket = TicketPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Ticket does not exist (%s).', $request->getParameter('id')));
    $Ticket->delete();

    $this->redirect('tickets/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Ticket = $form->save();

      $this->redirect('tickets/edit?id='.$Ticket->getId());
    }
    else
    {
      $params= $request->getParameter('info');
      $this->referrer= $params['referrer'];
    }
  }
}
