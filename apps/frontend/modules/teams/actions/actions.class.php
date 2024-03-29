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
    if($this->getUser()->hasPermission('teams'))
    {
      $this->Teams = TeamPeer::retrieveAll();
    }
    else
    {
      $this->Teams = TeamPeer::retrievePublicOrJoined($this->getUser()->getProfile()->getUserId());
    }
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Team = TeamPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Team);
    $this->components=$this->Team->getComponents();
    $this->forward404Unless($this->getUser()->hasCredential('teams') or $this->Team->getIsPublic() or $this->getUser()->getProfile()->getBelongsToTeam($this->Team->getPosixName()));
    $this->getUser()->setAttribute('team_id', $this->Team->getId());
  }

  public function executeViewlogs(sfWebRequest $request)
  {
    $this->Team = TeamPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Team);
    $this->wfevents=$this->Team->getWorkflowLogs();
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
      // we don't know whether this is new or updated, so we just look at previous events...
      if(!$Team->getWorkflowLogs())
      {
        $Team->addWfevent(
          $this->getUser()->getProfile()->getUserId(),
          'Team «%team%» created, posix name «%posix_name%»',
          array('%team%'=>$Team->getDescription(), '%posix_name%'=>$Team->getPosixName()),
          0,
          $this->getContext(),
          null
          );
      }
      else
      {
        $Team->addWfevent(
          $this->getUser()->getProfile()->getUserId(),
          'Team «%team%» updated, posix name «%posix_name%»',
          array('%team%'=>$Team->getDescription(), '%posix_name%'=>$Team->getPosixName()),
          0,
          $this->getContext(),
          null
          );
      }

      $this->redirect('teams/edit?id='.$Team->getId());
    }
  }
}
