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


public function executeGrid(sfWebRequest $request)
{
	$action=$request->getParameter('batch_action');
	$this->forward404Unless($this->schoolclass_id = $request->getParameter('id'));
	
	$this->forward404Unless($this->appointment= AppointmentPeer::retrieveByPK($request->getParameter('appointment')));

	$redirectURL='schoolclasses/view?id=' . $this->schoolclass_id . '&appointment=' . $this->appointment->getId();

	if ($action=='')
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must specify an action.'));
			
			$this->redirect($redirectURL);
		}

    $ids = $request->getParameter('ids');
    $this->students = sfGuardUserPeer::retrieveByPks($ids);
	$this->ids=base64_encode(serialize($ids));
	
	if (sizeof($this->students)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least a student.'));
			$this->redirect($redirectURL);
		}

}

	public function executeTickit(sfWebRequest $request)
	{

		$ids = unserialize(base64_decode($request->getParameter('ids')));
		$this->students = sfGuardUserPeer::retrieveByPks($ids);

		$student_id=$request->getParameter('student');
		$wpmodule_item_id=$request->getParameter('item');
		ob_start();

		echo "I was clicked, student is $student_id, item is $wpmodule_item_id\n";
		
		$f=fopen('lorislog.txt', 'a'); fwrite($f, ob_get_contents());fclose($f);ob_end_clean();

		sleep(5);
  	    return $this->renderPartial('ticks', array('students'=>$this->students, 'ids'=>$ids, 'wpmodule_item_id'=>$wpmodule_item_id));

	}

}