<?php

/**
 * wptooltypes actions.
 *
 * @package    schoolmesh
 * @subpackage wptooltypes
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class wptooltypesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->WptoolItemTypes = WptoolItemTypePeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WptoolItemTypeForm();
    if($request->hasParameter('appointmenttype'))
    {
      $this->form->setDefault('appointment_type_id', $request->getParameter('appointmenttype'));
    }

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WptoolItemTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($WptoolItemType = WptoolItemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WptoolItemType does not exist (%s).', $request->getParameter('id')));
    $this->form = new WptoolItemTypeForm($WptoolItemType);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($WptoolItemType = WptoolItemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WptoolItemType does not exist (%s).', $request->getParameter('id')));
    $this->form = new WptoolItemTypeForm($WptoolItemType);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($WptoolItemType = WptoolItemTypePeer::retrieveByPk($request->getParameter('id')), sprintf('Object WptoolItemType does not exist (%s).', $request->getParameter('id')));
    
    $appointment_type_id=$WptoolItemType->getAppointmentTypeId();
    $WptoolItemType->delete();

    $this->redirect('appointmenttypes/show?id='. $appointment_type_id);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $WptoolItemType = $form->save();

      $this->redirect('wptooltypes/edit?id='.$WptoolItemType->getId());
    }
  }
}
