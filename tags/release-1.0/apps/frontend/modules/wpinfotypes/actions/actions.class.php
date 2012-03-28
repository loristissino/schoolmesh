<?php

/**
 * wpinfotypes actions.
 *
 * @package    schoolmesh
 * @subpackage wpinfotypes
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class wpinfotypesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->WpinfoTypes = WpinfoTypePeer::doSelect(new Criteria());
  }

  /*
  public function executeShow(sfWebRequest $request)
  {
    $this->WpinfoType = WpinfoTypePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->WpinfoType);
  }
  */

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WpinfoTypeForm();
    if($request->hasParameter('appointmenttype'))
    {
      $this->form->setDefault('appointment_type_id', $request->getParameter('appointmenttype'));
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WpinfoTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($WpinfoType = WpinfoTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WpinfoType does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpinfoTypeForm($WpinfoType);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($WpinfoType = WpinfoTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WpinfoType does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpinfoTypeForm($WpinfoType);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($WpinfoType = WpinfoTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WpinfoType does not exist (%s).', $request->getParameter('id')));
    $WpinfoType->delete();

    $this->redirect('wpinfotypes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $WpinfoType = $form->save();

      $this->redirect('wpinfotypes/edit?id='.$WpinfoType->getId());
    }
  }
}
