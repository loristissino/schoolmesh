<?php

/**
 * appointmenttypes actions.
 *
 * @package    schoolmesh
 * @subpackage appointmenttypes
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class appointmenttypesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->AppointmentTypes = AppointmentTypePeer::retrieveAll();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->AppointmentType = AppointmentTypePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->AppointmentType);
    
    $this->WpinfoTypes=$this->AppointmentType->getWpinfoTypes();
    $this->WpitemTypes=$this->AppointmentType->getWpitemTypes();
    //$this->WptoolTypes=$this->AppointmentType->getWptoolTypes();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AppointmentTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AppointmentTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($AppointmentType = AppointmentTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object AppointmentType does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentTypeForm($AppointmentType);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($AppointmentType = AppointmentTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object AppointmentType does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentTypeForm($AppointmentType);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($AppointmentType = AppointmentTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object AppointmentType does not exist (%s).', $request->getParameter('id')));
    
    try
    {
      $AppointmentType->delete();
      $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('The item was deleted'));
    }
    catch (Exception $e)
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('The item could not be deleted'));
    }

    $this->redirect('appointmenttypes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $AppointmentType = $form->save();

      $this->redirect('appointmenttypes/edit?id='.$AppointmentType->getId());
    }
  }
}
