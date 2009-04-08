<?php

/**
 * wpinfo actions.
 *
 * @package    schoolmesh
 * @subpackage wpinfo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class wpinfoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->wpinfo_list = WpinfoPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WpinfoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WpinfoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));
    //$this->form = new WpinfoForm($wpinfo);
	$this->wpinfo=$wpinfo;
	$this->type=$wpinfo->getWpinfoType();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));

    $wpinfo->setContent($request->getParameter('value'));

	$this->getUser()->setFlash('notice_info', sprintf('The item was updated'));

	$wpinfo->save();
	
   $this->redirect('plansandreports/fill?id=' . $wpinfo->getAppointmentId());
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));
    $wpinfo->delete();

    $this->redirect('wpinfo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $wpinfo = $form->save();

      $this->redirect('wpinfo/edit?id='.$wpinfo->getId());
    }
  }
}
