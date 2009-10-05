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
		$this->enrolments=$this->schoolclass->getCurrentEnrolments();
  }

	
}