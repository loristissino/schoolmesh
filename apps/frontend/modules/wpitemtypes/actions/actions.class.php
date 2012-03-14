<?php

/**
 * wpitemtypes actions.
 *
 * @package    schoolmesh
 * @subpackage wpitemtypes
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class wpitemtypesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->WpitemTypes = WpitemTypePeer::doSelect(new Criteria());
  }

  /*
  public function executeShow(sfWebRequest $request)
  {
    $this->WpitemType = WpitemTypePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->WpitemType);
  }
  */

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WpitemTypeForm();
    if($request->hasParameter('appointmenttype'))
    {
      $this->form->setDefault('appointment_type_id', $request->getParameter('appointmenttype'));
    }

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WpitemTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($WpitemType = WpitemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WpitemType does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpitemTypeForm($WpitemType);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($WpitemType = WpitemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WpitemType does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpitemTypeForm($WpitemType);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($WpitemType = WpitemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WpitemType does not exist (%s).', $request->getParameter('id')));
    $WpitemType->delete();

    $this->redirect('wpitemtypes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $WpitemType = $form->save();

      $this->redirect('wpitemtypes/edit?id='.$WpitemType->getId());
    }
  }
}
