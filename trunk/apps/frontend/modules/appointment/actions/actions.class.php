<?php

/**
 * appointment actions.
 *
 * @package    mattiussi
 * @subpackage appointment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class appointmentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->appointment_list = AppointmentPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AppointmentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new AppointmentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($appointment = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object appointment does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentForm($appointment);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($appointment = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object appointment does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentForm($appointment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($appointment = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object appointment does not exist (%s).', $request->getParameter('id')));
    $appointment->delete();

    $this->redirect('appointment/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $appointment = $form->save();

      $this->redirect('appointment/edit?id='.$appointment->getId());
    }
  }
}
