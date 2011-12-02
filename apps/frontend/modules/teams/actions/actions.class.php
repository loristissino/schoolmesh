<?php

/**
 * teams actions.
 *
 * @package    schoolmesh
 * @subpackage teams
 * @author     Your name here
 */
class teamsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Teams = TeamPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Team = TeamPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Team);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TeamForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TeamForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Team = TeamPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Team does not exist (%s).', $request->getParameter('id')));
    $this->form = new TeamForm($Team);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Team = TeamPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Team does not exist (%s).', $request->getParameter('id')));
    $this->form = new TeamForm($Team);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Team = TeamPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Team does not exist (%s).', $request->getParameter('id')));
    $Team->delete();

    $this->redirect('teams/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Team = $form->save();

      $this->redirect('teams/edit?id='.$Team->getId());
    }
  }
}
