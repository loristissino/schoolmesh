<?php

/**
 * roles actions.
 *
 * @package    schoolmesh
 * @subpackage roles
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class rolesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Roles = RolePeer::retrieveAll();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RoleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RoleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Role = RolePeer::retrieveByPk($request->getParameter('id')), sprintf('Object Role does not exist (%s).', $request->getParameter('id')));
    $this->form = new RoleForm($Role);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Role = RolePeer::retrieveByPk($request->getParameter('id')), sprintf('Object Role does not exist (%s).', $request->getParameter('id')));
    $this->form = new RoleForm($Role);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Role = RolePeer::retrieveByPk($request->getParameter('id')), sprintf('Object Role does not exist (%s).', $request->getParameter('id')));
    $Role->delete();

    $this->redirect('roles/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Role = $form->save();

      $this->redirect('roles/edit?id='.$Role->getId());
    }
  }
}
