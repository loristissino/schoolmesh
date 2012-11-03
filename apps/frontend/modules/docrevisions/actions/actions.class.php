<?php

/**
 * docrevisions actions.
 *
 * @package    schoolmesh
 * @subpackage docrevisions
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class docrevisionsActions extends sfActions
{
  /*
  public function executeIndex(sfWebRequest $request)
  {
    $this->Docrevisions = DocrevisionPeer::doSelect(new Criteria());
  }
  * */

  public function executeShow(sfWebRequest $request)
  {
    $this->Docrevision = DocrevisionPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Docrevision);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->Document = DocumentPeer::retrieveByPk($request->getParameter('document'));
    $this->forward404Unless($this->Document);
    $this->form = new docrevisionForm();
    $this->form->setDefault('document_id', $this->Document->getId());
    $this->form->setDefault('revision_number', $this->Document->getRevisionNumber()===null ? 0 : $this->Document->getRevisionNumber() +1 );
    $this->form->setDefault('revisioned_at', time());
    
    if($Docrevision=DocrevisionPeer::retrieveByPK($request->getParameter('fromrevision', null)))
    {
      $this->form->setDefault('content', $Docrevision->getContent());
      $this->form->setDefault('content_type', $Docrevision->getContentType());
    }
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $params=$request->getParameter('docrevision');

    $this->forward404Unless($this->Document = DocumentPeer::retrieveByPK($params['document_id']));

    $this->form = new DocrevisionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Docrevision = DocrevisionPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Document revision does not exist (%s).', $request->getParameter('id')));
    $this->form = new DocrevisionForm($Docrevision);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Docrevision = DocrevisionPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Document revision does not exist (%s).', $request->getParameter('id')));
    $this->form = new docrevisionForm($Docrevision);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Docrevision = DocrevisionPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Document revision does not exist (%s).', $request->getParameter('id')));
    
    $document_id=$Docrevision->getDocumentId();
    
    $Docrevision->delete();

    $this->redirect('documents/details?id=' . $document_id);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $params = $this->form->getValues();
      
      $this->docrevision = DocrevisionPeer::retrieveByPK($params['id']);
      if(!$this->docrevision)
      {
        $this->docrevision = new Docrevision();
        Generic::logMessage('params', $params);
      }

      $result=$this->docrevision->updateFromForm($params + array('uploader_id'=>$this->getUser()->getProfile()->getUserId()), $this->form->getValue('source_attachment'), $this->form->getValue('published_attachment'), $this->getContext());
      
      $this->getUser()->setFlash($result['result'],
        $this->getContext()->getI18N()->__($result['message'])
        );
      
      return $this->redirect('docrevisions/edit?id='. $this->docrevision->getId());
      
    }
    

  }
}
