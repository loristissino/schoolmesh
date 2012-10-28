<?php

/**
 * documents actions.
 *
 * @package    schoolmesh
 * @subpackage documents
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class documentsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Doctypes = DoctypePeer::retrieveActive();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Document = DocumentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Document);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new documentForm();
  }
  
  public function executeActivaterevision(sfWebRequest $request)
  {
    $Docrevision=DocrevisionPeer::retrieveByPK($request->getParameter('id'));
    $Document=$Docrevision->getDocument();
    $Document
    ->setDocrevisionId($Docrevision->getId())
    ->save()
    ;
    
    return $this->redirect('documents/show?id=' . $Document->getId());
  }


  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new documentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Document = DocumentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Document does not exist (%s).', $request->getParameter('id')));
    $this->form = new documentForm($Document);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Document = DocumentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Document does not exist (%s).', $request->getParameter('id')));
    $this->form = new documentForm($Document);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Document = DocumentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Document does not exist (%s).', $request->getParameter('id')));
    $Document->delete();

    $this->redirect('documents/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Document = $form->save();

      $this->redirect('documents/edit?id='.$Document->getId());
    }
  }
}
