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
    $this->forward404();
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
    $this->forward404Unless($this->wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));

	$this->forward404Unless($this->wpinfo->getAppointment()->getUserId()==$this->getUser()->getProfile()->getSfGuardUser()->getId());

	if ($this->wpinfo->getContent()=='')
		$this->wpinfo->setContent($this->wpinfo->getWpinfoType()->getRenderedTemplate());
	$this->type=$this->wpinfo->getWpinfoType();
	
	$this->next_item = $this->wpinfo->getNext();
	$this->hints = $this->wpinfo->getHints();
	$this->example = $this->wpinfo->getExample();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));

    $result=$wpinfo->setCheckedContent($this->getUser()->getProfile()->getSfGuardUser()->getId(), $request->getParameter('value'));

	$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));

	if($result['result']=='notice_info')
		{
			$wpinfo->save();
			if ($request->getParameter('save') || $request->getParameter('save_x'))
				// we check also save_x to support image submit
				{
					$this->redirect('wpinfo/edit?id=' . $wpinfo->getId());
				}
			if ($request->getParameter('back') || $request->getParameter('back_x'))
				{
					$this->redirect('plansandreports/fill?id=' . $wpinfo->getAppointmentId());
				}
			if ($request->getParameter('continue') || $request->getParameter('continue_x'))
				{
					$this->redirect('wpinfo/edit?id=' . $wpinfo->getNext()->getId());
				}
		}
	else
		{
		$this->forward('wpinfo', 'edit');
		}
}
  public function executeReplace(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));
    $this->forward404Unless($wpinfo2 = WpinfoPeer::retrieveByPk($request->getParameter('app')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('app')));
	$wpinfo->setContent($wpinfo2->getContent());
	$wpinfo->save();
	$this->getUser()->setFlash('notice_info', $this->getContext()->getI18N()->__('Content saved.'));
	$this->forward('wpinfo', 'edit');
	
	}
	
  public function executeTakeexample(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));
	$wpinfo->setContent($wpinfo->getWpinfoType()->getExample());
	$wpinfo->save();
	$this->getUser()->setFlash('notice_info', $this->getContext()->getI18N()->__('Content saved.'));
	$this->forward('wpinfo', 'edit');
	
	}
	
	
  public function executeAppend(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpinfo = WpinfoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('id')));
    $this->forward404Unless($wpinfo2 = WpinfoPeer::retrieveByPk($request->getParameter('app')), sprintf('Object wpinfo does not exist (%s).', $request->getParameter('app')));
	$wpinfo->setContent($wpinfo->getContent() .  $wpinfo2->getContent());
	$wpinfo->save();
	$this->getUser()->setFlash('notice_info', $this->getContext()->getI18N()->__('Content saved.'));
	$this->forward('wpinfo', 'edit');
	
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
