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
  public function executeIndex(sfWebRequest $request)
  {
    $this->Docrevisions = DocrevisionPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Docrevision = DocrevisionPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Docrevision);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new docrevisionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

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
    $Docrevision->delete();

    $this->redirect('docrevisions/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $params = $this->form->getValues();
      
      $this->docrevision = DocrevisionPeer::retrieveByPK($params['id']);

      $result=$this->docrevision->updateFromForm($params + array('uploader_id'=>$this->getUser()->getProfile()->getUserId()), $this->form->getValue('source_attachment'), $this->form->getValue('published_attachment'), $this->getContext());
      
      $this->getUser()->setFlash($result['result'],
        $this->getContext()->getI18N()->__($result['message'])
        );
      
      return $this->redirect('docrevisions/edit?id='. $this->docrevision->getId());
      
    }
  }
}
