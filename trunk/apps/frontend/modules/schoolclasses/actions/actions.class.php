<?php

/**
 * schoolclass actions.
 *
 * @package    schoolmesh
 * @subpackage teaching
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class schoolclassesActions extends sfActions
{

	public function executeIndex($request)
  {
		$this->schoolclasses=SchoolclassPeer::retrieveCurrentSchoolclasses();
  }


	public function executeView($request)
  {
		$this->schoolclass_id = $request->getParameter('id');
		$this->forward404Unless($this->schoolclass = SchoolclassPeer::retrieveByPK($this->schoolclass_id));
		$this->appointment_id = $request->getParameter('appointment');
		if ($this->appointment_id)
			{
				$this->forward404Unless($this->appointment = AppointmentPeer::retrieveByPK($this->appointment_id));
				$this->forward404Unless($this->appointment->getSchoolclassId() == $this->schoolclass_id);
				$this->forward404Unless($this->appointment->getUserId() == $this->getUser()->getProfile()->getUserId());
			}
		$this->enrolments=$this->schoolclass->getCurrentEnrolments();
		$this->ids = $this->getUser()->getAttribute('ids', array());

  }


public function executeBatch(sfWebRequest $request)
{
	
	$ids = $request->getParameter('ids');
	$this->getUser()->setAttribute('ids', $ids);

	$action=$request->getParameter('batch_action');
	
	switch ($action)
	{
		case ('fill_recuperation_grid'):
			$this->forward('schoolclasses', 'fillRecuperationGrid');
		case ('get_recuperation_letters'):
			$this->forward('schoolclasses', 'getRecuperationLetters');
		default:
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select an action.'));
			$this->forward('schoolclasses', 'redirect');
	}

}


	public function executeRedirect(sfWebRequest $request)
	{
		$this->forward404Unless($this->schoolclass_id = $request->getParameter('id'));
		$this->forward404Unless($this->appointment= AppointmentPeer::retrieveByPK($request->getParameter('appointment')));
		$redirectURL='schoolclasses/view?id=' . $this->schoolclass_id . '&appointment=' . $this->appointment->getId();
		$this->redirect($redirectURL);
	}

public function executeFillRecuperationGrid(sfWebRequest $request)
{
	
	$this->term_id=sfConfig::get('app_config_current_term');
	$this->forward404Unless($this->term=TermPeer::retrieveByPK($this->term_id));

	$this->suggestions=SuggestionPeer::retrieveAllByRank();
	
	$this->forward404Unless($this->schoolclass_id = $request->getParameter('id'));
	
	$this->forward404Unless($this->appointment= AppointmentPeer::retrieveByPK($request->getParameter('appointment')));
	$this->hints=RecuperationHintPeer::retrieveAllByRankForTeacher($this->appointment->getUserId());
	
	$this->students = sfGuardUserProfilePeer::retrieveByPksSortedByLastnames($this->getUser()->getAttribute('ids'));

//	$this->ids=Generic::b64_serialize($ids);
	
	if (sizeof($this->students)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least a student.'));
			$this->forward('schoolclasses', 'redirect');
		}

  /*
  $this->form=new AssessmentDateForm();
  $this->form->setDefaults(array(
    'id'=>$this->appointment->getId(),
    'assessment_date'=>$this->getUser()->getAttribute('assessment_date')
  ));
  */
  
/*
    $ids = $request->getParameter('ids');
    $this->students = sfGuardUserPeer::retrieveByPks($ids);
	$this->ids=Generic::b64_serialize($ids);
	
	if (sizeof($this->students)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least a student.'));
			$this->forward('schoolclasses', 'redirect');
		}
*/
}

public function executeGetRecuperationLetters(sfWebRequest $request)
{
	$this->term_id=sfConfig::get('app_config_current_term');
	$this->forward404Unless($this->term=TermPeer::retrieveByPK($this->term_id));
	
	$this->forward404Unless($this->schoolclass_id = $request->getParameter('id'));
	$this->forward404Unless($this->appointment= AppointmentPeer::retrieveByPK($request->getParameter('appointment')));

	$this->ids = $this->getUser()->getAttribute('ids');
	$this->students = sfGuardUserPeer::retrieveByPks($this->ids);
	
	if (sizeof($this->students)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least one student.'));
			$this->forward('schoolclasses', 'redirect');
		}

	$this->doctype=$request->getParameter('doctype');
	if (!in_array($this->doctype, array('odt', 'doc', 'pdf', 'rtf')))
	{
		return;
		// we show the page where the user can choose the doctype
	}
	$this->forward404Unless(in_array($this->doctype, array('odt', 'doc', 'pdf', 'rtf')));
		
	try 
		{
			$odfdoc=$this->appointment->getRecuperationLettersOdf($this->ids, $this->doctype, $this->getContext(), $request->getParameter('template', ''));
		}
	catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.') . ' '. $e->getMessage());
			$this->forward('schoolclasses', 'redirect');
		}
		
	try
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;
		}
		catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Conversion failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the contents.'));
			$this->forward('schoolclasses', 'redirect');
		}
	
}


	public function executeTickit(sfWebRequest $request)
	{

		$ids = $this->getUser()->getAttribute('ids');
		
		$this->students = sfGuardUserProfilePeer::retrieveByPksSortedByLastnames($ids);
		
		$term_id=sfConfig::get('app_config_current_term');
	
		$wpmodule_item_id=$request->getParameter('item');
		$wpmodule_item=WpmoduleItemPeer::retrieveByPK($wpmodule_item_id);

		$student_id=$request->getParameter('student');
		
		if ($student_id=='all')
		{
			foreach($ids as $id)
			{
				$wpmodule_item->toggleStudent($id, $term_id);				
			}
			
		}
		else
		{
			
			$wpmodule_item->toggleStudent($student_id, $term_id);
		}

 	    return $this->renderPartial('wpmoduleitem', array('students'=>$this->students, 'wpmodule_item'=>$wpmodule_item, 'term_id'=>$term_id));

	}
	
