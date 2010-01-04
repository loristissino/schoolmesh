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
  }


public function executeBatch(sfWebRequest $request)
{
	$action=$request->getParameter('batch_action');
	
	switch ($action)
	{
		case ('fill_recuperation_grid'):
			$this->forward('schoolclasses', 'fillRecuperationGrid');
		case ('prepare_recuperation_letters'):
			$this->forward('schoolclasses', 'prepareRecuperationLetters');
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

    $ids = $request->getParameter('ids');
    $this->students = sfGuardUserPeer::retrieveByPks($ids);
	$this->ids=base64_encode(serialize($ids));
	
	if (sizeof($this->students)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least a student.'));
			$this->forward('schoolclasses', 'redirect');
		}

}

public function executePrepareRecuperationLetters(sfWebRequest $request)
{
	$this->term_id=sfConfig::get('app_config_current_term');
	$this->forward404Unless($this->term=TermPeer::retrieveByPK($this->term_id));
	
	$this->forward404Unless($this->schoolclass_id = $request->getParameter('id'));
	$this->forward404Unless($this->appointment= AppointmentPeer::retrieveByPK($request->getParameter('appointment')));

    $ids = $request->getParameter('ids');
    $this->students = sfGuardUserPeer::retrieveByPks($ids);
	
	if (sizeof($this->students)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least a student.'));
			$this->forward('schoolclasses', 'redirect');
		}

	$this->doctype=$request->getParameter('doctype', 'odt');
	$this->forward404Unless(in_array($this->doctype, array('odt', 'doc', 'pdf', 'rtf')));
		
	try 
		{
			$odfdoc=$this->appointment->getRecuperationLettersOdf($ids, $this->doctype, $this->getContext(), $request->getParameter('template', ''));
		}
	catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.') . $e->getMessage());
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

		$ids = unserialize(base64_decode($request->getParameter('ids')));
		$this->students = sfGuardUserPeer::retrieveByPks($ids);
		
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

  	    return $this->renderPartial('wpmoduleitem', array('students'=>$this->students, 'ids'=>base64_encode(serialize($ids)), 'wpmodule_item'=>$wpmodule_item, 'term_id'=>$term_id));

	}
	
public function executeSuggestion(sfWebRequest $request)

{
		$ids = unserialize(base64_decode($request->getParameter('ids')));
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
				$appointment->toggleStudentSuggestion($id, $term_id, $suggestion_id);				
			}
			
		}
		else
		{
			
			$appointment->toggleStudentSuggestion($student_id, $term_id, $suggestion_id);
		}

  	    return $this->renderPartial('suggestion', array('suggestion'=>$suggestion, 'students'=>$this->students, 'ids'=>base64_encode(serialize($ids)), 'appointment_id'=>$appointment->getId(), 'term_id'=>$term_id));
	
	
}


}