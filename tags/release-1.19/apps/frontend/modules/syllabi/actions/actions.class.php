<?php

/**
 * syllabi actions.
 *
 * @package    schoolmesh
 * @subpackage syllabi
 * @author     Loris Tissino
 */
class syllabiActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->syllabi = SyllabusPeer::retrieveActive();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->syllabus = SyllabusPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->syllabus);
    $this->maxlevel=$request->getParameter('maxlevel', 1000);
    
    if($request->getParameter('format', '')=='markdown')
    {
      $this->setTemplate('markdown');
      $this->getResponse()->setContentType('text/plain; Charset: utf-8');
      $this->setLayout(false);
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new syllabusForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new syllabusForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($syllabus = SyllabusPeer::retrieveByPk($request->getParameter('id')), sprintf('Object syllabus does not exist (%s).', $request->getParameter('id')));
    $this->form = new syllabusForm($syllabus);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($syllabus = SyllabusPeer::retrieveByPk($request->getParameter('id')), sprintf('Object syllabus does not exist (%s).', $request->getParameter('id')));
    $this->form = new syllabusForm($syllabus);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  public function executeEvaluate(sfWebRequest $request)
  {
    $this->wpmodulesyllabusitem = WpmoduleSyllabusItemPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpmodulesyllabusitem);
	
	// FIXME We should check the owner and the value here...
	
    $min=1; //$type->getEvaluationMin();
    $max=4; //$type->getEvaluationMax();
    
    $evaluation=$request->getParameter('evaluation');
    $dbvalue=$evaluation==''? NULL: $evaluation;
    $this->wpmodulesyllabusitem->setEvaluation($dbvalue);
    $this->wpmodulesyllabusitem->save();
    return $this->renderPartial('syllabi/evaluation', array('id'=>$this->wpmodulesyllabusitem->getId(), 'dbvalue'=>$dbvalue, 'textvalue'=>'', 'min'=>$min, 'max'=>$max));
    
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($syllabus = SyllabusPeer::retrieveByPk($request->getParameter('id')), sprintf('Object syllabus does not exist (%s).', $request->getParameter('id')));
    $syllabus->delete();

    $this->redirect('syllabi/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $syllabus = $form->save();

      $this->redirect('syllabi/edit?id='.$syllabus->getId());
    }
  }
}