public function executeSuggestion(sfWebRequest $request)

{
		$ids = $this->getUser()->getAttribute('ids');
		$this->students = sfGuardUserPeer::retrieveByPks($ids);
		
		$term_id=sfConfig::get('app_config_current_term');
		
		$suggestion_id=$request->getParameter('suggestion');
		$suggestion=SuggestionPeer::retrieveByPK($suggestion_id);
	
		$appointment_id=$request->getParameter('appointment');
		$appointment=AppointmentPeer::retrieveByPK($appointment_id);

		$student_id=$request->getParameter('student');
		
		if ($student_id=='all')
		{
			foreach($ids as $id)
			{
				$appointment->toggleStudentSuggestion($id, $term_id, $suggestion);				
			}
			
		}
		else
		{
			
			$appointment->toggleStudentSuggestion($student_id, $term_id, $suggestion);
		}

  	    return $this->renderPartial('suggestion', array('suggestion'=>$suggestion, 'students'=>$this->students, 'ids'=>Generic::b64_serialize($ids), 'appointment_id'=>$appointment->getId(), 'term_id'=>$term_id));
		
}

public function executeHint(sfWebRequest $request)

{
		$ids = $this->getUser()->getAttribute('ids');
		$this->students = sfGuardUserPeer::retrieveByPks($ids);
		
		$term_id=sfConfig::get('app_config_current_term');
		
		$hint_id=$request->getParameter('hint');
		$hint=RecuperationHintPeer::retrieveByPK($hint_id);
	
		$appointment_id=$request->getParameter('appointment');
		$appointment=AppointmentPeer::retrieveByPK($appointment_id);

		$student_id=$request->getParameter('student');
		
		if ($student_id=='all')
		{
			foreach($ids as $id)
			{
				$appointment->toggleStudentRecuperationHint($id, $term_id, $hint);				
			}
			
		}
		else
		{
			
			$appointment->toggleStudentRecuperationHint($student_id, $term_id, $hint);
		}

  	    return $this->renderPartial('hint', array('hint'=>$hint, 'students'=>$this->students, 'ids'=>Generic::b64_serialize($ids), 'appointment_id'=>$appointment->getId(), 'term_id'=>$term_id));
		
}

public function executeEditHintInLine(sfWebRequest $request)
{
		$this->forward404Unless($request->getMethod()=="POST");
		$this->forward404Unless($hint=RecuperationHintPeer::retrieveByPk($request->getParameter('id')));

		$this->forward404Unless($hint->getIsEditable());

		$value=$request->getParameter('value')==''? '...' : $request->getParameter('value');
		$hint
		->setCheckedContent($value)
		->save();

		return $this->renderText($hint->getContent());

}

  public function executeAddhint(sfWebRequest $request)
  {
   $this->forward404Unless($request->getMethod()=="POST");

   $hint=new RecuperationHint();
   $hint
   ->setContent('...')
   ->setRank(100)
   ->setUserId($this->getUser()->getProfile()->getSfGuardUser()->getId())
   ->setIsSelectable(true)
   ->save();
   // FIXME Rank is set to 100, just to have first general hints

   $this->getUser()->setFlash('notice_hints',
$this->getContext()->getI18N()->__('A new item was inserted'));

   $this->redirect($request->getReferer().'#hints');

  }

  public function executeSyllabus(sfWebRequest $request)
  {
		$this->forward404Unless($this->schoolclass = SchoolclassPeer::retrieveByPK($request->getParameter('id')));

    $this->appointments=$this->schoolclass->getCurrentAppointments();
    $this->contributions=$this->schoolclass->getSyllabusContributions();

    // we need to check that all appointments share the same syllabus...
    $syllabus_ids=array();
    foreach($this->appointments as $appointment)
    {
      $syllabus_ids[$appointment->getSyllabusId()]=1;
    }
    
    if(sizeof($syllabus_ids)!=1)
    {
      return sfView::ERROR;
    }
    
    list($this->syllabus_id)=array_keys($syllabus_ids);
    
    $this->syllabus_items=SyllabusPeer::retrieveByPK($this->syllabus_id)->getSyllabusItems();
    
  }

}
