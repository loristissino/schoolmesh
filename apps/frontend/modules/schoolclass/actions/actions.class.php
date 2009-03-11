<?php

/**
 * schoolclass actions.
 *
 * @package    mattiussi
 * @subpackage schoolclass
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class schoolclassActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->schoolclass_list = SchoolclassPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SchoolclassForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new SchoolclassForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($schoolclass = SchoolclassPeer::retrieveByPk($request->getParameter('id')), sprintf('Object schoolclass does not exist (%s).', $request->getParameter('id')));
    $this->form = new SchoolclassForm($schoolclass);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($schoolclass = SchoolclassPeer::retrieveByPk($request->getParameter('id')), sprintf('Object schoolclass does not exist (%s).', $request->getParameter('id')));
    $this->form = new SchoolclassForm($schoolclass);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($schoolclass = SchoolclassPeer::retrieveByPk($request->getParameter('id')), sprintf('Object schoolclass does not exist (%s).', $request->getParameter('id')));
    
    try {
    
    $schoolclass->delete();
}

    catch (Exception $e)
    
    {

      $this->getUser()->setFlash('notice', sprintf('Deletion impossible (integrity violation)'));
      $this->redirect('schoolclass/edit?id='.$schoolclass->getId());
    }
    
    
    $this->redirect('schoolclass/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $schoolclass = $form->save();
      $this->getUser()->setFlash('notice', sprintf('Update successful'));

      $this->redirect('schoolclass/edit?id='.$schoolclass->getId());
    }
  }
}
