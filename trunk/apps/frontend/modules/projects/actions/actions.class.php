<?php

/**
 * projects actions.
 *
 * @package    schoolmesh
 * @subpackage projects
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

   $this->projects=SchoolprojectPeer::retrieveAllForYear(sfConfig::get('app_config_current_year'));
   $this->steps=Array();
	}
	
	
	
  public function executeEdit(sfWebRequest $request)
  {
	$this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
	
	$this->form = new SchoolprojectForm($this->project); 

	if ($request->isMethod('post'))
		{
			$this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
			$this->form->getValidatorSchema()->setOption('filter_extra_fields', false);
			$this->form->bind($request->getParameter('schoolproject'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project = SchoolprojectPeer::retrieveByPK($params['id']);
				
				$this->project
				->setTitle($params['title'])
				->save();
				
				if (sizeof($params['deadline'])>0)
				{
					foreach($params['deadline'] as $deadline_params)
					{
						$deadline=ProjDeadlinePeer::retrieveByPK($deadline_params['id']);
						$deadline
						->setDescription($deadline_params['description'])
						->setOriginalDeadlineDate(Generic::date_from_array($deadline_params['original_deadline_date']))
						->setCurrentDeadlineDate(Generic::date_from_array($deadline_params['current_deadline_date']))
						->setNotes($deadline_params['notes'])
						->setCompleted(@$deadline_params['completed']=='on')
						->save();
					}
				}

				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Project information updated.')
					);
					
			return $this->redirect('projects/edit?id='. $this->project->getId());
			}
			
		}
		
	if($this->project)
	{
		foreach($this->project->getProjDeadlines() as $index=>$deadline)
		{
			$deadlineForm=new ProjDeadlineForm($deadline);
			$this->form->embedForm('deadline[' . $index . ']', $deadlineForm);
		}
	}
   }  
	
}
