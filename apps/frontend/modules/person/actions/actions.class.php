<?php

/**
 * person actions.
 *
 * @package    mattiussi
 * @subpackage person
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class personActions extends sfActions
{
  public function executeIndex()
  {
    $this->personList = PersonPeer::doSelect(new Criteria());
  }

  public function executeCreate()
  {
    $this->form = new PersonForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = new PersonForm(PersonPeer::retrieveByPk($request->getParameter('id')));
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new PersonForm(PersonPeer::retrieveByPk($request->getParameter('id')));

    $this->form->bind($request->getParameter('person'));
    if ($this->form->isValid())
    {
      $person = $this->form->save();

      $this->redirect('person/edit?id='.$person->getId());
    }

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($person = PersonPeer::retrieveByPk($request->getParameter('id')));

    $person->delete();
    //catch $e;

    $this->redirect('person/index');
  }
}
