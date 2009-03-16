<?php

/**
 * wpmodule actions.
 *
 * @package    schoolmesh
 * @subpackage wpmodule
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class wpmoduleActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->wpmodule_list = WpmodulePeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpmodule);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WpmoduleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WpmoduleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpmoduleForm($wpmodule);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpmoduleForm($wpmodule);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule does not exist (%s).', $request->getParameter('id')));
    $wpmodule->delete();

    $this->redirect('wpmodule/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $wpmodule = $form->save();

      $this->redirect('wpmodule/edit?id='.$wpmodule->getId());
    }
  }
}
