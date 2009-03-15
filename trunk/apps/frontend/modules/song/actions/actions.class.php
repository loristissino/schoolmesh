<?php

/**
 * song actions.
 *
 * @package   schoolmesh
 * @subpackage song
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class songActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->song_list = SongPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SongForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new SongForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($song = SongPeer::retrieveByPk($request->getParameter('id')), sprintf('Object song does not exist (%s).', $request->getParameter('id')));
    $this->form = new SongForm($song);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($song = SongPeer::retrieveByPk($request->getParameter('id')), sprintf('Object song does not exist (%s).', $request->getParameter('id')));
    $this->form = new SongForm($song);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($song = SongPeer::retrieveByPk($request->getParameter('id')), sprintf('Object song does not exist (%s).', $request->getParameter('id')));
    $song->delete();

    $this->redirect('song/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $song = $form->save();

      $this->redirect('song/edit?id='.$song->getId());
    }
  }
}
